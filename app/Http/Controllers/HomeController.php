<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $categories = DB::table('category')->get();
        $posts      = DB::table('blog')->get()->sortByDesc('id')->toArray();
        $featuredProducts = (new Products())->get_featured_products();
        return view('index', ['categories' => $categories, 'posts' => $posts, 'category_active' => 'all', 'featuredProducts' => $featuredProducts]);
    }

    public function getUserDetails()
    {
        $categories = DB::table('category')->get();
        return view('account', ['categories' => $categories, 'category_active' => 'all']);
    }
}
