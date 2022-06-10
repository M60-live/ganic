@extends('layouts.main')

@section('content')
  <div class="products">
    <div class="container" style="min-height: 350px; padding-top: 25px; padding-bottom: 25px;">
      @if (session('message'))
        <div class="row" style="margin-top: 50px;">
          <div class="col col-md-12">
            <div class="alert alert-success" role="alert">
              {{ session('message') }}
            </div>
          </div>
        </div>
      @endif
      <div class="row">
        <div class="col col-md-3">
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-profile" role="tab" aria-controls="profile" aria-selected="true">Your Profile</a>
            <a class="nav-link" id="orders" data-toggle="pill" href="#v-orders" role="tab" aria-controls="orders" aria-selected="false">Your Orders</a>
          </div>
        </div>
        <div class="col col-md-9">
          <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-profile" role="tabpanel" aria-labelledby="profile">loading..</div>
            <div class="tab-pane fade" id="v-orders" role="tabpanel" aria-labelledby="orders">loading..</div>
            <div class="tab-pane fade" id="v-settings" role="tabpanel" aria-labelledby="settings">loading..</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javaScript')
<script type="text/javascript">
    $(document).ready(function (){

        $.ajax({
            url:'/account/profile',
            type:'GET',
            data:{action:'profile'},
            beforeSend: function() {
                $('#v-profile').html('loading...');
            },
            success:function(data){
//                console.log(data);
                $('#v-profile').html(data);
            }
        });

        $(':link[class^="nav-link"]').click(function () {
            var page = $(this).html();
            var view='';
            if(page=='Your Profile')
            {
                view='profile';
            }
            else
            {
                view='orders';
            }
            $.ajax({
                url:'/account/'+view,
                type:'GET',
                data:{action:view},
                success:function(data){
//                    console.log(data);
                    $('#v-'+view).html(data);
                }
            });
        });
    });
</script>
@endsection