@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form class="form lg:!grid-cols-2">
            @csrf
            <div class="form-input">
                <label for="event_divisions_id">Divisi</label>
                <input type="text" class="input" name="event_divisions_id" value="{{ $eventRecruitment->event_division->name }}" readonly>
            </div>
            <div class="form-input">
                <label for="student_name">Nama Mahasiswa</label>
                <input type="text" class="input" name="student_name" value="{{ $eventRecruitment->student_name }}" readonly>
            </div>
            <div class="form-input">
                <label for="student_code">NIM</label>
                <input type="text" class="input" name="student_code" value="{{ $eventRecruitment->student_code }}" readonly>
            </div>
            <div class="form-input">
                <label for="number_phone">Nomor Telepon</label>
                <input type="text" class="input" name="number_phone" value="{{ $eventRecruitment->number_phone }}" readonly>
            </div>
            <div class="form-input">
                <label for="study_program">Program Studi</label>
                <input type="text" class="input" name="study_program" value="{{ $eventRecruitment->study_program }}" readonly>
            </div>
            <div class="form-input">
                <label for="status">Status</label>
                <input type="text" class="input capitalize" name="status" value="{{ $eventRecruitment->status }}" readonly>
            </div>
            <div class="form-input lg:col-span-2">
                <label for="reason">Motivasi/ Alasan Mengikuti Kepanitiaan</label>
                <textarea rows="4" class="input" name="reason" readonly>{{ $eventRecruitment->reason }}</textarea>
            </div>
            <div class="button-group justify-between">
                <a href="{{ route('event-recruitment.index', $event) }}" class="button-secondary">Kembali ke Halaman Perekrut</a>
                @if($eventRecruitment->status === 'accepted')
                    <a href="{{ route('evaluation.create-form', $eventRecruitment) }}" class="button-primary">Buat Evaluasi</a>
                @endif
            </div>
        </form>
    </div>
@endsection
