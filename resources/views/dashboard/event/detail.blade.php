@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form class="form lg:!grid-cols-2" enctype="multipart/form-data">
            <div class="form-input lg:col-span-2">
                <label>
                    Foto Event
                    <span class="input-image">
                        <img src="{{ $event->image_path ? asset('assets/image/event/' . $event->image_path) : 'https://placehold.co/100?text=Image+Not+Found' }}" alt="Image Not Found" class="image-preview">
                    </span>
                </label>
            </div>
            <div class="form-input lg:col-span-2">
                <label for="author">Pembuat</label>
                <input type="text" class="input" name="author" value="{{ $event->student_organization ? 'Ormawa: ' . $event->student_organization->name : 'UKM: ' . $event->student_activity_unit->name }}" readonly>
            </div>
            <div class="form-input">
                <label for="name">Nama Event</label>
                <input type="text" class="input" name="name" value="{{ $event->name }}" readonly>
            </div>
            <div class="form-input">
                <label for="link_group_wa">Link Grup WA</label>
                <input type="text" class="input" name="link_group_wa" value="{{ $event->link_group_wa }}" readonly>
            </div>
            <div class="form-input">
                <label for="protector">Pelindung</label>
                <input type="text" class="input" name="protector" value="{{ $event->protector }}" readonly>
            </div>
            <div class="form-input">
                <label for="responsible_person">Penanggung Jawab</label>
                <input type="text" class="input" name="responsible_person" value="{{ $event->responsible_person }}" readonly>
            </div>
            <div class="form-input lg:col-span-2">
                <label for="steering_committee_chair">Ketua Steering Committee</label>
                <input type="text" class="input" name="steering_committee_chair" value="{{ $event->steering_committee_chair }}" readonly>
            </div>
            <div class="form-input lg:col-span-2">
                <label for="description">Deskripsi</label>
                <textarea class="input" name="description" rows="4" readonly>{{ $event->description }}</textarea>
            </div>
            <hr class="style-gap lg:col-span-2">
            <div class="form-input">
                <label for="division">Total Divisi Dibutuhkan</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="division" value="{{ count($event->event_divisions) }}" readonly>
                    <a href="{{ route('event-division.index', $event) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="form-input">
                <label for="recruitment">Total Mahasiswa Registrasi</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="recruitment" value="{{ count($event->event_recruitments) }}" readonly>
                    <a href="{{ route('event-recruitment.index', $event) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="form-input lg:col-span-2">
                <label for="track-record">Total Rekam Jejak</label>
                <div class="input-wrapper">
                    <input type="text" class="input" name="track-record" value="{{ count($event->event_track_records) }}" readonly>
                    <a href="{{ route('event-track-record.index', $event) }}" class="button-redirect group">
                        <span class="bg-link-move-light group-hover:opacity-100"></span>
                    </a>
                </div>
            </div>
            <div class="button-group">
                <a href="{{ route('event.index') }}" class="button-secondary">Kembali ke Halaman Event</a>
            </div>
        </form>
    </div>
@endsection
