@props(['title' => 'Dashboard', 'subtitle' => '', 'searchLabel' => 'Search'])

<header class="bg-white flex items-center px-4 lg:px-6 h-[70px] flex-shrink-0 shadow-sm">
    <div>
        <h1 class="text-[18px] lg:text-2xl font-bold text-slate-900">{{ $title }}</h1>
        @if($subtitle)
            <p class="text-sm text-slate-500 mt-1">{{ $subtitle }}</p>
        @endif
    </div>

    <div class="flex-1"></div>

    <div class="hidden sm:flex items-center gap-2 bg-[#F8F9FB] rounded-lg px-3 py-1.5 w-44 lg:w-72 mr-3">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.67 11.67L15 15" stroke="#7B8A99" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M6.5 12C9.26142 12 11.5 9.76142 11.5 7C11.5 4.23858 9.26142 2 6.5 2C3.73858 2 1.5 4.23858 1.5 7C1.5 9.76142 3.73858 12 6.5 12Z" stroke="#7B8A99" stroke-width="1.5"/>
        </svg>
        <span class="text-[11px] font-light text-slate-500">{{ $searchLabel }}</span>
    </div>

    <button type="button" class="relative mr-3 inline-flex h-10 w-10 items-center justify-center rounded-full bg-[#F0F2F7] text-slate-700 transition hover:bg-slate-200">
        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.8623 10.9963C13.5154 10.3988 12.9998 8.70813 12.9998 6.5C12.9998 5.17392 12.473 3.90215 11.5353 2.96447C10.5976 2.02678 9.32585 1.5 7.99976 1.5C6.67368 1.5 5.40191 2.02678 4.46423 2.96447C3.52655 3.90215 2.99976 5.17392 2.99976 6.5C2.99976 8.70875 2.48351 10.3988 2.13664 10.9963C2.04806 11.1482 2.0011 11.3207 2.00049 11.4966C1.99989 11.6724 2.04566 11.8453 2.1332 11.9978C2.22074 12.1503 2.34694 12.277 2.49908 12.3652C2.65122 12.4534 2.82392 12.4999 2.99976 12.5H5.55039C5.66575 13.0645 5.97253 13.5718 6.41885 13.9361C6.86517 14.3004 7.42362 14.4994 7.99976 14.4994C8.5759 14.4994 9.13436 14.3004 9.58068 13.9361C10.027 13.5718 10.3338 13.0645 10.4491 12.5H12.9998C13.1756 12.4998 13.3482 12.4532 13.5002 12.365C13.6523 12.2768 13.7784 12.15 13.8659 11.9975C13.9533 11.845 13.999 11.6722 13.9984 11.4964C13.9978 11.3206 13.9508 11.1481 13.8623 10.9963Z" fill="#0F172A"/>
        </svg>
    </button>
</header>
