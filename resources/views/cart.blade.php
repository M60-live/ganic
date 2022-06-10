@extends('layouts.main')

@section('content')
  <div class="products">
    <div class="container">
      <div class="row">
        <div class="flex-row col-md-6 offset-md-3">
          <div class="section_title text-center">Your Cart - Ready to checkout?</div>
        </div>
      </div>
    </div>
  </div>

  <div class="products pt-2">
    <div class="container">
      @if ($flash = session('message'))
        <div class="row">
          <div class="col-lg-12">
            <div class="alert alert-warning" role="alert">
              {{ $flash }}
            </div>
          </div>
        </div>
      @endif
      @if($addressComplete=="1")
        <form method="post" action="/confirmation">
      @endif
        @csrf
        {{--<div class="row">
          <div class="flex-row col-md-8 offset-md-2">
            @if(!empty($products->items()))
              @if($addressComplete=="1")
                <button class="btn btn-primary" type="submit">Check Out</button>
              @else
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                  Check Out
                </button>
                @include('modal',['type'=>'error','message'=>'Please fill in your address before you proceed check out!'])
              @endif
            @else
              no items in your cart...
            @endif
          </div>
        </div>--}}
        <hr>
        {{--<div class="row">
          <div class="offset-md-3 col-md-6">
            <p class="pb-5 text-center">You can now track your order after purchasing. On profile (<i class="fa fa-user"></i>), select the "Your Orders" tab to view status of your order.</p>
          </div>
        </div>--}}
        <div class="row pt-4">
          <div class="flex-row col-md-6 offset-md-3" style="margin-bottom: 35px;">
            @foreach($products as $product)
              <div class="card" style="margin-bottom: 10px;border-radius: 15px; box-shadow: rgba(210,210,210,.1) 5px 5px 6px; border: rgba(0,0,0,.1) solid 1px;">
                <div class="card-body">

                  <div class="row">
                    <div class="col col-md-2">
                      {{--<input type="checkbox" name="products[{{ $product->id }}]" class="css-checkbox" id="checkbox{{ $product->id }}" checked="checked">
                      <label for="checkbox{{ $product->id }}" class="css-label lite-green-check"></label>--}}

                      <label class="checkbox-container">
                        <input type="checkbox" name="products[{{ $product->id }}]" id="checkbox{{ $product->id }}" checked="checked"/>
                        <span class="checkmark"></span>
                      </label>
                    </div>
                    <div class="col col-md-4">
                      <img src="{{ asset('storage/products/'.$product->img_dir) }}" class="img-responsive img-thumbnail" />
                    </div>
                    <div class="col col-md-6">
                      <h3 class="mb-0 display-5">{{ $product->value }}</h3>
                      @if($product->product_options != '')<small class=""><i>({{ $product->product_options }})</i></small>@endif
                      <h4 class="">R{{ $product->price }}</h4>
                      <a href="/cart/remove/{{ $product->id }}" class="btn btn-outline-danger">remove</a>
                    </div>
                  </div>

                </div>
              </div>
            @endforeach
          </div>
          <div class="col-md-3" style="margin-bottom: 35px;">
            <div class="alert alert-info pb-5 text-center">You can now track your order after purchasing. On profile (<i class="fa fa-user"></i>), select the "Your Orders" tab to view status of your order.</div>
          </div>
        </div>
          <div class="row">
            <div class="flex-row col-md-3 offset-md-6 pb-5">
              @if(!empty($products))
                @if($addressComplete=="1")
                  <button class="btn btn-primary pull-right" type="submit">Check Out</button>
                @else
                  <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">
                    Check Out
                  </button>
                  @include('modal',
                  [
                    'type'=>'error',
                    'message'=>'Please fill in your address before you proceed check out!',
                    'textbody'=>'<a href="/account" class="btn btn-info btn-sm">Take me there</a>'
                  ])
                @endif
              @else
                no items in your cart...
              @endif
            </div>
          </div>
      @if($addressComplete=="1")
        </form>
      @endif
    </div>
  </div>
@endsection

@section('javaScript')
  <script type="text/javascript">
    $(document).ready(function(){
      $('input[id="checkbox"]').click(function(){
        $('input[type="checkbox"]').attr('checked',false);
      });
    });
  </script>
@endsection