<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usersCount = User::all()->count();
        $subscriptions = Subscription::all();
        $subscriptionsCount = $subscriptions->count();
        $lastUpdate = ($subscriptionsCount > 0)? $subscriptions->last()->updated_at->format('d.m.Y H:i') : null;
        return view('admin/index', [
            'usersCount' => $usersCount,
            'subscriptionsCount' => $subscriptionsCount,
            'lastUpdate' => $lastUpdate,
        ]);
    }
}
