@extends('template.homepage')

@section('content')
    <section class="detail-ormawa container mt-[44px] lg:mt-[56px]">
        <h6 class="subtitle">Profile Ormawa</h6>
        <h2 class="title">Tentang {{ $studentOrganization->name }}</h2>
        <div class="data-detail flex items-center gap-[8px] mb-[20px] lg:mb-[42px]">
            <p class="text-[0.875rem] text-primary">Dari {{ $studentOrganization->name }}</p>
            <span class="w-[6px] h-[6px] aspect-square rounded-full bg-light/[0.42]"></span>
            <p class="text-light/[0.42] text-[0.875rem]">{{ \Carbon\Carbon::parse($studentOrganization->created_at)->translatedFormat('j F Y, g.i A') }}</p>
        </div>
        <img src="{{ asset('assets/image/student-organization/' . $studentOrganization->image_path) }}" alt="Ormawa Image" class="w-full rounded-[4px] aspect-[16/6] object-cover border border-light/[0.12] mb-[24px] lg:mb-[42px]">
        <p class="description">{{ $studentOrganization->description }}</p>
    </section>
    <div class="gap-[100px] md:gap-[110px] lg:gap-[120px] flex flex-col py-[100px] md:py-[110px] lg:py-[120px] bg-dark-900">
        <section class="structure-ormawa container">
            <div class="section-header">
                <h2 class="title">Struktur Kepanitiaan Ormawa</h2>
            </div>
            <div class="section-content content-gap grid grid-cols-2 lg:grid-cols-4 gap-[16px] lg:gap-[20px]">
                @foreach($studentOrganization->student_organization_structures as $StudentOrganizationStructure)
                    <div class="card-structure bg-dark-700 rounded-[3px] overflow-hidden flex flex-col">
                        <img src="https://placehold.co/48x48?text=Image+Not+Found" alt="Image Ormawa" class="structure-image w-full aspect-video object-cover">
                        <div class="structure-content p-[16px] lg:p-[20px]">
                            <h4 class="content-title text-[0.913rem] lg:text-[1rem] font-xd-prime-medium leading-[112%] mb-[4px]">{{ $StudentOrganizationStructure->student_name }}</h4>
                            <p class="content-description text-[0.813rem] text-light/[0.62]">{{ $StudentOrganizationStructure->role }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="structure-achievement container">
            <div class="section-header">
                <h2 class="title">Prestasi Organisasi Mahasiswa</h2>
            </div>
            <div class="section-content content-gap grid grid-cols-2 lg:grid-cols-4 gap-[16px] lg:gap-[20px]">
                @foreach($studentOrganization->student_organization_achievements as $StudentOrganizationAchievement)
                    <div class="structure-content bg-dark-700 rounded-[3px] overflow-hidden p-[16px] lg:p-[20px]">
                        <h4 class="content-title text-[0.913rem] lg:text-[1rem] font-xd-prime-medium leading-[112%] mb-[6px] lg:mb-[8px]">{{ $StudentOrganizationAchievement->name }}</h4>
                        <p class="content-description text-[0.875rem] text-light/[0.62]">{{ $StudentOrganizationAchievement->description }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
    <section class="ormawa container" id="ormawa ukm">
        <div class="section-header">
            <h2 class="title">Visi & Misi Organisasi Mahasiswa</h2>
        </div>
        <div class="section-content content-gap">
            <div class="content-card">
                <h3 class="card-title">VISI</h3>
                @foreach($studentOrganization->student_organization_visions as $i => $studentOrganizationVision)
                    <p class="card-list">
                        <span class="list-wrapper">
                            <span class="list-number">{{ $i + 1 }}</span>
                            {{ $studentOrganizationVision->name }}
                        </span>
                    </p>
                @endforeach
            </div>
            <div class="content-card">
                <h3 class="card-title">MISI</h3>
                @foreach($studentOrganization->student_organization_missions as $i => $studentOrganizationMission)
                    <p class="card-list">
                        <span class="list-wrapper">
                            <span class="list-number">{{ $i + 1 }}</span>
                            {{ $studentOrganizationMission->name }}
                        </span>
                    </p>
                @endforeach
            </div>
        </div>
    </section>
@endsection
