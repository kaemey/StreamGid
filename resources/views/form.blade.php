@extends('layouts.main')

@section('title', 'Анкета')

@section('content')
<div class="col border text-center">
    <div style="margin-top: 2%;">

        <table class="table" style="width:50%;">
            <tbody>
                <tr>
                    <td>
                        Анкета
                    </td>
                    <td>
                        <form method="post" action="{{ route('form', $user['form_id']) }}">
                            @csrf
                            <input type="submit" value="Заказать стрим">
                        </form>
                    </td>
                </tr>
                <tr>
                    <th>Имя</th>
                    <td>{{ $user['name'] }}</td>
                </tr>
                <tr>
                    <th>Рейтинг</th>
                    <td>{{ $user['rate'] }} <img src="{{ asset('images/star.png') }}"></td>
                </tr>
                <tr>
                    <th>Фото</th>
                    @if (isset($user['avatar']))
                    <td><img src="{{ asset($user['avatar']) }}" width="50%"></td>
                    @else
                    <td><img src="images/image.png" width="50%"></td>
                    @endif
                </tr>
                <tr>
                    <th>О себе</th>
                    <td>{{ $user['about'] }}

                    </td>
                </tr>
                <tr>
                    <th>Расписание</th>
                    <td> В разработке </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection