<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Notification;

class NotificationController extends Controller
{


  public static function store($descripcion,$leida)
  {
    return Notification::create([
      'descripcion' => $descripcion,
      'leida' => $leida,
    ]) ? true : false;
  }


  public function read()
  {

  }
  public function getNotifications()
  {
    $notifications = Notification::where('leida', '=', 0)->get();
    return $notifications;
  }

  public function marcarLeida(Request $request)
  {
    $request->validate([
      'id' => 'required|integer|exists:notifications,id',
    ]);



    $notificacion = Notification::find($request->id);
    $notificacion->leida = 1;
    $notificacion->save();

    return response()->json(['success' => true]);
  }

}
