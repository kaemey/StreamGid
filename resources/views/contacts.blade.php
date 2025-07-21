@extends('layouts.main')

@section('title', 'Контакты')

@section('content')
    <div class="col-md-9">
        <div class="card shadow-lg border-0 p-4" style="background: linear-gradient(145deg, #f0f8ff, #e6f0ff);">

            {{-- Заголовок --}}
            <div class="d-flex justify-content-start align-items-center mb-4 ps-2">
                <h2 class="text-primary mb-0">
                    <i class="bi bi-envelope-at-fill me-2"></i>Контакты
                </h2>
            </div>

            {{-- Контактная информация --}}
            <div class="text-secondary" style="line-height: 1.7">
                <p>Если у вас возникли вопросы, предложения или вы столкнулись с проблемой — мы всегда готовы помочь. Ниже
                    представлены способы связи с нашей командой поддержки:</p>

                <ul class="list-unstyled ps-2">
                    <li class="mb-2">
                        <i class="bi bi-envelope-fill text-primary me-2"></i>
                        <strong>Email:</strong> support@streamhub.ru
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-telephone-fill text-primary me-2"></i>
                        <strong>Телефон:</strong> +7 (495) 123-45-67
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                        <strong>Офис:</strong> г. Москва, ул. Проточная, д. 12, офис 305
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-clock-fill text-primary me-2"></i>
                        <strong>График работы:</strong> Пн–Пт, с 10:00 до 18:00 (МСК)
                    </li>
                </ul>

                <p>Вы также можете связаться с нами через форму обратной связи или написать напрямую в <a
                        href="https://t.me/streamhub_support" target="_blank"
                        class="text-decoration-none text-primary">Telegram</a>.</p>

                <p class="mt-4">Наша команда стремится отвечать как можно быстрее — обычно в течение 24 часов.</p>
            </div>

        </div>
    </div>
@endsection
