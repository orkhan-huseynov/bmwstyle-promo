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
            $subscriptions = Subscription::where('user_id', $userId)->orderBy('period_start', 'asc')->get();
        } else {
            $subscriptions = Subscription::orderBy('period_start', 'asc')->get();
        }

        $lastUpdate = (count($subscriptions) > 0)? $subscriptions->last()->updated_at->format('d.m.Y H:i') : null;
        $filterUsers = User::all();

//        $baxa = User::findOrFail(6);
//        $baxa->password = bcrypt('Baxa2018!');
//        $baxa->group_id = 1;
//        $baxa->save();

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

    function subscriptionsReport()
    {
        $groupedData = Subscription::get()->groupBy(function ($d) {
           return $d->period_start->format('n');
        })->map(function ($value) {
            return $value->count();
        });

        return response()->json([
            'responseCode' => 1,
            'responseMessage' => $groupedData,
        ]);
    }

    function checkCardNumber()
    {
        $cardNumber = filter_input(INPUT_GET, 'cardNumber', FILTER_SANITIZE_STRING);

        $user = User::where('card_number', $cardNumber)->get()->first();

        if ($user == null) {
            return view('card-check-not-found', [
                'cardNumber' => $cardNumber,
            ]);
        }

        $subscriptions = Subscription::where('user_id', $user->id)
                                        ->where('is_active', true)
                                        ->where('period_start', Carbon::now()->startOfMonth())
                                        ->get();

        $hasSubscription = ($subscriptions->count() > 0);
        $isVip = ($hasSubscription && $subscriptions->first()->is_vip);

        return view('card-check', [
            'cardNumber' => $cardNumber,
            'hasSubscription' => $hasSubscription,
            'user' => $user,
            'isVip' => $isVip,
        ]);
    }
}
