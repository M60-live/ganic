@extends('layouts.main')

@section('content')
  @parent
  <div class="products">
    <div class="container">

      <div class="row">

        {{--<div class="col-md-3">
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
        </div>--}}
      </div>
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

      <div class="row products_row">

        <div class="col col-md-12" style="margin-bottom: 15px;">
          <a href="/products/category/{{ $product_details->categoryid }}" class="btn btn-primary"><span class="fa fa-angle-left" style="color: #fff;"></span> back to {{ $product_details->category_name }} category</a>
{{--          <a href="{{ url()->previous() }}" class="btn btn-primary"><span class="fa fa-angle-left" style="color: #fff;"></span> back to <b>{{ $category_name }}</b> list</a>--}}
        </div>
        <!-- Product Image -->
        <div class="col-lg-6">
          <div class="product_image_slider_container">
            <div id="slider" class="flexslider">
              <ul class="slides">
                <li>
                  @if($product_details->instock=='1')
                    <img src="{{ asset('storage/products/'.$product_details->img_dir.env("APP_VERSION")) }}" />
                  @else
                    <div class="out-of-stock">Out of stock</div>
                    <img src="{{ asset('storage/products/'.$product_details->img_dir.env("APP_VERSION")) }}" />
                  @endif
                </li>
                <li>
                  {{--<img src="{{ asset('storage/products/'.$product_details->img_dir) }}" />--}}
                </li>
                <li>
{{--                  <img src="{{ asset('storage/products/'.$product_details->img_dir) }}" />--}}
                </li>
              </ul>
            </div>
            {{--<div class="carousel_container">
              <div id="carousel" class="flexslider">
                <ul class="slides">
                  <li>
                    <div><img src="{{ asset('storage/products/'.$product_details->img_dir) }}" /></div>
                  </li>
                  <li>
                    <div><img src="{{ asset('storage/products/'.$product_details->img_dir) }}" /></div>
                  </li>
                  <li>
                    <div><img src="{{ asset('storage/products/'.$product_details->img_dir) }}" /></div>
                  </li>
                </ul>
              </div>
              <div class="fs_prev fs_nav disabled"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
              <div class="fs_next fs_nav"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
            </div>--}}
          </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6 product_col">
          <div class="row">
          <div class="product_info">
            <div class="col col-md-12">
              <div class="product_name">{{ $product_details->value }}</div>
            </div>
            <div class="col col-md-12">
              <form method="post" action="/add_to_cart" id="add_to_cart_form">
              @if(isset($product_options) && !empty($product_options))
                <div class="px-2 py-2 mt-2 border-0 shadow-sm">
                  {{--<select class="form-control col-md-7" name="options">
                    @foreach($product_options as $options)
                      <option value="{{ $options->id }}">{{ $options->value }}</option>
                    @endforeach
                  </select>--}}
                  <label class="text-black-50">select options:</label>
                  <?php $cnt=1?>
                  @foreach($product_options as $options)
                    @if($cnt>1)
                      <label class="radio-container">
                        <input type="radio" name="options" value="{{ $options->id }}" /> {{ $options->value }}
                        <span class="checkmark"></span>
                      </label>
                    @else
                      <label class="radio-container">
                        <input type="radio" name="options" value="{{ $options->id }}" checked/> {{ $options->value }}
                        <span class="checkmark"></span>
                      </label>
                    @endif
                    <?php $cnt++; ?>
                  @endforeach
                </div>
              @endif
            </div>
            <div class="col col-md-12">
              <div class="product_category">In <a href="/products/category/{{ $product_details->categoryid }}">{{ $product_details->category_name }}</a></div>
            </div>
            {{--<div class="product_rating_container d-flex flex-row align-items-center justify-content-start">
              <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
              <div class="product_reviews">4.7 out of (3514)</div>
              <div class="product_reviews_link"><a href="#">Reviews</a></div>
            </div>--}}
            <div class="col col-md-12 product-detail-container">
              <div class="product_price">R{{ substr($product_details->price,0,strpos($product_details->price,".")) }}<span>{{ substr($product_details->price,strpos($product_details->price,".")) }}</span></div>
            </div>
            {{--<div class="col col-md-12 product-detail-container">
              <div class="product_size_title">Select Size</div>
              <ul class="d-flex flex-row align-items-start justify-content-start">
                <li>
                  <input type="radio" id="radio_1" disabled name="product_radio" class="regular_radio radio_1">
                  <label for="radio_1">XS</label>
                </li>
                <li>
                  <input type="radio" id="radio_2" name="product_radio" class="regular_radio radio_2" checked>
                  <label for="radio_2">S</label>
                </li>
                <li>
                  <input type="radio" id="radio_3" name="product_radio" class="regular_radio radio_3">
                  <label for="radio_3">M</label>
                </li>
                <li>
                  <input type="radio" id="radio_4" name="product_radio" class="regular_radio radio_4">
                  <label for="radio_4">L</label>
                </li>
                <li>
                  <input type="radio" id="radio_5" name="product_radio" class="regular_radio radio_5">
                  <label for="radio_5">XL</label>
                </li>
                <li>
                  <input type="radio" id="radio_6" disabled name="product_radio" class="regular_radio radio_6">
                  <label for="radio_6">XXL</label>
                </li>
              </ul>
            </div>--}}
            <div class="col-md-12 product-detail-container">
              <p>{{ $product_details->desc }}.</p>
            </div>
            <div class="col col-md-12 product-detail-container">
              <div class="row">
                @if(auth()->check())
                <div class="col-sm-12 cart-icon-div text-center">
                  <div class="product_buttons">
                    <div class="text-right d-flex flex-row align-items-start justify-content-start">
                      {{--<div class="product_button product_fav text-center d-flex flex-column align-items-center justify-content-center">
                        <div><div><img src="/img/heart_2.svg" class="svg" alt=""><div>+</div></div></div>
                      </div>--}}
                        @if($product_details->instock=='1')
                          <div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center" id="add_to_cart" >
                          <div><div><img src="/img/cart.svg" class="svg" alt=""><div>+</div></div></div>

                                  @csrf
                                  <input type="hidden" name="product_id" value="{{ $product_details->id }}"/>
                                  <input type="hidden" name="category_id" value="{{ $product_details->categoryid }}"/>
                              </form>
                          </div>
                        @else
                            <div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center">
                                <div><div style="width: 100%;padding-top: 5px;"><strike><strong>Out of stock</strong></strike></div></div>
                            </div>
                        @endif
                    </div>
                  </div>
                </div>
                @else
                  <div class="col-sm-12 cart-icon-div text-center">
                    {{--<div class="product_buttons">--}}
                      {{--<div class="text-right d-flex flex-row align-items-start justify-content-start">--}}
{{----}}
                          {{--<div class="product_button product_cart text-center d-flex flex-column align-items-center justify-content-center" id="" >--}}
                            <a href="/login/?failed=order" class="btn btn-primary">Order now</a>
                          {{--</div>--}}
{{----}}
                      {{--</div>--}}
                    {{--</div>--}}
                  </div>
                @endif
                {{--<div class="col-sm-6 cart-icon-div">
                    <i class="fa fa-2x fa-heart cart-icon"></i>
                </div>
                <div class="col-sm-6 cart-icon-div">
                    <i class="fa fa-2x fa-plus-circle cart-icon"></i>
                </div>--}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-md">
        <b>Related Product(s):</b>
        <hr>
      </div>
    </div>
    @if(!empty($relatedProducts) && ($relatedProducts->total()>0))
      <div class="row mb-5">
          @foreach($relatedProducts as $related)
          <div class="col-md-2">
              <div class="card">
                <a href="/products/view/{{ $related->categoryid }}/{{ $related->id }}/{{ $related->category_name }}"><img src=" {{ asset('storage/products/'.$related->img_dir.env("APP_VERSION")) }}" class="" /></a><br>
                <p class="px-2 py-2"><small>{{ $related->value }}</small></p>
              </div>
          </div>
          @endforeach
      </div>
    @endif
  </div>
</div>
@endsection

@section('stylesheet')
  <link href="{{ asset('css/flexslider/flexslider.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/product.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/product_responsive.css') }}" rel="stylesheet" />
@endsection

@section('javaScript')
  <script src="{{ asset('/css/flexslider/jquery.flexslider-min.js') }}"></script>
  <script src="{{ asset('/js/product.js') }}"></script>
  <script src="{{ asset('/js/parallax.min.js') }}"></script>
{{--  <script src="{{ asset('/js/easing.js') }}"></script>--}}
  <script type="text/javascript">
    $(document).ready(function(){
      $('div[id^="add_to_cart"]').click(function(){
        $('#add_to_cart_form').submit();
      });
    });
  </script>
@endsection
