@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form action="{{ route('admin.update', $admin) }}" method="POST" class="form lg:!grid-cols-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-input lg:col-span-2">
                <label>
                    Foto Admin
                    <span class="input-image">
                        <img src="{{ $admin->profile_path ? asset('assets/image/admin/' . $admin->profile_path) : 'https://placehold.co/100?text=Image+Not+Found' }}" alt="Image Not Found" class="image-preview">
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
                <input type="password" class="input" name="password" placeholder="Ganti password admin...">
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
            <div class="button-group">
                <button type="submit" class="button-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.index') }}" class="button-secondary">Batal Edit</a>
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
