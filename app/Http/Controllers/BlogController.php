<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin');
  }

  function getBlogs($blog_id='')
  {
    if($blog_id=='')
    {
      $Blogs = DB::table('blog')
      ->orderBy('created_at')
      ->paginate(10);
    }
    else
    {
      $Blogs = DB::table('blog')
      ->where('id','=',$blog_id)
      ->get()->toArray();
    }
    return $Blogs;
  }

  public function index()
  {
    $Blogs = $this::getBlogs();
    $paginate=$Blogs->links();
    $categories = DB::table('category')->get();
    return view('Blog.dashboard',['categories'=>$categories,'category_active'=>'all','Blogs'=>$Blogs,'paginate'=>$paginate]);
  }

  public function view_post($post_id)
  {
    $Blogs = $this::getBlogs($post_id);
    $categories = DB::table('category')->get();
    return view('Blog.view_post',['categories'=>$categories,'category_active'=>'all','Blogs'=>$Blogs]);
  }

  public function create_page()
  {
    $categories = DB::table('category')->get();
    return view('Blog.create',['categories'=>$categories,'category_active'=>'all']);
  }

  public function create(Request $request)
  {
    $title = $request->get('title');
    $subtitle = $request->get('subtitle');
    $body_message = $request->get('body_message');
    $enabled = $request->get('enabled');
    $blog_type = $request->get('blog_type');
    $valid=true;
//    die($body_message);
    if($enabled=='')
    {
      $enabled='0';
    }
    else
    {
      $enabled='1';
    }
    if(!$request->hasFile('img_url'))
    {
      $valid=false;
    }

    if($valid)
    {
      $blog_id = DB::table('blog')
      ->insertGetId(['title'=>$title,'subtitle'=>$subtitle,'body_message'=>$body_message,'created_at'=>now(),'enabled'=>$enabled,'type'=>$blog_type]);

      $Location='/app/public/blog/';
      $FileType = $request->file('img_url')->getClientOriginalExtension();
      $newFileName = $blog_id.".".$FileType;
      $FileResponse=$request->file('img_url')->move(storage_path($Location),$newFileName);
      if($FileResponse)
      {
        $responseIMG = DB::table('blog')
          ->where('id',$blog_id)
          ->update(['img_url'=>$newFileName]);
      }

      if($enabled==1)
      {
        session()->flash('message', 'Blog Post created and live!!!');
      }
      else
      {
        session()->flash('message', 'Blog Post created');
      }
    }
    else
    {
      session()->flash('message', 'Failed to create your blog post. Please load an image');
    }

    return redirect()->action('BlogController@index');
  }

  public function update(Request $request)
  {
    $title = $request->get('title');
    $subtitle = $request->get('subtitle');
    $body_message = $request->get('body_message');
    $post_id = $request->get('post_id');
    $enabled = $request->get('enabled');


    if($enabled =='' || $enabled == null)
    {
      $enabled='0';
    }
    else
    {
      $enabled='1';
    }

    $blog_id = DB::table('blog')
    ->where('id',$post_id)
    ->update(['title'=>$title,'subtitle'=>$subtitle,'body_message'=>$body_message,'updated_at'=>now(),'enabled'=>$enabled]);

    if($request->hasFile('img_url'))
    {
      $Location='/app/public/blog/';
      $FileType = $request->file('img_url')->getClientOriginalExtension();
      $FileContent = $request->file('img_url');
      $newFileName = $post_id.".".$FileType;
//      $FileResponse=$request->file('img_url')->move(public_path('img').$Location,$newFileName);
      $FileResponse=$request->file('img_url')->move(storage_path($Location),$newFileName);
//      $FileResponse=Storage::disk('public_uploads_blog')->put($Location.$newFileName,  File::get($FileContent));
      if($FileResponse)
      {
        $responseIMG = DB::table('blog')
        ->where('id',$post_id)
        ->update(['img_url'=>$newFileName]);
      }
    }

    session()->flash('message', 'Product updated.');
    return redirect()->action('BlogController@index');
  }
}