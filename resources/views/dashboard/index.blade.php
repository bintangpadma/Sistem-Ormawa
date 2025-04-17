@extends('template.dashboard')

@section('content')
    <div class="content-menu content-dashboard">
        <div class="dashboard-menu">
            <div class="menu-icon">
                <span class="bg-dashboard-student-organization-dark"></span>
            </div>
            <div class="menu-data">
                <h6 class="data-name">Total Ormawa</h6>
                <p class="data-value">{{ $studentOrganizationCount }}</p>
            </div>
        </div>
        <div class="dashboard-menu">
            <div class="menu-icon">
                <span class="bg-dashboard-student-organization-dark"></span>
            </div>
            <div class="menu-data">
                <h6 class="data-name">Total UKM</h6>
                <p class="data-value">{{ $studentActivityUnitCount }}</p>
            </div>
        </div>
        <div class="dashboard-menu">
            <div class="menu-icon">
                <span class="bg-dashboard-student-organization-dark"></span>
            </div>
            <div class="menu-data">
                <h6 class="data-name">Total Berita</h6>
                <p class="data-value">{{ $newsCount }}</p>
            </div>
        </div>
        <div class="dashboard-menu">
            <div class="menu-icon">
                <span class="bg-dashboard-student-organization-dark"></span>
            </div>
            <div class="menu-data">
                <h6 class="data-name">Total Event</h6>
                <p class="data-value">{{ $eventCount }}</p>
            </div>
        </div>
    </div>
@endsection
