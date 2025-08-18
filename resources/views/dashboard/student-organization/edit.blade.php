@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form action="{{ route('student-organization.update', $studentOrganization) }}" method="POST" class="form lg:!grid-cols-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-input lg:col-span-2">
                <label>
                    Foto Ormawa
                    <span class="input-image">
                        <img src="{{ $studentOrganization->image_path ? asset('assets/image/student-organization/' . $studentOrganization->image_path) : 'https://placehold.co/100?text=Image+Not+Found' }}" alt="Image Not Found" class="img-preview w-[100px] h-[100px] object-cover aspect-square rounded-[4px]">
                        <input type="file" class="image-input-hidden" id="image_path" name="image_path">
                        <div class="button-secondary image-button">Pilih foto</div>
                    </span>
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
                <input type="password" class="input" name="password" placeholder="Ganti password ormawa...">
                @error('password')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="abbreviation">Singkatan</label>
                <input type="text" class="input" name="abbreviation" value="{{ $studentOrganization->abbreviation }}">
                @error('abbreviation')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="sort">Urutan</label>
                <input type="text" class="input" name="sort" value="{{ $studentOrganization->sort }}">
                @error('sort')
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
            <div class="button-group">
                <button type="submit" class="button-primary">Simpan Perubahan</button>
                <a href="{{ route('student-organization.index') }}" class="button-secondary">Batal Edit</a>
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
