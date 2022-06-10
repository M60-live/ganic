@extends('layouts.main')

@section('content')
  <div class="products">
    <div class="container">
      @if (session('message'))
        <div class="row" style="margin-top: 50px;">
          <div class="col col-md-12">
            <div class="alert alert-success" role="alert">
              {{ session('message') }}
            </div>
          </div>
        </div>
      @endif
      <div class="row" style="margin-top: 50px;">
        <div class="col col-md-12">
          <h2 class="text-center text-black-50">Contact Us</h2>
        </div>
        <div class="col col-md-12">
          <h4 class="text-center text-black-50">For any queries or special orders, please don't hesitate and send us a message.</h4>
        </div>
      </div>
      <div class="row" style="margin-top: 30px;">
        <div class="col col-xs-12 col-md-2"></div>
        <div class="col col-md-6 text-right">
          <form method="post" action="/send_message" enctype="multipart/form-data" class="">
            @csrf
            {{--<div class="form-group">--}}
              <div class="row">
                <div class="col-md-4 text-right"><label class="col-form-label-lg">Full Names:</label></div>
                <div class="col-md-8"><input type="text" name="name" value="{{ $userDetails['name'] }}" class="form-control" required/></div>
              </div>
            {{--</div>--}}
            {{--<div class="form-group">--}}
              <div class="row">
                <div class="col-md-4 text-right"><label class="col-form-label-lg">Email:</label></div>
                @if(auth()->check())
                  <div class="col-md-8"><input type="email" name="email" value="{{ $userDetails['email'] }}" class="form-control" required readonly /></div>
                @else
                  <div class="col-md-8"><input type="email" name="email" value="{{ $userDetails['email'] }}" class="form-control" required /></div>
                @endif
              </div>
            {{--</div>--}}
            {{--<div class="form-group">--}}
              <div class="row">
                <div class="col-md-4 text-right"><label class="col-form-label-lg">Mobile Number:</label></div>
                <div class="col-md-8"><input type="text" name="phone_number" value="{{ $userDetails['phone_number'] }}" class="form-control" /></div>
              </div>
            {{--</div>--}}
            <div class="form-group">
              <div class="row">
                <div class="col-md-4 text-right"><label class="col-form-label-lg">Message:</label></div>
                <div class="col-md-8"><textarea class="form-control" rows="10" name="message"></textarea></div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8"><button class="btn btn-lg btn-primary">Send <span class="fa fa-send" style="color: #fff;"></span></button></div>
              </div>
            </div>
          </form>
        </div>
        <div class="col col-md-4">
          <img src="{{ asset('/img/banana.jpg') }}" class="img-responsive" />
          {{--<img src="{{ asset('/img/flyer.png') }}" class="img-responsive"/><br>--}}
        </div>
      </div>
    </div>
  </div>
@endsection