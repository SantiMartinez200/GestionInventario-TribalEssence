<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Notification;

class NotificationController extends Controller
{
  

  public function create(Request $request){
    $notif = Notification::create($request->all());
  }


  public function read()
  {

  }
  public function getNotifications(){
    $notifications = Notification::where('leida','=',0)->get();
    return $notifications;
  }
}
