<?php

namespace App\Http\Middleware;

use App\Http\Controllers\CajaController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCajaAbierta
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    $caja_abierta = CajaController::cajaIsOpen();
    //dd($caja_abierta);
    if ($caja_abierta) {
      return redirect()->route('caja.index')->with('error', 'Debes cerrar la caja antes de irte.');
    } else {
      return $next($request);
    }
  }
}
