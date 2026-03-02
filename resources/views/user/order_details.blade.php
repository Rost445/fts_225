@extends('layouts.app')
@section('content')
   <style>
    .pt-90 {
      padding-top: 90px !important;
    }

    .pr-6px {
      padding-right: 6px;
      text-transform: uppercase;
    }

    .my-account .page-title {
      font-size: 1.5rem;
      font-weight: 700;
      text-transform: uppercase;
      margin-bottom: 40px;
      border-bottom: 1px solid;
      padding-bottom: 13px;
    }

    .my-account .wg-box {
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      padding: 24px;
      flex-direction: column;
      gap: 24px;
      border-radius: 12px;
      background: var(--White);
      box-shadow: 0px 4px 24px 2px rgba(20, 25, 38, 0.05);
    }

    .bg-success {
      background-color: #40c710 !important;
    }

    .bg-danger {
      background-color: #f44032 !important;
    }

    .bg-warning {
      background-color: #f5d700 !important;
      color: #000;
    }

    .table-transaction>tbody>tr:nth-of-type(odd) {
      --bs-table-accent-bg: #fff !important;

    }

    .table-transaction th,
    .table-transaction td {
      padding: 0.625rem 1.5rem .25rem !important;
      color: #000 !important;
    }

    .table> :not(caption)>tr>th {
      padding: 0.625rem 1.5rem .25rem !important;
      background-color: #6a6e51 !important;
    }

    .table-bordered>:not(caption)>*>* {
      border-width: inherit;
      line-height: 32px;
      font-size: 14px;
      border: 1px solid #e1e1e1;
      vertical-align: middle;
    }

    .table-striped .image {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      flex-shrink: 0;
      border-radius: 10px;
      overflow: hidden;
    }

    .table-striped td:nth-child(1) {
      min-width: 250px;
      padding-bottom: 7px;
    }

    .pname {
      display: flex;
      gap: 13px;
    }

    .table-bordered> :not(caption)>tr>th,
    .table-bordered> :not(caption)>tr>td {
      border-width: 1px 1px;
      border-color: #6a6e51;
    }
  </style>
   <main class="pt-90" style="padding-top: 0px;">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">{{ $header_title ?? '' }}</h2>
      <div class="row">
        <div class="col-lg-2">
         
            @include('user.account-nav')
         
        </div>

        <div class="col-lg-10">
          <div class="wg-box mt-5 mb-5">
            <div class="row">
              <div class="col-6">
                <h5>{{ $header_title ?? '' }}</h5>
              </div>
              <div class="col-6 text-right">
                <a class="btn btn-sm btn-danger" href="{{ route('user.orders') }}">Назад</a>
              </div>
            </div>
            <div class="table-responsive table-striped">
              <table class="table table-striped table-bordered table-transaction">
                <tbody>
                  <tr>
                    <th> Номер замовлення</th>
                    <td>{{ $order->id }}</td>
                    <th> Мобільний телефон</th>
                    <td>{{ $order->phone }}</td>
                    <th>Поштовий індекс</th>
                    <td>{{ $order->zip_code }}</td>
                  </tr>
                  <tr>
                    <th>Дата замовлення</th>
                    <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                    <th>Дата доставки</th>
                    <td>{{ $order->delivered_date }}</td>
                    <th>Дата скасування</th>
                    <td>{{ $order->canceled_date }}</td>
                  </tr>
                  <tr>
                    <th>Статус замовлення</th>
                    <td colspan="5">
                      <span class="badge bg-danger">{{ $order->status_ua }}</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="wg-box wg-table table-all-user">
            <div class="row">
              <div class="col-6">
                <h5>Замовлені товари</h5>
              </div>
              <div class="col-6 text-right">

              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                     <th>Назва</th>
                                    <th class="text-center">Ціна</th>
                                    <th class="text-center">Кількість</th>
                                    <th class="text-center">Артикул</th>
                                    <th class="text-center">Категорія</th>
                                    <th class="text-center">Бренд</th>
                                    <th class="text-center">Опції</th>
                                    <th class="text-center">Статус повернення</th>
                                   
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orderItems as $item)
                                    <tr>

                                        <td>
                                            <div class="image">
                                                <img src="{{ asset('uploads/products/' . $item->product->image) }}"
                                                    alt="{{ $item->product->name }}" class="image">
                                            </div>
                                            <div class="name">
                                                <a href="{{ route('shop.product.details', ['product_slug' => $item->product->slug]) }}"
                                                    target="_blank" class="body-title-2">{{ $item->product->name }}</a>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ number_format($item->price) }} ₴</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-center">{{ $item->product->SKU }}</td>
                                        <td class="text-center">{{ $item->product->category->name }}</td>
                                        <td class="text-center">{{ $item->product->brand->name }}</td>
                                        <td class="text-center">{{ $item->options }}</td>
                                        <td class="text-center">
                                            {{ $item->rstatus == 0 ? 'Не повернуто' : 'Повернуто' }}
                                        </td>
                                        
                                    </tr>
                                @endforeach
              </table>
            </div>
          </div>
          <div class="divider"></div>
          <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

          </div>

          <div class="wg-box mt-5">
            <h5>Адреса доставки</h5>
            <div class="my-account__address-item col-md-6">
               <div class="my-account__address-item__detail">
					 <p>{{ $order->name }}</p>
                            <p>{{ $order->address }}</p>
                            <p>{{ $order->city }}, {{ $order->state }}</p>
                            <p>{{ $order->country }}</p>
                            <p>{{ $order->zip }}</p>
                            <p>{{ $order->landmark }}</p>
                            <br>
                            <p>Мобільний : {{ $order->phone }}</p>
				</div>
            </div>
          </div>

          <div class="wg-box mt-5">
            <h5>Транзакції</h5>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-transaction">
                        <tbody>
                            <tr>
                                <th> Проміжний підсумок</th>
                                <td>{{ number_format($order->subtotal, 2) }} ₴</td>
                                <th>ПДВ</th>
                                <td>{{ number_format($order->tax, 2) }} ₴</td>
                                <th>Знижка</th>
                                <td>{{ number_format($order->discount, 2) }} ₴</td>
                            </tr>
                            <tr>
                                <th>Всього</th>
                                <td>{{ number_format($order->total, 2) }} ₴</td>
                                <th>Метод оплати</th>
                                <td>{{ $order->payment_mode }}</td>
                                <th>Статус замовлення</th>
                                <td>
                                    @if ($transaction->status_ua == 'затверджено')
                                        <span class="badge bg-success">Затверджено</span>
                                    @elseif($transaction->status_ua == 'відхилено')
                                        <span class="badge bg-danger">Відхилено</span>
                                  
                                    @elseif($transaction->status_ua == 'повернуто')
                                        <span class="badge bg-secondary">Повернуто</span>
                                    @else
                                        <span class="badge bg-warning">{{ ucfirst($transaction->status_ua) }}</span>
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                    </table>
            </div>
          </div>

        </div>

      </div>
    </section>
  </main>


@endsection
