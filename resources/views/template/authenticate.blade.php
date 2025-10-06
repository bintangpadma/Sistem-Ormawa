<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $page }} | Organisasi Mahasiswa Universitas Primakara</title>

    {{-- STYLE CSS --}}
    <script src="https://kit.fontawesome.com/e5ccf98c71.js" crossorigin="anonymous"></script>
    @vite('resources/css/app.css')
    {{-- END STYLE CSS --}}
</head>
<body>
<main class="authenticate">
    <div class="grid grid-cols-1 lg:grid-cols-2 items-center h-dvh md:h-screen">
        @yield('content')
    </div>
</main>
</body>
</html>
