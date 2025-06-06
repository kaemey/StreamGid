@extends('layouts.main')

@section('title', 'Профиль стримера')

@section('content')
<div class="col-md-9">
    <div class="card shadow-lg border-0 p-4" style="background: linear-gradient(145deg, #f0f8ff, #e6f0ff);">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary"><i class="bi bi-person-badge-fill me-2"></i>Профиль стримера</h2>
            <a href="{{ route('orderList') }}" class="btn btn-success shadow-sm">
                <i class="bi bi-list-check me-1"></i>Список заказов
            </a>
        </div>

        <table class="table table-borderless text-dark">
            <tbody>
                <tr>
                    <th style="width: 25%;"><i class="bi bi-person-fill me-2 text-info"></i>Имя</th>
                    <td class="fw-semibold">{{ $user['name'] }}</td>
                </tr>
                <tr>
                    <th><i class="bi bi-telephone-fill me-2 text-info"></i>Телефон</th>
                    <td>{{ $user['phone'] }}</td>
                </tr>
                <tr>
                    <th><i class="bi bi-envelope-fill me-2 text-info"></i>Email</th>
                    <td>{{ $user['email'] }}</td>
                </tr>
                <tr>
                    <th><i class="bi bi-image-fill me-2 text-info"></i>Аватар</th>
                    <td>
                        <div class="mb-3">
                            <img id="avatar-preview" src="{{ asset($user['avatar'] ?? 'images/image.png') }}"
                                alt="Аватар" class="img-thumbnail rounded shadow-sm"
                                style="max-width: 200px; border: 2px solid #007bff;">
                        </div>
                        <form enctype="multipart/form-data" method="POST" action="{{ route('upload_avatar') }}"
                            id="avatar-form">
                            @csrf
                            <div id="drop-zone" class="border border-primary rounded p-3 text-center mb-2"
                                style="cursor: pointer; background-color: #f8f9fa;">
                                <p class="text-muted mb-1"><i
                                        class="bi bi-cloud-arrow-up-fill text-primary me-1"></i>Перетащите изображение
                                    сюда или кликните</p>
                                <input type="file" name="avatar" id="avatar-input" class="form-control d-none"
                                    accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-sm">Загрузить</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <th><i class="bi bi-calendar-week-fill me-2 text-info"></i>Расписание</th>
                    <td>
                        <div class="row">
                            @foreach ($timing as $day => $time)
                            <div class="col-md-6 mb-2">
                                <span class="badge bg-{{ $time[0] ? 'success' : 'secondary' }} p-2 fs-6 shadow-sm">
                                    <strong>{{ $day }}:</strong>
                                    @if ($time[0])
                                    {{ $time[1] }} - {{ $time[2] }}
                                    @else
                                    неактивен
                                    @endif
                                </span>
                            </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <form action="{{ route('profile.edit') }}" method="get">
                            <button type="submit" class="btn btn-outline-primary">
                                <i class="bi bi-pencil-square me-1"></i>Редактировать профиль
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const dropZone = document.getElementById("drop-zone");
    const input = document.getElementById("avatar-input");
    const preview = document.getElementById("avatar-preview");

    dropZone.addEventListener("click", () => input.click());

    input.addEventListener("change", () => {
        if (input.files.length > 0) {
            previewImage(input.files[0]);
        }
    });

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