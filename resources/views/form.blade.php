@extends('layouts.main')

@section('title', 'Анкета')

@section('content')
    <div class="col border text-center">
        <div style="margin-top: 2%;">

            <table class="table" style="width:65%;">
                <tbody>
                    <tr>
                        <td>
                            Анкета
                        </td>
                        <td>
                            @if(Auth::check())
                                <a href="{{ route('orderStream', $user['id']) }}"><button>Заказать стрим</button></a>
                            @else
                                <a href="{{ route('orderStream', $user['id']) }}"><button disabled>Заказать
                                        стрим</button></a><br>
                                Авторизируйтесь, чтобы заказать стрим.
                            @endif
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
                        <td>
                            @foreach ($timing as $day => $time)
                                @if($time[0])
                                    <span style="padding: 3px; background-color: green; margin: 3px;">{{ $day }} :
                                        {{ $time[1] }} -
                                        {{ $time[2] }}
                                    </span>
                                @else
                                    <span style="padding: 3px; background-color: grey; margin: 3px;">{{ $day }} : -
                                    </span>
                                @endif

                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection