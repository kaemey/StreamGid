@extends('layouts.main')

@section('title', 'Список заказов')

@section('content')
<div class="col-md-9">
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-primary text-white text-center rounded-top-4">
            <h4 class="my-2">Список заказов</h4>
        </div>
        <div class="card-body p-4">

            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Стример</th>
                            <th>График</th>
                            <th>Статус заказа</th>
                            <th>Действия</th>
                            <th>Оплата</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td>
                                <a href="{{ route('form', $order['streamer_id']) }}" class="text-decoration-none">
                                    {{ $order['streamer_name'] }}
                                </a>
                            </td>
                            <td>{{ $order['day'] }}: {{ $order['time'][1] }} - {{ $order['time'][2] }}</td>
                            <td><span class="fw-semibold">{{ $order['string_status'] }}</span></td>
                            <td>
                                @if($order['status'] == 0)
                                <a href="{{ route('cancelOrder', $order['id']) }}"
                                    class="btn btn-outline-danger btn-sm">Отменить</a>
                                @elseif($order['status'] == 1)
                                <div class="d-flex flex-column gap-2">
                                    <a href="{{ route('payOrder', $order['id']) }}"
                                        class="btn btn-success btn-sm">Оплатить</a>
                                    <a href="{{ route('cancelOrder', $order['id']) }}"
                                        class="btn btn-outline-danger btn-sm">Отменить</a>
                                </div>
                                @endif
                            </td>
                            <td>{{ $order['payment_status_string'] }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-muted">У вас пока нет заказов</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection