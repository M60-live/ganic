<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class CategoryController extends Controller
{
    function get_categories($id='')
    {
        if($id!='')
        {
            $Categories = DB::table('category')
            ->where('id','=',$id)
            ->select('*')
            ->get()->toArray();
        }
        else
        {
            $Categories = DB::table('category')
            ->select('*')
            ->get()->toArray();
        }

        return $Categories;
    }

    function get_products($id='')
    {
        if($id=='')
        {

            $products = DB::table('products')
            ->join('category','products.categoryid','=','category.id')
            ->orderBy('products.value','asc')
            ->select('products.*','category.id as cat_id','category.value as category_name')
            ->paginate();
        }
        else
        {
            $products = DB::table('products')
            ->join('category','products.categoryid','=','category.id')
            ->where('products.id','=',$id)
            ->select('products.*','category.id as cat_id','category.value as category_name')
            ->paginate();

        }
        /*$Results['products']=$products;*/
        $Results=$products;
        return $Results;
    }


    public function index()
    {
        $Categories = $this->get_categories();
        return view('Category.list_categories',['categories'=>$Categories,'category_active'=>'all']);
    }

    public function view($category_id)
    {
        $Categories = $this->get_categories();
        return view('Category.view',['categories'=>$Categories,'category_active'=>'all']);
    }

    public function update(Request $request)
    {
        $category_id = $request->get('id');
        $category_name = $request->get('value');

        $response = DB::table('category')
        ->where('id',$category_id)
        ->update(['value'=>$category_name,'updated_at'=>now()]);

        session()->flash('message', 'Category Updated');
        return redirect()->action('CategoryController@index');
    }
}
