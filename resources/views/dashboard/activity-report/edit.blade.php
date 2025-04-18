@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form action="{{ route('activity-report.update', $activityReport) }}" method="POST" class="form lg:!grid-cols-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-input lg:col-span-2">
                <label>
                    File LPJ
                    <span class="input-image">
                        <input type="file" class="image-input-hidden" id="file_path" name="file_path">
                        <div class="button-secondary file-button">Pilih File</div>
                        <span id="file-name" class="image-name">Sudah ada file</span>
                    </span>
                </label>
                @error('file_path')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="name">Nama</label>
                <input type="text" class="input" name="name" placeholder="Masukkan nama lpj..." value="{{ $activityReport->name }}">
                @error('name')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-input lg:col-span-2">
                <label for="description">Deskripsi</label>
                <textarea rows="4" class="input" name="description" placeholder="Masukkan description lpj...">{{ $activityReport->description }}</textarea>
                @error('description')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group">
                <button type="submit" class="button-primary">Simpan Perubahan</button>
                <a href="{{ route('activity-report.index') }}" class="button-secondary">Batal Edit</a>
            </div>
        </form>
    </div>

    <script>
        const fileInput = document.getElementById('file_path');
        const fileNameDisplay = document.getElementById('file-name');

        fileInput.addEventListener('change', function () {
            fileNameDisplay.textContent = fileInput.files[0]?.name || 'Sudah ada file';
        });
    </script>
@endsection
