<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SystemMails extends Mailable
{
  use Queueable, SerializesModels;
  public $msgName;
  public $msgEmail;
  public $msgMessage;
  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($name,$email,$phone_number,$message='',$mailType='',$product_list='')
  {
    $this->msgName = $name;
    $this->msgEmail = $email;
    $this->phone_number = $phone_number;
    $this->msgMessage = $message;
    $this->mailType = $mailType;
    $this->product_list = $product_list;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    $name = $this->msgName;
    $email = $this->msgEmail;
    $phone_number = $this->phone_number;
    $message = $this->msgMessage;
    $mailType = $this->mailType;
    $product_list = $this->product_list;
    if($mailType==''){
      $mailType='Mails.contactForm';
    }
    else
    {
      if($mailType=='registration')
      {
        $mailType='Mails.registration';
      }
      if($mailType=='client')
      {
        $mailType='Mails.contactForm';
      }
      if($mailType=='admin')
      {
        $mailType='Mails.contactForm_admin';
      }
      if($mailType=='invoice')
      {
        $mailType='Mails.purchase';
      }
    }

    if($this->mailType=='invoice')
    {
      return $this->view($mailType)
          ->subject('Purchase Order 🌻')
          ->with('name',$name)
          ->with('email',$email)
          ->with('msg',$message)
          ->with('product_list',$product_list);
    }
    else
    {
      return $this->view($mailType)
          ->subject('Ganic Roots 🌱')
          ->with('name',$name)
          ->with('email',$email)
          ->with('phone_number',$phone_number)
          ->with('msg',$message);
    }
  }
}
