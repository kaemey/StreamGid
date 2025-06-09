@extends('layouts.main')

@section('title', 'Редактирование профиля стримера')

@section('content')
    <div class="col-md-9">
        <div class="card shadow-lg border-0 p-4" style="background: linear-gradient(145deg, #f0f8ff, #e6f0ff);">
            <h2 class="text-primary mb-4">
                <i class="bi bi-pencil-square me-2"></i>Редактирование профиля стримера
            </h2>

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <table class="table table-borderless text-dark">
                    <tbody>
                        <tr>
                            <th style="width: 25%;">
                                <i class="bi bi-person-fill me-2 text-info"></i>Имя
                            </th>
                            <td>
                                <input type="text" class="form-control" name="name" value="{{ $user['name'] }}">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-telephone-fill me-2 text-info"></i>Телефон
                            </th>
                            <td>
                                <input type="text" class="form-control" name="phone" value="{{ $user['phone'] }}">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-envelope-fill me-2 text-info"></i>Email
                            </th>
                            <td>
                                <input type="text" class="form-control" name="email" value="{{ $user['email'] }}">
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <i class="bi bi-tags-fill me-2 text-info"></i>Категории
                            </th>

                            <td>

                                <div class="border rounded p-3 bg-white shadow-sm">
                                    <div class="row row-cols-2 row-cols-md-3 g-2">
                                        @for ($i = 0; $i < getCategoryCount(); $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="categories[]"
                                                    value="{{ $i }}" id="cat-{{ $i }}"
                                                    @if (in_array($i, $user['categories'])) checked @endif>
                                                <label class="form-check-label" for="cat-{{ $i }}">
                                                    {{ getCategoryAsString($i) }}
                                                </label>
                                            </div>
                                        @endfor
                                    </div>
                                    <small class="text-muted">Выберите одну или несколько категорий, подходящих вашему
                                        контенту.</small>
                                </div>

                            </td>
                        </tr>


                        <tr>
                            <th>
                                <i class="bi bi-toggle-on me-2 text-info"></i>Активировать анкету
                            </th>
                            <td>
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" name="active" id="activeSwitch"
                                        @if ($user['active'] == '1') checked @endif>
                                    <label class="form-check-label" for="activeSwitch">Видим для заказчиков</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-calendar-week me-2 text-info"></i>Расписание
                            </th>
                            <td>
                                <div class="row">
                                    @php $i = 1; @endphp
                                    @foreach ($timing as $day => $time)
                                        <div class="col-md-6 mb-2">
                                            <div class="border p-3 rounded shadow-sm bg-white">
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input"
                                                        id="day-{{ $i }}" name="time:{{ $i }}:0"
                                                        @if ($time[0]) checked @endif>
                                                    <label class="form-check-label fw-bold"
                                                        for="day-{{ $i }}">{{ $day }}</label>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-text">с</span>
                                                    <input type="text" name="time:{{ $i }}:1"
                                                        value="{{ $time[1] }}" class="form-control">
                                                    <span class="input-group-text">до</span>
                                                    <input type="text" name="time:{{ $i }}:2"
                                                        value="{{ $time[2] }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        @php $i++; @endphp
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-end">
                                <button type="submit" class="btn btn-outline-success px-4">
                                    <i class="bi bi-save me-1"></i>Сохранить изменения
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
@endsection
