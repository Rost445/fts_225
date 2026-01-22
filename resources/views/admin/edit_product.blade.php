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
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data" action="{{ route('admin.product.update') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $product->id }}">
                <div class="wg-box">
                    <!--name-->
                    <fieldset class="name">
                        <div class="body-title mb-10">Назва <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Назва продукту" name="name" tabindex="0"
                            value="{{ $product->name }}" aria-required="true" required="">
                    </fieldset>
                    @error('name')
                        <div class="tf-text-error mb-10">{{ $message }}</div>
                    @enderror
                    <!--.name-->
                    <!--slug-->
                    <fieldset class="slug">
                        <div class="body-title mb-10">Слаг<span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Слаг- назва продукту латиницею" name="slug"
                            tabindex="0" value="{{ $product->slug }}" aria-required="true" required="">
                    </fieldset>
                    @error('slug')
                        <div class="tf-text-error mb-10">{{ $message }}</div>
                    @enderror
                    <!--.slug-->

                    <div class="gap22 cols">
                        <!--category-->
                        <fieldset class="category">
                            <div class="body-title mb-10">Категорія <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="category_id">
                                    <option>Виберіть категорію</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        @error('category_id')
                            <div class="tf-text-error mb-10">{{ $message }}</div>
                        @enderror
                        <!--.category-->
                        <!--brand-->
                        <fieldset class="brand">
                            <div class="body-title mb-10">Brand <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="brand_id">
                                    <option>Виберіть бренд</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        @error('brand_id')
                            <div class="tf-text-error mb-10">{{ $message }}</div>
                        @enderror
                        <!--.brand-->
                    </div>
                    <!--shortdescription -->
                    <fieldset class="shortdescription">
                        <div class="body-title mb-10">Короткий опис <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10 " name="short_description" placeholder="Короткий опис" tabindex="0" aria-required="true"
                            required="">{{ $product->short_description }}</textarea>
                    </fieldset>

                    @error('short_description')
                        <div class="tf-text-error mb-10">{{ $message }}</div>
                    @enderror
                    <!--.shortdescription -->
                    <!--description -->
                    <fieldset class="description">
                        <div class="body-title mb-10">Опис<span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10 ht-150" name="description" placeholder="Опис продукту" tabindex="0" aria-required="true"
                            required="">{{ $product->description }}</textarea>
                    </fieldset>
                    @error('description')
                        <div class="tf-text-error mb-10">{{ $message }}</div>
                    @enderror
                    <!--.description -->

                </div>
                <div class="wg-box">
                    <!--image-->
                    <fieldset>
                        <div class="body-title">Завантажити зображення<span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            @if ($product->image)
                                <div class="item" id="imgpreview">
                                    <img src="{{ asset('uploads/products/' . $product->image) }}" class="effect8"
                                        alt="{{ $product->name }}">
                                </div>
                            @endif
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
                            @if ($product->images)
                                @foreach (explode(',', $product->images) as $img)
                                    <div class="item gitems">
                                        <img src="{{ asset('uploads/products/' . trim($img)) }}"
                                            alt="{{ $product->name }}">
                                    </div>
                                @endforeach
                            @endif
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
                    <!--image-->
                    <div class="cols gap22">
                        <!--price -->
                        <fieldset class="regular_price">
                            <div class="body-title mb-10">Ціна<span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Введіть ціну" name="regular_price"
                                tabindex="0" value="{{ $product->regular_price }}" aria-required="true"
                                required="">
                        </fieldset>
                        @error('regular_price')
                            <div class="tf-text-error mb-10">{{ $message }}</div>
                        @enderror
                        <!--.regular_price -->

                        <!--sale_price -->
                        <fieldset class="sale_price">
                            <div class="body-title mb-10">Ціна зі
                                знижкою<span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Введіть ціну зі знижкою" name="sale_price"
                                tabindex="0" value="{{ $product->sale_price }}" aria-required="true" required="">
                        </fieldset>
                        @error('regular_price')
                            <div class="tf-text-error mb-10">{{ $message }}</div>
                        @enderror
                    </div>
                    <!--.sale_price -->
                    <div class="cols gap22">
                        <!--SKU-->
                        <fieldset class="SKU">
                            <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Введіть SKU" name="SKU"
                                tabindex="0" value="{{ $product->SKU }}" aria-required="true" required="">
                        </fieldset>
                        @error('SKU')
                            <div class="tf-text-error mb-10">{{ $message }}</div>
                        @enderror
                        <fieldset class="quantity">
                            <div class="body-title mb-10">Кількість <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Введіть кількість" name="quantity"
                                tabindex="0" value="{{ $product->quantity }}" aria-required="true" required="">
                        </fieldset>
                        @error('quantity')
                            <div class="tf-text-error mb-10">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="cols gap22">
                        <!--stock_status-->
                        <fieldset class="stock_status">
                            <div class="body-title mb-10">Наявність</div>
                            <div class="select mb-10">
                                <select class="" name="stock_status">
                                    <option value="instock" {{ $product->stock_status == 'instock' ? 'selected' : '' }}>В
                                        наявності</option>
                                    <option value="outofstock"
                                        {{ $product->stock_status == 'outofstock' ? 'selected' : '' }}>Немає в наявності
                                    </option>
                                </select>
                            </div>
                        </fieldset>

                        @error('stock_status')
                            <div class="tf-text-error mb-10">{{ $message }}</div>
                        @enderror
                        <!--.stock_status-->
                        <!--featured-->
                        <fieldset class="featured">
                            <div class="body-title mb-10">Рекомендований товар</div>
                            <div class="select mb-10">
                                <select class="" name="featured">
                                    <option value="0" {{ $product->featured == 0 ? 'selected' : '' }}>Ні</option>
                                    <option value="1" {{ $product->featured == 1 ? 'selected' : '' }}>Так</option>
                                </select>
                            </div>
                        </fieldset>
                        @error('featured')
                            <div class="tf-text-error mb-10">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="cols gap10"></div><button class="tf-button w-full" type="submit">Оновити продукт</button>
                </div>
        </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {

            // Превʼю головного зображення
            $('#myFile').on('change', function(e) {
                const file = this.files[0];
                const photoInp = $("#myFile");

                if (file) {
                    $('#imgpreview img').attr('src', URL.createObjectURL(file));
                    $('#imgpreview').show();
                }
            });

            // Превʼю галереї
            $('#gFile').on('change', function() {
                const photoInp = $("#gFile");
                const gphotos = this.files;
                // $('#galUpload').html(''); // очистити перед новим вибором (опціонально)
                $.each(gphotos, function(key, val) {
                    $('#galUpload').prepend(`
                    <div class="item gitems">
                        <img src="${URL.createObjectURL(val)}" alt="gallery image"></div> `);
                });
            });



            // Автогенерація slug
            $("input[name='name']").on('change', function() {
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
