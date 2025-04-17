@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        @if(session()->has('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <form action="{{ route('admin.store') }}" method="POST" class="form lg:!grid-cols-2" enctype="multipart/form-data">
            @csrf
            <div class="form-input lg:col-span-2">
                <label>
                    Foto Admin
                    <span class="input-image">
                        <img src="https://placehold.co/100?text=Image+Not+Found" alt="Image Not Found" class="image-preview">
                        <input type="file" class="image-input-hidden" id="profile_path" name="profile_path">
                        <div class="button-secondary image-button">Pilih foto</div>
                    </span>
                </label>
                @error('profile_path')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="username">Username</label>
                <input type="text" class="input" name="username" placeholder="Masukkan username admin...">
                @error('username')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="full_name">Nama Lengkap</label>
                <input type="text" class="input" name="full_name" placeholder="Masukkan nama lengkap admin...">
                @error('full_name')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" class="input" name="email" placeholder="Masukkan email admin...">
                @error('email')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="password">Password</label>
                <input type="password" class="input" name="password" placeholder="Masukkan password admin...">
                @error('password')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="lecturer_code">NIP/NIM</label>
                <input type="text" class="input" name="lecturer_code" placeholder="Masukkan nip/nim admin...">
                @error('lecturer_code')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="phone_number">Nomor Telepon</label>
                <input type="text" class="input" name="phone_number" placeholder="Masukkan nomor telepon admin...">
                @error('phone_number')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="gender">Jenis Kelamin</label>
                <select class="input" name="gender" id="gender">
                    <option value="">Masukkan nomor telepon admin...</option>
                    <option value="male">Laki-Laki</option>
                    <option value="female">Perempuan</option>
                </select>
                @error('gender')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group">
                <button type="submit" class="button-primary">Tambah Admin</button>
                <a href="{{ route('admin.index') }}" class="button-secondary">Batal Tambah</a>
            </div>
        </form>
    </div>

    <script>
        const imagePreview = document.querySelector('.image-preview');
        const imageInput = document.querySelector('.image-input-hidden');

        imageInput.addEventListener('change', function() {
            imagePreview.src = URL.createObjectURL(imageInput.files[0]);
        });
    </script>
@endsection
