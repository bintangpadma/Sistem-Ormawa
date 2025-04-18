@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        @if(session()->has('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <form action="{{ route('evaluation.store') }}" method="POST" class="form lg:!grid-cols-2">
            @csrf
            <input type="hidden" name="event_recruitments_id" value="{{ $eventRecruitment->id }}">
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
            <hr class="style-gap lg:col-span-2">
            <div class="form-input lg:col-span-2">
                <label for="assessment">Penilaian</label>
                <select class="input" name="assessment">
                    <option value="">Pilih penilaian panitia...</option>
                    <option value="excellent">Sangat Bagus</option>
                    <option value="good">Bagus</option>
                    <option value="poor">Buruk</option>
                    <option value="very_poor">Sangat Buruk</option>
                </select>
                @error('assessment')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="criticism">Kritik</label>
                <textarea rows="4" class="input" name="criticism" placeholder="Masukkan kritik panitia..."></textarea>
                @error('criticism')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="suggestion">Saran</label>
                <textarea rows="4" class="input" name="suggestion" placeholder="Masukkan saran panitia..."></textarea>
                @error('suggestion')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group">
                <button type="submit" class="button-primary">Tambah Evaluasi</button>
                <a href="{{ route('event-recruitment.show', ['event' => $eventRecruitment->event, 'eventRecruitment' => $eventRecruitment]) }}" class="button-secondary">Batal Tambah</a>
            </div>
        </form>
    </div>
@endsection
