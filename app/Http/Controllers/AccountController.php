<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class AccountController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    public function index()
    {
        $categories = DB::table('category')->get();
        return view('account',['categories'=>$categories,'category_active'=>'all']);
    }

    public function profile(Request $request)
    {
        $action=$request->get('action');
        if($action=='profile')
        {
            $users=DB::table('users')->where('id','=',auth()->user()->id)->get()->toArray();
            $shipping=DB::table('shipping')->where('user_id','=',auth()->user()->id)->get()->toArray();
            if(empty($shipping))
            {
                return View::make('Account.profile')->with(['users'=>$users])->render();
            }
            else
            {
                return View::make('Account.profile')->with(['users'=>$users,'shipping'=>$shipping])->render();
            }
        }
        else
        {
            return View::make('Account.orders')->render();
        }
    }

    public function update_profile(Request $request)
    {
        $name=$request['name'];
        $surname=$request['surname'];
        $phone_number=$request['phone_number'];

        $street_address=$request['street_address'];
        $suburb=$request['suburb'];
        $city=$request['city'];
        $province=$request['province'];
        $zip_code=$request['zip_code'];

        $response = DB::table('users')
        ->where('id',auth()->user()->id)
        ->update(['name'=>$name,'surname'=>$surname,'phone_number'=>$phone_number,'updated_at'=>now()]);
        if($street_address!='' && $suburb!='' && $city!='' && $province!='' && $zip_code!='')
        {
            $shippingAddressResponse=DB::table('shipping')->where('user_id','=',auth()->user()->id)->get()->toArray();
            if(empty($shippingAddressResponse))
            {
                $response = DB::table('shipping')
                ->insert(['user_id'=>auth()->user()->id,'street_address'=>$street_address,'suburb'=>$suburb,'city'=>$city,'province'=>$province,'zip_code'=>$zip_code,'created_at'=>now()]);
            }
            else
            {
                $response = DB::table('shipping')
                ->where('user_id','=',auth()->user()->id)
                ->update(['street_address'=>$street_address,'suburb'=>$suburb,'city'=>$city,'province'=>$province,'zip_code'=>$zip_code,'updated_at'=>now()]);
            }
        }
        session()->flash('message', 'Your profile has been update');
        return redirect()->action('AccountController@index');
    }

    public function orders()
    {
      $orders = DB::table('cart')
      ->join('products','products.id','=','cart.product_id')
      ->join('status','status.id','=','cart.status_id')
      ->leftJoin('product_options','product_options.id','=','cart.product_options_id')
      ->where('cart.user_id','=',auth()->user()->id)
      ->whereNotNull('cart.dt_successful')
      //->whereNull('cart.pf_payment_id')
      ->select('products.value','products.price','cart.dt_successful','products.img_dir','cart.pf_payment_id','status.value as status_name','product_options.value as product_options')
      ->orderBy('cart.dt_checkout','desc')
      ->get()->toArray();

      return View::make('Account.orders')->with(['orders'=>$orders])->render();
    }
}