@extends('template.dashboard')

@section('content')
    <div class="content-menu p-[16px] lg:p-[20px] border border-light/[0.06] rounded-[4px]">
        @if(session()->has('failed'))
            <div class="alert alert-danger w-full mb-3" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <form action="{{ route('admin.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-2 gap-[12px] w-full" enctype="multipart/form-data">
            @csrf
            <div class="form-input lg:col-span-2">
                <label for="profile_path">
                    Foto Admin
                    <div class="wrapper flex items-end gap-2 mt-[8px]">
                        <img src="https://placehold.co/100?text=Image+Not+Found" alt="Image Not Found" class="img-preview w-[100px] h-[100px] object-cover aspect-square rounded-[4px]">
                        <input type="file" class="absolute opacity-0 top-0 left-0 input-file" id="profile_path" name="profile_path">
                        <div class="button-secondary cursor-pointer text-[0.875rem] py-[12px] px-[16px]">Pilih foto</div>
                    </div>
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
            <div class="button-group flex items-center gap-[8px] lg:gap-[12px] lg:col-span-2">
                <button type="submit" class="button-primary">Tambah Admin</button>
                <a href="{{ route('admin.index') }}" class="button-secondary">Batal Tambah</a>
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
