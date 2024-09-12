<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
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
    $ingresosNetos = self::getIngresosBrutos() - self::getGastosCompras();
    return $ingresosNetos;
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

  public function index()
  {
    $ingresosNetos = self::calcularIngresosNetos();
    $existenciasActuales = self::calcularExistenciasActuales();
    $gastosCompras = self::getGastosCompras();
    $ingresosBrutos = self::getIngresosBrutos();
    $existenciasTotales = self::getExistenciasTotales();
    $existenciasVendidas = self::getExistenciasVendidas();
    return view('datos.index', compact('ingresosNetos', 'existenciasActuales', 'gastosCompras', 'ingresosBrutos', 'existenciasTotales', 'existenciasVendidas'));
  }
}
