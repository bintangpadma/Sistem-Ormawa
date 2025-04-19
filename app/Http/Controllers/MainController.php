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

    public function showEvent(Event $event, Request $request)
    {
        $search = $request->input('search');
        return view('homepage.detail-event', [
            'page' => 'Halaman Detail Event',
            'event' => $event->load([
                'student_organization',
                'event_divisions',
                'event_recruitments' => function ($query) {
                    $query->where('status', 'accepted');
                },
            ]),
            'otherEvents' => Event::where('id', '!=', $event->id)->with([
                'student_organization',
                'event_divisions',
                'event_recruitments' => fn($query) => $query->where('status', 'accepted'),
            ])->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('description', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('student_organization', function ($q) use ($search) {
                            $q->where('name', 'LIKE', '%' . $search . '%')
                                ->orWhere('abbreviation', 'LIKE', '%' . $search . '%');
                        });
                });
            })->latest()->get(),
            'search' => $search,
        ]);
    }
}
