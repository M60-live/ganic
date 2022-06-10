@extends('layouts.main')

@section('content')
  <div class="products">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section_title text-center">{{ $heading }}</div>
        </div>
      </div>

      <div class="row" style="margin-top: 50px;">
        <div class="flex-row col-md-5">
          <img class="img-responsive" src="{{ asset('storage/blog/'.$Blogs[0]->img_url) }}" alt="{{ $Blogs[0]->title }}" />
        </div>
        <div class="flex-row col-md-7">
          <h5 class="text-right"><small><i>published on: {{ date('d F Y',strtotime($Blogs[0]->created_at)) }}</i></small></h5>
          <h2 class="text-muted">{{ $Blogs[0]->title }}</h2>
          <h3 class="">{{ $Blogs[0]->subtitle }}</h3>
        </div>
        <div class="flex-row col-md-12">
          {!! $Blogs[0]->body_message !!}
        </div>
        <div class="flex-row col-md-12">
          <h4 class="mt-5"><small><i>published on: {{ date('d F Y',strtotime($Blogs[0]->created_at)) }}</i></small></h4>
        </div>
      </div>

    </div>
  </div>
@endsection