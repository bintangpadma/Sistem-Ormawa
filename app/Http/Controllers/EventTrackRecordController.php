<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventTrackRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        ]);
    }

    public function store(Event $event, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'image_path' => 'required|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'year' => 'required|integer',
                'title' => 'required|string',
                'description' => 'required|string',
            ]);

            if ($request->hasFile('image_path')) {
                $imageFile = $request->file('image_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('assets/image/track-record'), $imageName);
                $validatedData['image_path'] = $imageName;
            }

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
                'image_path' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'year' => 'required|integer',
                'title' => 'required|string',
                'description' => 'required|string',
            ]);

            if ($request->hasFile('image_path')) {
                $imageFile = $request->file('image_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                if ($eventTrackRecord->image_path && File::exists(public_path('assets/image/track-record/' . $eventTrackRecord->image_path))) {
                    File::delete(public_path('assets/image/track-record/' . $eventTrackRecord->image_path));
                }
                $imageFile->move(public_path('assets/image/track-record'), $imageName);
                $validatedData['image_path'] = $imageName;
            } else {
                $validatedData['image_path'] = $eventTrackRecord->image_path;
            }

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
            if ($eventTrackRecord->image_path && File::exists(public_path('assets/image/track-record/' . $eventTrackRecord->image_path))) {
                File::delete(public_path('assets/image/track-record/' . $eventTrackRecord->image_path));
            }
            $eventTrackRecord->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus rekam jejak event!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus rekam jejak event!');
        }
    }
}
