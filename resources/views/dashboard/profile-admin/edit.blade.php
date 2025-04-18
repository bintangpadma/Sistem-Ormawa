@extends('template.dashboard')

@section('content')
    @if(session()->has('failed'))
        <div class="alert alert-danger" role="alert">
            {{ session('failed') }}
        </div>
    @endif
    <form action="{{ route('profile.update') }}" method="POST" class="content-menu content-profile" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label class="menu-profile flex flex-col gap-[6px] lg:gap-[8px] input-image">
            <img src="{{ auth()->user()->admin ? (auth()->user()->admin->profile_path ? asset('assets/image/admin/' . auth()->user()->admin->profile_path) : 'https://placehold.co/100?text=Image+Not+Found') : (auth()->user()->student_organization->profile_path ? asset('assets/image/student-organization/' . auth()->user()->student_organization->profile_path) : 'https://placehold.co/100?text=Image+Not+Found') }}" alt="Profile Image" class="profile-image">
            <input type="file" class="image-input-hidden" id="profile_path" name="profile_path">
            <div class="button-secondary image-button w-full text-center">Pilih foto</div>
            @error('profile_path')
            <p class="text-invalid">{{ $message }}</p>
            @enderror
        </label>
        <div class="menu-profile">
            <h4 class="profile-title">Edit Data Profil</h4>
            <div class="form grid-cols-1 lg:grid-cols-2">
                <div class="form-input">
                    <label for="username">Username</label>
                    <input type="text" class="input" name="username" placeholder="Masukkan username admin..." value="{{ auth()->user()->username }}">
                    @error('username')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="full_name">Nama Lengkap</label>
                    <input type="text" class="input" name="full_name" placeholder="Masukkan nama lengkap admin..." value="{{ auth()->user()->admin->full_name }}">
                    @error('full_name')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="email">Email</label>
                    <input type="email" class="input" name="email" placeholder="Masukkan email admin..." value="{{ auth()->user()->email }}">
                    @error('email')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="lecturer_code">NIP/NIM</label>
                    <input type="text" class="input" name="lecturer_code" placeholder="Masukkan nip/nim admin..." value="{{ auth()->user()->admin->lecturer_code }}">
                    @error('lecturer_code')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="phone_number">Nomor Telepon</label>
                    <input type="text" class="input" name="phone_number" placeholder="Masukkan nomor telepon admin..." value="{{ auth()->user()->admin->phone_number }}">
                    @error('phone_number')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="gender">Jenis Kelamin</label>
                    <select class="input" name="gender" id="gender">
                        <option value="male" {{ auth()->user()->admin->gender === 'male' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="female" {{ auth()->user()->admin->gender === 'female' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <hr class="style-gap lg:col-span-2">
                <div class="form-input">
                    <label for="old_password">Password Lama</label>
                    <input type="password" class="input" name="old_password" placeholder="Masukkan password lama admin...">
                    @error('old_password')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="new_password">Password Baru</label>
                    <input type="password" class="input" name="new_password" placeholder="Masukkan password baru admin...">
                    @error('new_password')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit" class="button-primary">Simpan Perubahan</button>
                    <a href="{{ route('profile.index') }}" class="button-secondary">Batal Edit</a>
                </div>
            </div>
        </div>
    </form>

    <script>
        const imagePreview = document.querySelector('.profile-image');
        const imageInput = document.querySelector('.image-input-hidden');

        imageInput.addEventListener('change', function() {
            imagePreview.src = URL.createObjectURL(imageInput.files[0]);
        });
    </script>
@endsection
