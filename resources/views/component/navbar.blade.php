<div class="container">
    <div class="topbar">
        <a class="topbar-link">Pendaftaran Panitia</a>
        <a href="#ukm" class="topbar-link">UKM</a>
        <a href="#news" class="topbar-link">News</a>
    </div>
    <nav class="navbar container">
        <a href="{{ route('main.index') }}" class="navbar-brand">
            <img src="{{ asset('assets/image/brand/brand-logo.svg') }}" class="brand-logo" alt="Brand Logo" height="42">
        </a>
        <div class="navbar-button">
            <a href="#ormawa" class="button-link hidden lg:inline-block">Ormawa</a>
            <a href="#ukm" class="button-link hidden lg:inline-block">UKM</a>
            <a href="#news" class="button-link hidden lg:inline-block">News</a>
            <a href="{{ route('user.index') }}" class="button-primary">Masuk</a>
        </div>
    </nav>
</div>
