@extends('layouts.main')

@section('content')
  <div class="products">
    <div class="container">
      <div class="spacer"></div>
      <div class="row">
        <div class="col col-md-12">
          @include('layouts.admin_nav')
        </div>
      </div>
      <div class="spacer"></div>
      <div class="row">
        <div class="col col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/product/dashboard">Main Menu</a></li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col col-md-12 text-center">
          <div class="btn-group btn-group-vertical">
            <a class="btn btn-primary" href="/admin/product/create">Created a Product</a>
            <a class="btn btn-primary" href="/admin/product/list_products">List Products</a>
          </div>
      </div>
    </div>
  </div>
@endsection