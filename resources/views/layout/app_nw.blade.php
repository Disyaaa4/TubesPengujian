<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'COMPASS')</title>
    @vite('resources/css/compass_nw.css')

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;700&family=Oxygen:wght@400;700&display=swap"
        rel="stylesheet">

    @yield('styles')
</head>

<body>
    <div class="compass-wrapper">
        @auth
            @include('components.sidebar_nw')
            <div class="sidebar-overlay" onclick="closeSidebar()"></div>
        @endauth

        <div class="compass-main">
            @auth
                @include('components.header_nw', [
                    'title' => trim($__env->yieldContent('headerTitle')) ?: $headerTitle ?? 'COMPASS',
                    'searchLabel' => 'Search',
                ])
            @endauth

            <main class="compass-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.dashboard-sidebar');
            const overlay = document.querySelector('.sidebar-overlay');

            if (!sidebar || !overlay) return;

            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        function closeSidebar() {
            const sidebar = document.querySelector('.dashboard-sidebar');
            const overlay = document.querySelector('.sidebar-overlay');

            if (!sidebar || !overlay) return;

            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        }
    </script>

    @yield('scripts')

</body>

</html>
