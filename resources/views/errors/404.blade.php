@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">404</h1>
    <h3>Сторінку не знайдено</h3>
    <p>Можливо, вона була видалена або ви ввели неправильну адресу.</p>

    <a href="{{ url('/') }}" class="btn btn-primary mt-3">
        Повернутись на головну
    </a>
</div>
@endsection