@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>{{ $header_title }}</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="#">
                            <div class="text-tiny">Адмін-панель</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories') }}">
                            <div class="text-tiny">Категорії</div>
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
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.category.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $category->id }}">
                    <fieldset class="name">
                        <div class="body-title">Назва категорії <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Назва категорії" name="name" tabindex="0"
                            value="{{ $category->name }}" aria-required="true" required="">
                    </fieldset>
                    @error('name')
                        <div class="alert alert-danger text-center mb-3">{{ $message }}</div>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Слаг категорії <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Слаг категорії" name="slug" tabindex="0"
                            value="{{ $category->slug }}" aria-required="true" required="">
                    </fieldset>
                    @error('slug')
                        <div class="alert alert-danger text-center mb-3">{{ $message }}</div>
                    @enderror
                    <fieldset>
                        <div class="body-title">Завантажити зображення <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">

                            @if ($category->image)
                                <div class="item" id="imgpreview">
                                    <img src="{{ asset('uploads/categories') }}/{{ $category->image }}" class="effect8"
                                        alt="">
                                </div>
                            @else
                            @endif
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Перетягніть сюди свої зображення або виберіть <span
                                            class="tf-color">натисніть, щоб переглянути</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    @error('image')
                        <div class="alert alert-danger text-center mb-3">{{ $message }}</div>
                    @enderror

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Зберегти</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
   
@endpush
