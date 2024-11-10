<?php

namespace App\Http\Middleware;

use App\Http\Controllers\StockController;
use App\Http\Controllers\VentaDetalleController;
use App\Models\CompraDetalle;
use App\Models\Producto;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Log;
use App\Http\Controllers\NotificationController;
use Symfony\Component\HttpFoundation\Response;

class NotificationMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    $vars = VentaDetalleController::organizeVentas($request);

    $res = [];
    foreach ($vars as $row) {
      $res[] = CompraDetalle::where('producto_id', $row['producto_id'])->where('compra_detalles.id', $row['compra_detalle_id'])->join('productos', 'compra_Detalles.producto_id', '=', 'productos.id')->select('productos.nombre as nombre_producto', 'compra_detalles.*')->get();
    }
    for ($i = 0; $i < count($res); $i++) {
      if ($vars[$i]['compra_detalle_id'] == $res[$i][0]->id) {
        $will_alert = $vars[$i]['stock_al_vender'] - $vars[$i]['cantidad'];

        if ($will_alert <= $res[0][0]->stock_minimo) {
          $array = ['descripcion' => 'Stock mínimo del producto: ' . $res[$i][0]->nombre_producto . '(Ent. N° ' . $res[$i][0]->id . ')', 'leida' => 0];
          NotificationController::store($array['descripcion'], $array['leida']);
        }
      }
    }
    return $next($request);
  }
}
