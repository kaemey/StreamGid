@extends('layouts.main')

@section('title', 'Анкета')

@section('content')
<div class="col-md-8 mx-auto mt-5">
    <div class="card shadow rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h4 class="my-2">Оформление заказа стрима</h4>
        </div>
        <div class="card-body">
            <div class="mb-3 text-start">
                <a href="{{ route('form', $streamer['id']) }}" class="btn btn-outline-secondary">
                    ← Вернуться
                </a>
            </div>

            <form method="POST" action="{{ route("sendOrder") }}">
                @csrf

                <input type="hidden" name="streamer_id" value="{{ $streamer['id'] }}">

                <div class="mb-4">
                    <label for="day" class="form-label fw-bold">Дата</label>
                    <select name="day" id="day" class="form-select">
                        <?php $i = 1; ?>
                        @foreach ($timing as $day => $time)
                        @if($time[0])
                        <option value="{{ $i }}">
                            {{ $day }} : {{ $time[1] }} - {{ $time[2] }}
                        </option>
                        @else
                        <option disabled>
                            {{ $day }} : -
                        </option>
                        @endif
                        <?php    $i++; ?>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label fw-bold">Опишите, какие места вы хотите увидеть</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5">📹 Заказать стрим</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection