<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->

    <!-- Styles / Scripts -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('css/bootstrap.min.js') }}"></script>

</head>

<body>

    <div class="container-fluid" style="padding: 2%;">
        <div class="row top_nav">
            <div class="col-1 border">
                Logo
            </div>
            <div class="col-1 border">
                Название
            </div>
            <div class="col text-end border" style="padding-right: 5%">
                @if (Auth::check())

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a href="{{ route('profile') }}"><img src="{{ asset('images/user.png') }}" width="48"></a>
                    <button>
                        <img src="images/logout.png" width="48" />
                    </button>
                </form>
                @else
                <a href="{{ route('auth') }}">Авторизация /</a>
                <a href="{{ route('reg') }}"> Регистрация</a>
                @endif
            </div>
        </div>
    </div>

    <main style="height: 500px">
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} Мой сайт
    </footer>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>