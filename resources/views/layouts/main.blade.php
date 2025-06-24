<?php
use App\Models\City;
use App\Models\Category;

$cities = City::all();
$categories = Category::all();
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
                    <div class="p-3 shadow-sm rounded bg-light">

                        <form method="GET" action="{{ url('') }}">
                            <!-- Город -->
                            <div class="mb-3">
                                <label for="city" class="form-label fw-bold">Выберите город</label>
                                <select name="city" id="city" class="form-select">
                                    <option value="">Все города</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ request('city') == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Категория -->
                            <div class="mb-3">
                                <label for="category" class="form-label fw-bold">Категория</label>
                                <select name="category" id="category" class="form-select">
                                    <option value="">Все категории</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Отзывы -->
                            <div class="mb-3">
                                <label for="reviews" class="form-label fw-bold">Отзывы</label>
                                <select name="reviews" id="reviews" class="form-select">
                                    <option value="">Неважно</option>
                                    <option value="with" {{ request('reviews') === 'with' ? 'selected' : '' }}>Только
                                        с отзывами</option>
                                    <option value="without" {{ request('reviews') === 'without' ? 'selected' : '' }}>
                                        Без отзывов</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100"><i
                                    class="bi bi-funnel-fill me-1"></i>Применить</button>
                        </form>

                    </div>
                </div>
                <!-- Sidebar -->

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
