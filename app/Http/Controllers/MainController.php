<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\News;
use App\Models\StudentActivityUnit;
use App\Models\StudentOrganization;
use App\Models\StudentOrganizationProgram;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('homepage.index', [
            'page' => 'Halaman Beranda',
            'studentOrganizations' => StudentOrganization::latest()->get(),
            'studentActivityUnits' => StudentActivityUnit::latest()->get(),
            'studentOrganizationPrograms' => StudentOrganizationProgram::with('student_organization')->latest()->get(),
            'events' => Event::latest()->get(),
        ]);
    }
}
