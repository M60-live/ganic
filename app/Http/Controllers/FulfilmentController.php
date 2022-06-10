<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SystemMails;

class FulfilmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    function get_statuses()
    {
        $status = DB::table('status')
            ->select('id','value','icon')
            ->get()->toArray();
        return $status;
    }

    function get_orders()
    {
        $orders = DB::table('users')
            ->join('cart','users.id','=','cart.user_id')
            ->whereNotNull('cart.dt_successful')
            ->groupBy('users.id','users.name','users.surname','cart.delivery_charge','cart.pf_payment_id','dt_successful')
            ->orderBy('cart.dt_successful','desc')
            ->select('users.id','users.name','users.surname','cart.delivery_charge','cart.pf_payment_id',
                DB::raw('left(cart.dt_successful,16) as date_ordered'),DB::raw('count(*) as items_count'))
            ->paginate();

        return $orders;
    }

    function get_order_details($pf_payment_id)
    {
        $orders = DB::table('users')
            ->join('cart','users.id','=','cart.user_id')
            ->join('products','products.id','=','cart.product_id')
            ->leftJoin('product_options','product_options.id','=','cart.product_options_id')
            ->where('cart.pf_payment_id',$pf_payment_id)
//            ->whereNotNull('cart.dt_successful')
            ->select('users.id','users.name','users.surname','products.value','products.price',
                'cart.delivery_charge','cart.pf_payment_id','cart.dt_successful','status_id','product_options.value as product_options')
            ->get()->toArray();
        return $orders;
    }

    function get_user_address($user_id)
    {
        $orders = DB::table('users')
            ->join('shipping','shipping.user_id','=','users.id')
            ->where('users.id',$user_id)
            ->select('users.id','shipping.street_address','shipping.suburb','shipping.city','shipping.province','shipping.zip_code')
            ->get()->toArray();
        return $orders;
    }

    public function index()
    {
        $orders = $this->get_orders();
        $categories = DB::table('category')->get();
        return view('Fulfillments.dashboard',['categories'=>$categories,'orders'=>$orders]);
    }

    public function view_order(Request $request)
    {
        $pf_payment_id = $request['pf_payment_id'];
        $order = $this->get_order_details($pf_payment_id);
        $orderStatus = DB::table('cart')
            ->join('status','status.id','=','cart.status_id')
            ->where('cart.pf_payment_id','=',$pf_payment_id)
            ->groupBy('cart.pf_payment_id','status.id','status.value')
            ->select('cart.pf_payment_id','status.id','status.value')
            ->get()->toArray();
        $statusList=$this->get_statuses();
        $categories = DB::table('category')->get();

        $shipping_address = $this->get_user_address($order[0]->id);

        return view('Fulfillments.view_order',['categories'=>$categories,'order'=>$order,'statusOrder'=>$orderStatus,'statusList'=>$statusList,'shipping_address'=>$shipping_address]);
    }

    public function change_order_status(Request $request)
    {
        $status_id = $request->get('status_id');
        $payment_id = $request->get('payment_id');

        $orderStatus = DB::table('cart')
            ->where('pf_payment_id','=',$payment_id)
            ->whereNotNull('dt_successful')
            ->update(['status_id'=>$status_id]);

        return json_encode($orderStatus);
    }

}
