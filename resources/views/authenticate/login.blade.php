@extends('template.authenticate')

@section('content')
    <div class="authenticate-banner login"></div>
    <div class="authenticate-content">
        @if (session()->has('success'))
            <div class="alert alert-success w-full mb-3" role="alert">
                {{ session('success') }}
            </div>
        @elseif(session()->has('failed'))
            <div class="alert alert-danger w-full mb-3" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <h2 class="title mb-[20px] lg:mb-[24px]">Masukkan Akun Ormawa/ Admin Anda Sekarang</h2>
        <form action="{{ route('user.store') }}" method="POST" class="form">
            @csrf
            <div class="form-input">
                <label for="email">Email</label>
                <input type="email" class="input" name="email" placeholder="Masukkan email anda...">
            </div>
            <div class="form-input">
                <label for="password">Password</label>
                <input type="password" class="input" name="password" placeholder="Masukkan password anda...">
            </div>
            <button type="submit" class="button-primary w-full text-center">Masuk</button>
        </form>
    </div>
@endsection
