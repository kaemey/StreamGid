@extends('layouts.main')

@section('title', 'Анкета стримера')

@section('content')
    <div class="col-md-9">
        <div class="card shadow-lg border-0 p-4" style="background: linear-gradient(145deg, #f0f8ff, #e6f0ff);">

            {{-- Заголовок --}}
            <div class="d-flex justify-content-start align-items-center mb-3 ps-2">
                <h2 class="text-primary"><i class="bi bi-person-lines-fill me-2"></i>Анкета стримера</h2>
            </div>

            {{-- Кнопка заказа стрима --}}
            <div class="mb-4 px-2">
                @if (Auth::check())
                    <a href="{{ route('orderStream', $user['id']) }}" class="btn btn-danger shadow px-4 py-2"
                        style="min-width: 220px;">
                        <i class="bi bi-controller me-2"></i>Заказать стрим
                    </a>
                @else
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <button class="btn btn-outline-secondary shadow" disabled>
                            <i class="bi bi-lock-fill me-1"></i>Войдите для заказа
                        </button>
                        <a href="{{ route('auth') }}">
                            <button class="btn btn-outline-primary shadow">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Авторизация
                            </button>
                        </a>
                    </div>
                @endif
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
                            <div class="d-flex flex-wrap gap-4 align-items-start">
                                {{-- Фото --}}
                                <img src="{{ asset($user['avatar'] ?? 'images/image.png') }}"
                                    class="img-thumbnail rounded shadow-sm"
                                    style="max-width: 250px; border: 2px solid #0d6efd;">

                                {{-- Категории --}}
                                <div class="d-flex flex-column gap-2">
                                    <div class="fw-semibold text-secondary"><i class="bi bi-tags-fill me-1"></i>Категории:
                                    </div>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($categories as $category)
                                            <span class="badge rounded-pill px-3 py-2 shadow-sm fw-semibold"
                                                style="
        background-color: {{ in_array($category->id, $user['categories']) ? '#0d6efd' : '#dc3545' }};
        color: white;
        font-size: 0.95rem;
    ">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="bi bi-chat-text-fill me-2 text-info"></i>О себе</th>
                        <td>{{ $user['about'] ?? 'Информация не указана' }}</td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-calendar-week-fill me-2 text-info"></i>Расписание</th>
                        <td>
                            <div class="d-flex flex-wrap justify-content-start gap-2">
                                @foreach ($timing as $day => $time)
                                    <div class="text-center border rounded shadow-sm px-2 py-1"
                                        style="min-width: 110px;
                           background-color: {{ $time[0] ? '#d1e7dd' : '#f8d7da' }};">
                                        <div class="fw-bold">{{ $day }}</div>
                                        @if ($time[0])
                                            <small class="text-success">{{ $time[1] }} – {{ $time[2] }}</small>
                                        @else
                                            <small class="text-danger">неактивен</small>
                                        @endif
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
