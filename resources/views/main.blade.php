@extends('layouts.main')

@section('title', 'Главная страница')

@section('content')

    <div class="col border text-center">
        Анкеты
        <div class="container-fluid" style="padding-top: 1%">
            <div class="row" id="anketa_list">

                @foreach($formsData as $form)

                    @if (isset($_GET['city']))
                        @if($form['city'] == $_GET['city'])
                            <div class="col-4 text-center anketa" data-url="{{ url('forms/' . $form['id']) }}">
                                <div class="bgAnketa anketa">
                                    @if(isset($form['photo']))
                                        <img src="{{ asset($form['photo']) }}" class="anketa" width="256" style="margin-bottom: 4%;">
                                    @else
                                        <img src="{{ asset('images/image.png') }}" class="anketa" width="256" style="margin-bottom: 4%;">
                                    @endif
                                    <br>
                                    <p class="anketa">{{ $form['username'] }} 4.5 <img src="{{ asset('images/star.png') }}"></p>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="col-4 text-center anketa" data-url="{{ url('forms/' . $form['id']) }}">
                            <div class="bgAnketa anketa">
                                @if(isset($form['photo']))
                                    <img src="{{ asset($form['photo']) }}" class="anketa" width="256" style="margin-bottom: 4%;">
                                @else
                                    <img src="{{ asset('images/image.png') }}" class="anketa" width="256" style="margin-bottom: 4%;">
                                @endif
                                <br>
                                <p class="anketa">{{ $form['username'] }} 4.5 <img src="{{ asset('images/star.png') }}"></p>
                            </div>
                        </div>
                    @endif

                @endforeach


            </div>
        </div>
    </div>

@endsection