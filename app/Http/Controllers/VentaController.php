<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VentaController extends Controller
{
  public function index(): View
  {
    $ventas = Venta::all();
    return view('ventas.index', compact('ventas'));
  }

  public static function calculateTotal($detallesArray)
  {
    $total = 0;
    foreach ($detallesArray as $detalle) {
      $total += $detalle["precio_venta"] * $detalle["cantidad"];
    }
    return $total;
  }

  public static function store($array)
  {
    $venta = Venta::Create($array);
  }
}
