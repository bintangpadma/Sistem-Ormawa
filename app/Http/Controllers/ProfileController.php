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
        $view = auth()->user()->admin ? 'dashboard.profile-admin.index' : (auth()->user()->student_organization ? 'dashboard.profile-student-organization.index' : 'dashboard.profile-student-activity-unit.index');

        return view($view, [
            'page' => 'Halaman Profil'
        ]);
    }

    public function edit()
    {
        $view = auth()->user()->admin ? 'dashboard.profile-admin.edit' : (auth()->user()->student_organization ? 'dashboard.profile-student-organization.edit' : 'dashboard.profile-student-activity-unit.edit');

        return view($view, [
            'page' => 'Halaman Edit Profil',
        ]);
    }

    public function update(Request $request)
    {
        try {
            $validatedDataUser = $request->validate([
                'username' => 'required|string|max:100',
                'email' => 'required|string|max:255',
                'old_password' => 'nullable|string',
                'new_password' => 'nullable|string',
            ]);

            if (auth()->user()->admin) {
                $validatedDataAdmin = $request->validate([
                    'profile_path' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                    'lecturer_code' => 'required|string|max:50',
                    'full_name' => 'required|string|max:255',
                    'phone_number' => 'required|max:15',
                    'gender' => 'required|max:25',
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

                auth()->user()->admin->update($validatedDataAdmin);
            } else if (auth()->user()->student_organization) {
                $validatedDataStudentOrganization = $request->validate([
                    'image_path' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                    'name' => 'required|string|max:100',
                    'abbreviation' => 'required|string|max:50',
                    'description' => 'required|string',
                ]);

                if ($request->hasFile('image_path')) {
                    $imageFile = $request->file('image_path');
                    $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                    if (auth()->user()->student_organization->image_path && File::exists(public_path('assets/image/student-organization/' . auth()->user()->student_organization->image_path))) {
                        File::delete(public_path('assets/image/student-organization/' . auth()->user()->student_organization->image_path));
                    }
                    $imageFile->move(public_path('assets/image/student-organization'), $imageName);
                    $validatedDataStudentOrganization['image_path'] = $imageName;
                } else {
                    $validatedDataStudentOrganization['image_path'] = auth()->user()->student_organization->image_path;
                }

                auth()->user()->student_organization->update($validatedDataStudentOrganization);
            } else if (auth()->user()->student_activity_unit) {
                $validatedDataStudentActivityUnit = $request->validate([
                    'image_path' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
                    'name' => 'required|string|max:100',
                    'abbreviation' => 'required|string|max:50',
                    'description' => 'required|string',
                ]);

                if ($request->hasFile('image_path')) {
                    $imageFile = $request->file('image_path');
                    $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
                    if (auth()->user()->student_activity_unit->image_path && File::exists(public_path('assets/image/student-activity-unit/' . auth()->user()->student_activity_unit->image_path))) {
                        File::delete(public_path('assets/image/student-activity-unit/' . auth()->user()->student_activity_unit->image_path));
                    }
                    $imageFile->move(public_path('assets/image/student-activity-unit'), $imageName);
                    $validatedDataStudentActivityUnit['image_path'] = $imageName;
                } else {
                    $validatedDataStudentActivityUnit['image_path'] = auth()->user()->student_activity_unit->image_path;
                }

                auth()->user()->student_activity_unit->update($validatedDataStudentActivityUnit);
            }

            if (!empty($validatedDataUser['old_password']) && !empty($validatedDataUser['new_password'])) {
                if (!Hash::check($validatedDataUser['old_password'], auth()->user()->password)) {
                    return redirect()->route('profile.edit', auth()->user())->with('failed', "Password lama tidak sesuai!");
                }
                $validatedDataUser['password'] = Hash::make($validatedDataUser['new_password']);
            }

            auth()->user()->update($validatedDataUser);

            return redirect()->route('profile.index')->with('success', 'Berhasil mengedit profil!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect()->back()->with('failed', 'Gagal mengedit profil!');
        }
    }
}
