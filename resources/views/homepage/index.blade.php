@extends('template.homepage')

@section('content')
    <div class="container">
        <section class="hero" id="hero">
            <div class="hero-content">
                <h6 class="subtitle">Selamat Datang di</h6>
                <h1 class="headline">Sistem Ormawa Primakara University</h1>
                <a href="#about" class="button-primary">
                    Selengkapnya
                    <span class="button-arrow">
                        <span class="arrow-icon"></span>
                    </span>
                </a>
            </div>
            <div class="hero-banner">
                <img src="{{ asset('assets/image/banner/banner-hero.jpg') }}" alt="Banner Hero" class="banner-image">
            </div>
        </section>
    </div>
    <section class="about" id="about">
        <div class="about-banner">
            <img src="{{ asset('assets/image/banner/banner-about.jpg') }}" alt="Banner About" class="banner-image">
        </div>
        <div class="about-content">
            <div class="container">
                <h2 class="title mb-[20px] lg:mb-[24px]">Kenali SISTEM ORMAWA di <span>Primakara University</span></h2>
                <p class="description">Primakara University merupakan universitas IT di bawah naungan Yayasan Primakara. Berdiri sejak tahun 2013 sebagai Sekolah Tinggi Manajemen Informatika dan Komputer (STMIK), kemudian bertransformasi menjadi Primakara University pada tahun 2023. Primakara University memiliki dua fakultas dan tujuh program studi jenjang sarjana (S1).</p>
            </div>
        </div>
    </section>
    <div class="container">
        <section class="ormawa" id="ormawa ukm">
            <div class="section-header">
                <h2 class="title"><span>ORMAWA & UKM</span></h2>
                <p class="description opacity-[0.62]">Ada {{ count($studentOrganizations) }} ORMAWA dan {{ count($studentActivityUnits) }} UKM di Primakara University</p>
            </div>
            <div class="section-content content-gap">
                <div class="content-card">
                    <h3 class="card-title">ORMAWA</h3>
                    @foreach($studentOrganizations as $i => $studentOrganization)
                        <a href="{{ route('main.show-ormawa', $studentOrganization) }}" class="card-list group">
                            <span class="list-wrapper">
                                <span class="list-number">{{ $i + 1 }}</span>
                                {{ $studentOrganization->abbreviation }}
                            </span>
                            <span class="arrow-icon group-hover:translate-x-[4px]"></span>
                        </a>
                    @endforeach
                </div>
                <div class="content-card">
                    <h3 class="card-title">UKM</h3>
                    @foreach($studentActivityUnits as $i => $studentActivityUnit)
                        <p class="card-list">
                                <span class="list-wrapper">
                                    <span class="list-number">{{ $i + 1 }}</span>
                                    {{ $studentActivityUnit->abbreviation }}
                                </span>
                        </p>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
    <div class="container">
        <section class="program" id="program">
            <div class="section-header">
                <h2 class="title">Kisah Setiap Program Kerja ORMAWA dan UKM</h2>
            </div>
            <div class="section-content content-gap swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach($studentOrganizationPrograms as $studentOrganizationProgram)
                        <div class="swiper-slide">
                            <div class="card-program">
                                <img src="{{ $studentOrganizationProgram->image_path ? asset('assets/image/student-organization/' . $studentOrganizationProgram->image_path) : 'https://placehold.co/48x48?text=Image+Not+Found' }}" alt="Image Ormawa" class="program-image">
                                <div class="program-content">
                                    <h4 class="content-title">{{ $studentOrganizationProgram->name }}</h4>
                                    <h6 class="content-author">{{ $studentOrganizationProgram->student_organization->abbreviation }}</h6>
                                    <p class="content-description">{{ $studentOrganizationProgram->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
{{--                    <div class="swiper-pagination"></div>--}}
                </div>
            </div>
        </section>
    </div>
    <div class="container">
        <section class="recruitment" id="recruitment">
            <div class="section-header">
                <h2 class="title">Informasi Seputar OPEN REQRUITMENT Program Kerja</h2>
            </div>
            <div class="section-content content-gap">
                @foreach($events as $event)
                    <div class="card-event">
                        <a href="{{ route('main.show-event', $event) }}" class="inline-block">
                            <img src="{{ asset('assets/image/event/' . $event->image_path) }}" alt="Event Image" class="event-image">
                        </a>
                        <div class="event-content">
                            <a href="{{ route('main.show-event', $event) }}" class="content-title">{{ $event->name }}</a>
                            <a href="{{ route('main.show-recruitment', $event) }}" class="button-primary px-[18px] py-[12px] text-[0.913rem] font-xd-prime-regular">Daftar Sekarang</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
    <div class="container">
        <section class="structure" id="structure">
            <div class="section-header">
                <h2 class="title">Struktur Organisasi Mahasiswa</h2>
            </div>
            <div class="section-content content-gap">
                @foreach($studentOrganizations as $studentOrganization)
                    <div class="card-structure">
                        <h5 class="structure-title">{{ $studentOrganization->name }}</h5>
                        <a href="{{ route('main.show-ormawa', $studentOrganization) }}" class="button-primary px-[18px] py-[12px] text-[0.913rem] font-xd-prime-regular">Lihat Detail</a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        let swiper = new Swiper(".mySwiper", {
            pagination: {
                el: ".swiper-pagination",
            },
        });
    </script>
@endsection
