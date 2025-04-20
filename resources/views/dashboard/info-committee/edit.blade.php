@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form action="{{ route('news.update', $news) }}" method="POST" class="form lg:!grid-cols-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-input lg:col-span-2">
                <label>
                    Foto Berita
                    <span class="input-image">
                        <img src="{{ $news->image_path ? asset('assets/image/news/' . $news->image_path) : 'https://placehold.co/100?text=Image+Not+Found' }}" alt="Image Not Found" class="image-preview">
                        <input type="file" class="image-input-hidden" id="image_path" name="image_path">
                        <div class="button-secondary image-button">Pilih foto</div>
                    </span>
                </label>
                @error('image_path')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            @if(auth()->user()->admin)
                <div class="form-input">
                    <label for="student_organizations_id">Organisasi Mahasiswa</label>
                    <select class="input" name="student_organizations_id" id="student_organizations_id">
                        @foreach($studentOrganizations as $studentOrganization)
                            <option value="{{ $studentOrganization->id }}" {{ $news->student_organizations_id === $studentOrganization->id ? 'selected' : '' }}>{{ $studentOrganization->name }}</option>
                        @endforeach
                    </select>
                    @error('student_organizations_id')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
            @elseif(auth()->user()->student_organization)
                <input type="hidden" name="student_organizations_id" value="{{ auth()->user()->student_organization->id }}">
            @endif
            <div class="form-input {{ auth()->user()->student_organization ? 'lg:col-span-2' : '' }}">
                <label for="name">Nama Berita</label>
                <input type="text" class="input" name="name" placeholder="Masukkan nama berita..." value="{{ $news->name }}">
                @error('name')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="description">Deskripsi</label>
                <textarea class="input" name="description" placeholder="Masukkan deskripsi berita..." rows="4">{{ $news->description }}</textarea>
                @error('description')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group">
                <button type="submit" class="button-primary">Simpan Perubahan</button>
                <a href="{{ route('news.index') }}" class="button-secondary">Batal Edit</a>
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
