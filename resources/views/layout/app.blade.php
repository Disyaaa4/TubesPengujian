<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'COMPASS - Sistem Informasi Telkom University Surabaya')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;700&family=Oxygen:wght@400;700&display=swap" rel="stylesheet">

    <!-- Custom styles -->
    <style>
        @font-face {
            font-family: 'Overpass';
            src: url('https://fonts.googleapis.com/css2?family=Overpass:wght@400;700&display=swap');
        }

        @font-face {
            font-family: 'Oxygen';
            src: url('https://fonts.googleapis.com/css2?family=Oxygen:wght@400;700&display=swap');
        }

        .font-overpass {
            font-family: 'Overpass', sans-serif;
        }

        .font-oxygen {
            font-family: 'Oxygen', sans-serif;
        }
    </style>

    @yield('styles')
</head>
<body>
    @yield('content')
</body>
</html>
