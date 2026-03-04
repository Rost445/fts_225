@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">

        <div class="main-content-wrap">
            <div class="tf-section-2 mb-30">
                <div class="flex gap20 flex-wrap-mobile">
                    <div class="w-half">

                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Всього замовлень</div>
                                        <h4>{{ $dashboardDatas->Total }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Сума всіх замовлень (грн)</div>
                                        <h4>{{ $dashboardDatas->TotalAmount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Замовлено</div>
                                        <h4>{{ $dashboardDatas->TotalOrdered }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Сума замовлень (грн)</div>
                                        <h4>{{ $dashboardDatas->TotalOrderedAmount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="w-half">

                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Доставлено</div>
                                        <h4>{{ $dashboardDatas->TotalDelivered }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Сума доставлених замовлень (грн)</div>
                                        <h4>{{ $dashboardDatas->TotalDeliveredAmount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Скасовано</div>
                                        <h4>{{ $dashboardDatas->TotalCanceled }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap14">
                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>
                                    <div>
                                        <div class="body-text mb-2">Сума скасованих замовлень (грн)</div>
                                        <h4>{{ $dashboardDatas->TotalCanceledAmount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Щомісячний Дохід</h5>

                    </div>
                    <div class="flex flex-wrap gap40">
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t1"></div>
                                    <div class="text-tiny">Всього</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>{{ number_format($TotalAmount, 2) }} грн</h4>
                            </div>
                        </div>
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t2"></div>
                                    <div class="text-tiny">В очікуванні</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>{{ number_format($TotalOrderedAmount, 2) }} грн</h4>
                            </div>
                        </div>
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t3"></div>
                                    <div class="text-tiny">Доставлено</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>{{ number_format($TotalDeliveredAmount, 2) }} грн</h4>
                            </div>
                        </div>
                        <div>
                            <div class="mb-2">
                                <div class="block-legend">
                                    <div class="dot t4"></div>
                                    <div class="text-tiny">Скасовано</div>
                                </div>
                            </div>
                            <div class="flex items-center gap10">
                                <h4>{{ number_format($TotalCanceledAmount, 2) }} грн</h4>
                            </div>
                        </div>
                    </div>
                    <div id="line-chart-8"></div>
                </div>

            </div>
            <div class="tf-section mb-30">

                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Останні замовлення</h5>
                        <div class="dropdown default">
                            <a class="btn btn-secondary dropdown-toggle" href="{{ route('admin.orders') }}"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="view-all"> Переглянути всі</span>
                            </a>
                        </div>
                    </div>
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:70px">№ замовлення</th>
                                        <th class="text-center">Ім'я</th>
                                        <th class="text-center">Телефон</th>
                                        <th class="text-center">Проміжний підсумок</th>
                                        <th class="text-center">ПДВ</th>
                                        <th class="text-center">Всього</th>
                                        <th class="text-center">Статус</th>
                                        <th class="text-center">Дата замовлення</th>
                                        <th class="text-center">Загальна кількість товарів</th>
                                        <th class="text-center">Дата доставки</th>
                                        <th class="text-center">Переглянути</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">{{ $order->id }}</td>
                                            <td class="text-center">{{ $order->name }}</td>
                                            <td class="text-center">{{ $order->phone }}</td>
                                            <td class="text-center">{{ number_format($order->subtotal, 2) }} ₴</td>
                                            <td class="text-center">{{ number_format($order->tax, 2) }} ₴</td>
                                            <td class="text-center">{{ number_format($order->total, 2) }} ₴</td>
                                            @php
                                                $statusLabels = [
                                                    'ordered' => 'Замовлено',
                                                    'delivered' => 'Доставлено',
                                                    'canceled' => 'Скасовано',
                                                ];
                                                $badgeClasses = [
                                                    'ordered' => 'badge bg-primary',
                                                    'delivered' => 'badge bg-success',
                                                    'canceled' => 'badge bg-danger',
                                                ];
                                            @endphp

                                            <td class="text-center">
                                                <span class="{{ $badgeClasses[$order->status] ?? 'badge bg-warning' }}">
                                                    {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="text-center">{{ $order->created_at }}</td>
                                            <td class="text-center">{{ $order->orderItems->count() }}</td>

                                            <td class="text-center">{{ $order->delivered_date }}</td>

                                            <td class="text-center">
                                                <a href="{{ route('admin.order.details', $order->id) }}"
                                                    class="list-icon-function view-icon">
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
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
@push('scripts')
<script>
        (function ($) {

            var tfLineChart = (function () {

                var chartBar = function () {

                    var options = {
                        series: [{
                            name: 'Всього',
                            data: [{{ $TotalAmount }}]
                        }, {
                            name: 'В очікуванні',
                            data: [{{ $TotalOrderedAmount }}]
                        },
                        {
                            name: 'Доставлено',
                            data: [{{ $TotalDeliveredAmount }}]
                        }, {
                            name: 'Скасовано',
                            data: [{{ $TotalCanceledAmount }}]
                        }],
                        chart: {
                            type: 'bar',
                            height: 325,
                            toolbar: {
                                show: false,
                            },
                        },
                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '10px',
                                endingShape: 'rounded'
                            },
                        },
                        dataLabels: {
                            enabled: false
                        },
                        legend: {
                            show: false,
                        },
                        colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                        stroke: {
                            show: false,
                        },
                        xaxis: {
                            labels: {
                                style: {
                                    colors: '#212529',
                                },
                            },
                           categories: {!! json_encode($monthlyDatas->pluck('month_name')) !!},
                        },
                        yaxis: {
                            show: false,
                        },
                        fill: {
                            opacity: 1
                        },
                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return "$ " + val + ""
                                }
                            }
                        }
                    };

                    chart = new ApexCharts(
                        document.querySelector("#line-chart-8"),
                        options
                    );
                    if ($("#line-chart-8").length > 0) {
                        chart.render();
                    }
                };

                /* Function ============ */
                return {
                    init: function () { },

                    load: function () {
                        chartBar();
                    },
                    resize: function () { },
                };
            })();

            jQuery(document).ready(function () { });

            jQuery(window).on("load", function () {
                tfLineChart.load();
            });

            jQuery(window).on("resize", function () { });
        })(jQuery);
    </script>
      @endpush('scripts')
