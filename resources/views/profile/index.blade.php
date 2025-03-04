@extends('layouts.main')

@section('title', 'Главная страница')

@section('content')
    <div class="container-fluid">
        <div class="row left_nav">
            <div class="col-2 text-center border">
                @for ($i = 0; $i < 9; $i++) <a href="123123">"Москва"</a></br>
                @endfor
            </div>
            <div class="col border text-center">
                <div style="margin-top: 2%;">
                    Профиль
                    <table class="table" style="width:50%;">
                        <tbody>
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
                                <td></td>
                                <td align="center" width="500px">
                                    <form action="{{ route("profile.edit") }}" method="get">
                                        <button type="submit">Редактировать профиль</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>




            </div>
        </div>

    </div>
    </div>
@endsection