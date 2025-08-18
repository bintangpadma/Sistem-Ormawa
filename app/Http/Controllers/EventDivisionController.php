<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventDivision;
use Illuminate\Http\Request;

class EventDivisionController extends Controller
{
    public function index(Event $event, Request $request)
    {
        $search = $request->input('search');
        $eventDivisions = EventDivision::where('events_id', $event->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })->orderBy('sort', 'asc')->paginate(10);

        return view('dashboard.event-division.index', [
            'page' => 'Halaman Divisi',
            'eventDivisions' => $eventDivisions,
            'event' => $event,
            'search' => $search,
        ]);
    }

    public function show(Event $event, EventDivision $eventDivision)
    {
        return response()->json([
            'status_code' => 200,
            'event' => $event,
            'event_division' => $eventDivision,
        ]);
    }

    public function store(Event $event, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'sort' => 'required|integer',
            ]);
            $validatedData['events_id'] = $event->id;
            EventDivision::create($validatedData);

            return redirect()->back()->with('success', 'Berhasil menambahkan divisi baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan divisi baru!');
        }
    }

    public function update(Event $event, EventDivision $eventDivision, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'sort' => 'required|integer',
            ]);
            $eventDivision->update($validatedData);

            return redirect()->back()->with('success', 'Berhasil mengedit divisi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit divisi!');
        }
    }

    public function destroy(Event $event, EventDivision $eventDivision)
    {
        try {
            $eventDivision->delete();

            return redirect()->back()->with('success', 'Berhasil menghapus divisi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus divisi!');
        }
    }
}
