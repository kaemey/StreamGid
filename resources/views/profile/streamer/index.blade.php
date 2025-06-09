@extends('layouts.main')

@section('title', 'Профиль стримера')

@section('content')
    <div class="col-md-9">
        <div class="card shadow-lg border-0 p-4" style="background: linear-gradient(145deg, #f0f8ff, #e6f0ff);">
            <h2 class="text-primary mb-3">
                <i class="bi bi-person-badge-fill me-2"></i>Профиль стримера
            </h2>

            <div class="mb-4 d-flex gap-3 flex-wrap">
                <a href="{{ route('orderList') }}" class="btn btn-success shadow-sm">
                    <i class="bi bi-list-check me-1"></i>Список заказов
                </a>

                <form action="{{ route('profile.edit') }}" method="get">
                    <button type="submit" class="btn btn-outline-primary shadow-sm">
                        <i class="bi bi-pencil-square me-1"></i>Редактировать профиль
                    </button>
                </form>
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
                                    style="cursor: pointer;">
                                    <p class="text-muted mb-1">Перетащите изображение сюда или кликните</p>
                                    <input type="file" name="avatar" id="avatar-input" class="form-control d-none"
                                        accept="image/*">
                                </div>
                            </form>
                            {{-- Категории --}}
                            <div class="d-flex flex-column gap-2">
                                <div class="fw-semibold text-secondary"><i class="bi bi-tags-fill me-1"></i>Категории:
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    @for ($i = 0; $i < getCategoryCount(); $i++)
                                        <span class="badge rounded-pill px-3 py-2 shadow-sm fw-semibold"
                                            style="
        background-color: {{ in_array($i, $user['categories']) ? '#0d6efd' : '#dc3545' }};
        color: white;
        font-size: 0.95rem;
    ">
                                            {{ getCategoryAsString($i) }}
                                        </span>
                                    @endfor
                                </div>
                            </div>
                        </td>

                    </tr>
                    <tr>
                        <th><i class="bi bi-calendar-week-fill me-2 text-info"></i>Расписание</th>
                        <td>
                            <div class="d-flex flex-wrap justify-content-start gap-2">
                                @foreach ($timing as $day => $time)
                                    <div class="text-center border rounded shadow-sm px-2 py-1"
                                        style="min-width: 110px;
                           background-color: {{ $time[0] ? '#d1e7dd' : '#f8d7da' }};">
                                        <div class="fw-bold">{{ $day }}</div>
                                        @if ($time[0])
                                            <small class="text-success">{{ $time[1] }} – {{ $time[2] }}</small>
                                        @else
                                            <small class="text-danger">неактивен</small>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
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
            const form = document.getElementById("avatar-form");

            dropZone.addEventListener("click", () => input.click());

            input.addEventListener("change", () => {
                if (input.files.length > 0) {
                    previewImage(input.files[0]);
                    form.submit();
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
                    form.submit();
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
