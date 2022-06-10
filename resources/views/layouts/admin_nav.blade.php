<ul class="nav nav-tabs nav-fill">
  <li class="nav-item"><a class="nav-link" href="/admin/catgory/list">Category</a></li>
  <li class="nav-item"><a class="nav-link" href="/admin/product/list_products/">Products</a></li>
  {{--<li class="nav-item"><a class="nav-link" href="/admin/product/dashboard">Products</a></li>--}}
  <li class="nav-item"><a class="nav-link" href="/admin/orders/dashboard">Orders</a></li>
  <li class="nav-item"><a class="nav-link" href="/admin/users/dashboard">Registered Users</a></li>
  {{--<li class="nav-item"><a class="nav-link" href="/admin/orders/dashboard">Orders</a></li>--}}
  <li class="nav-item"><a class="nav-link" href="/admin/blog/dashboard">Blog</a></li>
</ul>

@section('javaScript')
  <script type="text/javascript">
    $(document).ready(function(){

      var urlPath = $(location).attr('href');
      var urlPathAbs = window.location.pathname.substr(0,window.location.pathname.lastIndexOf('/'));
      //console.log(urlPathAbs);

      $('.nav-link').each(function(i,ele){
        if($(this).attr('href').substr(0,window.location.pathname.lastIndexOf('/')) == urlPathAbs)
        {
          //console.log($(this).attr('href').substr(0,window.location.pathname.lastIndexOf('/')));
          $(this).addClass('active');
        }
        else
        {
          $(this).removeClass('active');
        }
      });
    });
  </script>
@endsection