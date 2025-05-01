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
            <hr class="style-gap lg:col-span-2">
            <div class="form-input">
                <label for="vision">Total Visi</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="vision" value="{{ count($studentActivityUnit->student_activity_unit_visions) }}" readonly>
                    <a href="{{ route('student-activity-unit-vision.index', $studentActivityUnit) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="form-input">
                <label for="mission">Total Misi</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="mission" value="{{ count($studentActivityUnit->student_activity_unit_missions) }}" readonly>
                    <a href="{{ route('student-activity-unit-mission.index', $studentActivityUnit) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="form-input">
                <label for="program">Total Program</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="program" value="{{ count($studentActivityUnit->student_activity_unit_programs) }}" readonly>
                    <a href="{{ route('student-activity-unit-program.index', $studentActivityUnit) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="form-input">
                <label for="structure">Total Struktur</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="structure" value="{{ count($studentActivityUnit->student_activity_unit_structures) }}" readonly>
                    <a href="{{ route('student-activity-unit-structure.index', $studentActivityUnit) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="form-input">
                <label for="achievement">Total Prestasi</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="achievement" value="{{ count($studentActivityUnit->student_activity_unit_achievements) }}" readonly>
                    <a href="{{ route('student-activity-unit-achievement.index', $studentActivityUnit) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="form-input">
                <label for="division">Total Divisi</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="division" value="{{ count($studentActivityUnit->student_activity_unit_divisions) }}" readonly>
                    <a href="{{ route('student-activity-unit-division.index', $studentActivityUnit) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="form-input">
                <label for="news">Berita</label>
                <input type="text" class="input" name="news" value="{{ count($studentActivityUnit->newses) }}" readonly>
            </div>
            <div class="form-input">
                <label for="event">Event</label>
                <input type="text" class="input" name="event" value="{{ count($studentActivityUnit->events) }}" readonly>
            </div>
            <div class="button-group">
                <a href="{{ route('student-activity-unit.index') }}" class="button-secondary">Kembali ke Halaman UKM</a>
            </div>
        </form>
    </div>
@endsection
