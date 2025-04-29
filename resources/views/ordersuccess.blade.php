@extends('layouts.main')

@section('title', 'Анкета')

@section('content')
<div class="col border text-center">
    <div style="margin-top: 2%;">

        <table class="table" style="width:65%;">
            <tbody>
                <tr>
                    <td style="text-align: left;"><a href="{{ route('home') }}"><button>Вернуться на
                                главную</button></a></td>
                    <td>Стрим заказан успешно!</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection