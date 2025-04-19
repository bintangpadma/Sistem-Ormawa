@extends('template.homepage')

@section('content')
    <section class="detail-event container mt-[44px] lg:mt-[56px] flex gap-[32px] lg:gap-[40px]">
        <div class="event-content w-full">
            <p class="text-[0.875rem] text-light/[0.42] mb-[8px] lg:mb-[12px]">Ormawa > {{ $news->student_organization->abbreviation }} > <span class="text-primary">Berita</span></p>
            <h2 class="title">{{ $news->name }}</h2>
            <p class="text-light/[0.42] text-[0.875rem] mb-[20px] lg:mb-[28px]">{{ \Carbon\Carbon::parse($news->created_at)->translatedFormat('j F Y, g.i A') }}</p>
            <img src="{{ asset('assets/image/news/' . $news->image_path) }}" alt="Berita Image" class="w-full rounded-[4px] aspect-[16/6] object-cover border border-light/[0.12] mb-[24px] lg:mb-[42px]">
            <p class="description">{{ $news->description }}</p>
        </div>
        <div class="event-aside hidden lg:inline-block lg:w-[460px]">
            <h6 class="subtitle !text-light">Lebih Banyak Berita</h6>
            <form method="GET" class="form w-full mb-[12px] lg:mb-[16px]">
                <div class="form-input relative">
                    <input type="text" class="input relative" name="search" placeholder="Cari berita..." value="{{ $search }}">
                    <button type="submit" class="button-search absolute top-1/2 right-[6px] -translate-y-1/2 w-[38px] h-[38px] aspect-square rounded-[2px] bg-primary flex items-center justify-center">
                        <span class="bg-search-dark w-[16px] h-[16px] bg-center bg-cover bg-no-repeat"></span>
                    </button>
                </div>
            </form>
            <div class="event-list flex flex-col gap-[12px] lg:gap-[16px]">
                @if(count($otherNewses) > 0)
                    @foreach($otherNewses as $otherNews)
                        <a href="{{ route('main.show-news', $otherNews) }}" class="card-other bg-dark-700 overflow-hidden rounded-[3px] flex items-center gap-[12px] lg:gap-[16px]">
                            <img src="{{ asset('assets/image/news/' . $otherNews->image_path) }}" alt="Berita Image" class="aspect-square object-cover w-[120px]">
                            <div class="flex flex-col gap-[4px]">
                                <h6 class="text-[0.913rem] font-xd-prime-regular line-clamp-1">{{ $otherNews->name }}</h6>
                                <p class="text-[0.85rem] text-light/[0.62] line-clamp-2">{{ $otherNews->description }}</p>
                                <p class="text-[0.75rem] text-primary line-clamp-1">Dari {{ $otherNews->student_organization->name }}</p>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p class="text-center text-light/[0.62] text-[0.875rem] mt-[20px]">Berita tidak ditemukan.</p>
                @endif
            </div>
        </div>
    </section>
@endsection
