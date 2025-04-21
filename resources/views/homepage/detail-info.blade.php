@extends('template.homepage')

@section('content')
    <section class="detail-info container mt-[44px] lg:mt-[56px] flex flex-col gap-[12px] lg:gap-[16px]">
        <h2 class="title">Info Tentang Kepanitiaan</h2>
        <p class="description opacity-[0.62]">{{ $infoCommittee->committee_definition }}</p>
        <section class="accordion flex flex-col gap-[12px] mt-[20px]">
            @foreach($infoCommittee->info_committee_divisions as $i => $infoCommitteeDivision)
                <div class="accordion-item flex flex-col rounded-[2px] overflow-hidden">
                    <button type="button" class="item-header flex items-center gap-[8px] lg:gap-[12px] bg-primary py-[6px] px-[6px] pe-[20px] lg:pe-[24px] justify-between group">
                        <span class="header-number w-[42px] h-[42px] aspect-square rounded-[2px] bg-dark-800 leading-[42px] text-center text-[1.125rem] font-xd-prime-medium text-primary">{{ $i + 1 }}</span>
                        <span class="text-[1rem] !font-xd-prime-medium text-dark-800 uppercase w-full text-start">{{ $infoCommitteeDivision->name }}</span>
                        <span class="w-[14px] h-[12px] bg-cover bg-center bg-no-repeat bg-arrow-right-dark group-hover:translate-x-[4px]"></span>
                    </button>
                    <div class="item-body p-[20px] lg:p-[24px] bg-dark-700 hidden flex-col gap-[20px]">
                        <div class="wrapper flex flex-col gap-[4px]">
                            <p class="body-definition text-[0.913rem] text-light">Pengertian:</p>
                            <p class="body-definition text-[0.913rem] text-light/[0.62]">{{ $infoCommitteeDivision->definition }}</p>
                        </div>
                        <div class="wrapper flex flex-col gap-[4px]">
                            <p class="body-definition text-[0.913rem] text-light">Tugas:</p>
                            @foreach($infoCommitteeDivision->info_committee_division_tasks as $infoCommitteeDivisionTask)
                                <p class="body-definition text-[0.913rem] text-light/[0.62] flex items-center gap-[4px]">
                                    <span class="w-[5px] h-[5px] rounded-full aspect-square bg-light/[0.24]"></span>
                                    {{ $infoCommitteeDivisionTask->name }}
                                </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </section>

    <script>
        const accordionItems = document.querySelectorAll('.accordion-item .item-header');

        accordionItems.forEach(accordionItem => {
            accordionItem.addEventListener('click', function () {
                const parent = accordionItem.parentElement;
                const itemBody = parent.querySelector('.item-body');
                itemBody.classList.toggle('hidden');
                itemBody.classList.toggle('flex');
            });
        });
    </script>
@endsection
