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
                <h3>Купони</h3>
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
                        <div class="text-tiny">Купони</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                    tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.coupon.add') }}"><i class="icon-plus"></i>Додати
                        купон</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show fs-3" role="alert">
                                <div class="p-3">{{ session('success') }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Код</th>
                                    <th>Тип</th>
                                    <th>Значення</th>
                                    <th>Сума кошика</th>
                                    <th>Дата закінчення</th>
                                    <th>Дія</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->id }}</td>
                                        <td>{{ $coupon->code }}</td>
                                       <td>
    {{ $coupon->type == 'fixed' ? 'Фіксована сума' : 'Відсоток' }}
</td>
                                        <td>{{ $coupon->value }}</td>
                                        <td>{{ $coupon->cart_value }}</td>
                                        <td>{{ $coupon->expire_date }}</td>
                                        <td>
                                            <div class="list-icon-function">
                                                <a href="{{ route('admin.coupon.edit', ['id' => $coupon->id]) }}">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>
                                           <form action="{{ route('admin.coupon.delete', ['id' => $coupon->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="item text-danger delete">
                                                    <i class="icon-trash-2"></i>
                                                </div>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $coupons->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.delete').on('click', function(e) {
                e.preventDefault();

                let form = $(this).closest('form');

                swal({
                    title: "Ви впевнені?",
                    text: "Цю дію не можна буде скасувати!",
                    icon: "warning",
                    buttons: ["Скасувати", "Видалити"],
                    dangerMode: true,
                }).then(function(willDelete) {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
