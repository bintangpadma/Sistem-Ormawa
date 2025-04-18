<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\StudentOrganization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $isStudentOrganization = auth()->user()->student_organization;
        $events = Event::with(['student_organization', 'event_divisions', 'event_recruitments'])
            ->when($isStudentOrganization, function ($query) use ($isStudentOrganization) {
                $query->where('student_organizations_id', $isStudentOrganization->id);
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('description', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('student_organization', function ($q) use ($search) {
                            $q->where('name', 'LIKE', '%' . $search . '%')
                                ->orWhere('abbreviation', 'LIKE', '%' . $search . '%');
                        });
                });
            })
            ->latest()
            ->paginate(10);

        return view('dashboard.event.index', [
            'page' => 'Halaman Event',
            'events' => $events,
            'search' => $search,
        ]);
    }

    public function show(Event $event)
    {
        $event->load(['student_organization', 'event_divisions', 'event_recruitments']);

        return view('dashboard.event.detail', [
            'page' => 'Halaman Detail Event',
            'event' => $event,
        ]);
    }

    public function create()
    {
        $studentOrganizations = StudentOrganization::latest()->get();

        return view('dashboard.event.create', [
            'page' => 'Halaman Tambah Event',
            'studentOrganizations' => $studentOrganizations,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'image_path' => 'required|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'student_organizations_id' => 'required',
                'name' => 'required|string|max:150',
                'description' => 'required|string',
            ]);

            if ($request->hasFile('image_path')) {
                $imageFile = $request->file('image_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('assets/image/event'), $imageName);
                $validatedData['image_path'] = $imageName;
            }

            Event::create($validatedData);

            return redirect()->route('event.index')->with('success', 'Berhasil menambahkan event baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan event baru!');
        }
    }

    public function edit(Event $event)
    {
        $event->load(['student_organization', 'event_divisions', 'event_recruitments']);
        $studentOrganizations = StudentOrganization::latest()->get();

        return view('dashboard.event.edit', [
            'page' => 'Halaman Edit Event',
            'event' => $event,
            'studentOrganizations' => $studentOrganizations,
        ]);
    }

    public function update(Request $request, Event $event)
    {
        try {
            $validatedData = $request->validate([
                'image_path' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'student_organizations_id' => 'required',
                'name' => 'required|string|max:150',
                'description' => 'required|string',
            ]);

            if ($request->hasFile('image_path')) {
                $imageFile = $request->file('image_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                if ($event->image_path && File::exists(public_path('assets/image/event/' . $event->image_path))) {
                    File::delete(public_path('assets/image/event/' . $event->image_path));
                }
                $imageFile->move(public_path('assets/image/event'), $imageName);
                $validatedData['image_path'] = $imageName;
            } else {
                $validatedData['image_path'] = $event->image_path;
            }

            $event->update($validatedData);
            return redirect()->route('event.index')->with('success', 'Berhasil mengedit event!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit event!');
        }
    }

    public function destroy(Event $event)
    {
        try {
            if ($event->image_path && File::exists(public_path('assets/image/event/' . $event->image_path))) {
                File::delete(public_path('assets/image/event/' . $event->image_path));
            }
            $event->delete();
            return redirect()->route('event.index')->with('success', 'Berhasil menghapus event!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus event!');
        }
    }
}
