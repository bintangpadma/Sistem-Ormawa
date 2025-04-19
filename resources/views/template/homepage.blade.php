<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page }} | Organisasi Mahasiswa Universitas Primakara</title>

    {{-- STYLE CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite('resources/css/app.css')
    {{-- END STYLE CSS --}}
</head>
<body>
<main class="homepage w-full">
    @include('component.navbar')
    <div class="homepage-content w-full">
        @yield('content')
        <footer class="footer container">
            <p class="copyright">Copyright © 2025 Ivan Verdyansyah</p>
        </footer>
    </div>
</main>
</body>
</html>
