@extends('layouts.main')

@section('content')
    @parent
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
                        <li class="breadcrumb-item"><a href="/admin/product/list_products/">List Products</a></li>
                        <li class="breadcrumb-item active">Deleting - {{ $Product[0]->value }}</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-12">
                    <div class="alert alert-warning">
                        Delete not possible on this product. There are people who have may have ordered the product already.<br>
                        <a href="/admin/product/view_product/{{ $Product[0]->id }}" class="btn btn-primary btn-sm">go back</a>
                    </div>
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col col-md-12 text-center">

                </div>
            </div>
        </div>
    </div>
@endsection