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
                        <li class="breadcrumb-item"><a href="/admin/orders/dashboard">Main Menu</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col col-md-12">
                    <table class="table table-bordered">
                        <thead><th>#</th><th>Client Name</th><th>Items</th><th>Date Placed</th><th>Action</th></thead>
                        <tbody>
                        <?php $cnt=1; ?>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $cnt }}</td>
                                <td>{{ $order->name." ".$order->surname }}</td>
                                <td>{{ $order->items_count }}</td>
                                <td>{{ date('d F Y H:i',strtotime($order->date_ordered)) }}</td>
                                <td><a href="/admin/orders/view_order/{{ $order->pf_payment_id }}" class="btn btn-primary">View</a></td>
                            </tr>
                            <?php $cnt++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection