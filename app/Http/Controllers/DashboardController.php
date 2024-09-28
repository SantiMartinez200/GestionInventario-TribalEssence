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

  public static function calcularIngresosNetos()
  {
    $data = [];



    $ingresosNetos = self::getIngresosBrutos() - self::getGastosCompras();
    $porcentajeCostos = (self::getGastosCompras() / self::getIngresosBrutos()) * 100;
    $porcentajeGanancias = 100 - $porcentajeCostos;
    $data = [
      'ingresosNetos' => $ingresosNetos,
      'porcentajeCostos' => number_format($porcentajeCostos, 2),
      'porcentajeGanancias' => number_format($porcentajeGanancias, 2),
    ];
    return $data;
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
    $productosMasVendidos = DB::table('venta_detalles')->select('producto_id', 'productos.nombre', DB::raw('SUM(cantidad) as total_vendido'))
      ->groupBy('producto_id')
      ->orderBy('total_vendido', 'DESC')
      ->join('productos', 'productos.id', '=', 'venta_detalles.producto_id')
      ->limit(3)
      ->get();
    return $productosMasVendidos;
  }

  public function productosMenosVendidos()
  {
    $productosMenosVendidos = DB::table('venta_detalles')->select('producto_id', 'productos.nombre', DB::raw('SUM(cantidad) as total_vendido'))
      ->groupBy('producto_id')
      ->orderBy('total_vendido', 'ASC')
      ->join('productos', 'productos.id', '=', 'venta_detalles.producto_id')
      ->limit(3)
      ->get();
    return $productosMenosVendidos;
  }

  public function index()
  {
    $ingresosNetos = self::calcularIngresosNetos();
    $existenciasActuales = self::calcularExistenciasActuales();
    $gastosCompras = self::getGastosCompras();
    $ingresosBrutos = self::getIngresosBrutos();
    $existenciasTotales = self::getExistenciasTotales();
    $existenciasVendidas = self::getExistenciasVendidas();
    $cuentaProductosMasVendidos = self::productosMasVendidos();
    $cuentaProductosMenosVendidos = self::productosMenosVendidos();
    return view('datos.index', compact(
      'ingresosNetos',
      'existenciasActuales',
      'gastosCompras',
      'ingresosBrutos',
      'existenciasTotales',
      'existenciasVendidas',
      'cuentaProductosMasVendidos'
      ,
      'cuentaProductosMenosVendidos'
    ));
  }
}
