<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
    public function product_details($product_id)
    {
        $product = DB::table('products')
            ->join('category', 'products.categoryid', '=', 'category.id')
            ->select('products.*','category.value as category_name')
            ->where('products.id','=', $product_id)
            ->first();
        return $product;
    }

    public function related_products($product_id, $category_id)
    {
        $products = DB::table('products')
            ->join('category','products.categoryid','=','category.id')
            ->where('category.id', '=', $category_id)
            ->where('products.enabled','=', 1)
            ->where('products.id', '<>', $product_id)
            ->select('products.*', 'category.id as cat_id', 'category.value as category_name')
            ->paginate(3);
        return $products;
    }

    public function get_featured_products()
    {
        $Products = DB::table('products')
            ->join('category','products.categoryid','=','category.id')
            ->where('products.enabled','=','1')
            ->orderBy('products.created_at','desc')
            ->limit(3)
            ->select('products.*','category.id as cat_id','category.value as category_name')
            ->get();
        return $Products;
    }
}
