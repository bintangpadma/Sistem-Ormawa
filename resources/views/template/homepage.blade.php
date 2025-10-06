<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page }} | Organisasi Mahasiswa Universitas Primakara</title>

    {{-- STYLE CSS --}}
    <script src="https://kit.fontawesome.com/e5ccf98c71.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite('resources/css/app.css')
    {{-- END STYLE CSS --}}
</head>
<body>
<main class="homepage w-full flex flex-col min-h-dvh md:min-h-screen">
    @include('component.navbar')
    <div class="homepage-content w-full pb-[120px]">
        @yield('content')
    </div>
</main>
</body>
</html>
