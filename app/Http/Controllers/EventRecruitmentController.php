<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventDivision;
use App\Models\EventRecruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRecruitmentEmail;

class EventRecruitmentController extends Controller
{
    public function index(Event $event, Request $request)
    {
        $search = $request->input('search');
        $eventRecruitments = EventRecruitment::where('events_id', $event->id)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('student_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('student_code', 'LIKE', '%' . $search . '%')
                        ->orWhere('number_phone', 'LIKE', '%' . $search . '%')
                        ->orWhere('study_program', 'LIKE', '%' . $search . '%')
                        ->orWhere('class', 'LIKE', '%' . $search . '%')
                        ->orWhere('year_appointment', 'LIKE', '%' . $search . '%')
                        ->orWhere('reason', 'LIKE', '%' . $search . '%')
                        ->orWhere('status', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('event_division', function ($q) use ($search) {
                            $q->where('name', 'LIKE', '%' . $search . '%');
                        })
                    ;
                });
            })->latest()->paginate(10);

        return view('dashboard.event-recruitment.index', [
            'page' => 'Halaman Perekrutan',
            'eventRecruitments' => $eventRecruitments,
            'event' => $event,
            'search' => $search,
        ]);
    }

    public function show(Event $event, EventRecruitment $eventRecruitment)
    {
        return view('dashboard.event-recruitment.detail', [
            'page' => 'Halaman Detail Perekrutan',
            'eventRecruitment' => $eventRecruitment,
            'event' => $event,
        ]);
    }

    public function create(Event $event)
    {
        $eventDivisions = EventDivision::where('events_id', $event->id)->latest()->get();

        return view('dashboard.event-recruitment.create', [
            'page' => 'Halaman Tambah Perekrutan',
            'eventDivisions' => $eventDivisions,
            'event' => $event,
        ]);
    }

    public function store(Event $event, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'event_divisions_id' => 'required',
                'student_name' => 'required|string|max:255',
                'student_code' => 'required|string|max:50',
                'email' => 'required|email:dns|max:255',
                'number_phone' => 'required|string|max:15',
                'study_program' => 'required|string|max:50',
                'class' => 'required|string|max:25',
                'year_appointment' => 'required|string',
                'reason' => 'required|string',
            ]);
            $validatedData['events_id'] = $event->id;
            EventRecruitment::create($validatedData);
            if (auth()->check()) {
                return redirect()->route('event-recruitment.index', $event)->with('success', 'Berhasil mendaftar panitia event!');
            } else {
                return redirect()->back()->with('success', 'Berhasil mendaftar panitia event!');
            }
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mendaftar panitia event!');
        }
    }

    public function edit(Event $event, EventRecruitment $eventRecruitment)
    {
        $eventDivisions = EventDivision::where('events_id', $event->id)->latest()->get();

        return view('dashboard.event-recruitment.edit', [
            'page' => 'Halaman Edit Perekrutan',
            'eventRecruitment' => $eventRecruitment,
            'eventDivisions' => $eventDivisions,
            'event' => $event,
        ]);
    }

    public function update(Event $event, EventRecruitment $eventRecruitment, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'student_name' => 'required|string|max:255',
                'student_code' => 'required|string|max:50',
                'email' => 'required|email:dns|max:255',
                'number_phone' => 'required|string|max:15',
                'study_program' => 'required|string|max:50',
                'class' => 'required|string|max:25',
                'year_appointment' => 'required|string',
                'reason' => 'required|string',
                'status' => 'required|string',
            ]);
            $eventRecruitment->update($validatedData);
            if ($validatedData['status'] === 'accepted') {
                $this->sendRecruitmentEmail($eventRecruitment->id, 'accepted');
            } else if ($validatedData['status'] === 'rejected') {
                $this->sendRecruitmentEmail($eventRecruitment->id, 'rejected');
            }
            return redirect()->route('event-recruitment.index', $event)->with('success', 'Berhasil mengedit perekrut!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit perekrut!');
        }
    }

    public function destroy(Event $event, EventRecruitment $eventRecruitment)
    {
        try {
            $eventRecruitment->delete();

            return redirect()->back()->with('success', 'Berhasil menghapus perekrut!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus perekrut!');
        }
    }

    public function sendRecruitmentEmail(int $id, string $status)
    {
        $eventRecruitment = EventRecruitment::with(['event', 'event_division'])->where('id', $id)->firstOrFail();

        $data = [
            'student_name' => $eventRecruitment->student_name,
            'student_code' => $eventRecruitment->student_code,
            'event' => $eventRecruitment->event->name,
            'event_division' => $eventRecruitment->event_division->name,
            'link_group_wa' => $eventRecruitment->event->link_group_wa,
            'status' => $status,
            'from_email' => env('MAIL_FROM_ADDRESS'),
            'from_name' => 'Admin ' . $eventRecruitment->event->name,
        ];

        Mail::to($eventRecruitment->email)->send(new SendRecruitmentEmail($data));
    }
}
