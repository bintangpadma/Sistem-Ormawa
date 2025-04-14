@extends('template.dashboard')

@section('content')
    <div class="content-menu p-[16px] lg:p-[20px] border border-light/[0.06] rounded-[4px]">
        <form action="{{ route('admin.update', $admin) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-2 gap-[12px] w-full" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-input lg:col-span-2">
                <label for="profile_path">
                    Foto Admin
                    <div class="wrapper flex items-end gap-2 mt-[8px]">
                        <img src="{{ $admin->profile_path ? asset('assets/image/admin/' . $admin->profile_path) : 'https://placehold.co/100?text=Image+Not+Found' }}" alt="Image Not Found" class="img-preview w-[100px] h-[100px] object-cover aspect-square rounded-[4px]">
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
                <input type="text" class="input" name="username" value="{{ $admin->user->username }}">
                @error('username')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="full_name">Nama Lengkap</label>
                <input type="text" class="input" name="full_name" value="{{ $admin->full_name }}">
                @error('full_name')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" class="input" name="email" value="{{ $admin->user->email }}">
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
                <input type="text" class="input" name="lecturer_code" value="{{ $admin->lecturer_code }}">
                @error('lecturer_code')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="phone_number">Nomor Telepon</label>
                <input type="text" class="input" name="phone_number" value="{{ $admin->phone_number }}">
                @error('phone_number')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="gender">Jenis Kelamin</label>
                <select class="input" name="gender" id="gender">
                    <option value="male" {{ $admin->gender === 'male' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="female" {{ $admin->gender === 'female' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('gender')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="status">Status</label>
                <select class="input" name="status" id="status">
                    <option value="1" {{ $admin->status == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $admin->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('status')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group flex items-center gap-[8px] lg:gap-[12px] lg:col-span-2">
                <button type="submit" class="button-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.index') }}" class="button-secondary">Batal Edit</a>
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
