@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form class="form lg:!grid-cols-2" enctype="multipart/form-data">
            <div class="form-input">
                <label for="author">Pembuat</label>
                <input type="text" class="input" name="author" value="{{ $activityReport->student_organization ? 'Ormawa: ' . $activityReport->student_organization->name : 'UKM: ' . $activityReport->student_activity_unit->name }}" readonly>
            </div>
            <div class="form-input">
                <label for="name">Nama</label>
                <input type="text" class="input" name="name" value="{{ $activityReport->name }}" readonly>
            </div>
{{--            <div class="form-input">--}}
{{--                <label for="status">Status</label>--}}
{{--                <input type="text" class="input capitalize" name="status" value="{{ $activityReport->status === 'pending' ? 'Tertunda' : ($activityReport->status === 'accepted' ? 'Diterima' : 'Tidak Diterima') }}" readonly>--}}
{{--            </div>--}}
            <div class="form-input lg:col-span-2">
                <label for="description">Deskripsi</label>
                <textarea class="input" name="description" rows="4" readonly>{{ $activityReport->description }}</textarea>
            </div>
            <div class="button-group">
                <a href="{{ route('activity-report.index') }}" class="button-secondary">Kembali ke Halaman Arsip Administrasi</a>
            </div>
        </form>
    </div>
@endsection
