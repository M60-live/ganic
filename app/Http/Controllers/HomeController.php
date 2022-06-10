<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
//      $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
//        return view('home');
    $categories = DB::table('category')->get();
    $posts = DB::table('blog')->get()->sortByDesc('id')->toArray();
    return view('index',['categories'=>$categories,'posts'=>$posts,'category_active'=>'all']);
  }

  public function getUserDetails()
  {
    $categories = DB::table('category')->get();
    return view('account',['categories'=>$categories,'category_active'=>'all']);
  }
}
