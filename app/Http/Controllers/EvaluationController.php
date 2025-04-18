<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\EventRecruitment;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $evaluations = Evaluation::with(['event_recruitment.event', 'event_recruitment.event_division'])
            ->when($search, function ($query, $search) {
                $query->where('assessment', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('event_recruitment', function ($query) use ($search) {
                        $query->where(function ($subQuery) use ($search) {
                            $subQuery->where('status', 'accepted')
                                ->where(function ($q) use ($search) {
                                    $q->where('student_name', 'LIKE', '%' . $search . '%')
                                        ->orWhere('student_code', 'LIKE', '%' . $search . '%')
                                        ->orWhere('number_phone', 'LIKE', '%' . $search . '%')
                                        ->orWhere('study_program', 'LIKE', '%' . $search . '%')
                                        ->orWhereHas('event', function ($q2) use ($search) {
                                            $q2->where('name', 'LIKE', '%' . $search . '%');
                                        })
                                        ->orWhereHas('event_division', function ($q2) use ($search) {
                                            $q2->where('name', 'LIKE', '%' . $search . '%');
                                        });
                                });
                        });
                    });
            })
            ->latest()
            ->paginate(10);

        return view('dashboard.evaluation.index', [
            'page' => 'Halaman Evaluasi Panitia',
            'evaluations' => $evaluations,
            'search' => $search,
        ]);
    }

    public function show(Evaluation $evaluation)
    {
        $evaluation->load(['event_recruitment.event', 'event_recruitment.event_division']);

        return view('dashboard.evaluation.detail', [
            'page' => 'Halaman Detail Evaluasi Panitia',
            'evaluation' => $evaluation,
        ]);
    }

    public function create(EventRecruitment $eventRecruitment)
    {
        $eventRecruitment->load('event');

        return view('dashboard.evaluation.create', [
            'page' => 'Halaman Tambah Evaluasi Panitia',
            'eventRecruitment' => $eventRecruitment,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'event_recruitments_id' => 'required',
                'assessment' => 'required|string|max:50',
                'criticism' => 'required|string',
                'suggestion' => 'required|string',
            ]);

            if (Evaluation::where('event_recruitments_id', $validatedData['event_recruitments_id'])->exists()) {
                return redirect()->route('evaluation.index')->with('failed', 'Evaluasi pada panitia ini sudah ada!');
            }

            Evaluation::create($validatedData);

            return redirect()->route('evaluation.index')->with('success', 'Berhasil menambahkan evaluasi baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan evaluasi baru!');
        }
    }

    public function edit(Evaluation $evaluation)
    {
        $evaluation->load(['event_recruitment.event', 'event_recruitment.event_division']);

        return view('dashboard.evaluation.edit', [
            'page' => 'Halaman Edit Evaluasi Panitia',
            'evaluation' => $evaluation,
        ]);
    }

    public function update(Request $request, Evaluation $evaluation)
    {
        try {
            $validatedData = $request->validate([
                'assessment' => 'required|string|max:50',
                'criticism' => 'required|string',
                'suggestion' => 'required|string',
            ]);
            $evaluation->update($validatedData);

            return redirect()->route('evaluation.index')->with('success', 'Berhasil mengedit evaluasi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit evaluasi!');
        }
    }

    public function destroy(Evaluation $evaluation)
    {
        try {
            $evaluation->delete();
            return redirect()->route('evaluation.index')->with('success', 'Berhasil menghapus evaluasi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus evaluasi!');
        }
    }
}
