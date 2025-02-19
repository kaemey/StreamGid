@extends('layouts.main')

@section('title', 'Главная страница')

@section('content')
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

                    @for ($i = 0; $i < 9; $i++) <div class="col-4 text-center anketa" data-url="https://www.google.com">
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
@endsection