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
                        <form action="{{ route("profile.update") }}" method="post">
                            @csrf
                            <tbody>

                                <tr>
                                    <th>Имя</th>
                                    <td><input type="text" name="name" value="{{ $user['name'] }}"></td>
                                </tr>
                                <tr>
                                    <th>Телефон</th>
                                    <td><input type="text" name="phone" value="{{ $user['phone'] }}"></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><input type="text" name="email" value="{{ $user['email'] }}"></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td align="center" width="500px">

                                        <button type="submit">Сохранить изменения</button>

                                    </td>
                                </tr>
                        </form>
                        </tbody>
                    </table>
                </div>




            </div>
        </div>

    </div>
    </div>
@endsection