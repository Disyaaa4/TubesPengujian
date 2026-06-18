@props(['user', 'navItems' => []])

<aside class="w-[240px] flex-shrink-0 bg-[#16202C] text-white flex flex-col">
    <div class="px-6 pt-5 pb-4">
        <span class="text-2xl font-extrabold uppercase tracking-[2px]">COMPASS</span>
    </div>

    <div class="flex flex-col items-center pt-2 pb-5 px-4">
        <div class="w-14 h-14 rounded-full bg-white/15 border border-white/20 mb-3 grid place-items-center text-lg font-bold text-white">
            {{ strtoupper(substr($user->nama_lengkap ?? $user->name ?? 'USER', 0, 2)) }}
        </div>

        <p class="text-xs font-bold text-center">{{ $user->nama_lengkap ?? $user->name ?? 'Unknown User' }}</p>
        <p class="text-[10px] mt-0.5 opacity-80">{{ $user->nip ?? $user->id_user ?? 'N/A' }}</p>
    </div>

    <div class="h-px bg-white/20 mx-4"></div>
    <p class="text-[10px] px-6 pt-4 pb-2 opacity-70">MENU</p>

    <nav class="flex flex-col gap-1 px-4">
        @foreach($navItems as $item)
            <button type="button" class="group relative flex items-center gap-3 w-full rounded-2xl px-4 py-3 text-left text-sm font-semibold transition duration-200 {{ $item['active'] ? 'bg-[#303750] text-white' : 'text-white/80 hover:bg-[#303750]/60 hover:text-white' }}">
                @if($item['active'])
                    <span class="absolute left-0 top-0 h-full w-1 rounded-r-full bg-[#50B8E4] shadow-lg"></span>
                @endif
                <span class="w-3 h-3 rounded-full bg-white/60"></span>
                <span>{{ $item['label'] }}</span>
            </button>
        @endforeach
    </nav>

    <div class="flex-1"></div>
    <div class="h-px bg-white/20 mx-4"></div>

    <form action="{{ route('logout') }}" method="POST" class="mx-4 mt-4">
        @csrf
        <button type="submit" class="flex items-center justify-center gap-2 w-full rounded-2xl border border-white/20 bg-white/5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 2H2C1.44772 2 1 2.44772 1 3V13C1 13.5523 1.44772 14 2 14H6" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M11 11L14 8L11 5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M14 8H7" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Logout
        </button>
    </form>
</aside>
