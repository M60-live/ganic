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
            <li class="breadcrumb-item"><a href="/admin/catgory/list">List Categories</a></li>
            <li class="breadcrumb-item active">{{ $categories[0]->value }}</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col col-md-12">
          <div class="jumbotron">
            <form action="/admin/catgory/update" method="post" class="" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{ $categories[0]->id }}"/>
              <table class="table">
                <tbody>
                  <tr><td><strong>Name:</strong></td><td><input class="form-control" name="value" value="{{ $categories[0]->value }}" /></td></tr>
                  <tr><td></td><td><button class="btn btn-primary" type="submit">Update</button></td></tr>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection