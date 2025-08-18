@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        @if(session()->has('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <form action="{{ route('evaluation.update', $evaluation) }}" method="POST" class="form lg:!grid-cols-2">
            @csrf
            @method('PUT')
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
                <select class="input" name="assessment">
                    <option value="active" {{ $evaluation->assessment === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="less active" {{ $evaluation->assessment === 'less active' ? 'selected' : '' }}>Kurang Aktif</option>
                    <option value="inactive" {{ $evaluation->assessment === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                @error('assessment')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="criticism">Kritik</label>
                <textarea rows="4" class="input" name="criticism" placeholder="Masukkan kritik panitia...">{{ $evaluation->criticism }}</textarea>
                @error('criticism')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="suggestion">Saran</label>
                <textarea rows="4" class="input" name="suggestion" placeholder="Masukkan saran panitia...">{{ $evaluation->suggestion }}</textarea>
                @error('suggestion')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group">
                <button type="submit" class="button-primary">Simpan Perubahan</button>
                <a href="{{ route('evaluation.index') }}" class="button-secondary">Batal Edit</a>
            </div>
        </form>
    </div>
@endsection
