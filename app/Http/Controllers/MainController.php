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

    public function showRecruitment(Event $event)
    {
        return view('homepage.recruitment', [
            'page' => 'Halaman Daftar Event',
            'event' => $event->load(['student_organization', 'event_divisions']),
        ]);
    }

    public function showOrmawa(StudentOrganization $studentOrganization)
    {
        return view('homepage.detail-ormawa', [
            'page' => 'Halaman Detail Organisasi Mahasiswa',
            'studentOrganization' => $studentOrganization->load([
                'user',
                'student_organization_visions',
                'student_organization_missions',
                'student_organization_programs',
                'student_organization_structures',
                'student_organization_achievements',
            ]),
        ]);
    }
}
