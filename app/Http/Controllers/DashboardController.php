<?php

namespace App\Http\Controllers;

use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role == 'Admin') {
            $events = Event::latest()->get();
        } else {
            $events = Event::where('user_id', $user->id)->latest()->get();
        }

        return view('pages.dashboard', compact('events'));
    }

    public function adminDashboard()
    {
        $events = Event::latest()->take(4)->get();
        return view('pages.admin_dashboard', compact('events'));
    }
}
