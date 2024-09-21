<?php

namespace App\Http\Controllers;

use App\Models\Aroma;
use App\Models\Caja;
use App\Models\CompraDetalle;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Venta;
use App\Models\VentaDetalle;
use DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VentaDetalleController extends Controller
{
  public function index()
  {
    if (CajaController::cajaIsOpen() == true) {
      $ventas = DB::table('ventas')->join('users', 'ventas.usuario_id', "=", 'users.id')->select('ventas.*', 'users.name')->orderBy('ventas.id', 'DESC')->get();
      return view('ventas.index', ['ventas' => $ventas]);
    } else {
      return redirect()->route('caja.index')->with('error', 'Debes abrir una caja antes');
    }
  }


  public function findSalidas($id)
  {
    $recomendaciones = DB::table('venta_detalles')->where('venta_detalles.venta_id', "=", $id)->join('productos', 'venta_detalles.producto_id', '=', 'productos.id')->join('proveedores', 'venta_detalles.proveedor_id', '=', 'proveedores.id')->join('aromas', 'venta_detalles.aroma_id', '=', 'aromas.id')->join('marcas', 'venta_detalles.marca_id', '=', 'marcas.id')->select('venta_detalles.id', 'venta_detalles.venta_id', 'venta_detalles.compra_detalle_id', 'venta_detalles.created_at', 'venta_detalles.marca_id', 'marcas.nombre AS nombre_marca', 'venta_detalles.producto_id', 'productos.nombre AS nombre_producto', 'venta_detalles.proveedor_id', 'proveedores.nombre AS nombre_proveedor', 'venta_detalles.aroma_id', 'aromas.nombre AS nombre_aroma', 'venta_detalles.precio_venta', 'venta_detalles.cantidad')->orderBy('venta_detalles.created_at', 'DESC')->get();
    return $recomendaciones;
  }

  public static function organizeVentas(Request $request)
  {
    $ventas = $request->all();
    $reorderedArray = [];
    $flag = false;
    for ($i = 0; $i < count($ventas["cantidad"]); $i++) {
      if (empty($ventas["cantidad"][0]) || $ventas["cantidad"][0] === '') {
        $flag = true;
        return $flag;
      }
    }
    for ($j = 0; $j < count($ventas["cantidad"]); $j++) {
      if ($ventas['cantidad'][$j] != 0) {
        $reorderedArray[] = [
          'compra_detalle_id' => $ventas['compra-select'][$j],
          'proveedor_id' => $ventas['proveedor'][$j],
          'marca_id' => $ventas['marca'][$j],
          'producto_id' => $ventas['producto'][$j],
          'aroma_id' => $ventas['aroma'][$j],
          'cantidad' => $ventas['cantidad'][$j],
          'precio_venta' => $ventas['precio'][$j],
        ];
      }
    }
    return $reorderedArray;
  }

  public function store(Request $request)
  {
    $reorderedArray = self::organizeVentas($request);
    if (gettype($reorderedArray) == "boolean") {
      return redirect()->route('vender')->with('error', 'No se pudo cargar la venta');
    }
    $total = VentaController::calculateTotal($reorderedArray);
    $cajaAbierta = Caja::where('estado', 'Abierta')->where('usuario_id', auth()->user()->id)->first();
    $caja = $cajaAbierta->id;
    $array = [
      'usuario_id' =>  auth()->user()->id,
      'caja_id' => $caja,
      'total' => $total,
    ];
    VentaController::store($array);
    $venta_id = Venta::all()->last()->id;

    // ------------------------------------------- //
    $request = new Request([
      'caja_id' => $cajaAbierta->id,
      'tipo_movimiento' => 'E',
      'monto' => $total,
      'descripcion' => 'Venta de productos',
    ]);
    MovimientosCajaController::store($request);
    // ------------------------------------------- //

    foreach ($reorderedArray as $value) {
      $value['venta_id'] = $venta_id;
      $value = VentaDetalle::create($value);
    }

    return redirect()->route('vender')->with('success', 'Venta registrada');
  }

}