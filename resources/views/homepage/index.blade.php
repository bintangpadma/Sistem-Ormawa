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
        <section class="ormawa" id="ormawa">
            <div class="section-header">
                <h2 class="title"><span>ORMAWA & UKM</span></h2>
                <p class="description opacity-[0.62]">Ada {{ count($studentOrganizations) }} ORMAWA dan {{ count($studentActivityUnits) }} UKM di Primakara University</p>
            </div>
            <div class="section-content content-gap">
                <div class="content-card">
                    <h3 class="card-title">ORMAWA</h3>
                    @foreach($studentOrganizations as $i => $studentOrganization)
                        <a href="{{ route('main.show-student-organization', $studentOrganization) }}" class="card-list group">
                            <span class="list-wrapper">
                                <span class="list-number">{{ $i + 1 }}</span>
                                <span class="list-value">{{ $studentOrganization->abbreviation }}</span>
                            </span>
                            <span class="arrow-icon group-hover:translate-x-[4px]"></span>
                        </a>
                    @endforeach
                </div>
                <div class="content-card">
                    <h3 class="card-title">UKM</h3>
                    @foreach($studentActivityUnits as $i => $studentActivityUnit)
                        <a href="{{ route('main.show-student-activity-unit', $studentActivityUnit) }}" class="card-list group">
                            <span class="list-wrapper">
                                <span class="list-number">{{ $i + 1 }}</span>
                                <span class="list-value">{{ $studentActivityUnit->abbreviation }}</span>
                            </span>
                            <span class="arrow-icon group-hover:translate-x-[4px]"></span>
                        </a>
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
            @foreach($studentOrganizations as $studentOrganization)
                <div class="section-content content-gap swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach($studentOrganization->student_organization_programs as $studentOrganizationProgram)
                            <div class="swiper-slide">
                                <div class="card-program">
                                    <img src="{{ $studentOrganizationProgram->image_path ? asset('assets/image/program/' . $studentOrganizationProgram->image_path) : 'https://placehold.co/48x48?text=Image+Not+Found' }}" alt="Image Ormawa" class="program-image">
                                    <div class="program-content">
                                        <h4 class="content-title">{{ $studentOrganizationProgram->name }}</h4>
                                        <h6 class="content-author">{{ $studentOrganizationProgram->student_organization->abbreviation }}</h6>
                                        <p class="content-description">{{ $studentOrganizationProgram->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </section>
    </div>
    <div class="container">
        <section class="recruitment" id="recruitment">
            <div class="section-header">
                <h2 class="title">Informasi Seputar OPEN REQRUITMENT Program Kerja</h2>
            </div>
            <div class="section-content content-gap">
                @foreach($events as $event)
                    @php
                        \Carbon\Carbon::setLocale('id');
                        $today = \Carbon\Carbon::now('Asia/Jakarta');
                        $start = \Carbon\Carbon::parse($event->start_date)->startOfDay();
                        $end = \Carbon\Carbon::parse($event->end_date)->endOfDay();

                        $isOpen = $today->between($start, $end);
                    @endphp
                    <div class="card-event">
                        <div class="inline-block relative">
                            <img src="{{ asset('assets/image/event/' . $event->image_path) }}" alt="Event Image" class="event-image relative">
                            <p class="event-status {{ $isOpen ? 'status-open' : 'status-closed' }}">
                                {{ $isOpen ? 'Dibuka' : 'Tutup' }}
                            </p>
                        </div>
                        <div class="event-content">
                            <h6 class="content-title">{{ $event->name }}</h6>
                            <p class="content-date">
                                <i class="fa-regular fa-calendar text-light/[0.62]"></i>
                                {{ $start->translatedFormat('d F Y') }} - {{ $end->translatedFormat('d F Y') }}
                            </p>
                            <p class="content-quota">
                                <i class="fa-regular fa-user text-light/[0.62]"></i>
                                Kuota {{ $event->quota }} Orang
                                <span class="ms-auto text-inherit">({{ $event->event_recruitments->count() }} Pendaftar)</span>
                            </p>
                            <div class="content-button flex gap-[8px]">
                                <a href="{{ route('main.show-event', $event) }}" class="button-secondary w-full text-center px-[18px] py-[12px] text-[0.913rem] font-xd-prime-regular bg-dark-800">Lihat Event</a>
                                @if($isOpen)
                                    <a href="{{ route('main.show-recruitment', $event) }}" class="button-primary w-full text-center px-[18px] py-[12px] text-[0.913rem] font-xd-prime-regular">Daftar Sekarang</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
    <div class="container">
        <section class="recruitment" id="news">
            <div class="section-header">
                <h2 class="title">Berita Saat Ini</h2>
            </div>
            <div class="section-content content-gap">
                @foreach($newses as $news)
                    <a href="{{ route('main.show-news', $news) }}" class="card-event">
                        <img src="{{ asset('assets/image/news/' . $news->image_path) }}" alt="Berita Image" class="event-image">
                        <div class="event-content">
                            <p class="content-title">{{ $news->name }}</p>
                            <button type="button" class="button-primary px-[18px] py-[12px] text-[0.913rem] font-xd-prime-regular">Lihat Detail</button>
                        </div>
                    </a>
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
                        <a href="{{ route('main.show-student-organization', $studentOrganization) }}" class="button-primary px-[18px] py-[12px] text-[0.913rem] font-xd-prime-regular">Lihat Detail</a>
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
