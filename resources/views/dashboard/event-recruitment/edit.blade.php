@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        @if(session()->has('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <form action="{{ route('event-recruitment.update', ['event' => $event, 'eventRecruitment' => $eventRecruitment]) }}" method="POST" class="form lg:!grid-cols-2">
            @csrf
            @method('PUT')
            <div class="form-input">
                <label for="event_divisions_id">Divisi</label>
                <select class="input" name="event_divisions_id">
                    @foreach($eventDivisions as $eventDivision)
                        <option value="{{ $eventDivision->id }}" {{ $eventDivision->id === $eventRecruitment->event_divisions_id ? 'selected' : '' }}>{{ $eventDivision->name }}</option>
                    @endforeach
                </select>
                @error('event_divisions_id')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="student_name">Nama Mahasiswa</label>
                <input type="text" class="input" name="student_name" placeholder="Masukkan nama mahasiswa perekrut..." value="{{ $eventRecruitment->student_name }}">
                @error('student_name')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="student_code">NIM</label>
                <input type="text" class="input" name="student_code" placeholder="Masukkan nim perekrut..." value="{{ $eventRecruitment->student_code }}">
                @error('student_code')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="number_phone">Nomor Telepon</label>
                <input type="text" class="input" name="number_phone" placeholder="Masukkan nomor telepon perekrut..." value="{{ $eventRecruitment->number_phone }}">
                @error('number_phone')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="study_program">Program Studi</label>
                <input type="text" class="input" name="study_program" placeholder="Masukkan program studi perekrut..." value="{{ $eventRecruitment->study_program }}">
                @error('study_program')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="class">Kelas</label>
                <input type="text" class="input" name="class" placeholder="Masukkan kelas perekrut..." value="{{ $eventRecruitment->class }}">
                @error('class')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="year_appointment">Tahun Angkatan</label>
                <input type="text" class="input" name="year_appointment" placeholder="Masukkan tahun angkatan perekrut..." value="{{ $eventRecruitment->year_appointment }}">
                @error('year_appointment')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="status">Status</label>
                <select class="input" name="status">
                    <option value="pending" {{ $eventRecruitment->status === 'pending' ? 'selected' : '' }}>Tertunda</option>
                    <option value="accepted" {{ $eventRecruitment->status === 'accepted' ? 'selected' : '' }}>Diterima</option>
                    <option value="rejected" {{ $eventRecruitment->status === 'rejected' ? 'selected' : '' }}>Tidak Diterima</option>
                </select>
                @error('status')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="reason">Motivasi/ Alasan Mengikuti Kepanitiaan</label>
                <textarea rows="4" class="input" name="reason" placeholder="Masukkan motivasi/ alasan mengikuti kepanitiaan perekrut...">{{ $eventRecruitment->reason }}</textarea>
                @error('reason')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group">
                <button type="submit" class="button-primary">Simpan Perubahan</button>
                <a href="{{ route('event-recruitment.index', $event) }}" class="button-secondary">Batal Edit</a>
            </div>
        </form>
    </div>
@endsection
