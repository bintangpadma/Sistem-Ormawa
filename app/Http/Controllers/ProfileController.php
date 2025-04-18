<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('dashboard.profile-admin.index', [
            'page' => 'Halaman Profil'
        ]);
    }

    public function edit()
    {
        return view('dashboard.profile-admin.edit', [
            'page' => 'Halaman Profil',
        ]);
    }

    public function update(Request $request)
    {
        try {
            $validatedDataAdmin = $request->validate([
                'profile_path' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                'lecturer_code' => 'required|string|max:50',
                'full_name' => 'required|string|max:255',
                'phone_number' => 'required|max:15',
                'gender' => 'required|max:25',
            ]);

            $validatedDataUser = $request->validate([
                'username' => 'required|string|max:100',
                'email' => 'required|string|max:255',
                'old_password' => 'nullable|string',
                'new_password' => 'nullable|string',
            ]);

            if ($request->hasFile('profile_path')) {
                $imageFile = $request->file('profile_path');
                $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                if (auth()->user()->admin->profile_path && File::exists(public_path('assets/image/admin/' . auth()->user()->admin->profile_path))) {
                    File::delete(public_path('assets/image/admin/' . auth()->user()->admin->profile_path));
                }
                $imageFile->move(public_path('assets/image/admin'), $imageName);
                $validatedDataAdmin['profile_path'] = $imageName;
            } else {
                $validatedDataAdmin['profile_path'] = auth()->user()->admin->profile_path;
            }

            if (!empty($validatedDataUser['old_password']) && !empty($validatedDataUser['new_password'])) {
                if (!Hash::check($validatedDataUser['old_password'], auth()->user()->password)) {
                    return redirect()->route('profile.edit', auth()->user())->with('failed', "Password lama tidak sesuai!");
                }
                $validatedDataUser['password'] = Hash::make($validatedDataUser['new_password']);
            }

            auth()->user()->admin->update($validatedDataAdmin);
            auth()->user()->update($validatedDataUser);

            return redirect()->route('profile.index')->with('success', 'Berhasil mengedit profil!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit profil!');
        }
    }
}
