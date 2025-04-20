<?php

namespace App\Http\Controllers;

use App\Models\InfoCommittee;
use App\Models\InfoCommitteeDivision;
use Illuminate\Http\Request;

class InfoCommitteeDivisionController extends Controller
{
    public function index(InfoCommittee $infoCommittee, Request $request)
    {
        $search = $request->input('search');
        $infoCommitteeDivisions = InfoCommitteeDivision::where('info_committees_id', $infoCommittee->id)
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('definition', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.info-committee-division.index', [
            'page' => 'Halaman Info Panitia Divisi',
            'infoCommitteeDivisions' => $infoCommitteeDivisions,
            'infoCommittee' => $infoCommittee,
            'search' => $search,
        ]);
    }

    public function show(InfoCommittee $infoCommittee, InfoCommitteeDivision $infoCommitteeDivision)
    {
        return response()->json([
            'status_code' => 200,
            'info_committee' => $infoCommittee,
            'info_committee_division' => $infoCommitteeDivision,
        ]);
    }

    public function store(InfoCommittee $infoCommittee, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:50',
                'definition' => 'required|string',
            ]);
            $validatedData['info_committees_id'] = $infoCommittee->id;
            InfoCommitteeDivision::create($validatedData);
            return redirect()->back()->with('success', 'Berhasil menambahkan info panitia divisi baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan info panitia divisi baru!');
        }
    }

    public function update(InfoCommittee $infoCommittee, InfoCommitteeDivision $infoCommitteeDivision, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:50',
                'definition' => 'required|string',
            ]);
            $infoCommitteeDivision->update($validatedData);
            return redirect()->back()->with('success', 'Berhasil mengedit info panitia divisi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit info panitia divisi!');
        }
    }

    public function destroy(InfoCommittee $infoCommittee, InfoCommitteeDivision $infoCommitteeDivision)
    {
        try {
            $infoCommitteeDivision->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus info panitia divisi!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus info panitia divisi!');
        }
    }
}
