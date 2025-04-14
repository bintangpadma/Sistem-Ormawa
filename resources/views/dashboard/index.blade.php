@extends('template.dashboard')

@section('content')
    <div class="content-menu grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-[12px] md:gap-[16px] lg:gap-[20px]">
        <div class="menu-dashboard">
            <div class="dashboard-icon">
                <span class="bg-dashboard-student-organization-dark"></span>
            </div>
            <div class="dashboard-data">
                <h6 class="data-name">Total Ormawa</h6>
                <p class="data-value">{{ $studentOrganizationCount }}</p>
            </div>
        </div>
        <div class="menu-dashboard">
            <div class="dashboard-icon">
                <span class="bg-dashboard-student-organization-dark"></span>
            </div>
            <div class="dashboard-data">
                <h6 class="data-name">Total UKM</h6>
                <p class="data-value">{{ $studentActivityUnitCount }}</p>
            </div>
        </div>
        <div class="menu-dashboard">
            <div class="dashboard-icon">
                <span class="bg-dashboard-student-organization-dark"></span>
            </div>
            <div class="dashboard-data">
                <h6 class="data-name">Total Berita</h6>
                <p class="data-value">{{ $newsCount }}</p>
            </div>
        </div>
        <div class="menu-dashboard">
            <div class="dashboard-icon">
                <span class="bg-dashboard-student-organization-dark"></span>
            </div>
            <div class="dashboard-data">
                <h6 class="data-name">Total Event</h6>
                <p class="data-value">{{ $eventCount }}</p>
            </div>
        </div>
    </div>
@endsection
