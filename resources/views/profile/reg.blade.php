@extends('layouts.main')

@section('title', 'Регистрация')

@section('content')
    <div class="col-md-9">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="card shadow-lg border-0 rounded-4"
                        style="background: linear-gradient(145deg, #f0f8ff, #e6f0ff);">
                        <div class="card-header bg-success text-white fw-semibold rounded-top-4 d-flex align-items-center">
                            <i class="bi bi-person-plus-fill me-2 fs-5"></i> Регистрация
                        </div>

                        <div class="card-body p-5">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                {{-- Имя --}}
                                <div class="mb-4 row">
                                    <label for="name" class="col-md-4 col-form-label text-md-end fw-semibold">
                                        <i class="bi bi-person-fill text-success me-1"></i>Имя
                                    </label>
                                    <div class="col-md-6">
                                        <input id="name" type="text"
                                            class="form-control rounded-3 shadow-sm @error('name') is-invalid @enderror"
                                            name="name" value="{{ old('name') }}" required autofocus>
                                        @error('name')
                                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Я стример --}}
                                <div class="mb-4 row">
                                    <label for="isStreamer" class="col-md-4 col-form-label text-md-end fw-semibold">
                                        <i class="bi bi-camera-video-fill text-success me-1"></i>Я стример
                                    </label>
                                    <div class="col-md-6 d-flex align-items-center">
                                        <input type="checkbox" id="isStreamer" name="isStreamer"
                                            class="form-check-input ms-1" {{ old('isStreamer') ? 'checked' : '' }}>
                                    </div>
                                </div>

                                {{-- Телефон --}}
                                <div class="mb-4 row">
                                    <label for="phone" class="col-md-4 col-form-label text-md-end fw-semibold">
                                        <i class="bi bi-telephone-fill text-success me-1"></i>Телефон
                                    </label>
                                    <div class="col-md-6">
                                        <input id="phone" type="text"
                                            class="form-control rounded-3 shadow-sm @error('phone') is-invalid @enderror"
                                            name="phone" value="{{ old('phone') }}" required placeholder="+7">
                                        @error('phone')
                                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="mb-4 row">
                                    <label for="email" class="col-md-4 col-form-label text-md-end fw-semibold">
                                        <i class="bi bi-envelope-at-fill text-success me-1"></i>Email
                                    </label>
                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control rounded-3 shadow-sm @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Пароль --}}
                                <div class="mb-4 row">
                                    <label for="password" class="col-md-4 col-form-label text-md-end fw-semibold">
                                        <i class="bi bi-lock-fill text-success me-1"></i>Пароль
                                    </label>
                                    <div class="col-md-6">
                                        <input id="password" type="password"
                                            class="form-control rounded-3 shadow-sm @error('password') is-invalid @enderror"
                                            name="password" required>
                                        @error('password')
                                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Подтверждение пароля --}}
                                <div class="mb-4 row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end fw-semibold">
                                        <i class="bi bi-check2-circle text-success me-1"></i>Подтвердите пароль
                                    </label>
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password"
                                            class="form-control rounded-3 shadow-sm" name="password_confirmation" required>
                                    </div>
                                </div>

                                {{-- Кнопка --}}
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-success px-4 shadow-sm rounded-3">
                                            <i class="bi bi-person-check-fill me-1"></i>Зарегистрироваться
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- card-body -->
                    </div> <!-- card -->
                </div>
            </div>
        </div>
    </div>
@endsection
