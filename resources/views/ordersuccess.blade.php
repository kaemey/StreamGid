@extends('layouts.main')

@section('title', 'Анкета')

@section('content')
<div class="col-md-8 mx-auto">
    <div class="card shadow-lg border-0 p-4 mt-5 text-center"
        style="background: linear-gradient(145deg, #f0f8ff, #e6f0ff);">

        {{-- Верхняя панель --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary shadow-sm">
                <i class="bi bi-arrow-left-circle me-1"></i>На главную
            </a>
            <h4 class="text-success mb-0">
                <i class="bi bi-check-circle-fill me-2"></i>Стрим заказан успешно!
            </h4>
            <div></div> {{-- пустой блок для симметрии --}}
        </div>

        {{-- Доп. сообщение --}}
        <div class="alert alert-success shadow-sm mt-3" role="alert">
            Спасибо за заказ! Стример скоро с вами свяжется. 👾
        </div>
    </div>
</div>
@endsection