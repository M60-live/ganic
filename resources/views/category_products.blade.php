@extends('layouts.main')

@section('stylesheet')
  {{--<link href="{{ asset('css/category.css') }}" rel="stylesheet" />--}}
  {{--<link href="{{ asset('css/category_responsive.css') }}" rel="stylesheet" />--}}
@endsection

@section('content')
  <div class="products">
    <div class="container">
      {{--<div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="section_title text-center">Our Product Range</div>
        </div>
        --}}{{--<div class="col-md-3">
          <div class="products_bar d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-start justify-content-center">
            <div class="products_bar_side d-flex flex-row align-items-center justify-content-start ml-lg-auto">
              <div class="products_dropdown product_dropdown_sorting">
                <div class="isotope_sorting_text"><span>Default Sorting</span><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                <ul>
                  <li class="item_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'>Default</li>
                  <li class="item_sorting_btn" data-isotope-option='{ "sortBy": "price" }'>Price</li>
                  <li class="item_sorting_btn" data-isotope-option='{ "sortBy": "name" }'>Name</li>
                </ul>
              </div>
            </div>
          </div>
        </div>--}}{{--
      </div>--}}

      <div class="row page_nav_row">
        <div class="col">
          <div class="page_nav">
            <ul class="d-flex flex-row align-items-start justify-content-center menu-list">
              @if($category_active == 'all')
                <li class="active"><a href="/products/category/all">All</a></li>
              @else
                <li><a href="/products/category/all">All</a></li>
              @endif

              @foreach($categories as $category)
                @if($category->id == $category_active)
                  <li class="active"><a href="/products/category/{{ $category->id }}">{{ $category->value }}</a></li>
                @else
                  <li><a href="/products/category/{{ $category->id }}">{{ $category->value }}</a></li>
                @endif
              @endforeach
            </ul>
          </div>
        </div>
      </div>

      {{--<div class="row products_bar_row">
        <div class="col">
          <div class="products_bar d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-start justify-content-center">
            <div class="products_bar_side d-flex flex-row align-items-center justify-content-start ml-lg-auto">
              <div class="products_dropdown product_dropdown_sorting">
                <div class="isotope_sorting_text"><span>Default Sorting</span><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                <ul>
                  <li class="item_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'>Default</li>
                  <li class="item_sorting_btn" data-isotope-option='{ "sortBy": "price" }'>Price</li>
                  <li class="item_sorting_btn" data-isotope-option='{ "sortBy": "name" }'>Name</li>
                </ul>
              </div>
              --}}{{--<div class="products_dropdown text-right product_dropdown_filter">
                <div class="isotope_filter_text"><span>Filter</span><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                <ul>
                  <li class="item_filter_btn" data-filter="*">All</li>
                  <li class="item_filter_btn" data-filter=".hot">Hot</li>
                  <li class="item_filter_btn" data-filter=".new">New</li>
                  <li class="item_filter_btn" data-filter=".sale">Sale</li>
                </ul>
              </div>--}}{{--
            </div>
          </div>
        </div>
      </div>--}}

      <div class="row products_bar_row">
        <div class="col-lg-12">
          @if ($flash = session('message'))
            <div class="alert alert-success" role="alert">
              {{ $flash }}
            </div>
          @endif
        </div>
      </div>

      <div class="row products_row">
        <div class="col col-md-12">
          <div style="display: flex; justify-content: center;">
            {{ $Links }}
          </div>
        </div>
      </div>

      <div class="row products_bar_row">
        <div class="col col-md-12">
          @if(isset($keyword))
            <p>Found <b>{{ $products->total() }}</b> search results for: <strong><i>{{ $keyword }}</i></strong></p>
          @endif
        </div>
      </div>

      <div class="row products_row">

        @foreach($products as $product)
          <div class="col-lg-4 col-md-6 col-6">
            <div class="product">
              <div class="product_image">
                @if($product->instock=='1')
                  <a href="/products/view/{{ $product->cat_id }}/{{ $product->id }}/{{ $product->category_name }}" title="{{ $product->value }}"><img src="{{ asset('storage/products/'.$product->img_dir.env("APP_VERSION")) }}" alt="" /></a>
                @else
                  <div class="out-of-stock">Out of stock</div>
                  <a href="/products/view/{{ $product->cat_id }}/{{ $product->id }}/{{ $product->category_name }}" title="{{ $product->value }}"><img src="{{ asset('storage/products/'.$product->img_dir.env("APP_VERSION")) }}" alt="" /></a>
                @endif

              </div>
              <div class="product_content">
                <div class="product_info d-flex flex-row align-items-start justify-content-start">
                  <div>
                    <div>
                      <div class="product_name">
                        @if($product->instock=='0')
                          <a href="/products/view/{{ $product->cat_id }}/{{ $product->id }}/{{ $product->category_name }}" title="{{ $product->value }}"><strike>{{ $product->value }}</strike></a>
                        @else
                          <a href="/products/view/{{ $product->cat_id }}/{{ $product->id }}/{{ $product->category_name }}" title="{{ $product->value }}">{{ $product->value }}</a>
                        @endif
                      </div>
                      <div class="product_category">
                        In <a href="/products/category/{{ $product->cat_id }}">{{ $product->category_name }}</a>
                      </div>
                    </div>
                  </div>
                  <div class="product_price">
                    R{{ substr($product->price,0,strpos($product->price,".")) }}<span>{{ substr($product->price,strpos($product->price,".")) }}</span>
                  </div>
                  {{--<div class="ml-auto text-right">--}}
                    {{--<div class="rating_r rating_r_4 home_item_rating"><i></i><i></i><i></i><i></i><i></i></div>--}}
                    {{--<div class="product_price text-right">R{{ $product->price }}<span>.00</span></div>--}}
                  {{--</div>--}}
                </div>
                @if(auth()->check())
                <div class="product_buttons">
                  <div class="text-right d-flex flex-row align-items-start justify-content-start">
                    {{--<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
                      <div><div><img src="/img/heart_2.svg" class="svg" alt=""><div>+</div></div></div>
                    </div>--}}
                    {{--@if($product->instock=='1')
                         <div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center pb-2 pt-2" id="add_to_cart_{{ $product->id }}">
                             <div><div><img src="/img/cart.svg" class="svg" alt=""><div>+</div></div></div>
                             <form method="post" action="/add_to_cart" id="add_to_cart_form_{{ $product->id }}">
                                 @csrf
                                 <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                                 <input type="hidden" name="category_id" value="{{ $product->cat_id }}"/>
                             </form>
                         </div>
                    @else
                          <div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
                              <div><div style="width: 100%;padding-top: 7px;height: 38px;"><strike><strong>Out of stock</strong></strike></div></div>
                          </div>
                    @endif--}}
                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="row products_row">
        <div class="col col-md-12">
          <div style="display: flex; justify-content: center;">
            {{ $Links }}
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection

@section('javaScript')
  <script type="text/javascript">
    $(document).ready(function(){
      $('div[id^="add_to_cart_"]').click(function(){
        var prodID = $(this).prop('id').substr(12);
        $('#add_to_cart_form_'+prodID).submit();
      });
    });
  </script>
@endsection
