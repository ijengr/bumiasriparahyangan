<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // quick stats
        $totalMessages = Message::count();
        $unreadMessages = Message::where('is_read', false)->count();
        $totalUnits = class_exists(Unit::class) ? Unit::count() : 0;
        $totalUsers = class_exists(User::class) ? User::count() : 0;

        // messages per month for last 12 months
        $months = collect();
        $counts = collect();
        $unreadCounts = collect();
        for ($i = 11; $i >= 0; $i--) {
            $dt = Carbon::now()->startOfMonth()->subMonths($i);
            $label = $dt->format('M Y');
            $months->push($label);
            $counts->push(Message::whereYear('created_at', $dt->year)->whereMonth('created_at', $dt->month)->count());
            $unreadCounts->push(Message::whereYear('created_at', $dt->year)->whereMonth('created_at', $dt->month)->where('is_read', false)->count());
        }

    $latestMessages = Message::orderBy('created_at','desc')->limit(3)->get();

    return view('admin.dashboard', compact('totalMessages','unreadMessages','totalUnits','totalUsers','months','counts','unreadCounts','latestMessages'));
    }
}
