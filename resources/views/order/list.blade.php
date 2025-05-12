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
                <th>Действие</th>
                <th>Статус оплаты</th>
            </tr>
            @foreach ($orders as $order)
            <tr>
                <td><a href="{{ route("form", $order['streamer_id']) }}">{{ $order['streamer_name'] }}</a></td>
                <td>{{ $order['day'] }}:
                    {{ $order['time'][1] }}-{{ $order['time'][2] }}
                </td>
                <td>{{ $order['string_status'] }}
                </td>
                <td>
                    @if($order['status'] == 0)

                    <a href="{{ route("cancelOrder", $order["id"]) }}"><button>Отменить</button></a>

                    @endif

                    @if($order['status'] == 1)

                    <a href="{{ route("payOrder", $order["id"]) }}"><button>Оплатить</button></a><br><br>
                    <a href="{{ route("cancelOrder", $order["id"]) }}"><button>Отменить</button></a>

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