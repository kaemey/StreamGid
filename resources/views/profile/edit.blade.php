@extends('layouts.main')

@section('title', 'Редактирование профиля')

@section('content')
<div class="col-md-8 mx-auto mt-5">
    <div class="card shadow rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h4 class="my-2">Редактировать профиль</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf

                <div class="mb-3 row">
                    <label for="name" class="col-sm-3 col-form-label text-end">Имя</label>
                    <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" id="name" value="{{ $user['name'] }}"
                            required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="phone" class="col-sm-3 col-form-label text-end">Телефон</label>
                    <div class="col-sm-9">
                        <input type="text" name="phone" class="form-control" id="phone" value="{{ $user['phone'] }}"
                            required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-3 col-form-label text-end">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" id="email" value="{{ $user['email'] }}"
                            required>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-5">💾 Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection