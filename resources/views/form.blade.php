@extends('layouts.main')

@section('title', 'Анкета')

@section('content')
<div class="col border text-center">
    <div style="margin-top: 2%;">
        Анкета
        <table class="table" style="width:50%;">
            <tbody>
                <tr>
                    <th>Имя</th>
                    <td>{{ $user['name'] }}</td>
                </tr>
                <tr>
                    <th>Рейтинг</th>
                    <td>{{ $user['rate'] }}</td>
                </tr>
                <tr>
                    <th>Фото</th>
                    @if (isset($user['avatar']))
                    <td><img src="{{ asset($user['avatar']) }}" width="50%"></td>
                    @else
                    <td><img src="images/image.png" width="50%"></td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection