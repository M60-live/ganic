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
            <li class="breadcrumb-item active">List Products</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col col-md-12">
          @if (session('message'))
            <div class="alert alert-success" role="alert">
              {{ session('message') }}
            </div>
          @endif
        </div>
      </div>
      <div class="row">
        <div class="col col-md-12 text-center">
          {{--<div class="jumbotron">--}}
            <table class="table table-bordered">
              <thead><th>#</th><th>Active</th><th>Product Name</th><th>Category</th><th>Date</th><th><a href="/admin/product/create"><div class="fa fa-2x fa-plus-circle"></div></a></th></thead>
              <tbody>
              <?php $cnt=$Products->total(); ?>
              @foreach($Products as $product)
                <tr>
                  <td width="5%">{{ $cnt  - ($Products->perPage() * ($Products->currentPage()-1)) }}</td>
                  <td width="5%"><?php echo ($product->enabled==1)?'<span class="green-dot"></span>':'<span class="red-dot"></span>' ?></td>
                  <td width="45%" align="left">
                    <img src="{{ asset('storage/products/'.$product->img_dir) }}" class="img-fluid col-md-2 col-10" />

                    <a href="/admin/product/view_product/{{ $product->id }}" class="text-muted">{{ $product->value }}</a>
                  </td>
                  <td width="10%">{{ $product->category_name }}</td>
                  <td width="15%">{{ date('d F Y',strtotime($product->created_at)) }}</td>
                  <td width="5%"><a href="/admin/product/view_product/{{ $product->id }}" class="btn btn-primary">View</a></td>
                </tr>
                <?php $cnt--; ?>
              @endforeach
              </tbody>
            </table>
            <div style="margin: auto; display: flex; justify-content: center;">
              {{ $Links }}
            </div>
          {{--</div>--}}
        </div>
      </div>
    </div>
  </div>
@endsection