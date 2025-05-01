@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form class="form lg:!grid-cols-2" enctype="multipart/form-data">
            <div class="form-input lg:col-span-2">
                <label>
                    Foto Berita
                    <span class="input-image">
                        <img src="{{ $news->image_path ? asset('assets/image/news/' . $news->image_path) : 'https://placehold.co/100?text=Image+Not+Found' }}" alt="Image Not Found" class="image-preview">
                    </span>
                </label>
            </div>
            <div class="form-input">
                <label for="author">Pembuat</label>
                <input type="text" class="input" name="author" value="{{ $news->student_organization ? 'Ormawa: ' . $news->student_organization->name : 'UKM: ' . $news->student_activity_unit->name }}" readonly>
            </div>
            <div class="form-input">
                <label for="name">Nama Berita</label>
                <input type="text" class="input" name="name" value="{{ $news->name }}" readonly>
            </div>
            <div class="form-input lg:col-span-2">
                <label for="description">Deskripsi</label>
                <textarea class="input" name="description" rows="4" readonly>{{ $news->description }}</textarea>
            </div>
            <div class="button-group">
                <a href="{{ route('news.index') }}" class="button-secondary">Kembali ke Halaman Berita</a>
            </div>
        </form>
    </div>
@endsection
