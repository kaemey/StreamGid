<?php
use App\Models\City;

$cities = City::all();
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('/images/favicon.ico') }}" sizes="32x32" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('/images/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('/images//site.webmanifest') }}">

    <title>Stream gid</title>

    <!-- Fonts -->

    <!-- Styles / Scripts -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
    <script src="{{ asset('css/bootstrap.bundle.min.js') }}"></script>
    @yield('header')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar px-4 py-2">
        <a class="navbar-brand navbar-expand-lg px-4 py-3 d-flex align-items-center" href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="me-2" width="64">
            <span class="text-white fw-bold fs-4">Stream gid</span>
        </a>
        <div class="ms-auto">
            <div class="d-flex align-items-center gap-3 auth">
                @if (Auth::check())
                    <a href="{{ route('chat_index') }}" class="text-white fs-1"><i
                            class="bi bi-chat-dots-fill"></i></a>
                    <a href="{{ route('profile') }}" class="text-white fs-1"><i class="bi bi-person-circle"></i></a>

                    <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center m-0 p-0">
                        @csrf
                        <button type="submit" class="btn btn-link text-white fs-1 p-0 m-0"><i
                                class="bi bi-box-arrow-right"></i></button>
                    </form>
                @else
                    <a href="{{ route('auth') }}"><button class="btn btn-outline-light me-2">Авторизация</button></a>
                    <a href="{{ route('reg') }}"> <button class="btn btn-primary">Регистрация</button></a>
                @endif
            </div>
        </div>
    </nav>


    <main>

        <div class="container-fluid mt-4">
            <div class="row">

                <!-- Sidebar -->
                <div class="col-md-3 mb-4">
                    <div class="city-scroll p-2 shadow-sm rounded bg-light">
                        <a href="{{ url('') }}" class="btn btn-warning fw-bold mb-3 shadow-sm w-100">
                            <i class="bi bi-globe2 me-2"></i>Все города
                        </a>

                        <div class="d-grid gap-2">
                            @foreach ($cities as $city)
                                <a href="{{ url('?city=' . $city['name']) }}"
                                    class="city-button btn btn-outline-primary text-start">
                                    <i class="bi bi-geo-alt-fill me-1"></i>{{ $city['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                @yield('content')

            </div>
        </div>

    </main>

    <footer class="text-center py-4 shadow-sm">

        <div class="container">
            <div class="row">
                <div class="col-md-6 text-md-start mb-2 mb-md-0">
                    <p class="mb-0">© {{ date('Y') }} Stream gid. Все права защищены.</p>
                </div>
                <div class="col-md-6 text-md-end footer-links">
                    <a href="#"><i class="bi bi-shield-lock"></i> Политика</a>
                    <a href="#"><i class="bi bi-envelope"></i> Контакты</a>
                </div>

            </div>
        </div>
    </footer>


    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
