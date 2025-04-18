<aside class="sidebar lg:active">
    <div class="sidebar-header w-full h-[140px] p-[16px] lg:p-[20px] bg-light flex items-center justify-center">
        <a href="{{ route('dashboard.index') }}">
            <img src="{{ asset('assets/image/brand/brand-logo.svg') }}" alt="Brand Logo" height="42">
        </a>
    </div>
    <div class="sidebar-content px-[16px] lg:px-[20px] flex flex-col gap-[6px]">
        <a href="{{ route('dashboard.index') }}" class="content-item group {{ Route::is('dashboard*') ? 'active' : '' }}">
            <span class="group-hover:bg-dashboard-dark group-hover:opacity-100 {{ Route::is('dashboard*') ? 'bg-dashboard-dark opacity-100' : 'bg-dashboard-light opacity-[0.62]' }}"></span>
            Dashboard
        </a>
        <a href="{{ route('profile.index') }}" class="!flex lg:!hidden content-item group {{ Route::is('profile*') ? 'active' : '' }}">
            <span class="group-hover:bg-profile-dark group-hover:opacity-100 {{ Route::is('profile*') ? 'bg-profile-dark opacity-100' : 'bg-profile-light opacity-[0.62]' }}"></span>
            Profile
        </a>
        @if(auth()->user()->admin)
            <a href="{{ route('admin.index') }}" class="content-item group {{ Route::is('admin*') ? 'active' : '' }}">
                <span class="group-hover:bg-admin-dark group-hover:opacity-100 {{ Route::is('admin*') ? 'bg-admin-dark opacity-100' : 'bg-admin-light opacity-[0.62]' }}"></span>
                Admin
            </a>
            <a href="{{ route('student-organization.index') }}" class="content-item group {{ Route::is('student-organization*') ? 'active' : '' }}">
                <span class="group-hover:bg-student-organization-dark group-hover:opacity-100 {{ Route::is('student-organization*') ? 'bg-student-organization-dark opacity-100' : 'bg-student-organization-light opacity-[0.62]' }}"></span>
                Ormawa
            </a>
        @endif
        <a href="{{ route('student-activity-unit.index') }}" class="content-item group {{ Route::is('student-activity-unit*') ? 'active' : '' }}">
            <span class="group-hover:bg-student-activity-unit-dark group-hover:opacity-100 {{ Route::is('student-activity-unit*') ? 'bg-student-activity-unit-dark opacity-100' : 'bg-student-activity-unit-light opacity-[0.62]' }}"></span>
            UKM
        </a>
        <a href="{{ route('news.index') }}" class="content-item group {{ Route::is('news*') ? 'active' : '' }}">
            <span class="group-hover:bg-news-dark group-hover:opacity-100 {{ Route::is('news*') ? 'bg-news-dark opacity-100' : 'bg-news-light opacity-[0.62]' }}"></span>
            Berita
        </a>
        <a href="{{ route('event.index') }}" class="content-item group {{ Route::is('event*') ? 'active' : '' }}">
            <span class="group-hover:bg-event-dark group-hover:opacity-100 {{ Route::is('event*') ? 'bg-event-dark opacity-100' : 'bg-event-light opacity-[0.62]' }}"></span>
            Event
        </a>
        <a href="{{ route('activity-report.index') }}" class="content-item group {{ Route::is('activity-report*') ? 'active' : '' }}">
            <span class="group-hover:bg-activity-report-dark group-hover:opacity-100 {{ Route::is('activity-report*') ? 'bg-activity-report-dark opacity-100' : 'bg-activity-report-light opacity-[0.62]' }}"></span>
            LPJ
        </a>
        @if(auth()->user()->admin)
            <a href="{{ route('administrative-document.index') }}" class="content-item group {{ Route::is('administrative-document*') ? 'active' : '' }}">
                <span class="group-hover:bg-administrative-document-dark group-hover:opacity-100 {{ Route::is('administrative-document*') ? 'bg-administrative-document-dark opacity-100' : 'bg-administrative-document-light opacity-[0.62]' }}"></span>
                File Administrasi
            </a>
        @endif
        <form action="{{ route('user.delete') }}" method="POST">
            @csrf
            <button class="content-item w-full group">
                <span class="bg-logout-light opacity-[0.62] group-hover:bg-logout-dark group-hover:opacity-100"></span>
                Keluar
            </button>
        </form>
    </div>
</aside>
