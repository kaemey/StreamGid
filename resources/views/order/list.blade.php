@extends('layouts.main')

@section('title', 'Анкета')

@section('content')

    <div class="col border text-center">
        <div style="margin-top: 2%;">
            Список заказов
            <table>
                @foreach ($orders as $order)
                    <tr>
                        <td style="text-align: left; padding-right: 20px;"><a
                                href="{{ route("form", $order['streamer_id']) }}">{{ $order['streamer_name'] }}</a></td>
                        <td style="text-align: left;">{{ $order['day'] }}:
                            {{ $order['time'][1] }}-{{ $order['time'][2] }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection