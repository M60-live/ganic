<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegUsersController extends Controller
{
  function get_products($type='product',$id='',$limit=6)
  {
    if(strtolower($type)=='product')
    {
      if($id=='')
      {
        $products = DB::table('products')
        ->join('category','products.categoryid','=','category.id')
        ->orderBy('products.value','asc')
        ->limit($limit)
        ->select('products.*','category.id as cat_id','category.value as category_name')
        ->get()->toArray();
      }
      else
      {
        $products = DB::table('products')
        ->join('category','products.categoryid','=','category.id')
        ->where('products.id','=',$id)
        ->select('products.*','category.id as cat_id','category.value as category_name')
        ->get()->toArray();

      }
    }
    else
    {
      if($id=='' || $id=='all')
      {
        $products = DB::table('products')
        ->join('category','products.categoryid','=','category.id')
        ->orderBy('products.value','asc')
        ->select('products.*','category.id as cat_id','category.value as category_name')
        ->get()->toArray();
      }
      else
      {
        $products = DB::table('products')
        ->join('category','products.categoryid','=','category.id')
        ->where('category.id','=',$id)
        ->select('products.*','category.id as cat_id','category.value as category_name')
        ->get();
      }
    }
    return $products;
  }

  function get_users($id='',$limit=10)
  {
    if($id=="") {
      $Users = DB::table('users')
          ->orderBy('id', 'desc')
          ->limit($limit)
          ->select('*')
          ->paginate($limit);
    }
    else
    {
      $Users = DB::table('users')
          ->leftJoin('shipping','shipping.user_id','=','users.id')
          ->where('users.id',$id)
          ->select('users.id','users.name','users.surname','users.email','users.phone_number','users.created_at','users.updated_at',
              'shipping.street_address','shipping.suburb','shipping.city','shipping.province','shipping.zip_code')
          ->get()->toArray();
    }
    return $Users;
  }

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin');
  }

  public function index()
  {
    $Users = $this::get_users();
    $paginate = $Users;
    $categories = DB::table('category')->get();
    return view('AdminUsers.dashboard',['categories'=>$categories,'category_active'=>'all','Users'=>$Users,'paginate'=>$paginate]);
  }

  public function view_users(Request $request)
  {
    $user_id = $request['user_id'];
    $Users = $this::get_users($user_id);
//    print_r($Users);die();
    $categories = DB::table('category')->get();
    return view('AdminUsers.view_users',['categories'=>$categories,'category_active'=>'all','Users'=>$Users]);
  }
}
