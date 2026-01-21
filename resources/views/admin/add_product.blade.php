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
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
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
                        <a href="{{ route('admin.products') }}">
                            <div class="text-tiny">Продукти</div>
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
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
                action="{{ route('admin.product.store') }}">
                @csrf
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Назва <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Назва продукту" name="name" tabindex="0"
                            value="{{ old('name') }}" aria-required="true" required="">
                    </fieldset>
                    @error('name')
                        <div class="tf-text-error mb-10">{{ $message }}</div>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title mb-10">Слаг<span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Слаг- назва продукту латиницею" name="slug"
                            tabindex="0" value="{{ old('slug') }}" aria-required="true" required="">
                    </fieldset>
                    @error('slug')
                        <div class="tf-text-error mb-10">{{ $message }}</div>
                    @enderror

                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">Категорія <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="category_id">
                                    <option>Виберіть категорію</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        @error('category_id')
                            <div class="tf-text-error mb-10">{{ $message }}</div>
                        @enderror
                        <fieldset class="brand">
                            <div class="body-title mb-10">Brand <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="brand_id">
                                    <option>Виберіть бренд</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        @error('brand_id')
                            <div class="tf-text-error mb-10">{{ $message }}</div>
                        @enderror
                    </div>

                    <fieldset class="shortdescription">
                        <div class="body-title mb-10">Короткий опис <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10 ht-150" name="short_description" placeholder="Короткий опис" tabindex="0" aria-required="true"
                            required="">{{ old('short_description') }}</textarea>
                    </fieldset>
                    @error('short_description')
                        <div class="tf-text-error mb-10">{{ $message }}</div>
                    @enderror

                    <fieldset class="description">
                        <div class="body-title mb-10">Опис<span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="description" placeholder="Опис продукту" tabindex="0" aria-required="true"
                            required=""></textarea>
                    </fieldset>
                    @error('description')
                        <div class="tf-text-error mb-10">{{ $message }}</div>
                    @enderror
                </div>
                <div class="wg-box">
                    <fieldset>
                        <div class="body-title">Завантажити зображення<span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview" style="display:none">
                                <img src="../../../localhost_8000/images/upload/upload-1.png" class="effect8"
                                    alt="">
                            </div>
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Перетягніть сюди свої зображення або виберіть<span
                                            class="tf-color">натисніть, щоб
                                            переглядати</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    @error('image')
                        <div class="tf-text-error mb-10">{{ $message }}</div>
                    @enderror

                    <fieldset>
                        <div class="body-title mb-10">Завантажити зображення</div>
                        <div class="upload-image mb-16">
                            <!-- <div class="item">
                                                        <img src="images/upload/upload-1.png" alt="">
                                                    </div>                                                 -->
                            <div id="galUpload" class="item up-load">
                                <label class="uploadfile" for="gFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Перетягніть сюди свої зображення або виберіть<span
                                            class="tf-color">натисніть, щоб
                                            переглядати</span></span>
                                    <input type="file" id="gFile" name="images[]" accept="image/*"
                                        multiple="">
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    @error('images')
                        <div class="tf-text-error mb-10">{{ $message }}</div>
                    @enderror

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Ціна<span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Введіть ціну" name="regular_price"
                                tabindex="0" value="{{ old('regular_price') }}" aria-required="true" required="">
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Ціна зі знижкою<span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Введіть ціну зі знижкою" name="sale_price"
                                tabindex="0" value="{{ old('sale_price') }}" aria-required="true" required="">
                        </fieldset>
                    </div>
                    @error('regular_price')
                        <div class="tf-text-error mb-10">{{ $message }}</div>
                    @enderror
                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Введіть SKU" name="SKU"
                                tabindex="0" value="{{ old('SKU') }}" aria-required="true" required="">
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Кількість <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Введіть кількість" name="quantity"
                                tabindex="0" value="{{ old('quantity') }}" aria-required="true" required="">
                        </fieldset>
                    </div>
                    @error('SKU')
                        <div class="tf-text-error mb-10">{{ $message }}</div>
                    @enderror

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Наявність</div>
                            <div class="select mb-10">
                                <select class="" name="stock_status">
                                    <option value="instock">В наявності</option>
                                    <option value="outofstock">Немає в наявності</option>
                                </select>
                            </div>
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Рекомендований товар</div>
                            <div class="select mb-10">
                                <select class="" name="featured">
                                    <option value="0">Ні</option>
                                    <option value="1">Так</option>
                                </select>
                            </div>
                        </fieldset>
                    </div>
                    @error('quantity')
                        <div class="tf-text-error mb-10">{{ $message }}</div>
                    @enderror
                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">Додати товар</button>
                    </div>
                </div>
            </form>
            <!-- /form-add-product -->
        </div>
        <!-- /main-content-wrap -->
    </div>
    <!-- /main-content-wrap -->
@endsection


@push('scripts')
<script>
    $(function () {

        // Превʼю головного зображення
        $('#myFile').on('change', function (e) {
            const file = this.files[0];
            const photoInp = $("#myFile");

            if (file) {
                $('#imgpreview img').attr('src', URL.createObjectURL(file));
                $('#imgpreview').show();
            }
        });

        // Превʼю галереї
        $('#gFile').on('change', function () {
             const photoInp = $("#gFile");
            const gphotos = this.files;
           // $('#galUpload').html(''); // очистити перед новим вибором (опціонально)
            $.each(gphotos, function (key, val) {
                $('#galUpload').prepend(`
                    <div class="item gitems">
                        <img src="${URL.createObjectURL(val)}" alt="gallery image"></div> `);
            });
        });



        // Автогенерація slug
        $("input[name='name']").on('change', function () {
            $("input[name='slug']").val(stringToSlug($(this).val()));
        });

    });

    function stringToSlug(text) {
        return text
            .toLowerCase()
            .trim()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-');
    }
</script>
@endpush


