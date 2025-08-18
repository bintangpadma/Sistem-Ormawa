@extends('template.homepage')

@section('content')
    <section class="form-recruitment container mt-[44px] lg:mt-[56px]">
        <div class="recruitment-banner">
            <img src="{{ asset('assets/image/banner/banner-recruitment.jpg') }}" alt="Banner Image" class="banner-image">
        </div>
        <div class="recruitment-form">
            @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session()->has('failed'))
                <div class="alert alert-danger" role="alert">
                    {{ session('failed') }}
                </div>
            @endif
            <h2 class="title mb-[20px] lg:mb-[24px]">Pendaftaran Panitia {{$event->name}}</h2>
            <form action="{{ route('event-recruitment.store', $event) }}" method="POST" class="form lg:!grid-cols-2">
                @csrf
                <div class="form-input">
                    <label for="event_divisions_id">Divisi</label>
                    <select class="input" name="event_divisions_id">
                        <option value="">Pilih divisi anda...</option>
                        @foreach($event->event_divisions as $eventDivision)
                            <option value="{{ $eventDivision->id }}">{{ $eventDivision->name }}</option>
                        @endforeach
                    </select>
                    @error('event_divisions_id')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="student_name">Nama Mahasiswa</label>
                    <input type="text" class="input" name="student_name" placeholder="Masukkan nama mahasiswa anda...">
                    @error('student_name')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="student_code">NIM</label>
                    <input type="text" class="input" name="student_code" placeholder="Masukkan nim anda...">
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
                    <input type="text" class="input" name="number_phone" placeholder="Masukkan nomor telepon anda...">
                    @error('number_phone')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="study_program">Program Studi</label>
                    <input type="text" class="input" name="study_program" placeholder="Masukkan program studi anda...">
                    @error('study_program')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="class">Kelas</label>
                    <input type="text" class="input" name="class" placeholder="Masukkan kelas anda...">
                    @error('class')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input">
                    <label for="year_appointment">Tahun Angkatan</label>
                    <input type="text" class="input" name="year_appointment" placeholder="Masukkan tahun angkatan anda...">
                    @error('year_appointment')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-input lg:col-span-2">
                    <label for="reason">Motivasi/ Alasan Mengikuti Kepanitiaan</label>
                    <textarea rows="4" class="input" name="reason" placeholder="Masukkan motivasi/ alasan mengikuti kepanitiaan anda..."></textarea>
                    @error('reason')
                    <p class="text-invalid">{{ $message }}</p>
                    @enderror
                </div>
                <div class="button-group">
                    <button type="submit" class="button-primary w-full text-center font-xd-prime-medium">Daftar</button>
                </div>
            </form>
        </div>
    </section>
@endsection
