@extends('layouts.app')
@section('content')
    
<style>
.divider {
    height: 100px;
   
    margin: 20px 0;
}
.text-danger{
    color: crimson !important
}

</style>

    <main class="pt-90 mt-90">
      

        </div>
      <div class="container">
        <div class="row">
            <div class="col-md-12">
                  <div class="divider"></div>
                <h2 class="mb-4">Товари зі знижкою</h2>
            </div>
            <div class="row">
@forelse($products as $product)

<div class="col-md-3 mb-4">
    <div class="product-card">

        <img src="{{ asset('uploads/products/'.$product->image) }}" class="img-fluid">

        <h6 class="mt-2">{{ $product->name }}</h6>

        <div>
            <span class="text-danger fw-bold">
                {{ $product->sale_price }} грн
            </span>

            <span class="text-decoration-line-through text-muted">
                {{ $product->regular_price }} грн
            </span>
        </div>

        <a href="{{ route('shop.product.details', $product->slug) }}" class="btn btn-sm btn-dark mt-2">
            Детальніше
        </a>

    </div>
</div>

@empty

<p>Немає товарів зі знижкою</p>

@endforelse
            </div>
        </div>
      </div>
    </main>



@endsection


