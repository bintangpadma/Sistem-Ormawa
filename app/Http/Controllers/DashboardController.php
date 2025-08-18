<?php

namespace App\Http\Controllers;

use App\Models\Event;

class DashboardController extends Controller
{
    public function index()
    {
        $events = Event::with(['event_recruitments'])->when(auth()->user()->student_organization, function ($query) {
            $query->where('student_organizations_id', auth()->user()->student_organization->id);
        })->get();
        return view('dashboard.index', [
            'page' => 'Halaman Dashboard',
            'events' => $events,
        ]);
    }
}
