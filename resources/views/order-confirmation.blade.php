@extends('layouts.app')
@section('content')

  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
      <h2 class="page-title">Підтвердження замовлення</h2>
      <div class="checkout-steps">
        <a href="javascript:void(0)" class="checkout-steps__item active">
          <span class="checkout-steps__item-number"></span>
          <span class="checkout-steps__item-title">
            <span>Кошик для покупок</span>
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
        <a href="javascript:void(0)" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">03</span>
          <span class="checkout-steps__item-title">
            <span>Підтвердження</span>
            <em>Перегляньте та надішліть своє замовлення</em>
          </span>
        </a>
      </div>
      <div class="order-complete">
        <div class="order-complete__message">
          <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="40" cy="40" r="40" fill="#B9A16B" />
            <path
              d="M52.9743 35.7612C52.9743 35.3426 52.8069 34.9241 52.5056 34.6228L50.2288 32.346C49.9275 32.0446 49.5089 31.8772 49.0904 31.8772C48.6719 31.8772 48.2533 32.0446 47.952 32.346L36.9699 43.3449L32.048 38.4062C31.7467 38.1049 31.3281 37.9375 30.9096 37.9375C30.4911 37.9375 30.0725 38.1049 29.7712 38.4062L27.4944 40.683C27.1931 40.9844 27.0257 41.4029 27.0257 41.8214C27.0257 42.24 27.1931 42.6585 27.4944 42.9598L33.5547 49.0201L35.8315 51.2969C36.1328 51.5982 36.5513 51.7656 36.9699 51.7656C37.3884 51.7656 37.8069 51.5982 38.1083 51.2969L40.385 49.0201L52.5056 36.8996C52.8069 36.5982 52.9743 36.1797 52.9743 35.7612Z"
              fill="white" />
          </svg>
          <h3>Ваше замовлення прийнято!</h3>
          <p>Дякуємо! Ваше замовлення було отримано.</p>
        </div>
        <div class="order-info">
          <div class="order-info__item">
            <label>№ замовлення</label>
            <span>{{ $order->id }}</span>
          </div>
          <div class="order-info__item">
            <label>Дата</label>
            <span>{{ $order->created_at->format('d/m/Y') }}</span>
          </div>
          <div class="order-info__item">
            <label>Всього</label>
            <span>${{ number_format($order->total, 2) }}</span>
          </div>
          <div class="order-info__item">
            <label>Спосіб оплати</label>
            <span>{{ $order->transaction->mode_label }}</span>
          </div>
        </div>
        <div class="checkout__totals-wrapper">
          <div class="checkout__totals">
            <h3>Деталі замовлення</h3>
            <table class="checkout-cart-items">
              <thead>
                <tr>
                  <th>Продукція</th>
                  <th>Проміжна ціна</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($order->orderItems as $item)
                  <tr>
                    <td>
                      {{ $item->product->name }} x {{ $item->quantity }}
                    </td>
                    <td  class="text-right">
                      ${{ number_format($item->price, 2) }}
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <table class="checkout-totals">
              <tbody>
                <tr>
                  <th>Підсумок</th>
                  <td class="text-right">${{ number_format($order->subtotal, 2) }}</td>
                </tr>
                <tr>
                  <th>Знижка</th>
                  <td class="text-right">${{ number_format($order->discount, 2) }}</td>
                </tr>
                <tr>
                  <th>Доставка</th>
                  <td class="text-right">Безкоштовна доставка</td>
                </tr>
                <tr>
                  <th>ПДВ</th>
                  <td class="text-right">${{ number_format($order->tax, 2) }}</td>
                </tr>
                <tr>
                  <th>Всього</th>
                  <td class="text-right">${{ number_format($order->total, 2) }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </main>

@endsection