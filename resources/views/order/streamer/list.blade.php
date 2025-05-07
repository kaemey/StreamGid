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

        .order_description {
            max-width: 300px;
        }
    </style>
    <div class="col border">
        <div style="margin-top: 2%;">
            <div style="margin: 2%;">
                <h2>Список заказов</h2>
            </div>
            <table>
                <tr>
                    <th>Стример</th>
                    <th>Дата</th>
                    <th>Телефон</th>
                    <th>Описание</th>
                    <th></th>
                    <th>Статус</th>
                </tr>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order['user_name'] }}</td>


                        <td>{{ $order['day'] }}
                        </td>
                        <td>{{ $order['user_phone'] }}</td>
                        <td class="order_description">{{ $order['description'] }}
                        </td>
                        <td>
                            <a href="{{ route("acceptOrder", $order['id']) }}">
                                <button>Подтвердить</button>
                            </a><br><br>
                            <a href="{{ route("cancelOrder", $order['id']) }}">
                                <button>Отменить</button>
                            </a>
                        </td>
                        <td>{{ $order['status'] }}</td>

                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection