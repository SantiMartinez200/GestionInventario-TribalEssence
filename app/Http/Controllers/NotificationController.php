<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;

class NotificationController extends Controller
{
  

  public function create(Request $request){
    $notif = Notification::create($request->all());
  }
  public function read()
  {

  }
  public function show(){
    
  }
}
