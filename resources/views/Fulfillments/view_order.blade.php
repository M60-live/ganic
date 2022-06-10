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
                        <li class="breadcrumb-item"><a href="/admin/orders/dashboard"><i class="fa fa-angle-double-left"></i> Back to orders</a></li>
                        <li class="breadcrumb-item">View Order</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-8">
                    <div class="card mb-3 shadow">
                        <div class="card-header">Order Details</div>
                        <div class="card-body">
                            <table class="table table-success" style="color: #777; background-color: #eee;">
                                <tbody>
                                <tr><td><b>Order date:</b></td><td>{{ $order[0]->dt_successful }}</td></tr>
                                <tr><td><b>Customer Names:</b></td><td>{{ $order[0]->name.' '.$order[0]->surname }}</td></tr>
                                <tr><td><b>PayFast ID:</b></td><td>{{ $order[0]->pf_payment_id }}</td></tr>
                                <tr><td><b>FastWay Delivery Fee:</b></td><td>R {{ $order[0]->delivery_charge }}</td></tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered" style="color: #333;">
                                <thead>
                                    <th>Product</th>
                                    <th>Price</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $total=0;
                                    ?>
                                    @foreach($order as $item)
                                        <tr>
                                            <td>{{ $item->value }}<br>{{ $item->product_options }}</td>
                                            <td>R{{ $item->price }}</td>
                                        </tr>
                                        <?php $total+=$item->price; ?>
                                    @endforeach
                                    {{--<tr><td align="right"><b>Total Cost:</b></td><td><b>R{{ $total }}</b></td></tr>--}}
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer" style="color: #222;">
                            <b>Total Cost:</b> <b>R{{ ($total+$order[0]->delivery_charge) }}</b>
                        </div>
                    </div>
                </div>
                <div class="col col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">Shipping Address</div>
                        <div class="card-body">
                            <p>
                                {{ $shipping_address[0]->street_address }}<br>
                                {{ $shipping_address[0]->suburb }}<br>
                                {{ $shipping_address[0]->city }}<br>
                                {{ $shipping_address[0]->province }}<br>
                                {{ $shipping_address[0]->zip_code }}<br>
                            </p>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header">Order Action</div>
                        <div class="card-body">
                            <form method="post" action="">
                                <ul class="list-group">
                                    {{--<li class="list-group-item"><input type="radio" class="" name="status[recieved]" checked /> Order received <i class="fa fa-2x fa-money pull-right"></i></li>--}}
                                    {{--<li class="list-group-item"><input type="radio" class="" name="status[recieved]" /> Processing <i class="fa fa-2x fa-cogs pull-right"></i></li>--}}
                                    {{--<li class="list-group-item"><input type="radio" class="" name="status[recieved]" /> Package delivery picked up <i class="fa fa-2x fa-truck pull-right"></i></li>--}}
                                    {{--<li class="list-group-item"><input type="radio" class="" name="status[recieved]" /> Done <i class="fa fa-2x fa-check pull-right"></i></li>--}}
                                    @foreach($statusList as $status)
                                        @if($status->id ==$statusOrder[0]->id)
                                            <li class="list-group-item"><input type="radio" class="status" name="status" data-paymentid="{{ $order[0]->pf_payment_id }}" value="{{ $status->id }}" checked /> {{ $status->value }} <i class="fa fa-2x {{ $status->icon }} pull-right"></i></li>
                                        @else
                                            <li class="list-group-item"><input type="radio" class="status" name="status" data-paymentid="{{ $order[0]->pf_payment_id }}" value="{{ $status->id }}" /> {{ $status->value }} <i class="fa fa-2x {{ $status->icon }} pull-right"></i></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </form>
                        </div>
                    </div>
                    <div class="alert alert-success alert-dismissible mt-3 fade" role="alert">
                        <strong>Status Changes!</strong> This status will reflect on customers accounts as you see it.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
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