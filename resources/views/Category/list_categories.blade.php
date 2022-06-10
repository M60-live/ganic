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
            <li class="breadcrumb-item"><a href="/admin/catgory/list">Main Menu</a></li>
            <li class="breadcrumb-item">List Products</li>
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
        <div class="col col-md-12">
          <div class="">
            <table class="table">
              <thead><th>#</th><th>Category Name</th><th>Action</th></thead>
              <tbody>
              <?php $cnt=1; ?>
              @foreach($categories as $category)
                <tr><td>{{ $cnt }}</td><td>{{ $category->value }}</td><td><a href="/admin/catgory/view/{{ $category->id }}" class="btn btn-primary">View</a></td></tr>
                <?php $cnt++; ?>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection