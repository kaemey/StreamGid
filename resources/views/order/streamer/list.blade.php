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

        <h2 style="margin-bottom: 2%">Список заказов</h2>

        <table>
            <tr>
                <th>Стример</th>
                <th>Дата</th>
                <th>Телефон</th>
                <th>Описание</th>
                <th></th>
                <th>Статус заказа</th>
                <th>Статус оплаты</th>

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
                    @if($order["status"] !== 3)
                    <a href="{{ route("acceptOrder", $order['id']) }}">
                        <button class="btn btn-primary">Подтвердить</button>
                    </a>
                    @endif
                    @if(($order["status"] == 0) or ($order["status"] == 1))
                    <br><br>
                    <a href="{{ route("cancelOrder", $order['id']) }}">
                        <button class="btn btn-primary">Отменить</button>
                    </a>
                    @endif
                </td>
                <td>{{ $order['string_status'] }}</td>
                <td>
                    {{ $order["payment_status_string"] }}
                </td>

            </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection