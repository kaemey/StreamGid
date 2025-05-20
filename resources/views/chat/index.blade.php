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
        <table class="table" style="width:50%;">
            <tbody>
                <tr>
                    @foreach ($chats as $chat)
                    <td><img src="{{ $chat["avatar"] }}"></td>
                    <td>
                        <h2>{{ $chat["name"] }}</h2>
                    </td>

                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection