<?php

namespace App\Http\Controllers;

use App\Models\Aroma;
use App\Models\Caja;
use App\Models\CompraDetalle;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\ReingresoAjuste;
use App\Models\VentaDetalle;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\View\View;
use stdClass;

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
        'compraDetalles' => self::calculateStock(),
      ]);
    } else {
      return redirect()->route('caja.index')->with('error', 'Debes abrir una caja antes');
    }
  }


  public static function calculateThisStock($id)
  {
    $compraDetalles = CompraDetalle::with(['compra', 'marca', 'producto', 'proveedor', 'aroma', 'ventaDetalle'])->where('producto_id', $id)->get();
    //dd($compraDetalles);
    foreach ($compraDetalles as $detalle) {
      $filter = new stdClass;
      $filter->cantidad = $detalle->cantidad;
      if (!($detalle->ventaDetalle->isEmpty())) {
        foreach ($detalle->ventaDetalle as $venta) {
          $filter->cantidad -= $venta->cantidad;
        }
      }
    }
    return $filter->cantidad;
  }

  public static function calculateStock()
  {
    $compraDetalles = CompraDetalle::with(['compra', 'marca', 'producto', 'proveedor', 'aroma', 'ventaDetalle'])->get();
    $collection[] = new stdClass;
    foreach ($compraDetalles as $detalle) {
      $filter = new stdClass;
      $filter->id = $detalle->id;
      $filter->marca_id = $detalle->marca_id;
      $filter->marca_nombre = $detalle->marca->nombre;
      $filter->proveedor_id = $detalle->proveedor_id;
      $filter->proveedor_nombre = $detalle->proveedor->nombre;
      $filter->producto_id = $detalle->producto_id;
      $filter->producto_nombre = $detalle->producto->nombre;
      $filter->aroma_id = $detalle->aroma_id;
      $filter->aroma_nombre = $detalle->aroma->nombre;
      $filter->precio_costo = $detalle->precio_costo;
      $filter->updated_at = $detalle->updated_at;

      $filter->cantidad = $detalle->cantidad;
      if (!($detalle->ventaDetalle->isEmpty())) {
        foreach ($detalle->ventaDetalle as $venta) {
          $filter->cantidad -= $venta->cantidad;
        }
      }

      $collection[] = $filter;
    }
    return $collection;
  }
}

