@extends('layouts.main')

@section('title', 'Список заказов стримера')

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
                                <th>Пользователь</th>
                                <th>Дата</th>
                                <th>Телефон</th>
                                <th>Описание</th>
                                <th>Действия</th>
                                <th>Статус</th>
                                <th>Оплата</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ getStringDay($order->day) }}</td>
                                    <td>{{ $order->user->phone }}</td>
                                    <td class="text-start" style="max-width: 300px;">{{ $order->description }}</td>
                                    <td>
                                        <div class="d-flex flex-column gap-2">
                                            @if ($order->status !== 3 and $order->status !== 1)
                                                <a href="{{ route('acceptOrder', $order->id) }}"
                                                    class="btn btn-success btn-sm">Подтвердить</a>
                                            @endif

                                            @if (in_array($order->status, [0, 1]))
                                                <a href="{{ route('cancelOrder', $order->id) }}"
                                                    class="btn btn-outline-danger btn-sm">Отменить</a>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ getStringOrderStatusForStreamer($order->status) }}</td>
                                    <td>{{ getStringPaymentStatus($order->payment_status) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-muted">Заказов пока нет</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
