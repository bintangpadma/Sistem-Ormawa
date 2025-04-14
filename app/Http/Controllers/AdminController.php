<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $admins = Admin::with('user')
            ->when($search, function ($query, $search) {
                $query->where('full_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('lecturer_code', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone_number', 'LIKE', '%' . $search . '%')
                    ->orWhere('gender', 'LIKE', '%' . $search . '%');
            })->latest()->paginate(10);

        return view('dashboard.admin.index', [
            'page' => 'Halaman Admin',
            'admins' => $admins,
            'search' => $search,
        ]);
    }

    public function show(Admin $admin)
    {
        $admin->load('user');

        return view('dashboard.admin.detail', [
            'page' => 'Halaman Detail Admin',
            'admin' => $admin,
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.create', [
            'page' => 'Halaman Tambah Admin',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedDataAdmin = $request->validate([
                'profile_path' => 'required|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'lecturer_code' => 'required|string|max:50',
                'full_name' => 'required|string|max:255',
                'phone_number' => 'required|max:15',
                'gender' => 'required|max:25',
            ]);

            $validatedDataUser = $request->validate([
                'username' => 'required|string|max:100',
                'email' => 'required|string|max:255',
                'password' => 'required|string',
            ]);

            if ($request->hasFile('profile_path')) {
                $imageFile = $request->file('profile_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                $imageFile->move(public_path('assets/image/admin'), $imageName);
                $validatedDataAdmin['profile_path'] = $imageName;
            }

            $validatedDataUser['password'] = Hash::make($validatedDataUser['password']);
            $admin = Admin::create($validatedDataAdmin);
            $validatedDataUser['admins_id'] = $admin->id;
            User::create($validatedDataUser);

            return redirect()->route('admin.index')->with('success', 'Berhasil menambahkan admin baru!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menambahkan admin baru!');
        }
    }

    public function edit(Admin $admin)
    {
        $admin->load('user');

        return view('dashboard.admin.edit', [
            'page' => 'Halaman Edit Admin',
            'admin' => $admin,
        ]);
    }

    public function update(Request $request, Admin $admin)
    {
        try {
            $admin->load('user');
            $validatedDataAdmin = $request->validate([
                'profile_path' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'lecturer_code' => 'required|string|max:50',
                'full_name' => 'required|string|max:255',
                'phone_number' => 'required|max:15',
                'gender' => 'required|max:25',
                'status' => 'required|integer',
            ]);

            $validatedDataUser = $request->validate([
                'username' => 'required|string|max:100',
                'email' => 'required|string|max:255',
                'password' => 'nullable|string',
            ]);

            if ($request->hasFile('profile_path')) {
                $imageFile = $request->file('profile_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                if ($admin->profile_path && File::exists(public_path('assets/image/admin/' . $admin->profile_path))) {
                    File::delete(public_path('assets/image/admin/' . $admin->profile_path));
                }
                $imageFile->move(public_path('assets/image/admin'), $imageName);
                $validatedDataAdmin['profile_path'] = $imageName;
            } else {
                $validatedDataAdmin['profile_path'] = $admin->profile_path;
            }

            if (!empty($validatedDataUser['password'])) {
                $validatedDataUser['password'] = Hash::make($validatedDataUser['password']);
            } else {
                unset($validatedDataUser['password']);
            }
            $admin->update($validatedDataAdmin);
            $admin->user->update($validatedDataUser);

            return redirect()->route('admin.index')->with('success', 'Berhasil mengedit admin!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit admin!');
        }
    }

    public function destroy(Admin $admin)
    {
        try {
            $admin->load('user');
            if ($admin->profile_path && File::exists(public_path('assets/image/admin/' . $admin->profile_path))) {
                File::delete(public_path('assets/image/admin/' . $admin->profile_path));
            }
            $admin->user->delete();
            $admin->delete();
            return redirect()->route('admin.index')->with('success', 'Berhasil menghapus admin!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal menghapus admin!');
        }
    }
}
