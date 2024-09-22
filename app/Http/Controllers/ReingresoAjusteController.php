<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\ReingresoAjuste;
use DB;
use Illuminate\Http\Request;

class ReingresoAjusteController extends Controller
{
  public function stock_increment(Request $request)
  {
    $data = $request->all();
    
    $sum = intVal($data["old_stock_increment"] + intVal($data["new_stock_increment"]));

    /* Movimiento de caja */
    $cajaAbierta = Caja::where('estado', 'Abierta')->where('usuario_id', auth()->user()->id)->first()->id;
    $request = new Request([
      'caja_id' => $cajaAbierta,
      'tipo_movimiento' => 'S',
      'monto' => ($data['precio_costo_increment'] * $data['new_stock_increment']),
      'descripcion' => 'Reingreso de producto',
    ]);
    MovimientosCajaController::store($request);
    /* Movimiento de caja */

    /* Registro */
    ReingresoAjuste::create([
      'compra_detalle_id' => $data['id_increment'],
      'movimiento_caja_id' => $cajaAbierta,
      'usuario_id' => auth()->user()->id,
      'cantidad_reingreso' => $data['new_stock_increment'],
      'cantidad_ajuste' => null,
      'tipo' => 'reingreso',
      'motivo' => null,
    ]);
    /* Registro */



    return redirect()->back()->with('success', 'Stock actualizado exitosamente');
  }


  public function stock_decrement(Request $request)
  {
    $data = $request->all();
    $sum = intVal($data["old_stock_decrement"] - intVal($data["new_stock_decrement"]));
    
    /* Movimiento de caja */
    $cajaAbierta = Caja::where('estado', 'Abierta')->where('usuario_id', auth()->user()->id)->first()->id;
    $request = new Request([
      'caja_id' => $cajaAbierta,
      'tipo_movimiento' => 'E',
      'monto' => ($data['precio_costo_decrement'] * $data['new_stock_decrement']),
      'descripcion' => 'Reajuste de productos',
    ]);
    MovimientosCajaController::store($request);
    /* Movimiento de caja */

    /* Registro */
    ReingresoAjuste::create([
      'compra_detalle_id' => $data['id_decrement'],
      'movimiento_caja_id' => $cajaAbierta,
      'usuario_id' => auth()->user()->id,
      'cantidad_reingreso' => null,
      'cantidad_ajuste' => $data['new_stock_decrement']*-1,
      'tipo' => 'ajuste',
      'motivo' => null,
    ]);
    /* Registro */
    return redirect()->back()->with('success', 'Stock actualizado exitosamente');
  }
}
