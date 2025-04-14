@extends('template.dashboard')

@section('content')
    <div class="content-menu p-[16px] lg:p-[20px] border border-light/[0.06] rounded-[4px]">
        <form action="{{ route('student-organization.update', $studentOrganization) }}" method="POST" class="grid grid-cols-1 lg:grid-cols-2 gap-[12px] w-full" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-input lg:col-span-2">
                <label for="image_path">
                    Foto Ormawa
                    <div class="wrapper flex items-end gap-2 mt-[8px]">
                        <img src="{{ $studentOrganization->image_path ? asset('assets/image/student-organization/' . $studentOrganization->image_path) : 'https://placehold.co/100?text=Image+Not+Found' }}" alt="Image Not Found" class="img-preview w-[100px] h-[100px] object-cover aspect-square rounded-[4px]">
                        <input type="file" class="absolute opacity-0 top-0 left-0 input-file" id="image_path" name="image_path">
                        <div class="button-secondary cursor-pointer text-[0.875rem] py-[12px] px-[16px]">Pilih foto</div>
                    </div>
                </label>
                @error('image_path')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="username">Username</label>
                <input type="text" class="input" name="username" value="{{ $studentOrganization->user->username }}">
                @error('username')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="name">Nama</label>
                <input type="text" class="input" name="name" value="{{ $studentOrganization->name }}">
                @error('name')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" class="input" name="email" value="{{ $studentOrganization->user->email }}">
                @error('email')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="password">Password</label>
                <input type="password" class="input" name="password" placeholder="Masukkan password ormawa...">
                @error('password')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="abbreviation">Singkatan</label>
                <input type="text" class="input" name="abbreviation" value="{{ $studentOrganization->abbreviation }}">
                @error('abbreviation')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="description">Deskripsi</label>
                <textarea class="input" name="description" rows="4">{{ $studentOrganization->description }}</textarea>
                @error('description')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group flex items-center gap-[8px] lg:gap-[12px] lg:col-span-2">
                <button type="submit" class="button-primary">Simpan Perubahan</button>
                <a href="{{ route('student-organization.index') }}" class="button-secondary">Batal Edit</a>
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
