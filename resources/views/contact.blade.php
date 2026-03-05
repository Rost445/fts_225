@extends('layouts.app')
@section('content')
<style>
  .text-danger{
    color: crimson !important
  }
</style>
  <main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="contact-us container">
      <div class="mw-930">
        <h2 class="page-title">Контакти</h2>
      </div>
    </section>

    <hr class="mt-2 text-secondary " />
    <div class="mb-4 pb-4"></div>

    <section class="contact-us container">
      <div class="mw-930">
        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>  
          @endif
        <div class="contact-us__form">
          <form action="{{ route('home.contact.store') }}" name="contact-us-form" class="needs-validation" novalidate="" method="POST">
            @csrf
            <h3 class="mb-5">Зв'язатися з нами</h3>
            <div class="form-floating my-4">
              <input type="text" value="{{ old('name') }}" class="form-control" name="name" placeholder="І'мя *" required="">
              <label for="contact_us_name">І'мя *</label>
              @error('name')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-floating my-4">
              <input type="text" value="{{ old('phone') }}" class="form-control" name="phone" placeholder="Телефон *" required="">
              <label for="contact_us_name">Телефон *</label>
              @error('phone')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-floating my-4">
              <input type="email" value="{{ old('email') }}" class="form-control" name="email" placeholder="Email *" required="">
              <label for="contact_us_name">Адреса електронної пошти *</label>
              @error('email')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="my-4">
              <textarea class="form-control form-control_gray" name="comment" placeholder="Ваше повідомлення" cols="30"
                rows="8" required="">{{ old('comment') }}</textarea>
                @error('comment')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="my-4">
              <button type="submit" class="btn btn-primary">Відправити</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </main>


@endsection