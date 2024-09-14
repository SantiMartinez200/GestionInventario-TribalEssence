<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\CompraDetalle;
use App\Models\MovimientosCaja;
use DB;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Marca;
use App\Models\Aroma;
use Illuminate\Support\Facades\Auth;

class CompraDetalleController extends Controller
{

  public function store(Request $request)
  {
    //dd($request->all());
    //----MOVIMIENTO DE CAJA-----//
    $data = $request->all();
    $user = Auth::user()->id;
    $cajaAbierta = Caja::where('estado', 'Abierta')->where('usuario_id', '=', $user)->get();

    $total = $data['precio_costo'] * $data['cantidad'];
    $array = ['usuario_id' => $user, 'caja_id' => $cajaAbierta[0]["id"], 'total' => $total];
    CompraController::store($array);
    $idCompra = CompraController::getId();
    // ------------------------------------------- //
    $producto = Producto::find($data['producto_id']);
    $request = new Request([
      'caja_id' => $cajaAbierta[0]["id"],
      'tipo_movimiento' => 'S',
      'monto' => $total,
      'descripcion' => 'Compra del producto: ' . $producto->nombre . ' por $' . $data["precio_costo"] . ' X ' . $data["cantidad"] . ' U',
    ]);
      MovimientosCajaController::store($request);
    // ------------------------------------------- //

    //----MOVIMIENTO DE DETALLE------//
    try {
      CompraDetalle::create([
        'compra_id' => $idCompra,
        'marca_id' => $data['marca_id'],
        'proveedor_id' => $data['proveedor_id'],
        'producto_id' => $data['producto_id'],
        'aroma_id' => $data['aroma_id'],
        'precio_costo' => $data['precio_costo'],
        'porcentaje_ganancia' => $data['porcentaje_ganancia'],
        'precio_venta' => $data['precio_venta'],
        'cantidad' => $data['cantidad'],
      ]);
      return redirect()->route('stock')->with('success', 'Ingreso realizado con éxito');
    } catch (\Throwable $e) {
      $err = $e->getMessage();
      dd($err);
      return redirect()->route('stock')->with('error', 'No se pudo generar el ingreso');
    }
  }


  public function findEntrada($search)
  {
    $search = strval($search) . '%';
    $recomendaciones = DB::table('compra_detalles')->where('producto_id', 'like', $search)->join('productos', 'compra_detalles.producto_id', '=', 'productos.id')->join('proveedores', 'compra_detalles.proveedor_id', '=', 'proveedores.id')->join('aromas', 'compra_detalles.aroma_id', '=', 'aromas.id')->join('marcas', 'compra_detalles.marca_id', '=', 'marcas.id')->select('compra_detalles.id', 'compra_detalles.compra_id', 'compra_detalles.created_at', 'compra_detalles.marca_id', 'marcas.nombre AS nombre_marca', 'compra_detalles.producto_id', 'productos.nombre AS nombre_producto', 'compra_detalles.proveedor_id', 'proveedores.nombre AS nombre_proveedor', 'compra_detalles.aroma_id', 'aromas.nombre AS nombre_aroma', 'compra_detalles.precio_costo', 'compra_detalles.porcentaje_ganancia', 'compra_detalles.precio_venta', 'compra_detalles.cantidad')->get();
    return $recomendaciones;
  }
}
