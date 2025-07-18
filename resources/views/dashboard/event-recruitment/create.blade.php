@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        @if(session()->has('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <form action="{{ route('event-recruitment.store', $event) }}" method="POST" class="form lg:!grid-cols-2">
            @csrf
            <div class="form-input">
                <label for="event_divisions_id">Divisi</label>
                <select class="input" name="event_divisions_id">
                    <option value="">Pilih divisi perekrut...</option>
                    @foreach($eventDivisions as $eventDivision)
                        <option value="{{ $eventDivision->id }}">{{ $eventDivision->name }}</option>
                    @endforeach
                </select>
                @error('event_divisions_id')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="student_name">Nama Mahasiswa</label>
                <input type="text" class="input" name="student_name" placeholder="Masukkan nama mahasiswa perekrut...">
                @error('student_name')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="student_code">NIM</label>
                <input type="text" class="input" name="student_code" placeholder="Masukkan nim perekrut...">
                @error('student_code')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" class="input" name="email" placeholder="Masukkan email perekrut...">
                @error('email')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="number_phone">Nomor Telepon</label>
                <input type="text" class="input" name="number_phone" placeholder="Masukkan nomor telepon perekrut...">
                @error('number_phone')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="study_program">Program Studi</label>
                <input type="text" class="input" name="study_program" placeholder="Masukkan program studi perekrut...">
                @error('study_program')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="class">Kelas</label>
                <input type="text" class="input" name="class" placeholder="Masukkan kelas perekrut...">
                @error('class')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input">
                <label for="year_appointment">Tahun Angkatan</label>
                <input type="text" class="input" name="year_appointment" placeholder="Masukkan tahun angkatan perekrut...">
                @error('year_appointment')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="reason">Motivasi/ Alasan Mengikuti Kepanitiaan</label>
                <textarea rows="4" class="input" name="reason" placeholder="Masukkan motivasi/ alasan mengikuti kepanitiaan perekrut..."></textarea>
                @error('reason')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group">
                <button type="submit" class="button-primary">Tambah Perekrut</button>
                <a href="{{ route('event-recruitment.index', $event) }}" class="button-secondary">Batal Tambah</a>
            </div>
        </form>
    </div>
@endsection
