<?php

namespace App\Http\Controllers;

use Algolia\AlgoliaSearch\Model\Analytics\OrderBy;
use App\Models\Caja;
use App\Models\CompraDetalle;
use App\Models\MovimientosCaja;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Marca;
use App\Models\Aroma;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use stdClass;

class CompraDetalleController extends Controller
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
        'compraDetalles' => self::compras(),
      ]);
    } else {
      return redirect()->route('caja.index')->with('error', 'Debes abrir una caja antes');
    }
  }

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
      'tipo_movimiento' => 'Salida',
      'monto' => -$total,
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
        'stock_minimo' => $data['stock_minimo'],
        'cantidad' => $data['cantidad'],
      ]);
      return redirect()->route('compras')->with('success', 'Ingreso realizado con éxito');
    } catch (\Throwable $e) {
      $err = $e->getMessage();
      dd($err);
      return redirect()->route('stock')->with('error', 'No se pudo generar el ingreso');
    }
  }

  public function update(Request $request)
  {
    $data = $request->all();
    //dd($data);
    try {
      $compraDetalle = CompraDetalle::find($data['compra_detalle_id']);
      $compraDetalle->marca_id = $data["marca_id_modify"];
      $compraDetalle->proveedor_id = $data["proveedor_id_modify"];
      $compraDetalle->producto_id = $data["producto_id_modify"];
      $compraDetalle->aroma_id = $data["aroma_id_modify"];
      // $compraDetalle->precio_costo = $data["precio_costo_modify"];
      // $compraDetalle->porcentaje_ganancia = $data["porcentaje_ganancia_modify"];
      // $compraDetalle->precio_venta = $data["precio_venta_modify"];
      // $compraDetalle->cantidad = $data["cantidad_modify"];
      $compraDetalle->stock_minimo = $data['stock_minimo_modify'];
      $compraDetalle->updated_at = Carbon::now();
      $compraDetalle->save();
      return redirect()->back()->with('success', 'Modificiación correcta');
    } catch (\Throwable $th) {
      return redirect()->back()->with('error', 'Ocurrió un error');
    }
  }


  public function findEntrada($search)
  {
    $search = strval($search) . '%';
    $recomendaciones = DB::table('compra_detalles')->where('productos.nombre', 'like', $search)->join('productos', 'compra_detalles.producto_id', '=', 'productos.id')->join('proveedores', 'compra_detalles.proveedor_id', '=', 'proveedores.id')->join('aromas', 'compra_detalles.aroma_id', '=', 'aromas.id')->join('marcas', 'compra_detalles.marca_id', '=', 'marcas.id')->select('compra_detalles.id', 'compra_detalles.compra_id', 'compra_detalles.created_at', 'compra_detalles.marca_id', 'marcas.nombre AS nombre_marca', 'compra_detalles.producto_id', 'productos.nombre AS nombre_producto', 'compra_detalles.proveedor_id', 'proveedores.nombre AS nombre_proveedor', 'compra_detalles.aroma_id', 'aromas.nombre AS nombre_aroma', 'compra_detalles.precio_costo', 'compra_detalles.porcentaje_ganancia', 'compra_detalles.precio_venta', 'compra_detalles.cantidad')->OrderBy('compra_detalles.created_at','DESC')->get();
    return $recomendaciones;
  }

  public function findEntradaById($id)
  {
    $search = strval($id) . '%';
    $recomendaciones = DB::table('compra_detalles')->where('compra_detalles.id', '=', $id)->join('productos', 'compra_detalles.producto_id', '=', 'productos.id')->join('proveedores', 'compra_detalles.proveedor_id', '=', 'proveedores.id')->join('aromas', 'compra_detalles.aroma_id', '=', 'aromas.id')->join('marcas', 'compra_detalles.marca_id', '=', 'marcas.id')->select('compra_detalles.id', 'compra_detalles.compra_id', 'compra_detalles.created_at', 'compra_detalles.updated_at', 'compra_detalles.marca_id', 'marcas.nombre AS nombre_marca', 'compra_detalles.producto_id', 'productos.nombre AS nombre_producto', 'compra_detalles.proveedor_id', 'proveedores.nombre AS nombre_proveedor', 'compra_detalles.aroma_id', 'aromas.nombre AS nombre_aroma', 'compra_detalles.precio_costo', 'compra_detalles.porcentaje_ganancia', 'compra_detalles.precio_venta', 'compra_detalles.cantidad', 'compra_detalles.stock_minimo')->get();
    return $recomendaciones;
  }

  public static function compras()
  {
    $compraDetalles = CompraDetalle::with(['compra', 'marca', 'producto', 'proveedor', 'aroma', 'ventaDetalle'])->orderBy('created_at','DESC')->get();
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
      $collection[] = $filter;
    }
    $perPage = Auth::user()->paginado; 
    $page = request()->get('page', 1);
    $paginatedData = new LengthAwarePaginator(
      array_slice($collection, ($page - 1) * $perPage, $perPage), 
      count($collection), 
      $perPage, 
      $page, 
      ['path' => request()->url()] 
    );

    return $paginatedData; 
  }
}
