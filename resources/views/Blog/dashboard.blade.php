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
            <li class="breadcrumb-item"><a href="/admin/blog/dashboard">Main Menu</a></li>
          </ul>
        </div>
      </div>
      @if (session('message'))
        <div class="row">
          <div class="col col-md-12">
            <div class="alert alert-success" role="alert">
              {{ session('message') }}
            </div>
          </div>
        </div>
      @endif
      <div class="row">
        <div class="col col-md-12 text-center">
          <table class="table table-bordered">
            <thead><th></th><th></th><th>Title</th><th>Body Content</th><th>Active</th><th><a href="/admin/blog/create"><div class="fa fa-2x fa-plus-circle"></div></a></th></thead>
            <tbody>
            @if(!empty($Blogs))
              <?php $cnt=$Blogs->total(); ?>
              @foreach($Blogs as $blog)
                <tr>
                  <td>{{ $cnt  - ($Blogs->perPage() * ($Blogs->currentPage()-1)) }}</td>
                  <td class="col-sm-1 col-xs-2"><img src="{{ asset('storage/blog/'.$blog->img_url) }}" class="img-responsive img-thumbnail" /></td>
                  <td>{{ $blog->title }}</td>
                  <td>{{ substr($blog->body_message,0,70) }} ...</td>
                  <td>{{ $blog->enabled }}</td>
                  <td><a class="btn btn-primary" href="/admin/blog/{{ $blog->id }}">View</a></td>
                </tr>
                <?php $cnt--; ?>
              @endforeach
            @else
              <tr><td colspan="6">
                <div class="alert alert-secondary"><h3 class="text-muted">There's no blog entries found.</h3><br> <i>Follow this <b><a href="/admin/blog/create">link</a></b> to get started</i></div>
              </td></tr>
            @endif
            </tbody>
          </table>
          <div style="margin: auto; display: flex; justify-content: center;">
            {{ $paginate }}
          </div>
        </div>
      </div>
    </div>
@endsection