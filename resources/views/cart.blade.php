@extends('layouts.app')
@section('content')

    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">{{ $header_title }}</h2>
            <div class="checkout-steps">
                <a href="javascript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Кошик для покупок</span>
                        <em>Керуйте своїм списком предметів</em>
                    </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
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
            <div class="shopping-cart">
                @if ($items->count() > 0)
                    <div class="cart-table__wrapper">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Продукція</th>
                                    <th></th>
                                    <th>Ціна</th>
                                    <th>Кількість</th>
                                    <th>Проміжний підсумок</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            <div class="shopping-cart__product-item">
                                                <img loading="lazy"
                                                    src="{{ asset('uploads/products/thumbnails/' . $item->model->image) }}"
                                                    width="120" height="120" alt="{{ $item->name }}" />
                                            </div>
                                        </td>
                                        <td>
                                            <div class="shopping-cart__product-item__detail">
                                                <h4>{{ $item->name }}</h4>
                                                <ul class="shopping-cart__product-item__options">
                                                    <li>Колір: Жовтий</li>
                                                    <li>Розмір: L</li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__product-price">{{ $item->price }}</span>
                                        </td>
                                        <td>
                                            <div class="qty-control position-relative">
                                                <input type="number" name="quantity" value="{{ $item->qty }}"
                                                    min="1" class="qty-control__number text-center">
                                                <form action="{{ route('cart.qty.decrease', $item->rowId) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="qty-control__reduce">-</div>
                                                </form>
                                                <form action="{{ route('cart.qty.increase', $item->rowId) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="qty-control__increase">+</div>
                                                </form>


                                            </div>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__subtotal">{{ $item->subTotal() }}</span>
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.item.remove', $item->rowId) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="remove-cart " aria-label="Удалить">
                                                    <svg viewBox="0 0 24 24" width="14" height="14">
                                                        <path d="M18 6L6 18M6 6l12 12" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="cart-table-footer">
                            @if(!session()->has('coupon'))
                             <form action="{{ route('cart.apply.coupon') }}" method="post"
                                class="position-relative bg-body">
                                @csrf
                                <input class="form-control" type="text" name="coupon_code" placeholder="Код купона"
                                    value="">
                                <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                                    value="Застосувати купон">
                            </form>
                            @else
                            <form action="{{ route('cart.remove.coupon') }}" method="post"
                                class="position-relative bg-body">
                                @csrf
                                @method('DELETE')
                                <input class="form-control" type="text" name="coupon_code" placeholder="Код купона"
                                    value="@if (session()->has('coupon')) {{ session()->get('coupon')['code'] }} Застосовується! @endif">
                                <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                                    value="Видалити купон">
                            </form>
                            @endif
                            <form action="{{ route('cart.empty') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-light" type="submit">Очистити кошик</button>
                            </form>
                        </div>
                        @if (session()->has('success_message'))
                            <div class="alert alert-success  my-1" role="alert">
                                {{ session('success_message') }}
                            </div>
                        @elseif (session()->has('error_message'))
                            <div class="alert alert-danger  my-1" role="alert">
                                {{ session('error_message') }}
                            </div>
                        @endif
                    </div>

                    <div class="shopping-cart__totals-wrapper">
                        <div class="sticky-content">
                            <div class="shopping-cart__totals">
                                <h3>
                                    Сума кошика</h3>
                                @if (session()->has('discounts'))
                                    <table class="cart-totals">
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
                                                <td class="text-right">{{ session()->get('discounts')['subtotal'] }}</td>
                                            </tr>
                                            <tr>
                                                <th>Доставка</th>
                                                <td>
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
                                <table class="cart-totals">
                                    <tbody>
                                        <tr>
                                            <th>Проміжний підсумок</th>
                                            <td class="text-right">{{ Cart::instance('cart')->subtotal() }} $</td>
                                        </tr>
                                        <tr>
                                            <th>Доставка</th>
                                            <td>
                                                <span>Безкоштовна доставка</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>ПДВ</th>
                                            <td class="text-right">{{ Cart::instance('cart')->tax() }} $</td>
                                        </tr>
                                        <tr>
                                            <th>Всього</th>
                                            <td class="text-right">{{ Cart::instance('cart')->total() }} $</td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif
                            </div>
                            <div class="mobile_fixed-btn_wrapper">
                                <div class="button-wrapper container">
                                    <a href="{{ route('cart.checkout') }}" class="btn btn-primary btn-checkout">ПЕРЕЙТИ ДО ОФОРМЛЕННЯ ЗАМОВЛЕННЯ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @if ($items->count() == 0)
                    <div class="col-md-12 text-center pt-5 bp-5">
                        <h3>Кошик порожній</h3>
                        <a class="btn btn-info" href="{{ route('shop.index') }}">Повернутись до покупок</a>
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.qty-control__increase').on('click', function() {
                $(this).closest('td').find('form').last().submit();
            });
            $('.qty-control__reduce').on('click', function() {
                $(this).closest('td').find('form').first().submit();
            });

            $('.remove-cart').on('click', function() {
                $(this).closest('form').submit();
            });
        });
    </script>
@endpush
