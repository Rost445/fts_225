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
                                @if ($order->status == 'delivered')
                                    <span class="badge badge-success">Доставлено</span>
                                @elseif($order->status == 'pending')
                                    <span class="badge badge-warning">В очікуванні</span>
                                @elseif($order->status == 'canceled')
                                    <span class="badge badge-danger">Скасовано</span>
                                @else
                                    <span class="badge badge-secondary">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                        </tr>

                    </table>
                </div>
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <h5>Ordered Items</h5>
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
                                        <td class="text-center">${{ number_format($item->price) }}</td>
                                        <td class="text-center">{{ $item->product->quantity }}</td>
                                        <td class="text-center">{{ $item->product->SKU }}</td>
                                        <td class="text-center">{{ $item->product->category->name }}</td>
                                        <td class="text-center">{{ $item->product->brand->name }}</td>
                                        <td class="text-center">{{ $item->options }}</td>
                                        <td class="text-center">
                                            {{ $item->rstatus == 0 ? 'Не повернуто' : 'Повернуто' }}
                                        </td>
                                        <td class="text-center">
                                            <div class="list-icon-function view-icon">
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </div>
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
            </div>
        </div>




    </div>
    </div>
@endsection
