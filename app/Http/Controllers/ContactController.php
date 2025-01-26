<?php

namespace App\Http\Controllers;

use App\Mail\SystemMails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
  public function index(Request $request)
  {
    $categories = DB::table('category')->get();
    $userDetails['name'] = '';
    $userDetails['surname'] = '';
    $userDetails['email'] = '';
    $userDetails['phone_number'] = '';

    if(auth()->check())
    {
      $userDetails['name'] = $request->user()->name;
      $userDetails['surname'] = $request->user()->surname;
      $userDetails['email'] = $request->user()->email;
      $userDetails['phone_number'] = $request->user()->phone_number;
    }

    return view('Contact.index',['categories'=>$categories,'category_active'=>'all','userDetails'=>$userDetails]);
  }

  public function send_message(Request $request)
  {
    $name = $request->get('name');
    $email = $request->get('email');
    $phone_number = $request->get('phone_number');
    $message = $request->get('message');
    $bValid=true;

    $msg='Please fill in the following:<ul>';
    if($name=='')
    {
      $msg .= '<li>Name field</li>';
      $bValid=false;
    }
    if($email=='')
    {
      $msg .= '<li>Email field</li>';
      $bValid=false;
    }
    if($message=='')
    {
      $msg .= '<li>Message box</li>';
      $bValid=false;
    }
    $msg .= '</ul>';

    if($bValid)
    {
      $results = Mail::to($email)->send(new SystemMails($name,$email,$phone_number,$message));
      $adminResults = Mail::to("thembi@ganicroots.co.za")->send(new SystemMails($name,$email,$phone_number,$message,'admin'));
      $response = json_encode($results);
    }
    else
    {
      $response = $msg;
    }
    session()->flash('message', 'Your email has been sent.');

    return redirect()->action('ContactController@index');
  }
}
