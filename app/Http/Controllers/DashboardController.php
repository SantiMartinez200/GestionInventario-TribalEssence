<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentaDetalle;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class DashboardController extends Controller
{
  //Trae todas las ventas de la semana en la que se está parado.
  public function getVentasSemanales()
  {
    // Obtiene el inicio de la semana (lunes)
    $startOfWeek = strtotime('monday this week');
    $sellsThisWeek = [];
    $productos = []; // Mover esto fuera del bucle

    for ($i = 0; $i < 7; $i++) {
      // Calcula cada día de la semana
      $day = date('Y-m-d', strtotime("+$i days", $startOfWeek));

      // Realiza la consulta por el día específico
      $sql = VentaDetalle::whereDate('created_at', $day)->get(); // Cambié 'LIKE' por 'whereDate'

      // Solo agrega a la lista si hay resultados
      if (!$sql->isEmpty()) {
        $sellsThisWeek[$day] = $sql; // Almacena el día como clave y los resultados
      } else {
        $sellsThisWeek[$day] = []; // Cambiar "Sin Ventas" por un array vacío
      }

      foreach ($sellsThisWeek[$day] as $data) {
        // Obtén el nombre del producto
        $productoNombre = Producto::where('id', '=', $data->producto_id)->value('nombre');

        // Sumar las cantidades de cada producto
        if (!isset($productos[$productoNombre])) {
          $productos[$productoNombre] = array_fill(0, 7, 0); // Inicializar con cero para cada día
        }
        $index = array_search($day, array_keys($sellsThisWeek));
        $productos[$productoNombre][$index] += $data->cantidad; // Asumimos que hay una propiedad 'cantidad'
      }
    }

    // Prepara los datos para el gráfico
    foreach ($sellsThisWeek as $key => $value) {
      $date = new DateTime($key);
      $fechas[] = date_format($date, 'd/m/Y');
      unset($date);
    }
    $data = [
      'labels' => $fechas,
      'datasets' => [],
    ];

    foreach ($productos as $producto => $cantidades) {
      $data['datasets'][] = [
        'label' => $producto,
        'data' => $cantidades,
        'backgroundColor' => '#' . dechex(rand(0x000000, 0xFFFFFF)), // Color aleatorio
      ];
    }

    return response()->json($data); // Devolver JSON en la respuesta
  }


  public static function getGastosCompras()
  {
    $gastos = DB::table('compras')->sum('total');
    return $gastos;
  }

  public static function getIngresosBrutos()
  {
    $ingresos = DB::table('ventas')->sum('total');
    return $ingresos;
  }

  public static function calcularMarcasVendidas()
  {
    //De todos los productos vendidos, calcular el porcentaje que se vende de cada marca.
    $sql = DB::table('venta_detalles')->join('marcas','marcas.id','=','venta_detalles.marca_id')->select('marcas.nombre',DB::raw("sum(venta_detalles.cantidad) as total_vendido_marca"))->groupBy('marcas.nombre')->get();
    return $sql;
  }

  public static function calcularProductosVendidos()
  {
    //De todos los productos vendidos, calcular el porcentaje que se vende de cada marca.
    $productos = DB::table('venta_detalles')->join('productos','productos.id','=','venta_detalles.producto_id')->select('productos.nombre',DB::raw("sum(venta_detalles.cantidad) as total_vendido_producto"))->groupBy('productos.nombre')->get();
    
    return $productos;

  }

  public static function getExistenciasTotales()
  {
    $existencias = DB::table('compra_detalles')->sum('cantidad');
    return $existencias;
  }

  public static function getExistenciasVendidas()
  {
    $existenciasVendidas = DB::table('venta_detalles')->sum('cantidad');
    return $existenciasVendidas;
  }

  public static function calcularExistenciasActuales()
  {
    $existenciasActuales = self::getExistenciasTotales() - self::getExistenciasVendidas();
    return $existenciasActuales;
  }

  public function productosMasVendidos()
  {
    $productosMasVendidos = DB::table('venta_detalles')->select('producto_id', 'productos.nombre AS producto','marcas.nombre AS marca', DB::raw('SUM(cantidad) as total_vendido'))
      ->groupBy('producto_id','marcas.nombre','productos.nombre')
      ->orderBy('total_vendido', 'DESC')
      ->join('productos', 'productos.id', '=', 'venta_detalles.producto_id')
      ->join('marcas','marcas.id','=','venta_detalles.marca_id')
      ->limit(3)
      ->get();
    return $productosMasVendidos;
  }

  public function productosMenosVendidos()
  {
    $productosMenosVendidos = DB::table('venta_detalles')->select('producto_id', 'productos.nombre AS producto','marcas.nombre AS marca', DB::raw('SUM(cantidad) as total_vendido'))
    ->groupBy('producto_id','marcas.nombre','productos.nombre')
    ->orderBy('total_vendido', 'ASC')
    ->join('productos', 'productos.id', '=', 'venta_detalles.producto_id')
    ->join('marcas','marcas.id','=','venta_detalles.marca_id')
    ->limit(3)
    ->get();
    return $productosMenosVendidos;
  }


  public static function ordenarPorCantidad($collection)
  {
    $n = count($collection);
    for ($i = 0; $i < $n; $i++) {
      for ($j = 0; $j < $n - 1; $j++) {
        // Validar que ambos elementos tengan la propiedad 'cantidad'
        $cantidadA = isset($collection[$j]->cantidad) ? $collection[$j]->cantidad : 0;
        $cantidadB = isset($collection[$j + 1]->cantidad) ? $collection[$j + 1]->cantidad : 0;

        // Comparar las cantidades y hacer el intercambio si es necesario
        if ($cantidadA < $cantidadB) {
          // Intercambiar elementos
          $temp = $collection[$j];
          $collection[$j] = $collection[$j + 1];
          $collection[$j + 1] = $temp;
        }
      }
    }

    return $collection;
  }

  

  public static function topDashboard()
  {
    $compraDetalles = CompraDetalle::with(['compra', 'marca', 'producto', 'proveedor', 'aroma', 'ventaDetalle'])->orderBy('compra_detalles.cantidad', 'DESC')->get();


    $collection = [];
    $productosVacios = [];
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
      if ($filter->cantidad > 0) {
        $collection[] = $filter;
      }else{
        $productosVacios[] = $filter;
      }
    }

    $collectionOrdenada = self::ordenarPorCantidad($collection);
    $top3 = array_slice($collectionOrdenada, 0, 3);
    $top3['vacios'] = $productosVacios;
    return $top3;
  }



  public function index()
  {
    $ventasPorMarca = self::calcularMarcasVendidas();
    $ventasPorProducto = self::calcularProductosVendidos();

    $existenciasActuales = self::calcularExistenciasActuales();
    $gastosCompras = self::getGastosCompras();
    $ingresosBrutos = self::getIngresosBrutos();
    $existenciasTotales = self::getExistenciasTotales();
    $existenciasVendidas = self::getExistenciasVendidas();
    $cuentaProductosMasVendidos = self::productosMasVendidos();
    $cuentaProductosMenosVendidos = self::productosMenosVendidos();
    $top = self::topDashboard();

    return view('datos.index', compact(
      'ventasPorMarca',
      'ventasPorProducto',
      'existenciasActuales',
      'gastosCompras',
      'ingresosBrutos',
      'existenciasTotales',
      'existenciasVendidas',
      'cuentaProductosMasVendidos',
      'cuentaProductosMenosVendidos',
      'top'
    ));
  }
}
