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
            <li class="breadcrumb-item active">Create Blog Post</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col col-md-12 text-center">
          <form action="/admin/blog/create" method="post" enctype="multipart/form-data">
            @csrf
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td>Health / Beauty</td>
                  <td>
                      <select class="form-control" name="blog_type" required>
                          <option value="">Select Blog Type...</option>
                          <option value="beauty">Beauty Nugget</option>
                          <option value="lifestyle">Lifestyle Nugget</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td>Title</td>
                  <td><input class="form-control" type="text" name="title" placeholder="heading" required /></td>
                </tr>

                <tr>
                  <td>Subtitle</td>
                  <td><input class="form-control" type="text" placeholder="smaller heading" name="subtitle" required/></td>
                </tr>

                <tr>
                  <td>Post body message</td>
                  {{--<td><textarea class="form-control" rows="7" name="body_message" placeholder="write something here..." required></textarea></td>--}}
                  {{--<td><textarea class="blog_text" name="body_message" required></textarea></td>--}}
                  <td>

                    <textarea class="content" name="body_message"></textarea>
                  </td>
                </tr>

                <tr>
                  <td>Post Image</td>
                  <td><input class="form-control" type="file" name="img_url" required /></td>
                </tr>

                <tr>
                  <td>In Stock?</td>
                  <td><input type="checkbox" name="enabled" checked /></td>
                </tr>

                <tr>
                  <td></td>
                  <td><button type="submit" class="btn btn-success">Create</button></td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
    </div>
@endsection

@section('stylesheet')
{{--  <link href="{{ asset('/editor/css/froala_editor.min.css') }}" rel="stylesheet" />--}}
{{--  <link href="{{ asset('/editor/css/froala_style.min.css') }}" rel="stylesheet" />--}}
  {{--<link href="{{ asset('/editor/css/themes/dark.min.css') }}" rel="stylesheet" />--}}
  <link href="{{ asset('/plugin/css/samples.css') }}" rel="stylesheet" />
@endsection

@section('javaScript')
  {{--<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>--}}
  <script src="{{ asset('/plugin/js/ckeditor.js') }}"></script>
{{--  <script src="{{ asset('/plugin/js/sample.js') }}"></script>--}}
  <script type="text/javascript">
    $(document).ready(function(){
      CKEDITOR.replace('body_message');
    });
  </script>
@endsection