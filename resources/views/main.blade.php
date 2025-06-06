@extends('layouts.main')

@section('title', 'Главная страница')

@section('content')

<div class="col-md-9">
    <h3 class="mb-4">Анкеты</h3>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" id="anketa_list">

        @foreach($formsData as $form)

        @if (isset($_GET['city']))
        @if($form['city'] == $_GET['city'])
        <!-- Card -->
        <div class="col anketa">
            <a href="{{ url('form/' . $form['id']) }}">
                <div class="card profile-card h-100 shadow">
                    @if(isset($form['photo']))
                    <img src="{{ asset($form['photo']) }}" class="card-img-top">
                    @else
                    <img src="{{ asset('images/image.png') }}" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $form['username'] }}<span class="rating-star"> ★
                                {{ $form['rate'] }}</span>
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @else
        <!-- Card -->
        <div class="col anketa">
            <a href="{{ url('form/' . $form['id']) }}">
                <div class="card profile-card h-100 shadow">
                    @if(isset($form['photo']))
                    <img src="{{ asset($form['photo']) }}" class="card-img-top">
                    @else
                    <img src="{{ asset('images/image.png') }}" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $form['username'] }}<span class="rating-star"> ★
                                {{ $form['rate'] }}</span>
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        @endif

        @endforeach

    </div>
</div>

@endsection