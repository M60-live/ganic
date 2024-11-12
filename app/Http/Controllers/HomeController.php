<?php

namespace App\Http\Controllers;

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
        return view('index', ['categories' => $categories, 'posts' => $posts, 'category_active' => 'all']);
    }

    public function getUserDetails()
    {
        $categories = DB::table('category')->get();
        return view('account', ['categories' => $categories, 'category_active' => 'all']);
    }
}
