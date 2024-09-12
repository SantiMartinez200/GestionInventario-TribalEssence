<?php

namespace App\Http\Controllers;

use App\Models\Aroma;
use App\Models\CompraDetalle;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\VentaDetalle;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StockController extends Controller
{
  public function index()
  {
    if (CajaController::cajaIsOpen() == true) {

      $productos = Producto::all();
      $proveedores = Proveedor::all();
      $marcas = Marca::all();
      $aromas = Aroma::all();
      return view('ingresos.index', [
        'productos' => $productos,
        'aromas' => $aromas,
        'proveedores' => $proveedores,
        'marcas' => $marcas,
        'compraDetalles' => self::changeIdToName(),
      ]);
    } else {
      return redirect()->route('caja.index')->with('error', 'Debes abrir una caja antes');
    }
  }

  /*  //View de stock
      +"id": 1
      +"compra_id": 1
      +"marca_id": "dolor"
      +"proveedor_id": "Justus Spinka Sr."
      +"producto_id": "aspernatur"
      +"aroma_id": "laudantium"
      +"precio_costo": 670.0
      +"porcentaje_ganancia": 100
      +"precio_venta": 1340.0
      +"cantidad": 0
      +"created_at": "2024-09-07 19:20:58"
      +"updated_at: "2024-09-07 19:20:58"
  */

  /* //JS fetch en ventas
    {
    "id": 2,
    "compra_id": 2,
    "marca_id": 2,
    "nombre_marca": "dolor",
    "producto_id": 1,
    "nombre_producto": "reiciendis",
    "proveedor_id": 1,
    "nombre_proveedor": "Justus Spinka Sr.",
    "aroma_id": "1",
    "nombre_aroma": "nobis",
    "precio_costo": 2480,
    "porcentaje_ganancia": 1000,
    "precio_venta": 27280,
    "cantidad": 1000  
    "created_at": "2024-09-07 19:54:33",
  */

  public static function getThisDetalleCompras($id)
  {
    $compraDetalles = CompraDetalle::where('id', $id)->get();
    return $compraDetalles;
  }

  public static function getThisDetalleVentas($id)
  {
    $ventaDetalles = VentaDetalle::where('compra_detalle_id', $id)->get();
    return $ventaDetalles;
  }

  public static function calculateThisStock($id)
  {
    $compraDetalles = self::getThisDetalleCompras($id);
    $ventaDetalles = self::getThisDetalleVentas($id);
    for ($i = 0; $i < count($ventaDetalles); $i++) {
      for ($j = 0; $j < count($compraDetalles); $j++) {
        if ($ventaDetalles[$i]->compra_detalle_id == $compraDetalles[$j]->id) {
          $compraDetalles[$j]->cantidad -= $ventaDetalles[$i]->cantidad;
        }
      }
    }
    return $compraDetalles[0]->cantidad;
  }


  public static function changeThisIdToName($recomendaciones)
  {
    //dd($recomendaciones);
    foreach ($recomendaciones as $recomendacion) {
      $proveedor = Proveedor::find($recomendacion->proveedor_id);
      $marca = Marca::find($recomendacion->marca_id);
      $producto = Producto::find($recomendacion->producto_id);
      $aroma = Aroma::find($recomendacion->aroma_id);
      $recomendacion->proveedor_id = $proveedor->nombre;
      $recomendacion->marca_id = $marca->nombre;
      $recomendacion->producto_id = $producto->nombre;
      if ($recomendacion->aroma_id == "N/E") {
        $recomendacion->aroma_id = "N/E";
      } else {
        $recomendacion->aroma_id = $aroma->nombre;
      }

    }
    return $recomendaciones;
  }


  public static function getDetalleCompras()
  {
    $compraDetalles = DB::table('compra_detalles')->get();
    return $compraDetalles;

  }

  public static function getDetalleVentas()
  {
    $ventaDetalles = DB::table('venta_detalles')->get();
    return $ventaDetalles;
  }
  public static function calculateStock()
  {
    $compraDetalles = self::getDetalleCompras();
    $ventaDetalles = self::getDetalleVentas();
    for ($i = 0; $i < count($ventaDetalles); $i++) {
      for ($j = 0; $j < count($compraDetalles); $j++) {
        if ($ventaDetalles[$i]->compra_detalle_id == $compraDetalles[$j]->id) {
          $compraDetalles[$j]->cantidad -= $ventaDetalles[$i]->cantidad;
          $compraDetalles[$j]->updated_at = Carbon::now();
        }
      }
    }
    return $compraDetalles;
  }



  public function changeIdToName()
  {
    $compraDetalles = self::calculateStock();
    $marcas = Marca::all();
    $proveedores = Proveedor::all();
    $productos = Producto::all();
    $aromas = Aroma::all();
    for ($i = 0; $i < count($compraDetalles); $i++) {
      foreach ($marcas as $marca)
        if ($marca->id == $compraDetalles[$i]->marca_id) {
          $compraDetalles[$i]->marca_id = $marca->nombre;
        }
      foreach ($proveedores as $proveedor) {
        if ($proveedor->id == $compraDetalles[$i]->proveedor_id) {
          $compraDetalles[$i]->proveedor_id = $proveedor->nombre;
        }
      }
      foreach ($productos as $producto) {
        if ($producto->id == $compraDetalles[$i]->producto_id) {
          $compraDetalles[$i]->producto_id = $producto->nombre;
        }
      }
      foreach ($aromas as $aroma) {
        if ($aroma->id == $compraDetalles[$i]->aroma_id) {
          $compraDetalles[$i]->aroma_id = $aroma->nombre;
        }
      }
    }
    return $compraDetalles;
  }

  public function stock_increment(Request $request){
    $data = $request->all();
    $sum = intVal($data["new_stock"]) + intVal($data["old_stock"]);
    dd($sum);
      try {
        $compra_detalle = DB::table('compra_detalles')
              ->where('id', $data["id"])
              ->update(['cantidad' => $data["new_stock"]]);  
      return redirect()->back()->with('success','Stock actualizado exitosamente');
      } catch (Exception $e) {
        return redirect()->back()->with('error','Hubo un error al cargar la consulta.');
      }
    }
  }