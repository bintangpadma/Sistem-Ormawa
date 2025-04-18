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
            <img src="{{ auth()->user()->student_organization->image_path ? asset('assets/image/student-organization/' . auth()->user()->student_organization->image_path) : 'https://placehold.co/100?text=Image+Not+Found' }}" alt="Profile Image" class="profile-image">
            <input type="file" class="image-input-hidden" id="image_path" name="image_path">
            <div class="button-secondary image-button w-full text-center">Pilih foto</div>
            @error('image_path')
            <p class="text-invalid">{{ $message }}</p>
            @enderror
        </label>
        <div class="menu-profile">
            <h4 class="profile-title">Edit Data Profil</h4>
            <div class="form grid-cols-1 lg:grid-cols-2">
                <div class="form-input">
                    <label for="username">Username</label>
                    <input type="text" class="input" name="username" placeholder="Masukkan username organisasi mahasiswa..." value="{{ auth()->user()->username }}">
                    @error('username')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="email">Email</label>
                    <input type="email" class="input" name="email" placeholder="Masukkan email organisasi mahasiswa..." value="{{ auth()->user()->email }}">
                    @error('email')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="name">Nama Ormawa</label>
                    <input type="text" class="input" name="name" placeholder="Masukkan nama organisasi mahasiswa..." value="{{ auth()->user()->student_organization->name }}">
                    @error('name')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="abbreviation">Singkatan</label>
                    <input type="text" class="input" name="abbreviation" placeholder="Masukkan singkatan organisasi mahasiswa..." value="{{ auth()->user()->student_organization->abbreviation }}">
                    @error('abbreviation')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="description">Deskripsi</label>
                    <textarea class="input" name="description" rows="4" placeholder="Masukkan deskripsi organisasi mahasiswa...">{{ auth()->user()->student_organization->description }}</textarea>
                    @error('description')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <hr class="style-gap lg:col-span-2">
                <div class="form-input">
                    <label for="old_password">Password Lama</label>
                    <input type="password" class="input" name="old_password" placeholder="Masukkan password lama organisasi mahasiswa...">
                    @error('old_password')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="new_password">Password Baru</label>
                    <input type="password" class="input" name="new_password" placeholder="Masukkan password baru organisasi mahasiswa...">
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
