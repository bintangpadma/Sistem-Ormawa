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
<main class="dashboard flex">
    @include('component.sidebar')
    <div class="dashboard-content w-full">
        @include('component.topbar')
        <div class="content p-[16px] md:p-[32px] lg:p-[36px] xl:p-[42px]">
            @yield('content')
        </div>
    </div>
</main>

<script>
    const hamburger = document.querySelector('.button-hamburger')
    const sidebar = document.querySelector('.sidebar')

    hamburger.addEventListener('click', function() {
        sidebar.classList.toggle('active')
    })
</script>
</body>
</html>
