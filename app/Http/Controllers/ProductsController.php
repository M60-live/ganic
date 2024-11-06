<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
  function get_products_options($product_id)
  {
    $options = DB::table('product_options')
        ->where('product_id','=', $product_id)
        ->select('*')
        ->get()->toArray();
    return $options;
  }

  function get_products($type = 'product', $id = '', $limit = 6)
  {
    if($type == 'product')
    {
      if($id=='') {
        $products = DB::table('products')
        ->join('category','products.categoryid','=','category.id')
        ->where('products.enabled','=','1')
        ->orderBy('products.created_at','desc')
        ->limit($limit)
        ->select('products.*','category.id as cat_id','category.value as category_name')
        ->paginate($limit);
      } else {
        $products = DB::table('products')
        ->join('category','products.categoryid','=','category.id')
        ->where('products.id','=',$id)
        ->where('products.enabled','=','1')
        ->select('products.*','category.id as cat_id','category.value as category_name')
        ->paginate($limit);
      }
    }
    elseif($type=='category')
    {
      if($id=='' || $id=='all') {
        $products = DB::table('products')
          ->join('category','products.categoryid','=','category.id')
          ->where('products.enabled','=','1')
          ->orderBy('products.created_at','desc')
          ->select('products.*','category.id as cat_id','category.value as category_name')
          ->paginate($limit);
      } else {
        $products = DB::table('products')
          ->join('category','products.categoryid','=','category.id')
          ->where('category.id','=',$id)
          ->where('products.enabled','=','1')
          ->select('products.*','category.id as cat_id','category.value as category_name')
          ->paginate($limit);
      }
    }
    else
    {
      $products = DB::table('products')
      ->join('category','products.categoryid','=','category.id')
      ->where('products.value','like','%'.$id.'%')
      ->where('products.enabled','=','1')
      ->select('products.*','category.id as cat_id','category.value as category_name')
      ->paginate($limit);
    }
    return $products;
  }

  function related_products($id,$category)
  {
    $products = DB::table('products')
      ->join('category','products.categoryid','=','category.id')
      ->where('category.id','=',$category)
      ->where('products.enabled','=','1')
      ->where('products.id','<>',$id)
      ->select('products.*','category.id as cat_id','category.value as category_name')
      ->paginate(3);
    return $products;
  }

  public function index(Request $request)
  {
    $categories = DB::table('category')->get();

    $products = $this::get_products('product','');
    $links = $products;

    return view('category_products',['categories'=>$categories,'category_active'=>'all','products'=>$products,'Links'=>$links]);
  }

  public function view_category($id='all')
  {
    $categories = DB::table('category')->get();

    $products = $this::get_products('category',$id);
    $links = $products;

    return view('category_products',['categories'=>$categories,'category_active'=>$id,'products'=>$products,'Links'=>$links]);
  }

  public function product_details($id_category,$id,$category_name='All')
  {
    $categories = DB::table('category')->get();
    $product = $this::get_products('product',$id);
    $relatedProducts = $this::related_products($product[0]->id,$product[0]->cat_id);
    $product_options = $this::get_products_options($product[0]->id);
    return view('product_details',['categories'=>$categories,'category_active'=>$id_category,'category_name'=>$category_name,'product_details'=>$product,'relatedProducts'=>$relatedProducts,'product_options'=>$product_options]);
  }

  public function add_to_cart(Request $request)
  {
    $product_id = $request->post('product_id');
    $options_id = $request->post('options');
    $category_id = $request->get('category_id');
    $user_id = auth()->user()->id;

    $response = DB::table('cart')
      ->insert(['user_id'=>$user_id,'product_id'=>$product_id,'product_options_id'=>$options_id,'created_at'=>now()]);
    if($response)
    {
      session()->flash('message', 'added to cart');
    }
    return redirect()->action('ProductsController@index');
  }

  public function get_user_cart_count(Request $request)
  {
    $products = DB::table('cart')
      ->join('products','products.id','=','cart.product_id')
      ->join('users','users.id','=','cart.user_id')
      ->where('users.id','=',auth()->user()->id)
      ->whereNull('cart.dt_successful')
      ->select('users.id',DB::raw('count(*) as total'))
      ->groupBy('users.id')
      ->get()->toArray();
    if(empty($products))
    {
      $products[0]=[];
    }
    return json_encode($products[0]);
  }

  public function get_user_cart()
  {
    $products = DB::table('cart')
    ->join('products','products.id','=','cart.product_id')
    ->join('users','users.id','=','cart.user_id')
    ->where('users.id','=',auth()->user()->id)
    ->whereNull('cart.dt_successful')
    ->select('products.value')
    ->get()->toArray();
    if(empty($products))
    {
      $products[0]=[];
    }
    return json_encode($products[0]);
  }

  public function search(Request $request)
  {
//    print_r($request->get('keyword'));
//    print_r("<br>");
    $categories = DB::table('category')->get();
    $keyword = $request->get('keyword');
    $product = $this::get_products('search',$keyword);
    $links = $product;

    return view('category_products',['categories'=>$categories,'category_active'=>'all','products'=>$product,'Links'=>$links,'keyword'=>$keyword]);
  }

}
