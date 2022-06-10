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
            <li class="breadcrumb-item active">Blog Posts</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col col-md-12 text-center">
          <form action="/admin/blog/update" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="post_id" value="{{ $Blogs[0]->id }}" />
            <table class="table table-bordered">
              <tbody>
              <tr>
                <td>Title</td>
                <td><input value="{{ $Blogs[0]->title }}" class="form-control" type="text" name="title" placeholder="heading" required /></td>
              </tr>

              <tr>
                <td>Subtitle</td>
                <td><input value="{{ $Blogs[0]->subtitle }}" class="form-control" type="text" placeholder="smaller heading" name="subtitle" required/></td>
              </tr>

              <tr>
                <td>Post body message</td>
                {{--<td><textarea class="form-control" rows="7" name="body_message" placeholder="write something here..." required>{{ $Blogs[0]->body_message }}</textarea></td>--}}

                <td><textarea class="content" name="body_message" required>{{ $Blogs[0]->body_message }}</textarea></td>
              </tr>

              <tr>
                <td>Post Image</td>
                <td><img src="{{ asset('storage/blog/'.$Blogs[0]->img_url) }}" class="img-responsive" /></td>
              </tr>

              <tr>
                <td>Replace</td>
                <td><input class="form-control" type="file" name="img_url" /></td>
              </tr>

              <tr>
                <td>Active</td>
                <td><input  type="checkbox" name="enabled" checked /></td>
              </tr>

              <tr>
                <td></td>
                <td><button type="submit" class="btn btn-info">Update</button></td>
              </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javaScript')
    <script src="{{ asset('/editor/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/editor/ckeditor/js/sample.js') }}"></script>
@endsection


@section('stylesheet')
{{--    <link href="{{ asset('/editor/css/froala_editor.min.css') }}" rel="stylesheet" />--}}
{{--    <link href="{{ asset('/editor/css/froala_style.min.css') }}" rel="stylesheet" />--}}
{{--    <link href="{{ asset('/editor/css/themes/dark.min.css') }}" rel="stylesheet" />--}}

    <link href="{{ asset('/editor/ckeditor/css/samples.css') }}" rel="stylesheet" />

@endsection