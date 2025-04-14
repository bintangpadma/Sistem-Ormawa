<div class="topbar w-full h-[76px] bg-dark-700 px-[16px] md:px-[32px] lg:px-[36px] xl:px-[42px] flex items-center justify-between">
    <h4 class="topbar-title text-[1.5rem] font-xd-prime-medium">{{ $page }}</h4>
    <a href="{{ route('profile.index') }}" class="topbar-profile hidden lg:flex items-center gap-[16px] ps-[20px] border-s border-light/[0.12]">
        <div class="profile-data text-end">
            <h6 class="data-name text-light">{{ auth()->user()->admin ? auth()->user()->admin->full_name : auth()->user()->student_organization->name }}</h6>
            <p class="data-role text-primary text-[0.813rem]">{{ auth()->user()->admin ? 'Admin' : 'Ormawa' }}</p>
        </div>
        <img src="{{ auth()->user()->admin ? auth()->user()->admin->profile_path ? asset('assets/image/admin/' . auth()->user()->admin->profile_path) : 'https://placehold.co/48x48?text=Image+Not+Found' : 'https://placehold.co/48x48?text=Image+Not+Found' }}" alt="Profile Image" class="rounded-full" width="48" height="48">
    </a>
    <button type="button" class="button-hamburger flex items-center justify-center lg:hidden w-[48px] h-[48px] rounded-full bg-dark-800 group hover:bg-primary">
        <span class="bg-hamburger-light w-[16px] h-[15px] bg-center bg-cover bg-no-repeat opacity-[0.62] group-hover:bg-hamburger-dark group-hover:opacity-100"></span>
    </button>
</div>
