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
            <li class="breadcrumb-item active">Create Product</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col col-md-12">
          <div class="jumbotron">
            <form action="/admin/product/create" method="post" enctype="multipart/form-data">
              @csrf
              <table class="table">
                <tbody>
                <tr><td><strong>Name:</strong></td><td><input class="form-control" name="value" value="" required/></td></tr>
                <tr>
                  <td><strong>Category:</strong></td>
                  <td>
                    <select class="form-control" name="category_id" required>
                      <option value="">Select Category</option>
                      @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->value }}</option>
                      @endforeach
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <strong>Options</strong>:(optional)
                  </td>
                  <td>
                    <div id="option-container">
                      <div class="form-group">
                        <input type="text" name="options[1]" class="form-control col-md-5" placeholder="option 1" />
                      </div>
                      <div class="form-group">
                        <input type="text" name="options[2]" class="form-control col-md-5" placeholder="option 2" />
                      </div>
                    </div>
                    <div class="form-group">
                      <i class="btn btn-primary btn-sm" id="add_more" title="add more options"><span class="fa fa-plus text-white"></span></i>
                    </div>
                  </td>
                </tr>
                <tr><td><strong>Description:</strong></td><td><textarea class="form-control" name="desc" required></textarea></td></tr>
                <tr><td><strong>Price:</strong></td><td>R<input type="text" name="price" class="form-control" value="" required/></td></tr>
                <tr><td><strong>Load Image:</strong></td><td><input type="file" class="form-control" name="product_image" required /></td></tr>
                <tr><td><strong>Instock:</strong></td><td><input type="checkbox" name="in_stock" checked /></td></tr>
                <tr><td></td><td><button class="btn btn-primary" type="submit">Create</button></td></tr>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
  @parent
  <script type="text/javascript">
    $(document).ready(function(){
      $('#add_more').click(function(){

        let cnt=0;
        $('input[name*="options"]').each(function(e,i){
          cnt++;
        });

        $('#option-container').append('\
        <div class="form-group">\
            <input type="text" name="options['+(cnt+1)+']" class="form-control col-md-5" placeholder="option '+(cnt+1)+'" />\
            </div>\
        ');
        console.log(cnt);
      });
    });
  </script>
@endsection