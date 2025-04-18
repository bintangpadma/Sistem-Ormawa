@extends('template.dashboard')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session()->has('failed'))
        <div class="alert alert-danger" role="alert">
            {{ session('failed') }}
        </div>
    @endif
    <form class="content-menu content-profile">
        <div class="menu-profile">
            <img src="{{ auth()->user()->admin ? (auth()->user()->admin->profile_path ? asset('assets/image/admin/' . auth()->user()->admin->profile_path) : 'https://placehold.co/100?text=Image+Not+Found') : (auth()->user()->student_organization->profile_path ? asset('assets/image/student-organization/' . auth()->user()->student_organization->profile_path) : 'https://placehold.co/100?text=Image+Not+Found') }}" alt="Profile Image" class="profile-image">
        </div>
        <div class="menu-profile">
            <h4 class="profile-title">Data Profil</h4>
            <div class="form grid-cols-1 lg:grid-cols-2">
                <div class="form-input">
                    <label for="username">Username</label>
                    <input type="text" class="input" name="username" value="{{ auth()->user()->username }}" readonly>
                </div>
                <div class="form-input">
                    <label for="full_name">Nama Lengkap</label>
                    <input type="text" class="input" name="full_name" value="{{ auth()->user()->admin->full_name }}" readonly>
                </div>
                <div class="form-input">
                    <label for="email">Email</label>
                    <input type="email" class="input" name="email" value="{{ auth()->user()->email }}" readonly>
                </div>
                <div class="form-input">
                    <label for="lecturer_code">NIP/NIM</label>
                    <input type="text" class="input" name="lecturer_code" value="{{ auth()->user()->admin->lecturer_code }}" readonly>
                </div>
                <div class="form-input">
                    <label for="phone_number">Nomor Telepon</label>
                    <input type="text" class="input" name="phone_number" value="{{ auth()->user()->admin->phone_number }}" readonly>
                </div>
                <div class="form-input">
                    <label for="gender">Jenis Kelamin</label>
                    <input type="text" class="input" name="gender" value="{{ auth()->user()->admin->gender === 'male' ? 'Laki-Laki' : 'Perempuan' }}" readonly>
                </div>
                <div class="form-input">
                    <label for="status">Status</label>
                    <input type="text" class="input" name="status" value="{{ auth()->user()->admin->status ? 'Aktif' : 'Tidak Aktif' }}" readonly>
                </div>
                <div class="form-input">
                    <label for="is_super_admin">Super Admin</label>
                    <input type="text" class="input" name="is_super_admin" value="{{ auth()->user()->admin->is_super_admin ? 'Iya' : 'Tidak' }}" readonly>
                </div>
                <div class="button-group">
                    <a href="{{ route('profile.edit') }}" class="button-primary">Edit Profil</a>
                </div>
            </div>
        </div>
    </form>
@endsection
