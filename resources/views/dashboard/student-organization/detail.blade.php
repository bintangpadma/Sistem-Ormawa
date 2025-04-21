@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form class="form lg:!grid-cols-2" enctype="multipart/form-data">
            <div class="form-input lg:col-span-2">
                <label>
                    Foto Ormawa
                    <span class="input-image">
                        <img src="{{ $studentOrganization->image_path ? asset('assets/image/student-organization/' . $studentOrganization->image_path) : 'https://placehold.co/100?text=Image+Not+Found' }}" alt="Image Not Found" class="image-preview">
                    </span>
                </label>
            </div>
            <div class="form-input">
                <label for="username">Username</label>
                <input type="text" class="input" name="username" value="{{ $studentOrganization->user->username }}" readonly>
            </div>
            <div class="form-input">
                <label for="name">Nama</label>
                <input type="text" class="input" name="name" value="{{ $studentOrganization->name }}" readonly>
            </div>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" class="input" name="email" value="{{ $studentOrganization->user->email }}" readonly>
            </div>
            <div class="form-input">
                <label for="abbreviation">Singkatan</label>
                <input type="text" class="input" name="abbreviation" value="{{ $studentOrganization->abbreviation }}" readonly>
            </div>
            <div class="form-input lg:col-span-2">
                <label for="description">Deskripsi</label>
                <textarea class="input" name="description" rows="4" readonly>{{ $studentOrganization->description }}</textarea>
            </div>
            <hr class="style-gap lg:col-span-2">
            <div class="form-input">
                <label for="vision">Total Visi</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="vision" value="{{ count($studentOrganization->student_organization_visions) }}" readonly>
                    <a href="{{ route('student-organization-vision.index', $studentOrganization) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="form-input">
                <label for="mission">Total Misi</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="mission" value="{{ count($studentOrganization->student_organization_missions) }}" readonly>
                    <a href="{{ route('student-organization-mission.index', $studentOrganization) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="form-input">
                <label for="program">Total Program</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="program" value="{{ count($studentOrganization->student_organization_programs) }}" readonly>
                    <a href="{{ route('student-organization-program.index', $studentOrganization) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="form-input">
                <label for="structure">Total Struktur</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="structure" value="{{ count($studentOrganization->student_organization_structures) }}" readonly>
                    <a href="{{ route('student-organization-structure.index', $studentOrganization) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="form-input">
                <label for="achievement">Total Prestasi</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="achievement" value="{{ count($studentOrganization->student_organization_achievements) }}" readonly>
                    <a href="{{ route('student-organization-achievement.index', $studentOrganization) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="form-input">
                <label for="division">Total Divisi</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="division" value="{{ count($studentOrganization->student_organization_divisions) }}" readonly>
                    <a href="{{ route('student-organization-division.index', $studentOrganization) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="form-input">
                <label for="news">Berita</label>
                <input type="text" class="input" name="news" value="{{ count($studentOrganization->newses) }}" readonly>
            </div>
            <div class="form-input">
                <label for="event">Event</label>
                <input type="text" class="input" name="event" value="{{ count($studentOrganization->events) }}" readonly>
            </div>
            <div class="button-group">
                <a href="{{ route('student-organization.index') }}" class="button-secondary">Kembali ke Halaman Ormawa</a>
            </div>
        </form>
    </div>
@endsection
