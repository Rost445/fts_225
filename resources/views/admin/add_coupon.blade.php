@extends('layouts.admin')

@section('content')
    <style>
        table th,
        table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>

                        <div class="main-content-inner">
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                                    <h3>Інформація про купон</h3>
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
                                            <a href="{{ route('admin.coupons') }}">
                                                <div class="text-tiny">Купони</div>
                                            </a>
                                        </li>
                                        <li>
                                            <i class="icon-chevron-right"></i>
                                        </li>
                                        <li>
                                            <div class="text-tiny">Новий купон</div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="wg-box">
                                    <form class="form-new-product form-style-1" method="POST" action="{{ route('admin.coupon.store') }}">
                                        @csrf
                                        <fieldset class="name">
                                            <div class="body-title">Код купона <span class="tf-color-1">*</span></div>
                                            <input class="flex-grow" type="text" placeholder="Код купона" name="code"
                                                tabindex="0" value="{{ old('code') }}" aria-required="true" required="">
                                        </fieldset>
                                        @error('code')
                                            <div class="tf-color-1">{{ $message }}</div>
                                        @enderror
                                       <fieldset class="category">
                                            <div class="body-title">Тип купона</div>
                                            <div class="select flex-grow">
                                                <select class="" name="type">
                                                    <option value="">Виберіть тип</option>
                                                    <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Фіксована сума</option>
                                                    <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Відсоток</option>
                                                </select>
                                            </div>
                                        </fieldset>
                                        @error('type')
                                            <div class="tf-color-1">{{ $message }}</div>
                                        @enderror
                                        <fieldset class="name">
                                            <div class="body-title">Значення купона <span class="tf-color-1">*</span></div>
                                            <input class="flex-grow" type="text" placeholder="Значення купона" name="value"
                                                tabindex="0" value="{{ old('value') }}" aria-required="true" required="">
                                        </fieldset>
                                        @error('value')
                                            <div class="tf-color-1">{{ $message }}</div>
                                        @enderror
                                        <fieldset class="name">
                                            <div class="body-title">Сума замовлення <span class="tf-color-1">*</span></div>
                                            <input class="flex-grow" type="text" placeholder="Сума замовлення"
                                                name="cart_value" tabindex="0" value="{{ old('cart_value') }}" aria-required="true"
                                                required="">
                                        </fieldset>
                                        @error('cart_value')
                                            <div class="tf-color-1">{{ $message }}</div>
                                        @enderror
                                        <fieldset class="name">
                                            <div class="body-title">Дата закінчення <span class="tf-color-1">*</span></div>
                                            <input class="flex-grow" type="date" placeholder="Дата закінчення"
                                                name="expire_date" tabindex="0" value="{{ old('expire_date') }}" aria-required="true"
                                                required="">
                                        </fieldset>
                                        @error('expire_date')
                                            <div class="tf-color-1">{{ $message }}</div>
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