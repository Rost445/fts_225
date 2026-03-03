@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>{{ $header_title }}</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny"> Адмін-панель</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.slides') }}">
                            <div class="text-tiny">{{ $header_title }}</div>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
              <form action="{{ route('admin.slide.update', $slide->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
     <input type="hidden" name="id" value="{{ $slide->id }}">

                    <fieldset class="name">
                        <div class="body-title">Слоган <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Слоган" name="tagline" tabindex="0"
                            value="{{ $slide->tagline }}" aria-required="true" required="">
                        @error('tagline')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Заголовок <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Заголовок" name="title" tabindex="0"
                            value="{{ $slide->title }}" aria-required="true" required="">
                        @error('title')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Підзаголовок <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Підзаголовок" name="subtitle" tabindex="0"
                            value="{{ $slide->subtitle }}" aria-required="true" required="">
                        @error('subtitle')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Посилання <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Посилання" name="link" tabindex="0"
                            value="{{ $slide->link }}" aria-required="true" required="">
                        @error('link')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </fieldset>

                    <fieldset>
                        <div class="body-title">Завантаження зображення <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            @if ($slide->image)
                                <div class="item" id="imgpreview">
                                    <img src="{{ asset('uploads/slides/' . $slide->image) }}" alt="{{ $slide->title }}"
                                        class="effect8">
                                </div>
                            @endif
                            <div class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text"> Перетягніть сюди свої зображення або виберіть <span
                                            class="tf-color">натисніть, щоб переглянути</span></span>
                                    <input type="file" id="myFile" name="image" aria-required="true">
                                </label>
                            </div>

                        </div>

                    </fieldset>
                    @error('image')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <fieldset class="category">
                        <div class="body-title">Статус</div>
                        <div class="select flex-grow">
                            <select class="" name="status">
                                <option value="1" @if ($slide->status == 1) selected @endif>Активний</option>
                                <option value="0" @if ($slide->status == 0) selected @endif>Неактивний</option>
                            </select>
                        </div>
                    </fieldset>
                    @error('status')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Зберегти</button>
                    </div>
                </form>
            </div>
            <!-- /new-category -->
        </div>
        <!-- /main-content-wrap -->
    </div>
@endsection


@push('scripts')
    <script>
        $(function() {

            $('#myFile').on('change', function() {
                const [file] = this.files;
                if (file) {
                    $('#imgpreview img').attr("src", URL.createObjectURL(file));
                    $('#imgpreview').show();
                }
            });



        });
    </script>
@endpush
