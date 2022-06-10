@extends('layouts.main')

@section('content')
  <div class="products">
    <div class="container">
      <div class="row">
        <div class="flex-row col-md-6 offset-md-3">
          <div class="section_title text-center">
            Your order has been successfully placed<span class="glyphicon glyphicon-thumbs-up text-success"></span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="products">
    <div class="container">
      <div class="row">
        <div class="flex-row col-md-8 offset-md-2">
{{--            <pre>{{ print_r($product_list) }}</pre>--}}
            Please check your emails for a confirmation of your order.<br>
            Thanks for supporting <strong>Ganic Roots Products</strong><br>
            Please keep this reference number to your order to query about it: <b><i>{{ $pf_payment_id }}</i></b>
            <br>
            <br>
            Back to shopping: <a href="/products/" title="back to site" class="btn btn-success btn-lg">OK</a>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javaScript')

@endsection