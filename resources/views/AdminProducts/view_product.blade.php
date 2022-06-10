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
            <li class="breadcrumb-item"><a href="/admin/product/list_products">List Products</a></li>
            <li class="breadcrumb-item active">{{ $Products[0]->value }}</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col col-md-12">
          <div class="jumbotron">
            <form action="/admin/product/update_product" method="post" class="" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="product_id" value="{{ $Products[0]->id }}"/>
              <table class="table">
                <tbody>
                  <tr>
                    <td></td>
                    <td align="right">
                      <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">
                        delete this product
                      </button>
                      <?php $html = "<a href='/admin/product/delete/".$Products[0]->id."' class='btn btn-danger'>Yes</a> | <button type='button' class='btn btn-primary btn-sm' data-dismiss='modal'>No</button>"; ?>
                      @include('modal',
                      [
                        'type'=>'error',
                        'message'=>'Are you sure you want to delete this product?',
                        'textbody'=>$html
                      ])
                    </td>
                  </tr>
                  <tr><td><small>Last updated:</small></td><td><small>{{ date('d F Y',strtotime($Products[0]->created_at)) }}</small></td></tr>
                  <tr><td><small>created:</small></td><td><small>{{ date('d F Y',strtotime($Products[0]->created_at)) }}</small></td></tr>
                  <tr><td><strong>Name:</strong></td><td><input class="form-control" name="value" value="{{ $Products[0]->value }}" /></td></tr>
                  <tr>
                    <td><strong>Category:</strong></td>
                    <td>
                      <select class="form-control" name="category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                          @if($cat->id == $Products[0]->categoryid)
                            <option selected value="{{ $cat->id }}">{{ $cat->value }}</option>
                          @else
                            <option value="{{ $cat->id }}">{{ $cat->value }}</option>
                          @endif
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
                        @if(isset($product_options))
                          <?php $cnt=1; ?>
                          @foreach($product_options as $options)
                            <div class="form-group">
                              <input type="text" name="options[{{ $options->id }}]" class="form-control col-md-5" placeholder="option 1" value="{{ $options->value }}"/>
                            </div>
                          @endforeach
                        @endif
                      </div>
                      <div class="form-group">
                        <i class="btn btn-primary btn-sm" id="add_more" title="add more options"><span class="fa fa-plus text-white"></span></i>
                      </div>
                    </td>
                  </tr>
                  <tr><td><strong>Description:</strong></td><td><textarea class="form-control" name="desc">{{ $Products[0]->desc }}</textarea></td></tr>
                  <tr><td><strong>Price:</strong></td><td>R<input type="text" name="price" class="form-control" value="{{ $Products[0]->price }}" /></td></tr>
                  <tr><td><strong>Load Image:</strong></td><td><input type="file" class="form-control" name="product_image" /></td></tr>
                  <tr><td><strong>Image:</strong></td><td><img src="{{ asset('storage/products/'.$Products[0]->img_dir) }}" class="img-responsive" /></td></tr>
                  @if( $Products[0]->enabled==0)
                      <tr><td><strong>Active:</strong></td><td><input type="checkbox" name="enabled" /></td></tr>
                  @else
                      <tr><td><strong>Active:</strong></td><td><input type="checkbox" name="enabled" checked /></td></tr>
                  @endif
                  @if( $Products[0]->instock==0)
                    <tr><td><strong>Instock:</strong></td><td><input type="checkbox" name="in_stock" /></td></tr>
                  @else
                    <tr><td><strong>Instock:</strong></td><td><input type="checkbox" name="in_stock" checked /></td></tr>
                  @endif
                  <tr><td></td><td><button class="btn btn-primary" type="submit">Update</button></td></tr>
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
            <input type="text" name="new_options['+(cnt+1)+']" class="form-control col-md-5" placeholder="option '+(cnt+1)+'" />\
            </div>\
        ');
        console.log(cnt);
      });
    });
  </script>
@endsection