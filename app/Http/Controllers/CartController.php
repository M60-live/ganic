<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SystemMails;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
  public function __construct()
  {
    //$this->middleware('auth');
  }

  function get_products()
  {
    $products = DB::table('cart')
    ->join('users','users.id','=','cart.user_id')
    ->join('products','products.id','=','cart.product_id')
    ->where('users.id','=',auth()->user()->id)
    ->whereNull('cart.dt_successful')
    ->orderBy('products.value','asc')
    ->select('cart.id','products.value','products.price','products.img_dir')
    ->paginate();

    return $products;
  }

  public function index()
  {
      $categories = DB::table('category')->get();
      $products = $this::get_products();
      $addressComplete=0;
      Storage::disk('local')->put('payfast_data.txt',"Hello world");

      $response = DB::table('cart')
      ->where('user_id',auth()->user()->id)
      ->whereNull('cart.dt_successful')
      ->update(['dt_checkout'=>null]);

      $userData = DB::table('users')
          ->leftJoin('shipping','shipping.user_id','=','users.id')
          ->where('users.id','=',auth()->user()->id)
          ->select('users.id','shipping.street_address','shipping.suburb','shipping.city','shipping.province','shipping.zip_code')
          ->get()->toArray();
      if($userData[0]->street_address!="" && $userData[0]->suburb!="" && $userData[0]->city!=""
          && $userData[0]->province!="" && $userData[0]->zip_code!="")
          $addressComplete=1;

      $products = DB::table('cart')
          ->join('products','products.id','=','cart.product_id')
          ->leftJoin('product_options','product_options.id','=','cart.product_options_id')
          ->where('user_id',auth()->user()->id)
          ->whereNull('cart.dt_successful')
          ->select('products.id as  product_id','product_options.value as product_options','products.value','products.img_dir','products.price','products.price as prod_price','products.value as prod_name','cart.id')->get()->toArray();

      return view('cart',['categories'=>$categories,'category_active'=>'all','products'=>$products,'addressComplete'=>$addressComplete]);
  }

  public function confirmation(Request $request)
  {
    $selectProducts=array();
    $categories = DB::table('category')->get();
    $products = $this::get_products();
    $selectProducts = $request->get('products');
    if(empty($selectProducts))
    {
        session()->flash('message', 'At least one item needs to be checked before you proceed.');
        return redirect()->action('CartController@index');
    }
    else
    {
        $selectProducts = array_keys($selectProducts);
        $Total = 0;
        $Delivery = 99;
        $ProductsList = array();
        if (!empty($selectProducts)) {
            //*********************************************
            //***                                       ***
            //*** GET delivery price check from FASTWAY ***
            //***                                       ***
            //*********************************************
            $userData = DB::table('users')
                ->leftJoin('shipping', 'shipping.user_id', '=', 'users.id')
                ->where('users.id', '=', auth()->user()->id)
                ->select('users.*', 'shipping.street_address', 'shipping.suburb', 'shipping.city', 'shipping.province', 'shipping.zip_code')
                ->get()->toArray();
            $fromCode = 'PRY';
            $toSurburb = $userData[0]->suburb;
            $toPostalCode = $userData[0]->zip_code;

            //        $stream_opts = [
            //            "ssl" => [
            //                "verify_peer"=>false,
            //                "verify_peer_name"=>false,
            //            ]
            //        ];

            //        $apiData = file_get_contents($apiUrl,false, stream_context_create($stream_opts));
            //        echo 'https://api.fastway.org/v3/psc/lookup/'.$fromCode.'/'.$toSurburb.'/'.$toPostalCode.'/24?api_key=fafec9bfa79646fddfa4dcd7ec5ea29e',false, stream_context_create($stream_opts);
            //        die();
            //        $apiResponse=json_decode($apiData,true);
            //        die($apiResponse);

            //        echo "From: ".$fromCode;
            //        echo "To: ".$fromCode;
            //        echo"<pre>";

            /*$apiUrl = ('https://api.fastway.org/v3/psc/lookup/'.$fromCode.'/'.$toSurburb.'/'.$toPostalCode.'/24?api_key=fafec9bfa79646fddfa4dcd7ec5ea29e');
            $apiUrl = $url = str_replace(" ", '%20',$apiUrl);
            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'));
            $apiResponse = curl_exec($ch);

            $apiResponse = json_decode($apiResponse,true);
            $Delivery=$apiResponse['result']['services'][2]['totalprice_frequent'];*/
            //*********************************************
            //***  END of FASTWAY delivery price check  ***
            //*********************************************

            for ($x = 0; $x < count($selectProducts); $x++) {
                $response = DB::table('cart')
                    ->where('user_id', auth()->user()->id)
                    ->whereNull('dt_successful')
                    ->where('id', $selectProducts[$x])
                    ->update(['dt_checkout' => now(), 'delivery_charge' => $Delivery]);

                ///*** now make a query to calculate sum of products selected
                $SUM = DB::table('products')
                    ->join('cart', 'products.id', '=', 'cart.product_id')
                    ->where('user_id', auth()->user()->id)
                    ->where('cart.id', $selectProducts[$x])
                    ->select('products.price as prod_price', 'products.value as prod_name')->get()->toArray();
                $Total = $Total + $SUM[0]->prod_price;
                $ProductsList[$x]['name'] = $SUM[0]->prod_name;
                $ProductsList[$x]['price'] = $SUM[0]->prod_price;
            }

            $Total += $Delivery;
        }
        return view('confirmation', ['categories' => $categories, 'userData' => $userData[0], 'category_active' => 'all', 'Total' => $Total, 'Delivery' => $Delivery, 'ProductsList' => $ProductsList]);
    }
  }

  public function remove_item(Request $request)
  {
      $cart_id=$request['card_id'];
      $categories = DB::table('category')->get();
      $productData = DB::table('cart')
          ->join('products','products.id','=','cart.product_id')
          ->where('cart.user_id',auth()->user()->id)
          ->where('cart.id',$cart_id)
          ->select('cart.id','products.value','products.img_dir')->get()->toArray();

      return view('remove_item',['categories'=>$categories,'category_active'=>'all','products'=>$productData]);
  }

  public function remove_cart_item(Request $request)
  {
      $cart_id=$request->get('cart_id');
//      print_r($cart_id);die();
      $response = DB::table('cart')
          ->delete($cart_id);
      if($response)
      {
          session()->flash('message', 'Item has been removed from your cart.');
      }
      else
      {
          session()->flash('message', 'Failed to remove item.');
      }
      return redirect()->action('CartController@index');
  }

  public function notify_url(Request $request)
  {
//    header( 'HTTP/1.0 200 OK' );
//    flush();
    $payment_status=$request['payment_status'];
    $user_id=$request['m_payment_id'];
    $pf_payment_id=$request['pf_payment_id'];
    /*$pf_payment_id='2452';
    $user_id='1';
    $payment_status='complete';
    $response = DB::table('cart')
    ->where('user_id',$user_id)
    ->whereNull('dt_successful')
    ->whereNotNull('dt_checkout')
    ->update(['dt_successful'=>now(),'pf_payment_id'=>$pf_payment_id]);*/
    $jsonData = array('payment_status'=>$request['payment_status'],'m_payment_id'=>$request['m_payment_id'],'pf_payment_id'=>$request['pf_payment_id']);
    Storage::disk('local')->append('payfast_notify.txt',json_encode($jsonData));

    if($pf_payment_id!='')
    {
      if(strtolower($payment_status)=='complete')
      {
        $response = DB::table('cart')
            ->where('user_id',$user_id)
            ->whereNull('dt_successful')
            ->whereNotNull('dt_checkout')
            ->update(['dt_successful'=>now(),'pf_payment_id'=>$pf_payment_id,'status_id'=>1]);
      }
    }

    http_response_code(200);
    flush();
  }

  public function success(Request $request)
  {
      $categories = DB::table('category')->get();
      $pf_payment_id = DB::table('cart')
      ->where('cart.user_id',auth()->user()->id)
      ->orderBy('cart.dt_checkout','desc')
      ->limit(1)
      ->select('cart.pf_payment_id')->get()->toArray();

      //*** send client invoice to email
      $product_list = DB::table('products')
          ->join('cart','products.id','=','cart.product_id')
          ->where('cart.user_id',auth()->user()->id)
          ->where('pf_payment_id',$pf_payment_id[0]->pf_payment_id)
          ->orderBy('cart.dt_checkout','desc')
          ->select('products.value','products.price','cart.delivery_charge','cart.pf_payment_id')->get()->toArray();
//      echo "<pre>";print_r($product_list);die();
      $results = Mail::to(auth()->user()->email)->send(new SystemMails(auth()->user()->name,auth()->user()->email,'','','invoice',$product_list));

      return view('success_page',['categories'=>$categories,'category_active'=>'all','pf_payment_id'=>$pf_payment_id[0]->pf_payment_id,'product_list',$product_list]);
  }

  public function cancel(Request $request)
  {
      $categories = DB::table('category')->get();

      return view('cancel_page',['categories'=>$categories,'category_active'=>'all']);
  }

}
