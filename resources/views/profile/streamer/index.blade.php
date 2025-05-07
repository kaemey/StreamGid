@extends('layouts.main')

@section('title', 'Главная страница')

@section('content')
    <div class="col border text-center">
        <div style="margin-top: 2%;">

            <table class="table" style="width:50%;">
                <tbody>
                    <tr>
                        <td>
                            <h2>Профиль</h2>
                        </td>
                        <td><a href="{{ route("orderList") }}"><button>Список заказов</button></a></td>
                    </tr>
                    <tr>
                        <th>Имя</th>
                        <td>{{ $user['name'] }}</td>
                    </tr>
                    <tr>
                        <th>Телефон</th>
                        <td>{{ $user['phone'] }}</td>

                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user['email'] }}</td>

                    </tr>
                    <tr>
                        <th>Аватар</th>
                        @if (isset($user['avatar']))
                            <td>
                                <img src="{{ asset($user['avatar']) }}" width="50%"><br><br>
                                <form enctype="multipart/form-data" method="post" action="{{ route('upload_avatar') }}">
                                    @csrf
                                    <input type="file" name="avatar">
                                    <input type="submit" value="Загрузить">
                                </form>
                            </td>
                        @else
                            <td>
                                <img src="images/image.png" width="50%"><br><br>
                                <form enctype="multipart/form-data" method="post" action="{{ route('upload_avatar') }}">
                                    @csrf
                                    <input type="file" name="avatar">
                                    <input type="submit" value="Загрузить">
                                </form>
                            </td>
                        @endif

                    </tr>
                    <tr>
                        <td>Расписание</td>
                        <td>
                            <?php $i = 1 ?>
                            @foreach ($timing as $day => $time)

                                @if($i % 5 == 0)
                                    <br>
                                @endif

                                @if($time[0])
                                    <span style="padding: 3px; background-color: green; margin: 3px;">{{ $day }} :
                                        {{ $time[1] }} -
                                        {{ $time[2] }}
                                    </span>
                                @else
                                    <span style="padding: 3px; background-color: grey; margin: 3px;">{{ $day }} : -
                                    </span>
                                @endif
                                <?php    $i++ ?>
                            @endforeach
                        </td>

                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <form action="{{ route("profile.edit") }}" method="get">
                                <button type="submit">Редактировать профиль</button>
                            </form>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection