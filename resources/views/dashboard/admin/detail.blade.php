@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form class="form lg:!grid-cols-2" enctype="multipart/form-data">
            <div class="form-input lg:col-span-2">
                <label>
                    Foto Admin
                    <span class="input-image">
                        <img src="{{ $admin->profile_path ? asset('assets/image/admin/' . $admin->profile_path) : 'https://placehold.co/100?text=Image+Not+Found' }}" alt="Image Not Found" class="image-preview">
                    </span>
                </label>
            </div>
            <div class="form-input">
                <label for="username">Username</label>
                <input type="text" class="input" name="username" value="{{ $admin->user->username }}" readonly>
            </div>
            <div class="form-input">
                <label for="full_name">Nama Lengkap</label>
                <input type="text" class="input" name="full_name" value="{{ $admin->full_name }}" readonly>
            </div>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" class="input" name="email" value="{{ $admin->user->email }}" readonly>
            </div>
            <div class="form-input">
                <label for="lecturer_code">NIP/NIM</label>
                <input type="text" class="input" name="lecturer_code" value="{{ $admin->lecturer_code }}" readonly>
            </div>
            <div class="form-input">
                <label for="phone_number">Nomor Telepon</label>
                <input type="text" class="input" name="phone_number" value="{{ $admin->phone_number }}" readonly>
            </div>
            <div class="form-input">
                <label for="gender">Jenis Kelamin</label>
                <input type="text" class="input" name="gender" value="{{ $admin->gender === 'male' ? 'Laki-Laki' : 'Perempuan' }}" readonly>
            </div>
            <div class="form-input">
                <label for="status">Status</label>
                <input type="text" class="input" name="status" value="{{ $admin->status ? 'Aktif' : 'Tidak Aktif' }}" readonly>
            </div>
            <div class="form-input">
                <label for="is_super_admin">Super Admin</label>
                <input type="text" class="input" name="is_super_admin" value="{{ $admin->is_super_admin ? 'Iya' : 'Tidak' }}" readonly>
            </div>
            <div class="button-group">
                <a href="{{ route('admin.index') }}" class="button-secondary">Kembali ke Halaman Admin</a>
            </div>
        </form>
    </div>
@endsection
