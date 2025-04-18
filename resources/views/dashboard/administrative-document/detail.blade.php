@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        <form class="form lg:!grid-cols-2" enctype="multipart/form-data">
            <div class="form-input lg:col-span-2">
                <label for="name">Nama</label>
                <input type="text" class="input" name="name" value="{{ $administrativeDocument->name }}" readonly>
            </div>
            <div class="form-input lg:col-span-2">
                <label for="description">Deskripsi</label>
                <textarea class="input" name="description" rows="4" readonly>{{ $administrativeDocument->description }}</textarea>
            </div>
            <div class="button-group">
                <a href="{{ route('administrative-document.index') }}" class="button-secondary">Kembali ke Halaman Dokumen Administrasi</a>
            </div>
        </form>
    </div>
@endsection
