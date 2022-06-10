@extends('layouts.main')

@section('content')
  @parent
<div class="products">
  <div class="container-fluid">
    {{--<div class="row banner">--}}
    <div class="row">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width: 100%;" data-interval="10000">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" dat`a-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="/img/blog/Frame.jpg" alt="First slide" />
            <div class="carousel-caption d-none d-md-block">
              {{--<h3>Shop now</h3>--}}
              <a href="/products" class="btn btn-default"><span class="fa fa-shopping-bag text-white"></span> shop now</a>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="/img/blog/Frame3.jpg" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
              <h5 class="text-white">
                Check out our new hair care range
              </h5>
              <p class="text-white">
                <a href="/products/category/4" class="btn btn-default">take me there</a>
              </p>
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="/img/blog/Frame4.jpg" alt="Third slide">
            {{--<div class="carousel-caption d-none d-md-block">
              <h5>Shop all our products</h5>
              <p>All products are inspired by mother nature</p>
            </div>--}}
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="/img/blog/Frame2.jpg" alt="Fourth slide">
            {{--<div class="carousel-caption d-none d-md-block">
              <h5>Shop all our products</h5>
              <p>All products are inspired by mother nature</p>
            </div>--}}
            <div class="carousel-caption d-none d-md-block">
              <h5 class="text-white">
                Go natural and organic, spring clean your skin from nasties
              </h5>
              <p class="text-white">
                  <a href="/products/category/1" class="btn btn-default">check out our range</a>
              </p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>

</div>

<div class="products main-body" style="padding-bottom: 80px;">
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <p>
          <h3 class="text-black-50">Welcome to Ganic Roots</h3>
          {{--<img src="{{ asset('/img/flyer.png') }}" class="img-responsive"/><br>--}}
          We offer all-natural & organic handmade skin and hair products.
          We are all about simple, powerful ways to nourish skin and hair. Our products contain ingredients that are
          extracted from nature with no harmful, synthetic ingredients that are in so many
          of today's skin and hair products. We believe in keeping it clean and natural.
          So shop with us, we know you will love what you find.
          <br><br>
          <a href="/products/" class="btn btn-primary">Check our products</a>
        </p>
      </div>
      <div class="col col-md-5 offset-md-1">
        @guest
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-light mb-3">
            <h3 class="text-center text-black-50">Sign up today!</h3>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
              <div class="col-md-8">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>
              <div class="col-md-8">
                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" required autofocus>
                @if ($errors->has('surname'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('surname') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
              <div class="col-md-8">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>
              <div class="col-md-8">
                <input id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required>
                @if ($errors->has('phone_number'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('phone_number') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
              <div class="col-md-8">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
              <div class="col-md-8">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Sign Up') }}
                </button>
              </div>
            </div>
          </form>
          </div>
        </div>
        @else
            <p class="text-center">
                {{--<img src="/img/organiclogo.png" class="img-responsive col-md-9" />--}}
                <img src="/img/organic-logo.png" class="img-fluid" />
            </p>
        @endguest
      </div>
    </div>
  </div>
</div>


<div class="products">
  <div class="container-fluid">
    <div class="row">
      <div class="flex-row col-md-3 col-xs-12"></div>
      <div class="flex-row col-md-6 col-xs-12">
        <p>
          <h3 class="text-black-50">Our Promise</h3>
          Our products are extracts from nature's best offerings.
          Keep it clean and natural, love and nourish your
          hair and skin the Ganic Roots way.
        </p>
      </div>
    </div>
    <div class="col col-md-3 col-xs-12"></div>
  </div>
</div>

<div class="products"></div>


@endsection

@section('javaScript')
  @parent
  @include('layouts.popup')
  <script type="application/javascript">
    $(document).ready(function(){

    });
  </script>
@endsection