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

                                        <a href="{{ route('form', $order->streamer->id) }}" class="text-decoration-none">
                                            {{ $order->streamer->name }}
                                        </a>
                                    </td>
                                    <td>{{ getStringDay($order->day) }}: {{ $order->time[1] }} - {{ $order->time[2] }}</td>
                                    <td><span class="fw-semibold">{{ getStringOrderStatusForUser($order->status) }}</span>
                                    </td>
                                    <td>
                                        @if ($order->status == 0)
                                            <a href="{{ route('cancelOrder', $order->id) }}"
                                                class="btn btn-outline-danger btn-sm">Отменить</a>
                                        @elseif($order['status'] == 1)
                                            <div class="d-flex flex-column gap-2">
                                                @if ($order->payment_status == 0)
                                                    <a href="{{ route('payOrder', $order->id) }}"
                                                        class="btn btn-success btn-sm">Оплатить</a>
                                                @else
                                                    <a href="{{ route('finishOrder', $order->id) }}"
                                                        class="btn btn-success btn-sm">Выполнить</a>
                                                @endif

                                                <a href="{{ route('cancelOrder', $order->id) }}"
                                                    class="btn btn-outline-danger btn-sm">Отменить</a>
                                            </div>
                                        @elseif ($order->status == 4)
                                            @if ($order->review_point > 0)
                                                <div class="text-warning">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $order->review_point)
                                                            <i class="bi bi-star-fill"></i>
                                                        @else
                                                            <i class="bi bi-star"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            @else
                                                <form action="{{ route('sendReviewPoint', $order->id) }}" method="POST"
                                                    class="d-inline-block">
                                                    @csrf
                                                    <div class="d-flex gap-1 justify-content-center">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <button name="rating" value="{{ $i }}"
                                                                type="submit" class="btn btn-outline-warning p-1"
                                                                title="Оценить на {{ $i }}">
                                                                ★
                                                            </button>
                                                        @endfor
                                                    </div>
                                                </form>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ getStringPaymentStatus($order['payment_status']) }}</td>
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
