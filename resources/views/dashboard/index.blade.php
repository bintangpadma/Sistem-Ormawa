@extends('template.dashboard')

@section('content')
    <div class="content-menu content-dashboard">
        @foreach($events as $event)
            <div class="dashboard-menu">
                <div class="menu-icon">
                    <span class="bg-dashboard-student-organization-dark"></span>
                </div>
                <div class="menu-data flex flex-col justify-between">
                    <h6 class="data-name">Nama Event</h6>
                    <p class="data-value !text-[1.125rem]">{{ $event->name }}</p>
                </div>
            </div>
            <div class="dashboard-menu">
                <div class="menu-icon">
                    <span class="bg-dashboard-student-organization-dark"></span>
                </div>
                <div class="menu-data">
                    <h6 class="data-name">Total Pendaftar</h6>
                    <p class="data-value">{{ count($event->event_recruitments) }}</p>
                </div>
            </div>
            <div class="dashboard-menu">
                <div class="menu-icon">
                    <span class="bg-dashboard-student-organization-dark"></span>
                </div>
                <div class="menu-data">
                    <h6 class="data-name">Total Pendaftar Keterima</h6>
                    <p class="data-value">{{ $event->event_recruitments->where('status', 'accepted')->count() }}</p>
                </div>
            </div>
            <div class="dashboard-menu">
                <div class="menu-icon">
                    <span class="bg-dashboard-student-organization-dark"></span>
                </div>
                <div class="menu-data">
                    <h6 class="data-name">Total Pendaftar Ditolak</h6>
                    <p class="data-value">{{ $event->event_recruitments->where('status', 'rejected')->count() }}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
