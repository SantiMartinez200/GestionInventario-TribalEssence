<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;

class CompraController extends Controller
{
  public static function store($array)
  {
    Compra::create($array);
  }

  public static function getId()
  {
    $id = Compra::all()->last()->id;
    return $id;
  }
}
