@extends('layouts.main')

@section('title', 'Анкета')

@section('content')
    <style>
        table,
        td,
        th {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 15px;
        }

        td,
        th {
            text-align: left;
        }
    </style>
    <div class="col border text-center">
        <div style="margin-top: 2%;">
            Список заказов
            <table>
                <tr>
                    <th>Стример</th>
                    <th>График</th>
                    <th>Статус заказа</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>
                        <td><a href="{{ route("form", $order['streamer_id']) }}">{{ $order['streamer_name'] }}</a></td>
                        <td>{{ $order['day'] }}:
                            {{ $order['time'][1] }}-{{ $order['time'][2] }}
                        </td>
                        <td>{{ $order['status'] }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection