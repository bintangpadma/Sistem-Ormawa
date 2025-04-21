@extends('template.homepage')

@section('content')
    <section class="detail-info container mt-[44px] lg:mt-[56px] flex flex-col gap-[12px] lg:gap-[16px]">
        <h2 class="title">Info Tentang Kepanitiaan</h2>
        <p class="description opacity-[0.62]">{{ $infoCommittee->committee_definition }}</p>
        <section class="accordion flex flex-col mt-[20px]">
            @foreach($infoCommittee->info_committee_divisions as $i => $infoCommitteeDivision)
                <div class="accordion-item flex flex-col">
                    <button type="button" class="item-header rounded-[2px] flex items-center gap-[8px] lg:gap-[12px] bg-primary py-[6px] px-[6px] pe-[20px] lg:pe-[24px] justify-between group">
                        <span class="header-number w-[42px] h-[42px] aspect-square rounded-[2px] bg-dark-800 leading-[42px] text-center text-[1.125rem] font-xd-prime-medium text-primary">{{ $i + 1 }}</span>
                        <span class="text-[1rem] !font-xd-prime-medium text-dark-800 uppercase w-full text-start">{{ $infoCommitteeDivision->name }}</span>
                        <span class="w-[14px] h-[12px] bg-cover bg-center bg-no-repeat bg-arrow-right-dark group-hover:translate-x-[4px]"></span>
                    </button>
                </div>
            @endforeach
        </section>
    </section>
@endsection
