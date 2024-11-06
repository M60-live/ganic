<?php

namespace App\Http\Controllers;

use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
  private function get_products($type = 'product', $id='',$limit=4)
  {
    if(strtolower($type)=='product')
    {
      if($id=='')
      {
        $products = DB::table('products')
          ->join('category','products.categoryid','=','category.id')
          ->orderBy('products.created_at','desc')
          ->limit($limit)
          ->select('products.*','category.id as cat_id','category.value as category_name')
          ->paginate($limit);
      }
      else
      {
        $products = DB::table('products')
          ->join('category','products.categoryid','=','category.id')
          ->where('products.id','=',$id)
          ->select('products.*','category.id as cat_id','category.value as category_name')
          ->paginate($limit);

      }
    }
    else
    {
      if($id=='' || $id=='all')
      {
        $products = DB::table('products')
          ->join('category','products.categoryid','=','category.id')
          ->orderBy('products.created_at','desc')
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
    $Results=$products;
    return $Results;
  }

  function get_products_options($product_id)
  {
    $options = DB::table('product_options')
        ->where('product_id','=',$product_id)
        ->select('*')
        ->get()->toArray();
    return $options;
  }

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin');
  }

  public function index()
  {
    $categories = DB::table('category')->get();
    return view('AdminProducts.dashboard',['categories'=>$categories,'category_active'=>'all']);
  }

  public function list_products()
  {
    $Products = $this->get_products('product','',8);
    $Links = $Products;
    $categories = DB::table('category')->get();
    return view('AdminProducts.list_products',['categories'=>$categories,'category_active'=>'all','Products'=>$Products,'Links'=>$Links]);
  }

  public function view_product($product_id)
  {
    $Products = $this->get_products('product',$product_id);
    $categories = DB::table('category')->get();
    $product_options = $this::get_products_options($product_id);
    return view('AdminProducts.view_product',['categories'=>$categories,'category_active'=>'all','Products'=>$Products,'product_options'=>$product_options]);
  }

  public function update_product(Request $request)
  {
    $product_name = $request->get('value');
    $desc = $request->get('desc');
    $product_id = $request->get('product_id');
    $category_id = $request->get('category_id');
    $price = $request->get('price');
    $in_stock = $request->get('in_stock');
    $enabled = $request->get('enabled');
    $options = $request->get('options');
    $new_options = $request->get('new_options');

    if($in_stock!='')
    {
      $in_stock=1;
    }
    else
    {
      $in_stock=0;
    }
    if($enabled!='')
    {
        $enabled=1;
    }
    else
    {
        $enabled=0;
    }
    $product_image = $request->get('product_image');
    $Location='/app/public/products/';

    if($request->hasFile('product_image'))
    {
      $FileType = $request->file('product_image')->getClientOriginalExtension();
      $newFileName = $product_id.".".$FileType;
      $FileResponse=$request->file('product_image')->move(storage_path($Location),$newFileName);

      $response = DB::table('products')
      ->where('id',$product_id)
      ->update(['value'=>$product_name,'categoryid'=>$category_id,'desc'=>$desc,'price'=>$price,'enabled'=>$enabled,'instock'=>$in_stock,'img_dir'=>$newFileName,'updated_at'=>now()]);
    }
    else
    {
      $response = DB::table('products')
      ->where('id',$product_id)
      ->update(['value'=>$product_name,'categoryid'=>$category_id,'desc'=>$desc,'price'=>$price,'enabled'=>$enabled,'instock'=>$in_stock,'updated_at'=>now()]);
    }

    //#### update options if they exist ####
    if(isset($options))
    {
      foreach($options as $option_id => $option)
      {
        $response = DB::table('product_options')
            ->where('product_id',$product_id)
            ->where('id',$option_id)
            ->update(['value'=>$option,'updated_at'=>now()]);
      }
    }

    // **** add more options if new ones are added ****
    // **** check first if the item is in the cart, cant add new items if a customer has already added the product in their basket
    if(!empty($new_options))
    {
      foreach($new_options as $new_option)
      {
        if($new_option<>null)
        {
          $product_id = DB::table('product_options')
              ->insertGetId(['product_id'=>$product_id,'value'=>$new_option,'created_at'=>now()]);
        }
      }
    }

    session()->flash('message', 'Product Updated');
    return redirect()->action('AdminController@list_products');
  }

  public function create()
  {
    $Products = $this->get_products('product');
    $categories = DB::table('category')->get();
    return view('AdminProducts.create_product',['categories'=>$categories,'category_active'=>'all','Products'=>$Products]);
  }

  public function create_product(Request $request)
  {
    $product_name = $request->get('value');
    $desc = $request->get('desc');
    $category_id = $request->get('category_id');
    $price = $request->get('price');
    $in_stock = $request->get('in_stock');
    $options = $request->get('options');
    if($in_stock!='')
    {
      $in_stock=1;
    }
    else
    {
      $in_stock=0;
    }

    $Location='/app/public/products/';
    if($request->hasFile('product_image'))
    {
      $product_id = DB::table('products')
      ->insertGetId(['value'=>$product_name,'categoryid'=>$category_id,'desc'=>$desc,'price'=>$price,'instock'=>$in_stock,'img_dir'=>' ','created_at'=>now()]);

      $FileType = $request->file('product_image')->getClientOriginalExtension();
      $newFileName = $product_id.".".$FileType;
      $FileResponse=$request->file('product_image')->move(storage_path($Location),$newFileName);
      if($FileResponse)
      {
        $responseIMG = DB::table('products')
          ->where('id',$product_id)
          ->update(['img_dir'=>$newFileName]);
      }


      foreach($options as $option){
          if(!empty($option))
          {
              $option_id = DB::table('product_options')
              ->insertGetId([
                  'product_id' => $product_id,
                  'value' => $option,
                  'created_at' => now()
              ]);
          }
      }
      session()->flash('message', 'Product Loaded with image');
    }

    return redirect()->action('AdminController@list_products');
  }

  public function delete_product($product_id)
  {
    $can_delete=false;

    $categories = DB::table('category')->get();
    $Product = $this->get_products('product',$product_id);

    $results = DB::table('products')
      ->join('cart','cart.product_id','=','products.id')
      ->select('cart.id','products.id')
      ->where('products.id',"=", $product_id)
      ->whereNotNull('cart.dt_checkout')
      ->get()
      ->toArray();
    if (empty($results))
    {
      // Delete product from cart for people who have added to cart but not bought yet.
      DB::table('cart')
          ->where('cart.product_id','=',$product_id)->delete();

      // Then finally delete the actual product
      DB::table('products')
          ->where('products.id','=',$product_id)->delete();

      session()->flash('message', $Product[0]->value.' Deleted');
      return redirect()->action('AdminController@list_products');
    }

    return view('AdminProducts.delete',['categories'=>$categories,'category_active'=>'all','can_delete'=>$can_delete,'Product'=>$Product]);
  }

}
