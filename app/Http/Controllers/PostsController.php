<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Blog;

class PostsController extends Controller
{
  private function getBlogs($type,$id='')
  {
    if($type!='')
    {
        if($type=='lifestyle')
        {
            $Blogs = DB::table('blog')
            ->where('type','=',$type)
            ->where('enabled','=','1')
            ->orderBy('created_at','desc')
            //->get()->toArray();
            ->paginate(6);
        }
        else
        {
            $Blogs = DB::table('blog')
            ->where('type','=',$type)
            ->where('enabled','=',1)
            ->orderBy('created_at','desc')
            //->get()->toArray();
            ->paginate(6);
        }
    }
    else
    {
      $Blogs = DB::table('blog')
        //->where('title','=',urldecode($title))
        ->where('id','=',$id)
        ->where('enabled','=',1)
        ->get()->toArray();
    }
    return $Blogs;
  }

  public function lifestyle()
  {
    $Blogs = $this->getBlogs('lifestyle');
    $paginate = $Blogs;
    $categories = DB::table('category')->get();
    return view('Posts.index',['categories'=>$categories,'category_active'=>'all','heading'=>'Lifestyle','Blogs'=>$Blogs,'paginate'=>$paginate]);
  }

  public function beauty()
  {
    $Blogs = $this::getBlogs('beauty');
    $paginate=$Blogs;
    $categories = DB::table('category')->get();
    return view('Posts.index',['categories'=>$categories,'category_active'=>'all','heading'=>'Beauty','Blogs'=>$Blogs,'paginate'=>$paginate]);
  }

  public function view_post($heading,$id,$title)
  {
    $Blogs = $this->getBlogs('',$id);
    $categories = DB::table('category')->get();
    return view('Posts.view_post',['categories'=>$categories,'category_active'=>'all','heading'=>$heading,'Blogs'=>$Blogs]);
  }
}
