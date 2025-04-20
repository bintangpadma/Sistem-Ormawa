@extends('template.dashboard')

@section('content')
    <div class="content-menu content-table">
        @if(session()->has('failed'))
            <div class="alert alert-danger" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <form action="{{ route('info-committee.store') }}" method="POST" class="form lg:!grid-cols-2">
            @csrf
            <div class="form-input lg:col-span-2">
                <label for="committee_definition">Definisi Panitia</label>
                <textarea class="input" name="committee_definition" placeholder="Masukkan definisi panitia..." rows="4"></textarea>
                @error('committee_definition')
                <p class="text-invalid">{{ $message }}</p>
                @enderror
            </div>
            <div class="button-group">
                <button type="submit" class="button-primary">Tambah Info Panitia</button>
                <a href="{{ route('info-committee.index') }}" class="button-secondary">Batal Tambah</a>
            </div>
        </form>
    </div>
@endsection
