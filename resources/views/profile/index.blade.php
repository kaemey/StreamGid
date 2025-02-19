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
            Профиль
            <div class="container-fluid" style="padding-top: 1%">

                <form>

                </form>

            </div>
        </div>
    </div>

</div>
</div>
@endsection