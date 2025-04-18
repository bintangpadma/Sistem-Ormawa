<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRecruitment;
use Illuminate\Http\Request;

class EventRecruitmentController extends Controller
{
    public function index(Event $event, Request $request)
    {
        $search = $request->input('search');
        $eventRecruitments = EventRecruitment::where('events_id', $event->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.event-division.index', [
            'page' => 'Halaman Divisi',
            'eventDivisions' => $eventRecruitments,
            'event' => $event,
            'search' => $search,
        ]);
    }

    public function show(Event $event, EventRecruitment $eventRecruitment)
    {
        return response()->json([
            'status_code' => 200,
            'event' => $event,
            'event_division' => $eventRecruitment,
        ]);
    }

    public function store(Event $event, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:150',
            ]);
            $validatedData['events_id'] = $event->id;
            EventRecruitment::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan divisi baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan divisi baru!');
        }
    }

    public function update(Event $event, EventRecruitment $eventRecruitment, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:150',
            ]);
            $eventRecruitment->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit divisi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit divisi!');
        }
    }

    public function destroy(Event $event, EventRecruitment $eventRecruitment)
    {
        try {
            $eventRecruitment->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus divisi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus divisi!');
        }
    }
}
