<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\MovimientosCaja;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class MovimientosCajaController extends Controller
{
  public function index()
  {
    return view('caja.movimientos_caja.index', [
      'cajas' => Caja::latest()->paginate(Auth::user()->paginado)
    ]);
  }

  public function getMovimientos($id) //para api
  {
    $caja = Caja::find($id);
    $movimientos = $caja->movimientos;
    $montos = MovimientosCajaController::getMonto($id);
    $datosAdicionales = ['caja_fecha' => date_format($caja->created_at, 'd/m/Y')];
    return view('caja.movimientos_caja.movimientos', compact('movimientos', 'datosAdicionales', 'montos','caja'));
  }

  public function pdfMovimientos($id) //para api
  {
    $caja = Caja::findOrFail($id);
    $montos = MovimientosCajaController::getMonto($id);
    $movimientos = $caja->movimientos;
    $datosAdicionales = ['caja_fecha' => date_format($caja->created_at, 'd/m/Y')];
    $pdfName = date_format($caja->created_at, 'Y-m-d');
    $pdf = Pdf::loadView('pdf.registroscaja', ['movimientos' => $movimientos, 'datosAdicionales' => $datosAdicionales, 'montos' => $montos,'caja' => $caja]);
    return $pdf->stream('comprobante_caja_'.$pdfName.'.pdf');
  }



  public static function getMonto($id)
  {
    $caja = Caja::find($id);
    $movimientosSum = DB::table('movimientos_caja')->where('caja_id', $id)->sum('monto');
    $array = [];
    if ($caja->monto_inicial > 0) {
      $movimientosSum += $caja->monto_inicial;
    }
    return $array = ['monto_final' => $movimientosSum, 'monto_inicial' => $caja->monto_inicial];

  }
  public static function store(Request $request): RedirectResponse
  {
    $registro = $request->all();
    if ($registro["tipo_movimiento"] == "Salida") {
      $registro["monto"] = $registro["monto"] * -1;
    }
    MovimientosCaja::create($registro);
    return redirect(route('caja.index'));
  }
}
