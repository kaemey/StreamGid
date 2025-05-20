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
<div class="col border">
    <div style="margin-top: 2%;">
        <h2 style="margin-bottom: 2%">Список заказов</h2>
        <table>
            <tr>
                <th>Стример</th>
                <th>График</th>
                <th>Статус заказа</th>
                <th>Действие</th>
                <th>Статус оплаты</th>
            </tr>
            @foreach ($orders as $order)
            <tr>
                <td><a href="{{ route("form", $order['streamer_id']) }}">{{ $order['streamer_name'] }}</a></td>
                <td>{{ $order['day'] }}:
                    {{ $order['time'][1] }}-{{ $order['time'][2] }}
                </td>
                <td>{{ $order['string_status'] }}</td>
                <td>
                    @if($order['status'] == 0)

                    <a href="{{ route("cancelOrder", $order["id"]) }}"><button
                            class="btn btn-primary">Отменить</button></a>

                    @endif

                    @if($order['status'] == 1)

                    <a href="{{ route("payOrder", $order["id"]) }}"><button
                            class="btn btn-primary">Оплатить</button></a><br><br>
                    <a href="{{ route("cancelOrder", $order["id"]) }}"><button
                            class="btn btn-primary">Отменить</button></a>

                    @endif
                </td>
                <td>
                    {{ $order["payment_status_string"] }}
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>

@endsection