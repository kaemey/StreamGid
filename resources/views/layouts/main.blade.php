<?php
use App\Models\City;

$cities = City::all();
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stream gid</title>

    <!-- Fonts -->

    <!-- Styles / Scripts -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">
    <script src="{{ asset('css/bootstrap.bundle.min.js') }}"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-info px-4 py-2">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="me-2" width="64">
            <span class="text-white fw-bold fs-4">Stream gid</span>
        </a>
        <div class="ms-auto">
            <div class="d-flex align-items-center gap-3 auth">
                @if (Auth::check())

                <a href="{{ route('chat_index') }}" class="text-white fs-1"><i class="bi bi-chat-dots-fill"></i></a>
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
                    <div class="d-grid gap-2">

                        <a href="{{ url("") }}" class="btn btn-warning fw-bold mb-2">Все города</a>
                        @foreach ($cities as $city)
                        <a href="{{ url("?city=" . $city['name']) }}" class="btn btn-primary">
                            {{ $city['name'] }}
                        </a>
                        @endforeach
                    </div>
                </div>

                @yield('content')

            </div>
        </div>

    </main>

    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>