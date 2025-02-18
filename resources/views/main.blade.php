<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->

    <!-- Styles / Scripts -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('css/bootstrap.min.js') }}"></script>

</head>

<body>
    <div class="container-fluid" style="padding: 2%">
        <div class="row top_nav">
            <div class="col-1 border">
                Logo
            </div>
            <div class="col-1 border">
                Название
            </div>
            <div class="col text-end border" style="padding-right: 5%">
                <img src="{{ asset('images/user.png') }}" width="48">
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row left_nav">
            <div class="col-2 text-center border">
                @for ($i = 0; $i < 9; $i++) <a href="123123">"Москва"</a></br>
                @endfor
            </div>
            <div class="col border text-center">
                Анкеты
                <div class="container-fluid" style="padding-top: 1%">
                    <div class="row" id="anketa_list">

                        @for ($i = 0; $i < 9; $i++)
                            <div class="col-4 text-center anketa" data-url="https://www.google.com">
                                <div class="bgAnketa anketa">
                                    <img src="{{ asset('images/image.png') }}" class="anketa" width="256"
                                        style="margin-bottom: 4%;"><br>
                                    <p class="anketa">Имя 4.5 <img src="{{ asset('images/star.png') }}"></p>
                                </div>
                            </div>

                        @endfor


                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    <script src="{{ asset('css/main.js') }}"></script>
</body>


</html>