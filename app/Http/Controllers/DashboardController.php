<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\News;
use App\Models\StudentActivityUnit;
use App\Models\StudentOrganization;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $studentOrganizationCount = StudentOrganization::all()->count();
        $studentActivityUnitCount = StudentActivityUnit::all()->count();
        $newsCount = News::all()->count();
        $eventCount = Event::all()->count();
        return view('dashboard.index', [
            'page' => 'Halaman Dashboard',
            'studentOrganizationCount' => $studentOrganizationCount,
            'studentActivityUnitCount' => $studentActivityUnitCount,
            'newsCount' => $newsCount,
            'eventCount' => $eventCount,
        ]);
    }
}
