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
                        <li class="breadcrumb-item"><a href="/admin/users/dashboard"><i class="fa fa-angle-double-left"></i> Registered Users</a></li>
                        <li class="breadcrumb-item">User Details</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-12">

                </div>
                <div class="col col-md-8">
                    <div class="card">
                        <div class="card-header">User Details</div>
                        <div class="card-body">
                            <table class="table table-success" style="color: #777; background-color: #eee;">
                                <tbody>
                                <tr><td><b>Name:</b></td><td>{{ $Users[0]->name }}</td></tr>
                                <tr><td><b>Surname:</b></td><td>{{ $Users[0]->surname }}</td></tr>
                                <tr><td><b>Contact no:</b></td><td>{{ $Users[0]->phone_number }}</td></tr>
                                <tr><td><b>Email:</b></td><td>{{ $Users[0]->email }}</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" style="color: #222;">
                            <b>Registered date: {{ $Users[0]->created_at }} | Registered date: {{ $Users[0]->updated_at }}</b>
                        </div>
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">Shipping Address</div>
                        <div class="card-body">
                            <p>
                                @if($Users[0]->street_address == null)
                                    <div class="alert alert-warning">User profile incomplete</div>
                                @else
                                    {{ $Users[0]->street_address }}<br>
                                    {{ $Users[0]->suburb }}<br>
                                    {{ $Users[0]->city }}<br>
                                    {{ $Users[0]->province }}<br>
                                    {{ $Users[0]->zip_code }}<br>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <br><br><br>
        </div>
    </div>
@endsection

@section('js')
    @parent
    <script>
        $(document).ready(function(){
            $('input[class=status]').on('change',function(){
                console.log($(this).data('paymentid'));
                let status_id = $(this).val();
                let payment_id = $(this).data('paymentid');

                $.ajax({
                    url: '/admin/orders/change_order_status',
                    type: 'post',
                    data: {status_id:status_id,payment_id:payment_id,_token: $('meta[name="csrf-token"]').attr('content')},
                    success: function(response){
                        if(response){
                            $('.alert').addClass('show');
                            let timer = setInterval(function(){
                                $('.alert').removeClass('show');
                                clearInterval(timer);
                            },2000);

                        }
                        else{
                            console.log('An error has occurred.');
                        }
                    }
                });
            });
        });
    </script>
@endsection