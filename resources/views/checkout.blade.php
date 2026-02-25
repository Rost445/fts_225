@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Доставка та оформлення замовлення</h2>
            <div class="checkout-steps">
                <a href="{{ route('cart.index') }}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Сумка для покупок</span>
                        <em>Керуйте своїм списком предметів</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Доставка та оформлення замовлення</span>
                        <em>Оформлення Вашого списку товарів</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Підтвердження</span>
                        <em>Перегляньте та надішліть своє замовлення</em>
                    </span>
                </a>
            </div>
            <form name="checkout-form" action="">
                <div class="checkout-form">
                    <div class="billing-info__wrapper">
                        <div class="row">
                            <div class="col-6">
                                <h4>ДЕТАЛІ ДОСТАВКИ</h4>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>
                        @if ($address)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="my-account_address_list">
                                        <div class="my-account_address-list-item">
                                            <p>{{ $address->name }}</p>
                                            <p>{{ $address->phone }}</p>
                                            <p>{{ $address->zip }}, {{ $address->state }}, {{ $address->city }}</p>
                                            <p>{{ $address->address }}, {{ $address->locality }}</p>
                                            <p>{{ $address->landmark }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                @else
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="name" required=""
                                    value=" {{ old('name') }}">
                                <label for="name">Повне ім'я *</label>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="phone" required=""
                                    value="{{ old('phone') }}">
                                <label for="phone">Номер телефону *</label>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="zip" required=""
                                    value="{{ old('zip') }}">
                                <label for="zip">
                                    Поштовий індекс *</label>
                                @error('zip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control" name="state" required=""
                                    value="{{ old('state') }}">
                                <label for="state">Область *</label>
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="city" required=""
                                    value="{{ old('city') }}">
                                <label for="city">Місто / Селище *</label>
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="address" required=""
                                    value="{{ old('address') }}">
                                <label for="address">
                                    Номер будинку, назва будівлі *</label>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="locality" required=""
                                    value="{{ old('locality') }}">
                                <label for="locality">Назва вулиці, району, селища *</label>
                                @error('locality')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="landmark" required=""
                                    value="{{ old('landmark') }}">
                                <label for="landmark">Landmark *</label>
                                @error('landmark')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <span class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="checkout__totals-wrapper">
                    <div class="sticky-content">
                        <div class="checkout__totals">
                            <h3>
                                Ваше замовлення</h3>
                            <table class="checkout-cart-items">
                                <thead>
                                    <tr>
                                        <th>ПРОДУКТ</th>
                                        <th align="right">ПІДСУМОК</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::instance('cart') as $item)
                                        <tr>
                                            <td>
                                                {{ $item->name }} x {{ $item->qty }}
                                            </td>
                                            <td class="text-right">
                                                {{ $item->subtotal() }} ₴
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if (session()->has('discounts'))
                               <table class="checkout-totals">
                                     <tbody>
                                            <tr>
                                                <th>Проміжний підсумок</th>
                                                <td class="text-right">{{ Cart::instance('cart')->subtotal() }} $</td>
                                            </tr>
                                            <tr>
                                                <th>Знижка {{ session()->get('coupon')['code'] }}</th>
                                                <td class="text-right">{{ session()->get('discounts')['discount'] }} $</td>
                                            </tr>
                                            <tr>
                                                <th>Проміжний підсумок <br> після знижки</th>
                                                <td class="text-right">{{ session()->get('discounts')['subtotal'] }} $</td>
                                            </tr>
                                            <tr>
                                                <th>Доставка</th>
                                                <td class="text-right">
                                                    <span>Безкоштовна доставка</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>ПДВ</th>
                                                <td class="text-right">{{ session()->get('discounts')['tax'] }} $</td>
                                            </tr>
                                            <tr>
                                                <th>Всього</th>
                                                <td class="text-right">{{ session()->get('discounts')['total'] }} $</td>
                                            </tr>
                                        </tbody>
                                </table>
                            @else
                                 <table class="checkout-totals">
                                    <tbody>
                                        <tr>
                                            <th>ПІДСУМОК</th>
                                            <td class="text-right">{{ Cart::instance('cart')->subtotal() }} ₴</td>
                                        </tr>
                                        <tr>
                                            <th>ДОСТАВКА</th>
                                            <td class="text-right">Безкоштовна доставка</td>
                                        </tr>
                                        <tr>
                                            <th>ПДВ</th>
                                            <td class="text-right">{{ Cart::instance('cart')->tax() }} ₴</td>
                                        </tr>
                                        <tr>
                                            <th>ВСЬОГО</th>
                                            <td class="text-right">{{ Cart::instance('cart')->total() }} ₴</td>
                                        </tr>
                                    </tbody>
                                </table>
                             @endif
                        </div>
                        <div class="checkout__payment-methods">
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio"
                                    name="checkout_payment_method" id="checkout_payment_method_1" checked>
                                <label class="form-check-label" for="checkout_payment_method_1">
                                    Прямий банківський переказ
                                    <p class="option-detail">
                                        Зробіть свій платіж безпосередньо в наш банківський рахунок. Будь ласка,
                                        використовуйте свій номер замовлення як референс для оплати.
                                        Ваше замовлення не буде відправлено, поки кошти не будуть зараховані на наш рахунок.
                                    </p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio"
                                    name="checkout_payment_method" id="checkout_payment_method_2">
                                <label class="form-check-label" for="checkout_payment_method_2">
                                    Перевірка платежів
                                    <p class="option-detail">
                                        Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec
                                        dui. Aenean
                                        aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc,
                                        ut aliquet
                                        magna posuere eget.
                                    </p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio"
                                    name="checkout_payment_method" id="checkout_payment_method_3">
                                <label class="form-check-label" for="checkout_payment_method_3">
                                    Наложений платіж
                                    <p class="option-detail">
                                        Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec
                                        dui. Aenean
                                        aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc,
                                        ut aliquet
                                        magna posuere eget.
                                    </p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio"
                                    name="checkout_payment_method" id="checkout_payment_method_4">
                                <label class="form-check-label" for="checkout_payment_method_4">
                                    Paypal
                                    <p class="option-detail">
                                        Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec
                                        dui. Aenean
                                        aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc,
                                        ut aliquet
                                        magna posuere eget.
                                    </p>
                                </label>
                            </div>
                            <div class="policy-text">
                                Ваші персональні дані будуть використані для обробки вашого замовлення, підтримки вашого
                                досвіду на цьому веб-сайті та для інших цілей, описаних у нашій <a href="terms.html"
                                    target="_blank">політиці конфіденційності</a>.
                            </div>
                        </div>
                        <button class="btn btn-primary btn-checkout">ЗАМОВИТИ</button>
                    </div>
                </div>
                </div>
            </form>
        </section>
    </main>
@endsection
