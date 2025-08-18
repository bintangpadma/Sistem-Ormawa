<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventTrackRecord;
use App\Models\InfoCommittee;
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
            'studentOrganizations' => StudentOrganization::with('student_organization_programs')->orderBy('sort', 'asc')->get(),
            'studentActivityUnits' => StudentActivityUnit::latest()->get(),
            'studentOrganizationPrograms' => StudentOrganizationProgram::with('student_organization')->latest()->get(),
            'events' => Event::latest()->get(),
            'newses' => News::latest()->get(),
        ]);
    }

    public function showRecruitment(Event $event)
    {
        return view('homepage.recruitment', [
            'page' => 'Halaman Daftar Event',
            'event' => $event->load(['student_organization', 'event_divisions']),
        ]);
    }

    public function showStudentOrganization(StudentOrganization $studentOrganization)
    {
        $eventIds = $studentOrganization->load('events')->events->pluck('id')->toArray();
        $eventTrackRecords = EventTrackRecord::whereIn('events_id', $eventIds)->get();

        return view('homepage.detail-student-organization', [
            'page' => 'Halaman Detail Organisasi Mahasiswa',
            'studentOrganization' => $studentOrganization->load([
                'user',
                'student_organization_visions',
                'student_organization_missions',
                'student_organization_programs',
                'student_organization_structures',
                'student_organization_achievements',
                'student_organization_divisions.student_organization_division_tasks',
                'events.event_track_records',
            ]),
            'eventTrackRecords' => $eventTrackRecords
        ]);
    }

    public function showStudentActivityUnit(StudentActivityUnit $studentActivityUnit)
    {
        $eventIds = $studentActivityUnit->load('events')->events->pluck('id')->toArray();
        $eventTrackRecords = EventTrackRecord::whereIn('events_id', $eventIds)->get();

        return view('homepage.detail-student-activity-unit', [
            'page' => 'Halaman Detail UKM',
            'studentActivityUnit' => $studentActivityUnit->load([
                'user',
                'student_activity_unit_visions',
                'student_activity_unit_missions',
                'student_activity_unit_programs',
                'student_activity_unit_structures',
                'student_activity_unit_achievements',
                'student_activity_unit_divisions.student_activity_unit_division_tasks',
                'events.event_track_records',
            ]),
            'eventTrackRecords' => $eventTrackRecords
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

    public function showNews(News $news, Request $request)
    {
        $search = $request->input('search');
        return view('homepage.detail-news', [
            'page' => 'Halaman Detail Berita',
            'news' => $news->load(['student_organization']),
            'otherNewses' => News::where('id', '!=', $news->id)->with(['student_organization'])
                ->when($search, function ($query, $search) {
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

    public function showInfo(Request $request)
    {
        return view('homepage.detail-info', [
            'page' => 'Halaman Detail Berita',
            'infoCommittee' => InfoCommittee::with('info_committee_divisions.info_committee_division_tasks')->latest()->first(),
        ]);
    }
}
