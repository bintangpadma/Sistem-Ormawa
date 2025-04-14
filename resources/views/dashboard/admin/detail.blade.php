@extends('template.dashboard')

@section('content')
    <div class="content-menu p-[16px] lg:p-[20px] border border-light/[0.06] rounded-[4px]">
        <form class="grid grid-cols-1 lg:grid-cols-2 gap-[12px] w-full" enctype="multipart/form-data">
            <div class="form-input lg:col-span-2">
                <label for="profile_path">
                    Foto Admin
                    <div class="wrapper flex items-end gap-2 mt-[8px]">
                        <img src="{{ $admin->profile_path ? asset('assets/image/admin/' . $admin->profile_path) : 'https://placehold.co/100?text=Image+Not+Found' }}" alt="Image Not Found" class="img-preview w-[100px] h-[100px] object-cover aspect-square rounded-[4px]">
                    </div>
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
            <div class="button-group flex items-center gap-[8px] lg:gap-[12px] lg:col-span-2">
                <a href="{{ route('admin.index') }}" class="button-secondary">Kembali ke Halaman Admin</a>
            </div>
        </form>
    </div>

    <script>
        const tagImage = document.querySelector('.img-preview');
        const inputImage = document.querySelector('.input-file');

        inputImage.addEventListener('change', function() {
            tagImage.src = URL.createObjectURL(inputImage.files[0]);
        });
    </script>
@endsection
