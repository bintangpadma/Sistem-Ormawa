@extends('template.homepage')

@section('content')
    <section class="detail-event container mt-[44px] lg:mt-[56px] flex gap-[32px] lg:gap-[40px]">
        <div class="event-content w-full">
            <p class="text-[0.875rem] text-light/[0.42] mb-[8px] lg:mb-[12px]">Ormawa > {{ $event->student_organization->abbreviation }} > <span class="text-primary">Event</span></p>
            <h2 class="title">{{ $event->name }}</h2>
            <p class="text-light/[0.42] text-[0.875rem] mb-[20px] lg:mb-[28px]">{{ \Carbon\Carbon::parse($event->created_at)->translatedFormat('j F Y, g.i A') }}</p>
            <img src="{{ asset('assets/image/event/' . $event->image_path) }}" alt="Event Image" class="w-full rounded-[4px] aspect-square object-cover border border-light/[0.12] mb-[24px] lg:mb-[42px]">
            <p class="description">{{ $event->description }}</p>
        </div>
        <div class="event-aside hidden lg:inline-block lg:w-[460px]">
            <h6 class="subtitle !text-light">Lebih Banyak Event</h6>
            <form method="GET" class="form w-full mb-[12px] lg:mb-[16px]">
                <div class="form-input relative">
                    <input type="text" class="input relative" name="search" placeholder="Cari event..." value="{{ $search }}">
                    <button type="submit" class="button-search absolute top-1/2 right-[6px] -translate-y-1/2 w-[38px] h-[38px] aspect-square rounded-[2px] bg-primary flex items-center justify-center">
                        <span class="bg-search-dark w-[16px] h-[16px] bg-center bg-cover bg-no-repeat"></span>
                    </button>
                </div>
            </form>
            <div class="event-list flex flex-col gap-[12px] lg:gap-[16px]">
                @if(count($otherEvents) > 0)
                    @foreach($otherEvents as $otherEvent)
                        <a href="{{ route('main.show-event', $otherEvent) }}" class="card-other bg-dark-700 overflow-hidden rounded-[3px] flex items-center gap-[12px] lg:gap-[16px]">
                            <img src="{{ asset('assets/image/event/' . $otherEvent->image_path) }}" alt="Event Image" class="aspect-square object-cover w-[120px]">
                            <div class="flex flex-col gap-[4px]">
                                <h6 class="text-[0.913rem] font-xd-prime-regular line-clamp-1">{{ $otherEvent->name }}</h6>
                                <p class="text-[0.85rem] text-light/[0.62] line-clamp-2">{{ $otherEvent->description }}</p>
                                <p class="text-[0.75rem] text-primary line-clamp-1">Dari {{ $otherEvent->student_organization->name }}</p>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p class="text-center text-light/[0.62] text-[0.875rem] mt-[20px]">Event tidak ditemukan.</p>
                @endif
            </div>
        </div>
    </section>

    @if(count($event->event_recruitments) > 0)
        <section class="structure-achievement container">
            <div class="section-header">
                <h2 class="title">Mahasiswa Diterima Kepanitiaan</h2>
            </div>
            <div class="section-content content-gap grid grid-cols-2 lg:grid-cols-4 gap-[16px] lg:gap-[20px]">
                @foreach($event->event_recruitments as $eventRecruitment)
                    <div class="structure-content bg-dark-700 rounded-[3px] overflow-hidden p-[16px] lg:p-[20px]">
                        <h4 class="content-title text-[0.875rem] font-xd-prime-regular text-primary mb-[2px]">{{ $eventRecruitment->study_program }}</h4>
                        <h4 class="content-title text-[0.913rem] lg:text-[1rem] font-xd-prime-medium leading-[112%] mb-[6px] lg:mb-[8px]">{{ $eventRecruitment->student_name }}</h4>
                        <p class="content-description text-[0.813rem] text-light/[0.62]">{{ $eventRecruitment->student_code }}</p>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endsection
