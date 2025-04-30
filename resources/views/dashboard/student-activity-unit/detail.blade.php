@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form class="form lg:!grid-cols-2" enctype="multipart/form-data">
            <div class="form-input lg:col-span-2">
                <label>
                    Foto UKM
                    <span class="input-image">
                        <img src="{{ $studentActivityUnit->image_path ? asset('assets/image/student-activity-unit/' . $studentActivityUnit->image_path) : 'https://placehold.co/100?text=Image+Not+Found' }}" alt="Image Not Found" class="image-preview">
                    </span>
                </label>
            </div>
            <div class="form-input">
                <label for="username">Username</label>
                <input type="text" class="input" name="username" value="{{ $studentActivityUnit->user->username }}" readonly>
            </div>
            <div class="form-input">
                <label for="name">Nama</label>
                <input type="text" class="input" name="name" value="{{ $studentActivityUnit->name }}" readonly>
            </div>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" class="input" name="email" value="{{ $studentActivityUnit->user->email }}" readonly>
            </div>
            <div class="form-input">
                <label for="abbreviation">Singkatan</label>
                <input type="text" class="input" name="abbreviation" value="{{ $studentActivityUnit->abbreviation }}" readonly>
            </div>
            <div class="form-input lg:col-span-2">
                <label for="description">Deskripsi</label>
                <textarea class="input" name="description" rows="4" readonly>{{ $studentActivityUnit->description }}</textarea>
            </div>
            <div class="button-group">
                <a href="{{ route('student-activity-unit.index') }}" class="button-secondary">Kembali ke Halaman UKM</a>
            </div>
        </form>
    </div>
@endsection
