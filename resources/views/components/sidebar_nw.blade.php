<aside class="dashboard-sidebar">
    @php
        $menuIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none"><path d="M10.1377 0C10.6066 1.68174e-05 11.0504 0.145636 11.3867 0.40918L19.6221 6.86621C19.9942 7.15804 20.2754 7.73664 20.2754 8.21191V9.08789C20.2754 9.6495 19.822 10.1064 19.2646 10.1064H17.8525C17.6908 10.1064 17.5586 10.2395 17.5586 10.4023V16.4482C17.5584 17.855 16.4231 18.9997 15.0273 19H12.2783V14.376C12.2783 12.9999 11.6627 11.8809 10.1377 11.8809C8.61266 11.8809 7.99707 12.9999 7.99707 14.376V19H5.24805C3.85238 19 2.71702 17.8551 2.7168 16.4482V10.4023C2.71677 10.2395 2.58459 10.1064 2.42285 10.1064H1.01074C0.453399 10.1064 0 9.64974 0 9.08789V8.21191C3.11853e-05 7.73661 0.281178 7.15802 0.65332 6.86621L8.88867 0.40918C9.2252 0.145671 9.66836 0 10.1377 0Z" fill="white"/></svg>';
        $role = strtolower(auth()->user()->role ?? 'kaprodi');
    @endphp

    <div class="sidebar-logo">COMPASS</div>

    <div class="sidebar-profile mb-4">
        <div class="profile-circle"></div>
        <p class="profile-name">{{ auth()->user()->username ?? 'Dr. Berlian Rahmy Lidiawaty' }}</p>
        <p class="profile-id">{{ ucwords($role) }}</p>
    </div>

    <div class="menu-title">MENU</div>

    @if($role === 'admin')
        <a href="{{ route('admin.dashboard') }}" class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            {!! $menuIcon !!}
            <span>Dashboard</span>
        </a>
        <a href="#" class="menu-link">
            {!! $menuIcon !!}
            <span>Kelola User</span>
        </a>
        <a href="#" class="menu-link">
            {!! $menuIcon !!}
            <span>Kelola Mahasiswa</span>
        </a>
        <a href="#" class="menu-link">
            {!! $menuIcon !!}
            <span>Kelola Mata Kuliah</span>
        </a>
        <a href="#" class="menu-link">
            {!! $menuIcon !!}
            <span>Kelola PLO/CLO</span>
        </a>
        <a href="#" class="menu-link">
            {!! $menuIcon !!}
            <span>RPS</span>
        </a>
    @elseif($role === 'dosen wali')
        <a href="{{ route('dosen-wali.dashboard') }}" class="menu-link {{ request()->routeIs('dosen-wali.dashboard') ? 'active' : '' }}">
            {!! $menuIcon !!}
            <span>Dashboard</span>
        </a>
        <a href="{{ route('dosen-wali.nilai.index') }}" class="menu-link {{ request()->routeIs('dosen-wali.nilai.index') ? 'active' : '' }}">
            {!! $menuIcon !!}
            <span>Nilai Mahasiswa Perwalian</span>
        </a>
        <a href="{{ route('dosen-wali.input-nilai.index') }}" class="menu-link {{ request()->routeIs('dosen-wali.input-nilai.index') ? 'active' : '' }}">
            {!! $menuIcon !!}
            <span>Input Nilai</span>
        </a>
        <a href="{{ route('dosen-wali.rps.index') }}" class="menu-link {{ request()->routeIs('dosen-wali.rps.index') ? 'active' : '' }}">
            {!! $menuIcon !!}
            <span>RPS</span>
        </a>
    @else
        <!-- Kaprodi -->
        <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            {!! $menuIcon !!}
            <span>Dashboard</span>
        </a>
        <a href="{{ route('nilai.index') }}" class="menu-link {{ request()->routeIs('nilai.*') ? 'active' : '' }}">
            {!! $menuIcon !!}
            <span>Nilai</span>
        </a>

        @php
            $mataKuliahOpen = request()->routeIs('mata-kuliah.*');
        @endphp
        <a href="#" class="menu-link menu-toggle {{ $mataKuliahOpen ? 'active' : '' }}" onclick="toggleSubmenu(event, 'submenu-mata-kuliah')">
            {!! $menuIcon !!}
            <span>Mata Kuliah</span>
        </a>

        <div id="submenu-mata-kuliah" class="submenu {{ $mataKuliahOpen ? 'show' : '' }}">
            <a href="{{ route('mata-kuliah.lihat.ui') }}" class="submenu-link {{ request()->routeIs('mata-kuliah.lihat.ui') ? 'active' : '' }}">
                Lihat Mata Kuliah
            </a>
            <a href="{{ route('mata-kuliah.index') }}" class="submenu-link {{ request()->routeIs('mata-kuliah.index') ? 'active' : '' }}">
                Kelola Mata Kuliah
            </a>
        </div>

        <a href="{{ route('rps.index') }}" class="menu-link {{ request()->routeIs('rps.*') ? 'active' : '' }}">
            {!! $menuIcon !!}
            <span>RPS</span>
        </a>
    @endif

    <div class="logout-area">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">⏻ Log Out</button>
        </form>
    </div>
</aside>

<script>
    function toggleSubmenu(event, id) {
        event.preventDefault();
        event.stopPropagation();
        const submenu = document.getElementById(id);
        if(submenu) submenu.classList.toggle('show');
    }
</script>
