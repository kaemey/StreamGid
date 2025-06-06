@extends('layouts.main')

@section('title', 'Анкета стримера')

@section('content')
<div class="col-md-9">
    <div class="card shadow-lg border-0 p-4 position-relative"
        style="background: linear-gradient(145deg, #f0f8ff, #e6f0ff);">

        @if(Auth::check())
        <a href="{{ route('orderStream', $user['id']) }}"
            class="btn btn-danger position-absolute top-0 start-0 m-3 shadow">
            <i class="bi bi-controller me-1"></i>Заказать стрим
        </a>
        @else
        <div class="position-absolute top-0 start-0 m-3">
            <button class="btn btn-outline-secondary shadow" disabled>
                <i class="bi bi-lock-fill me-1"></i>Войдите для заказа
            </button>
        </div>
        @endif

        {{-- Заголовок с отступом --}}
        <div class="d-flex justify-content-start align-items-center mb-4 mt-5 ps-2">
            <h2 class="text-primary"><i class="bi bi-person-lines-fill me-2"></i>Анкета стримера</h2>
        </div>

        {{-- Таблица анкеты --}}
        <table class="table table-borderless text-dark">
            <tbody>
                <tr>
                    <th style="width: 25%;"><i class="bi bi-person-fill me-2 text-info"></i>Имя</th>
                    <td class="fw-semibold">{{ $user['name'] }}</td>
                </tr>
                <tr>
                    <th><i class="bi bi-star-fill me-2 text-warning"></i>Рейтинг</th>
                    <td class="fw-semibold text-dark">
                        {{ $user['rate'] }}
                        <img src="{{ asset('images/star.png') }}" alt="Звезда" style="width: 20px;">
                    </td>
                </tr>
                <tr>
                    <th><i class="bi bi-image-fill me-2 text-info"></i>Фото</th>
                    <td>
                        <img src="{{ asset($user['avatar'] ?? 'images/image.png') }}"
                            class="img-thumbnail rounded shadow-sm"
                            style="max-width: 250px; border: 2px solid #0d6efd;">
                    </td>
                </tr>
                <tr>
                    <th><i class="bi bi-chat-text-fill me-2 text-info"></i>О себе</th>
                    <td>{{ $user['about'] ?? 'Информация не указана' }}</td>
                </tr>
                <tr>
                    <th><i class="bi bi-calendar-week-fill me-2 text-info"></i>Расписание</th>
                    <td>
                        <div class="row">
                            @foreach ($timing as $day => $time)
                            <div class="col-md-6 mb-2">
                                <span class="badge bg-{{ $time[0] ? 'success' : 'secondary' }} p-2 fs-6 shadow-sm">
                                    <strong>{{ $day }}:</strong>
                                    @if ($time[0])
                                    {{ $time[1] }} - {{ $time[2] }}
                                    @else
                                    неактивен
                                    @endif
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection