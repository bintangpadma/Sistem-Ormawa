@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        @if(session()->has('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <form action="{{ route('activity-report.store') }}" method="POST" class="form lg:!grid-cols-2" enctype="multipart/form-data">
            @csrf
            @if(auth()->user()->student_organization)
                <input type="hidden" name="student_organizations_id" value="{{ auth()->user()->student_organization->id }}">
            @endif
            @if(auth()->user()->student_activity_unit)
                <input type="hidden" name="student_activity_units_id" value="{{ auth()->user()->student_activity_unit->id }}">
            @endif
            <div class="form-input lg:col-span-2">
                <label>
                    File Arsip Administrasi
                    <span class="input-file">
                        <input type="file" class="file-input-hidden" id="file_path" name="file_path">
                        <div class="button-secondary file-button">Pilih File</div>
                        <span id="file-name" class="file-name">Belum ada file arsip administrasi</span>
                    </span>
                </label>
                @error('file_path')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="name">Nama</label>
                <input type="text" class="input" name="name" placeholder="Masukkan nama arsip administrasi...">
                @error('name')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="description">Deskripsi</label>
                <textarea rows="4" class="input" name="description" placeholder="Masukkan deskripsi arsip administrasi..."></textarea>
                @error('description')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group">
                <button type="submit" class="button-primary">Tambah Arsip Administrasi</button>
                <a href="{{ route('activity-report.index') }}" class="button-secondary">Batal Tambah</a>
            </div>
        </form>
    </div>

    <script>
        const fileInput = document.getElementById('file_path');
        const fileNameDisplay = document.getElementById('file-name');

        fileInput.addEventListener('change', function () {
            fileNameDisplay.textContent = fileInput.files[0]?.name || 'Belum ada file arsip administrasi';
        });
    </script>
@endsection
