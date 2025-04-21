<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventTrackRecord;
use Illuminate\Http\Request;

class EventTrackRecordController extends Controller
{
    public function index(Event $event, Request $request)
    {
        $search = $request->input('search');
        $eventTrackRecords = EventTrackRecord::where('events_id', $event->id)
            ->when($search, function ($query, $search) {
                $query->where('year', 'LIKE', '%' . $search . '%')
                    ->orWhere('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('description', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.event-track-record.index', [
            'page' => 'Halaman Rekam Jejak Event',
            'eventTrackRecords' => $eventTrackRecords,
            'event' => $event,
            'search' => $search,
        ]);
    }

    public function show(Event $event, EventTrackRecord $eventTrackRecord)
    {
        return response()->json([
            'status_code' => 200,
            'event' => $event,
            'event_track_record' => $eventTrackRecord,
            'event_track_record_task' => $eventTrackRecord->load('event_track_record_tasks')->event_track_record_tasks()->count(),
        ]);
    }

    public function store(Event $event, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'year' => 'required|integer',
                'title' => 'required|string|max:150',
                'description' => 'required|string',
            ]);
            $validatedData['events_id'] = $event->id;
            EventTrackRecord::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan rekam jejak event baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan rekam jejak event baru!');
        }
    }

    public function update(Event $event, EventTrackRecord $eventTrackRecord, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'year' => 'required|integer',
                'title' => 'required|string|max:150',
                'description' => 'required|string',
            ]);
            $eventTrackRecord->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit rekam jejak event!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit rekam jejak event!');
        }
    }

    public function destroy(Event $event, EventTrackRecord $eventTrackRecord)
    {
        try {
            $eventTrackRecord->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus rekam jejak event!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus rekam jejak event!');
        }
    }
}
