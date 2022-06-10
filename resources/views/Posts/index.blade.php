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
        @foreach($Blogs as $blog)
          <div class="col col-sm-4 col-xs-6">
            <div class="card" style="margin-bottom: 25px;">
              <div class="card-img-top">
                <img class="img-responsive" src="{{ asset('storage/blog/'.$blog->img_url) }}" alt="{{ $blog->title }}" />
              </div>
              <div class="card-body">
                <h5 class="card-title">{{ $blog->title }}</h5>
                {{--<p class="card-text">{{ substr($blog->body_message,20,30) }} ...</p>--}}
                <a href="/blog/{{ $heading }}/{{ $blog->id }}/{{ urlencode($blog->title) }}" class="btn btn-primary">Read Article</a>
                <h5 class="text-right"><small>{{ date('d F Y',strtotime($blog->created_at)) }}</small></h5>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div style="margin: auto; display: flex; justify-content: center;">
        {{ $paginate }}
      </div>

    </div>
  </div>
@endsection