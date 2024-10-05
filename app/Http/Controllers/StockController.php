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
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
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
      return view('stock.stock', [
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
      $filter->existencias_iniciales = $detalle->cantidad;

      $filter->cantidad = $detalle->cantidad;
      if (!($detalle->ventaDetalle->isEmpty())) {
        foreach ($detalle->ventaDetalle as $venta) {
          $filter->cantidad -= $venta->cantidad;
        }
      }

      $collection[] = $filter;
    }
    $perPage = Auth::user()->paginado; // Número de registros por página
    $page = request()->get('page', 1); // Obtener el número de página actual, por defecto 1
    $paginatedData = new LengthAwarePaginator(
      array_slice($collection, ($page - 1) * $perPage, $perPage), // Datos por página
      count($collection), // Total de registros
      $perPage, // Registros por página
      $page, // Página actual
      ['path' => request()->url()] // URL para la paginación
    );

    return $paginatedData; // Devolver los datos paginados
  }
}

