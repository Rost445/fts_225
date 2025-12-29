@extends('layouts.admin')
@push('styles')
    <style>
        .table thead th,
        .table td {
            margin: auto !important;
            vertical-align: middle;
            text-align: center;
        }
        .list-icon-function {
            justify-content: center;
        }
    </style>
@endpush
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>{{ $header_title }}</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Адмін-панель</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">{{ $header_title }}</div>
                    </li>
                </ul>
            </div>
            @if ($brands->isNotEmpty())
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">

                        </div>
                        <a class="tf-button style-1 w208" href="{{ route('admin.brand.add') }}"><i
                                class="icon-plus"></i>Додати
                            бренд</a>
                    </div>
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show fs-3" role="alert">
                                    <div class="p-3">{{ session('success') }}</div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <table class="table table-bordered mb-0" style="border-bottom-color: ;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Зображення</th>
                                        <th>Назва</th>
                                        <th>Слаг</th>
                                        <th>Продукти</th>
                                        <th>Редагувати</th>
                                        <th>Видалити</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{ $brand->id }}</td>
                                            <td class="img-name">
                                                <div class="image">
                                                    <div class="image">
                                                        <img src="{{ asset('uploads/brands') }}/{{ $brand->image }} "
                                                            alt="{{ $brand->name }}" class="image p-3">
                                                    </div>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="name">
                                                    <a href="#" class="body-title-2">{{ $brand->name }}</a>
                                                </div>
                                            </td>
                                            <td>{{ $brand->slug }}</td>
                                            <td><a href="#" target="_blank">0</a></td>
                                            <td>
                                                <div class="list-icon-function">
                                                    <a href="{{ route('admin.brand.edit', $brand->id) }}">
                                                        <div class="item edit">
                                                            <i class="icon-edit-3"></i>
                                                        </div>
                                                    </a>
                                                   
                                                </div>
                                            </td>
                                            <td> <form action="{{ route('admin.brand.delete', ['id' => $brand->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="item text-danger delete">
                                                            <i class="icon-trash-2"></i>
                                                        </div>
                                                    </form></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="divider"></div>
                        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                            {{ $brands->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @else
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                        </div>
                        <a class="tf-button style-1 w208" href="{{ route('admin.brand.add') }}"><i
                                class="icon-plus"></i>Додати
                            бренд</a>

                    </div>
                    <div class="alert alert-secondary fs-3 p-5" role="alert">Немає брендів для відображення!</div>
                </div>
            @endif

        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(function() {
            $('.delete').on('click', function(e) {
                e.preventDefault();

                let form = $(this).closest('form');

                swal({
                    title: "Ви впевнені?",
                    text: "Цю дію не можна буде скасувати!",
                    icon: "warning",
                    buttons: ["Скасувати", "Видалити"],
                    dangerMode: true,
                }).then(function(willDelete) {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
