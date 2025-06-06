@extends('layouts.main')

@section('title', 'Главная страница')

@section('content')
    <div class="col border-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0 rounded-4"
                        style="background: linear-gradient(145deg, #f0f8ff, #e6f0ff);">
                        <div class="card-header bg-primary text-white fw-semibold rounded-top-4 d-flex align-items-center">
                            <i class="bi bi-box-arrow-in-right me-2 fs-5"></i> {{ __('Авторизация') }}
                        </div>

                        <div class="card-body p-5">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-4 row">
                                    <label for="email" class="col-md-4 col-form-label text-md-end fw-semibold">
                                        <i class="bi bi-envelope-at-fill text-primary me-1"></i>{{ __('Email / Телефон') }}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control rounded-3 shadow-sm @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label for="password" class="col-md-4 col-form-label text-md-end fw-semibold">
                                        <i class="bi bi-shield-lock-fill text-primary me-1"></i>{{ __('Пароль') }}
                                    </label>

                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control rounded-3 shadow-sm @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check text-start">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                {{ __('Запомнить меня') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4 d-flex align-items-center gap-2">
                                        <button type="submit" class="btn btn-success shadow-sm px-4 rounded-3">
                                            <i class="bi bi-box-arrow-in-right me-1"></i>{{ __('Войти') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link text-decoration-none text-primary"
                                                href="{{ route('password.request') }}">
                                                <i class="bi bi-question-circle-fill me-1"></i>{{ __('Забыли пароль?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
