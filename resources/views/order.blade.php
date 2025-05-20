@extends('layouts.main')

@section('title', 'Анкета')

@section('content')
<div class="col border text-center">
    <div style="margin-top: 2%;">

        <table class="table" style="width:65%;">
            <tbody>
                <tr>
                    <td style="text-align: left;"><a
                            href="{{ route('form', $streamer['id']) }}"><button>Вернуться</button></a></td>
                    <td></td>
                </tr>
                <form method="POST" action="{{ route("sendOrder") }}">
                    @csrf
                    <tr>
                        <td width="50%">
                            Выберите дату и распишите, какие места хотели бы увидеть
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            Дата:
                            <select name="day">
                                <?php $i = 1; ?>
                                @foreach ($timing as $day => $time) @if($time[0])
                                <option value="<?=$i?>" style="padding: 3px; background-color: green; margin: 3px;">
                                    {{ $day }} :
                                    {{ $time[1] }} -
                                    {{ $time[2] }}
                                </option>
                                @else
                                <option disabled style="padding: 3px; background-color: grey; margin: 3px;">{{ $day }} :
                                    -
                                </option>
                                @endif
                                <?php    $i++; ?>
                                @endforeach
                            </select>
                            <input name="streamer_id" type="hidden" value="{{ $streamer['id'] }}">
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            <textarea name="description" style="width:100%"></textarea>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;"><button type="submit" class="btn btn-primary">Заказать
                                стрим</button></td>
                        <td></td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
</div>
@endsection