<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Subscription;
use App\User;

class SubscriptionController extends Controller
{
    public function index(int $userId = 0)
    {
        if ($userId > 0) {
            $subscriptions = Subscription::where('user_id', $userId)->orderBy('created_at', 'desc')->get();
        } else {
            $subscriptions = Subscription::orderBy('created_at', 'desc')->get();
        }

        $lastUpdate = (count($subscriptions) > 0)? $subscriptions->last()->updated_at->format('d.m.Y H:i') : null;
        $filterUsers = User::all();

        return view('admin/subscriptions', [
            'subscriptions' => $subscriptions,
            'filterUsers' => $filterUsers,
            'lastUpdate' => $lastUpdate,
            'filterUserId' => $userId,
        ]);
    }

    public function add()
    {
        $users = User::all();
        return view('admin/subscriptions-add', [
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'userId' => 'numeric|min:1',
            'period' => 'size:7',
        ]);

        $user = User::findOrFail($request->userId);
        $periodStart = Carbon::createFromFormat('d/m/Y', '01/'.$request->period)->startOfMonth();
        $periodEnd = $periodStart->copy()->endOfMonth();
        $isVip = ($request->isVip == 'on');

        $existingSubscriptionsCount = Subscription::where('user_id', $user->id)->where('period_start', $periodStart)->count();
        if ($existingSubscriptionsCount > 0) {
            return view('admin/subscriptions-error', [
                'errorTitle' => 'Error adding subscription',
                'errorMessage' => 'Subscription for period ' . $periodStart->format('d.m.Y') . ' - ' . $periodEnd->format('d.m.Y') . ' already exists',
            ]);
        }

        $subscription = new Subscription();
        $subscription->user_id = $user->id;
        $subscription->period_start = $periodStart;
        $subscription->period_end = $periodEnd;
        $subscription->is_vip = $isVip;
        $subscription->is_active = true;
        $subscription->save();

        return redirect('/admin/subscriptions');
    }

    public function edit(int $subscriptionId) {
        $subscription = Subscription::findOrFail($subscriptionId);
        $users = User::all();

        return view('admin/subscriptions-edit', [
            'subscription' => $subscription,
            'users' => $users,
        ]);
    }

    public function update(Request $request, int $subscriptionId)
    {
        $subscription = Subscription::findOrFail($subscriptionId);

        $request->validate([
            'userId' => 'numeric|min:1',
            'period' => 'size:7',
        ]);

        $user = User::findOrFail($request->userId);
        $periodStart = Carbon::createFromFormat('d/m/Y', '01/'.$request->period)->startOfMonth();
        $periodEnd = $periodStart->copy()->endOfMonth();

        $existingSubscriptionsCount = Subscription::where('user_id', $user->id)->where('period_start', $periodStart)->where('id', '<>', $subscriptionId)->count();
        if ($existingSubscriptionsCount > 0) {
            return view('admin/subscriptions-error', [
                'errorTitle' => 'Error updating subscription',
                'errorMessage' => 'Subscription for period ' . $periodStart->format('d.m.Y') . ' - ' . $periodEnd->format('d.m.Y') . ' already exists',
            ]);
        }

        $isVip = ($request->isVip == 'on');
        $isActive = ($request->isActive == 'on');

        $subscription->user_id = $user->id;
        $subscription->period_start = $periodStart;
        $subscription->period_end = $periodEnd;
        $subscription->is_vip = $isVip;
        $subscription->is_active = $isActive;
        $subscription->save();

        return redirect('/admin/subscriptions');
    }

    function destroy(int $subscriptionId)
    {
        $subscription = Subscription::findOrFail($subscriptionId);
        $subscription->delete();

        return response()->json([
            'responseCode' => 1,
            'responseMessage' => 'ok',
        ]);
    }
}
