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
    <script src="{{ asset('css/bootstrap.min.js') }}"></script>

</head>

<body>

    <div class="container-fluid top-nav">
        <div class="row top_nav">
            <div class="col-1 border text-end">
                <img src="{{ asset('images/logo.png') }}" width="64">
            </div>
            <div class="col-2 border siteNameText">
                Stream gid
            </div>
            <div class="col text-end border" style="padding-right: 5%">
                @if (Auth::check())
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a href="{{ route("chat_index") }}" style="margin-right: 30px"><img
                            src="{{ asset('images/chat.png') }}" width="48"></a>
                    <a href="{{ route('profile') }}" style="margin-right: 30px"><img
                            src="{{ asset('images/user.png') }}" width="48"></a>
                    <button>
                        <img src="{{ asset('images/logout.png') }}" width="48" />
                    </button>
                </form>
                @else
                <a href="{{ route('auth') }}"><button class="btn-auth">Авторизация</button></a>
                <a href="{{ route('reg') }}"> <button class="btn-auth">Регистрация</button></a>
                @endif
            </div>
        </div>
    </div>

    <main>

        <div class="container-fluid">
            <div class="row">
                <div class="col-2 text-center border cities_nav">
                    <div style="padding-bottom: 20px">
                        <a href="{{ url("") }}"><button class="btn-all-city">Все города</button></a></br>
                    </div>
                    @foreach ($cities as $city)
                    <a href="{{ url("?city=" . $city['name']) }}"><button
                            class="btn-city">{{ $city['name'] }}</button></a></br>
                    @endforeach
                </div>
                @yield('content')
            </div>
            <div class="row">
                <footer style="margin-top: 2%">
                    &copy; {{ date('Y') }} Мой сайт
                </footer>
            </div>
        </div>

    </main>




    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>