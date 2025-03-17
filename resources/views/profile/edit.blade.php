@extends('layouts.main')

@section('title', 'Главная страница')

@section('content')
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
                        <th>Расписание</th>
                        <td>
                            <?php $i = 1; ?>
                            @foreach ($timing as $day => $time)
                            <input type="checkbox" name="time:<?=$i?>:0" @if ($time[0]) checked @endif /> {{ $day }} :
                            <input type="text" name="time:<?=$i?>:1" value="{{ $time[1] }}"> - <input type="text"
                                name="time:<?=$i?>:2" value="{{ $time[2] }}"><br>
                            <?php    $i += 1; ?>
                            @endforeach
                        </td>
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

@endsection