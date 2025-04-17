@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        @if(session()->has('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <form action="{{ route('student-organization.store') }}" method="POST" class="form lg:!grid-cols-2" enctype="multipart/form-data">
            @csrf
            <div class="form-input lg:col-span-2">
                <label>
                    Foto Admin
                    <span class="input-image">
                        <img src="https://placehold.co/100?text=Image+Not+Found" alt="Image Not Found" class="image-preview">
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
                <input type="text" class="input" name="username" placeholder="Masukkan username ormawa...">
                @error('username')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="name">Nama</label>
                <input type="text" class="input" name="name" placeholder="Masukkan nama ormawa...">
                @error('name')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" class="input" name="email" placeholder="Masukkan email ormawa...">
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
                <input type="text" class="input" name="abbreviation" placeholder="Masukkan singkatan ormawa...">
                @error('abbreviation')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="description">Deskripsi</label>
                <textarea class="input" name="description" placeholder="Masukkan deskripsi ormawa..." rows="4"></textarea>
                @error('description')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group">
                <button type="submit" class="button-primary">Tambah Ormawa</button>
                <a href="{{ route('student-organization.index') }}" class="button-secondary">Batal Tambah</a>
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
