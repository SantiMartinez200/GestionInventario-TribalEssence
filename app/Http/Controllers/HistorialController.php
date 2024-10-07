<?php

namespace App\Http\Controllers;

use App\Models\Historial;
use Illuminate\Http\Request;

class HistorialController extends Controller
{
  public static function store(Request $request)
  {
    $array = $request->all();
    $store = Historial::create($array);
    if($store){
      return true;
    }else{
      return false;
    }
  }

}
