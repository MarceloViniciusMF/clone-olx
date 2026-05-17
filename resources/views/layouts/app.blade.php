<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
            <div class="container">

                <a class="navbar-brand logo-olx" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <div class="flex-grow-1 px-lg-4 px-0 mt-3 mt-lg-0">
                        <form action="{{ route('search.index') }}" method="GET" class="d-flex">
                            <div class="input-group">
                                <input type="text" class="form-control olx-search-input"
                                    placeholder="Buscar em todo o site..." name="q" value="{{ request('q') }}"
                                    aria-label="Buscar">
                                <button class="btn olx-search-button" type="submit" id="button-search">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>

                    <ul class="navbar-nav ms-auto d-flex flex-row align-items-center mt-3 mt-lg-0">

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link olx-nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link olx-nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link olx-nav-link" href="{{ route('home') }}">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link olx-nav-link"
                                    href="{{ route('admin.categories.index') }}">{{ __('Categorias') }}</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link olx-nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                        <li class="nav-item ms-3">
                            <a href="{{ route('ads.create') }}" class="btn btn-anunciar">
                                Anunciar
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer class="footer-olx mt-auto py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6 mb-3">
                <h5>Navegação</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('welcome') }}" class="footer-link">Página Inicial</a></li>
                    <li><a href="{{ route('admin.categories.index') }}" class="footer-link">Categorias</a></li>
                    <li><a href="{{ route('ads.create') }}" class="footer-link">Anunciar</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <h5>Institucional</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">Sobre Nós</a></li>
                    <li><a href="#" class="footer-link">Ajuda e Contato</a></li>
                    <li><a href="#" class="footer-link">Termos de Uso</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <h5>Redes Sociais</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="footer-link">Facebook</a></li>
                    <li><a href="#" class="footer-link">Instagram</a></li>
                    <li><a href="#" class="footer-link">YouTube</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-6 mb-3">
                <h5>Seu App</h5>
                <p class="footer-text">Baixe nosso app e anuncie.</p>
                </div>
        </div>

        <hr class="footer-divider">

        <div class="row text-center">
            <div class="col">
                <p class="footer-text mb-0">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Todos os direitos reservados.
                </p>
            </div>
        </div>
    </div>
</footer>

</body>

</html>