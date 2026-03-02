@extends('layouts.admin')
@section('content')
    <style>
        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;
        }
    </style>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Деталі замовлення</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="#">
                            <div class="text-tiny">Адмінпанель</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Деталі замовлення</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <h5>Деталі замовлення</h5>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.orders') }}">Назад</a>
                </div>
                <div class="table-responsive">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered">

                        <tr>
                            <th>Замовлення №</th>
                            <th>Телефон</th>
                            <th>Поштовий індекс</th>
                            <th>Дата замовлення</th>
                            <th>Дата доставки</th>
                            <th>Скасовано</th>
                            <th>Статус замовлення</th>

                        </tr>
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->zip }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->delivery_date }}</td>
                            <td>{{ $order->cancelled_date }}</td>
                            <td colspan="5">
                                @php
                                    $statusLabels = [
                                        'ordered' => 'Замовлено',
                                        'delivered' => 'Доставлено',
                                        'canceled' => 'Скасовано',
                                    ];
                                    $badgeClasses = [
                                        'ordered' => 'bg-primary',
                                        'delivered' => 'bg-success',
                                        'canceled' => 'bg-danger',
                                    ];
                                @endphp

                                <span class="badge {{ $badgeClasses[$order->status] ?? 'bg-warning' }}">
                                    {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>

                    </table>
                </div>
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <h5>Замовлені товари</h5>
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
                                    <th class="text-center">Дія</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $item)
                                    <tr>

                                        <td class="pname">
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
                                        <td class="text-center">
                                            <a href="{{ route('admin.order.details', ['order_id' => $order->id]) }}">
                                                <div class="list-icon-function view-icon">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                        {{ $orderItems->links('pagination::bootstrap-5') }}
                    </div>
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

                <div class="wg-box mt-5">
                    <h5>Оновити статус замовлення</h5>
                    <form action="{{ route('admin.order.status.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                        <div class="row">

                            <select name="order_status" id="order_status" class="form-control">
                                <option value="ordered" {{ $order->status == 'ordered' ? 'selected' : '' }}>Замовлено
                                </option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Доставлено
                                </option>
                                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Скасовано
                                </option>
                            </select>
                        </div>
                        <div class="my-4">
                            <button type="submit" class="btn btn-primary">Оновити статус</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>
    </div>
@endsection
