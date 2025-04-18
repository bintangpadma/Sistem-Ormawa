@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form method="POST" class="form lg:!grid-cols-2">
            @csrf
            <input type="hidden" name="event_recruitments_id" value="{{ $evaluation->event_recruitment->id }}">
            <div class="form-input">
                <label for="student_name">Nama Mahasiswa</label>
                <input type="text" class="input" name="student_name" value="{{ $evaluation->event_recruitment->student_name }}" readonly>
            </div>
            <div class="form-input">
                <label for="student_code">NIM</label>
                <input type="text" class="input" name="student_code" value="{{ $evaluation->event_recruitment->student_code }}" readonly>
            </div>
            <div class="form-input">
                <label for="number_phone">Nomor Telepon</label>
                <input type="text" class="input" name="number_phone" value="{{ $evaluation->event_recruitment->number_phone }}" readonly>
            </div>
            <div class="form-input">
                <label for="study_program">Program Studi</label>
                <input type="text" class="input" name="study_program" value="{{ $evaluation->event_recruitment->study_program }}" readonly>
            </div>
            <hr class="style-gap lg:col-span-2">
            <div class="form-input lg:col-span-2">
                <label for="assessment">Penilaian</label>
                <input type="text" class="input" name="assessment" value="{{ $evaluation->assessment === 'excellent' ? 'Sangat Bagus' : ($evaluation->assessment === 'good' ? 'Bagus' : ($evaluation->assessment === 'poor' ? 'Buruk' : 'Sangat Buruk')) }}" readonly>
            </div>
            <div class="form-input lg:col-span-2">
                <label for="criticism">Kritik</label>
                <textarea rows="4" class="input" name="criticism" readonly>{{ $evaluation->criticism }}</textarea>
            </div>
            <div class="form-input lg:col-span-2">
                <label for="suggestion">Saran</label>
                <textarea rows="4" class="input" name="suggestion" readonly>{{ $evaluation->suggestion }}</textarea>
            </div>
            <div class="button-group">
                <a href="{{ route('evaluation.index',) }}" class="button-secondary">Kembali ke Halaman Evaluasi</a>
            </div>
        </form>
    </div>
@endsection
