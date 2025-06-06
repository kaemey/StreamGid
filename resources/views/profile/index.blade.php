@extends('layouts.main')

@section('title', 'Профиль')

@section('content')
<div class="col-md-9 mx-auto">
    <div class="card shadow-lg mt-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Профиль</h4>
            <a href="{{ route('orderList') }}" class="btn btn-light btn-sm">Список заказов</a>
        </div>
        <div class="card-body">
            <div class="row mb-3">

                <div class="col-md-4 text-center">
                    @if (isset($user['avatar']))
                    <img id="avatar-preview" src="{{ asset($user['avatar']) }}" alt="Avatar"
                        class="img-fluid rounded-circle mb-3" style="max-width: 200px;">
                    @else
                    <img id="avatar-preview" src="{{ asset('images/image.png') }}" alt="Default Avatar"
                        class="img-fluid rounded-circle mb-3" style="max-width: 200px;">
                    @endif

                    <form enctype="multipart/form-data" method="POST" action="{{ route('upload_avatar') }}"
                        id="avatar-form">
                        @csrf
                        <div id="drop-zone" class="border border-primary rounded p-3 text-center mb-2"
                            style="cursor: pointer;">
                            <p class="text-muted mb-1">Перетащите изображение сюда или кликните</p>
                            <input type="file" name="avatar" id="avatar-input" class="form-control d-none"
                                accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-sm">Загрузить</button>
                    </form>
                </div>

                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th class="w-25">Имя:</th>
                            <td>{{ $user['name'] }}</td>
                        </tr>
                        <tr>
                            <th>Телефон:</th>
                            <td>{{ $user['phone'] }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $user['email'] }}</td>
                        </tr>
                    </table>

                    <form action="{{ route('profile.edit') }}" method="get" class="mt-3">
                        <button type="submit" class="btn btn-primary">Редактировать профиль</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const dropZone = document.getElementById("drop-zone");
    const input = document.getElementById("avatar-input");
    const preview = document.getElementById("avatar-preview");

    // Клик по зоне = клик по инпуту
    dropZone.addEventListener("click", () => input.click());

    // Обработка выбора файла
    input.addEventListener("change", () => {
        if (input.files.length > 0) {
            previewImage(input.files[0]);
        }
    });

    // Drag'n'Drop события
    dropZone.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZone.classList.add("bg-light");
    });

    dropZone.addEventListener("dragleave", () => {
        dropZone.classList.remove("bg-light");
    });

    dropZone.addEventListener("drop", (e) => {
        e.preventDefault();
        dropZone.classList.remove("bg-light");

        if (e.dataTransfer.files.length > 0) {
            input.files = e.dataTransfer.files;
            previewImage(e.dataTransfer.files[0]);
        }
    });

    // Предпросмотр
    function previewImage(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>

@endsection