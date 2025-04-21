<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventTrackRecord;
use App\Models\EventTrackRecordTask;
use Illuminate\Http\Request;

class EventTrackRecordTaskController extends Controller
{
    public function index(Event $event, EventTrackRecord $eventTrackRecord, Request $request)
    {
        $search = $request->input('search');
        $eventTrackRecordTasks = EventTrackRecordTask::where('event_track_records_id', $eventTrackRecord->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.event-track-record-task.index', [
            'page' => 'Halaman Tugas Rekam Jejak Event',
            'eventTrackRecordTasks' => $eventTrackRecordTasks,
            'event' => $event,
            'eventTrackRecord' => $eventTrackRecord,
            'search' => $search,
        ]);
    }

    public function show(Event $event, EventTrackRecord $eventTrackRecord, EventTrackRecordTask $eventTrackRecordTask)
    {
        return response()->json([
            'status_code' => 200,
            'event' => $event,
            'eventTrackRecord' => $eventTrackRecord,
            'event_track_record_task' => $eventTrackRecordTask,
        ]);
    }

    public function store(Event $event, EventTrackRecord $eventTrackRecord, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:150',
            ]);
            $validatedData['event_track_records_id'] = $eventTrackRecord->id;
            EventTrackRecordTask::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan tugas rekam jejak event baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan tugas rekam jejak event baru!');
        }
    }

    public function update(Event $event, EventTrackRecord $eventTrackRecord, EventTrackRecordTask $eventTrackRecordTask, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:150',
            ]);
            $eventTrackRecordTask->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit tugas rekam jejak event!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit tugas rekam jejak event!');
        }
    }

    public function destroy(Event $event, EventTrackRecord $eventTrackRecord, EventTrackRecordTask $eventTrackRecordTask)
    {
        try {
            $eventTrackRecordTask->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus tugas rekam jejak event!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus tugas rekam jejak event!');
        }
    }
}
