@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-lg border-0 mt-5 p-4"
                style="background: linear-gradient(135deg, #f0f8ff, #e6f0ff);">

                <h3 class="text-center text-primary mb-4">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Вход в аккаунт
                </h3>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end fw-semibold">
                                <i class="bi bi-envelope-fill me-1 text-info"></i>Email
                            </label>
                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control shadow-sm @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end fw-semibold">
                                <i class="bi bi-lock-fill me-1 text-info"></i>Пароль
                            </label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control shadow-sm @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Remember me --}}
                        <div class="mb-3 row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Запомнить меня
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 d-flex align-items-center gap-3">
                                <button type="submit" class="btn btn-success shadow-sm px-4">
                                    <i class="bi bi-door-open-fill me-1"></i>Войти
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link text-decoration-none text-primary"
                                    href="{{ route('password.request') }}">
                                    Забыли пароль?
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
@endsection