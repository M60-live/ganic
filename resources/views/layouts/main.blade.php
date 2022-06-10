<?php
header( 'HTTP/1.0 200 OK' );
flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-143115405-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-143115405-1');
    </script>

    <title>Organic - Beauty | Ganic Roots</title>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('/img/fav-icon.png') }}">

  <meta name="description" content="Your online organic and beauty products store. Order bath salts, soaps and hair products on our store. Proudly South African products.">
  <meta name="keywords" content="Organic, Skincare, Skin care, Body care, Beauty, healthy lifestyle, Ganic Roots, natural, hair care" />
  <meta name="author" content="www.alphatobeta.co.za">

  <meta name="csrf-token" content="{{  csrf_token() }}">

  <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" />
  <link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet" />
  <link href="{{asset('css/owl.theme.default.css')}}" rel="stylesheet" />
  <link href="{{asset('css/animate.css')}}" rel="stylesheet" />
  <link href="{{asset('css/main_styles.css')}}" rel="stylesheet" />
  <link href="{{asset('css/responsive.css')}}" rel="stylesheet" />

  @yield('stylesheet')

</head>
<body>

  <div class="menu">

    <div class="menu_search" style="padding-top: 20px;">
      <form action="/search" id="menu_search_form" class="menu_search_form" method="post">
        @csrf
        <input type="text" name="keyword" class="search_input" placeholder="search..." required="required">
        <button class="menu_search_button"><img src="/img/search.png" alt=""></button>
      </form>
    </div>

    <div class="menu_nav">
        <div class="greetings" style="padding-top: 20px;"><a href="/"><img src="/img/logo2.png" class="img-responsive" style="max-width: 75px;"/></a></div>
      @guest

      @else
        <div class="greetings">Hi <a href="/account" class="copyright">{{ Auth::user()->name }}</a>
            <small>[<a class="" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> sign out
                </a>]</small></div>
      @endguest
      <ul class="menu-list menu-list">
        <li><a href="/products/">Shop Online</a></li>
        {{--@if($category_active == 'all')
          <li class="active"><a href="/products/category/all">All Products</a></li>
        @else
          <li><a href="/products/category/all">All Products</a></li>
        @endif--}}

        {{--@foreach($categories as $category)
          @if($category->id == $category_active)
            <li class="active"><a href="/products/category/{{ $category->id }}">{{ $category->value }}</a></li>
          @else
            <li><a href="/products/category/{{ $category->id }}">{{ $category->value }}</a></li>
          @endif
        @endforeach--}}
        @guest
          <li><a href="/login">Sign In</a></li>
        @else
          <li><a href="/account">Accounts</a></li>
          @if(auth()->check() && auth()->user()->admin==1)
            {{--<li><a href="/admin/product/dashboard">Admin</a></li>--}}
            <li><a href="/admin/product/list_products/">Admin</a></li>
          @endif
          {{--<li>
            <a class="" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Sign Out
            </a>
          </li>--}}
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        @endguest
          <li><a href="/contact_form">Contact Us</a></li>
          <li><a href="/lifestyle">Lifestyle</a></li>
          <li><a href="/beauty">Beauty</a></li>
      </ul>
    </div>

    <div class="menu_contact">
      <div class="menu_phone d-flex flex-row align-items-center justify-content-start">
        <i class="fa fa-envelope-o"></i><div> info@ganicroots.co.za</div>
      </div>
      <div class="menu_social">
        <ul class="menu_social_list d-flex flex-row align-items-start justify-content-start menu-list">
          <li><a href="https://www.facebook.com/GanicRootsZA/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          {{--<li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>--}}
          {{--<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>--}}
          <li><a href="https://www.instagram.com/ganic_roots/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        </ul>
      </div>
    </div>

  </div>

  <div class="super_container">
    <header class="header">
      <div class="header_overlay"></div>
      <div class="header_content d-flex flex-row align-items-center justify-content-start">
        <div class="navbar-brand logo">
          <a href="/products">Ganic Roots</a>
        </div>
        <div class="hamburger"><i class="fa fa-bars" aria-hidden="true"></i></div>
        <nav class="main_nav">
          <ul class="d-flex flex-row align-items-start justify-content-start menu-list">
          </ul>
        </nav>

        <div class="header_right d-flex flex-row align-items-center justify-content-start col-md-6 col-sm-5 col-xs-12">
          <div class="header_search" style="margin: auto">
            <form action="/search" id="header_search_form" method="post">
              @csrf
              <input type="text" name="keyword" class="search_input" placeholder="search..." required="required" />
              <button class="header_search_button"><img src="/img/search.png" alt="" /></button>
            </form>
          </div>
        </div>

        <div class="header_right d-flex flex-row align-items-center justify-content-start col-md-6 col-sm-7">
          @guest
          <div class="user"><a href="/login" title="Sign In"><i class="fa fa-2x fa-user-circle-o"></i></a></div>
          @else
          <!-- Cart -->
          {{--<div class="cart"><a href="#"><i class="fa fa-shopping-cart fa-2x"></i></a></div>--}}
          <div class="cart">
            <a href="/cart" title="your cart basket">
              {{--<img src="/img/carticon-round.svg" class="cart-img" />--}}<i class="fa fa-shopping-bag fa-2x"></i><span class="badge badge-info" style="display: none;" id="cart_count">0</span>
            </a>
          </div>
          <div class="cart">
            <a class="" href="/account" title="My Profile"
               > <i class="fa fa-2x fa-user-circle"></i>
            </a>
          </div>
          @endguest

          <div class="header_phone d-flex flex-row align-items-center justify-content-start">
            <a href="mailto:'info@ganicroots.co.za'"><i class="fa fa-envelope-open"></i></a>
            <div>info@ganicroots.co.za</div>
          </div>
        </div>

      </div>
    </header>
    {{--<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" >
      <a class="navbar-brand" href="/">
        <img src="/img/logo2.png" width="35" height="35" class="d-inline-block align-top" alt="Ganic Roots">
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto menu-list">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="/products/category/all" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Shop
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a href="/products/category/all" class="dropdown-item">All Products</a>
              @foreach($categories as $category)
                <a href="/products/category/{{ $category->id }}" class="dropdown-item">{{ $category->value }}</a>
              @endforeach
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>
        </ul>


        <ul class="navbar-nav navbar-right menu-list">
          <li class="nav-item">
            <a href="#" class="nav-link"><img src="/img/carticon-round.svg" class="img-responsive" style="max-width: 30px;" /></a>
          </li>
          <li class="nav-item">
            <span class="navbar-text">
              <i class="fa fa-mobile-phone fa-2x"></i> <span>+27 797 331 041</span>
            </span>
          </li>
        </ul>
      </div>
    </nav>--}}

    <div class="super_container_inner">
      <div class="super_overlay"></div>
      @yield('content')

      @include('layouts.footer')
    </div>
  </div>

  <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
  <script src="{{asset('js/popper.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>

  <script src="{{asset('js/TweenMax.min.js')}}"></script>
  <script src="{{asset('js/TimelineMax.min.js')}}"></script>
  <script src="{{asset('js/ScrollMagic.min.js')}}"></script>
  <script src="{{asset('js/animation.gsap.min.js')}}"></script>
  <script src="{{asset('js/ScrollToPlugin.min.js')}}"></script>
  <script src="{{asset('js/owl.carousel.js')}}"></script>
  <script src="{{asset('js/easing.js')}}"></script>
  <script src="{{asset('js/progressbar.min.js')}}"></script>
  <script src="{{asset('js/parallax.min.js')}}"></script>
  <script src="{{asset('js/custom.js')}}"></script>
  <script src="{{ asset('/editor/js/froala_editor.min.js') }}"></script>
  <script src="{{ asset('/editor/js/plugins/font_size.min.js') }}"></script>
  <script src="{{ asset('/editor/js/plugins/font_family.min.js') }}"></script>
  <script src="{{ asset('/editor/js/plugins/paragraph_format.min.js') }}"></script>
  <script src="{{ asset('/editor/js/plugins/code_view.min.js') }}"></script>
  <script src="{{ asset('/editor/js/plugins/align.min.js') }}"></script>
  <script src="{{ asset('/editor/js/plugins/colors.min.js') }}"></script>

  {{--<script src="//cdn.ckeditor.com/4.11.4/full/ckeditor.js"></script>--}}
  <script src="{{ asset('/editor/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('/editor/ckeditor/js/sample.js') }}"></script>
  @yield('javaScript')
  @yield('js')

  @guest
  @else
    <script type="text/javascript">
      $(document).ready(function(){

        $.ajax({
          url:'/get_user_cart_count',
          type:'post',
          data:{
            _token: $('meta[name="csrf-token"]').attr('content')
          },
          success:function(data){
            var cartResults = JSON.parse(data);
//            console.log(cartResults);
//            console.log(cartResults.total);

            if(cartResults.length!=0)
            {
              $('#cart_count').slideDown(500);
              $('#cart_count').html(cartResults.total);
            }
            else
            {
              $('#cart_count').hide();
            }
          }
        });

      });

      $('.blog_text').froalaEditor({
        theme: 'dark',
        charCounterCount: false,
        fontFamilySelection: true,
        fontSizeSelection: true,
        paragraphFormatSelection: true,
        codeMirror: true,
        toolbarButtons: ['fontFamily', '|', 'fontSize', '|', 'paragraphFormat', '|', 'text-align', 'align', 'bold', 'italic', 'underline','|', 'undo', 'redo', 'codeView'],
      });


      $('.blog_text_update').froalaEditor();

      CKEDITOR.replace('body_message');

    </script>
  @endguest

</body>
</html>