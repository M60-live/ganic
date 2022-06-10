@extends('layouts.main')

@section('content')
  <div class="products">
    <div class="container">
      <div class="row">
        <div class="flex-row col-md-6 offset-md-3">
          <div class="section_title text-center">
            You have canceled your order <span class="glyphicon glyphicon-thumbs-down text-danger"></span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="products">
    <div class="container">
      <div class="row">
        <div class="flex-row col-md-8 offset-md-2">
          Is there anything we can help you with? Click <a href="/contact_form">here</a>
          <br>
          <br>
          Back to shopping: <a href="/products/" title="back to site" class="btn btn-success btn-lg">OK</a>
        </div>
      </div>
    </div>
  </div>
@endsection
