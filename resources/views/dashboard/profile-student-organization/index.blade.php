@extends('template.dashboard')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session()->has('failed'))
        <div class="alert alert-danger" role="alert">
            {{ session('failed') }}
        </div>
    @endif
    <form class="content-menu content-profile">
        <div class="menu-profile">
            <img src="{{ auth()->user()->student_organization->image_path ? asset('assets/image/student-organization/' . auth()->user()->student_organization->image_path) : 'https://placehold.co/100?text=Image+Not+Found' }}" alt="Profile Image" class="profile-image">
        </div>
        <div class="menu-profile">
            <h4 class="profile-title">Data Profil</h4>
            <div class="form grid-cols-1 lg:grid-cols-2">
                <div class="form-input">
                    <label for="username">Username</label>
                    <input type="text" class="input" name="username" value="{{ auth()->user()->username }}" readonly>
                </div>
                <div class="form-input">
                    <label for="email">Email</label>
                    <input type="email" class="input" name="email" value="{{ auth()->user()->email }}" readonly>
                </div>
                <div class="form-input">
                    <label for="name">Nama Ormawa</label>
                    <input type="text" class="input" name="name" value="{{ auth()->user()->student_organization->name }}" readonly>
                </div>
                <div class="form-input">
                    <label for="abbreviation">Singkatan</label>
                    <input type="text" class="input" name="abbreviation" value="{{ auth()->user()->student_organization->abbreviation }}" readonly>
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="description">Deskripsi</label>
                    <textarea class="input" name="description" rows="4" readonly>{{ auth()->user()->student_organization->description }}</textarea>
                </div>
                <hr class="style-gap lg:col-span-2">
                <div class="form-input">
                    <label for="vision">Total Visi</label>
                    <div class="input-wrapper">
                        <input type="text" class="input" name="vision" value="{{ count(auth()->user()->student_organization->student_organization_visions) }}" readonly>
                        <a href="{{ route('student-organization-vision.index', auth()->user()->student_organization) }}" class="button-redirect group">
                            <span class="bg-link-move-light group-hover:opacity-100"></span>
                        </a>
                    </div>
                </div>
                <div class="form-input">
                    <label for="mission">Total Misi</label>
                    <div class="input-wrapper">
                        <input type="text" class="input" name="mission" value="{{ count(auth()->user()->student_organization->student_organization_missions) }}" readonly>
                        <a href="{{ route('student-organization-mission.index', auth()->user()->student_organization) }}" class="button-redirect group">
                            <span class="bg-link-move-light group-hover:opacity-100"></span>
                        </a>
                    </div>
                </div>
                <div class="form-input">
                    <label for="program">Total Program</label>
                    <div class="input-wrapper">
                        <input type="text" class="input" name="program" value="{{ count(auth()->user()->student_organization->student_organization_programs) }}" readonly>
                        <a href="{{ route('student-organization-program.index', auth()->user()->student_organization) }}" class="button-redirect group">
                            <span class="bg-link-move-light group-hover:opacity-100"></span>
                        </a>
                    </div>
                </div>
                <div class="form-input">
                    <label for="structure">Total Struktur</label>
                    <div class="input-wrapper">
                        <input type="text" class="input" name="structure" value="{{ count(auth()->user()->student_organization->student_organization_structures) }}" readonly>
                        <a href="{{ route('student-organization-structure.index', auth()->user()->student_organization) }}" class="button-redirect group">
                            <span class="bg-link-move-light group-hover:opacity-100"></span>
                        </a>
                    </div>
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="achievement">Total Prestasi</label>
                    <div class="input-wrapper">
                        <input type="text" class="input" name="achievement" value="{{ count(auth()->user()->student_organization->student_organization_achievements) }}" readonly>
                        <a href="{{ route('student-organization-achievement.index', auth()->user()->student_organization) }}" class="button-redirect group">
                            <span class="bg-link-move-light group-hover:opacity-100"></span>
                        </a>
                    </div>
                </div>
                <div class="form-input">
                    <label for="news">Berita</label>
                    <input type="text" class="input" name="news" value="{{ count(auth()->user()->student_organization->newses) }}" readonly>
                </div>
                <div class="form-input">
                    <label for="event">Event</label>
                    <input type="text" class="input" name="event" value="{{ count(auth()->user()->student_organization->events) }}" readonly>
                </div>
                <div class="button-group">
                    <a href="{{ route('profile.edit') }}" class="button-primary">Edit Profil</a>
                </div>
            </div>
        </div>
    </form>
@endsection
