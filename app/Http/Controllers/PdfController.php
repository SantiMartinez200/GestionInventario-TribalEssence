<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Historial;
use App\Models\User;
use App\Http\Controllers\MovimientosCajaController;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Carbon\Carbon;
use DateTime;
use Hamcrest\Core\IsTypeOf;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
  public function pdfMovimientos($id) //para api
  {
    $caja = Caja::findOrFail($id);
    $user_name = User::where('id', '=', $caja->usuario_id)->get()[0]->name;
    $montos = MovimientosCajaController::getMonto($id);
    $movimientos = $caja->movimientos;
    $datosAdicionales = ['caja_fecha' => date_format($caja->created_at, 'd/m/Y'), 'caja_cierre' => date_format($caja->updated_at, 'd/m/Y')];
    foreach ($caja as $c) {
      
    }
    $pdfName = date_format($caja->created_at, 'Y-m-d');
    $pdf = Pdf::loadView('pdf.caja.registroscaja', ['movimientos' => $movimientos, 'datosAdicionales' => $datosAdicionales, 'montos' => $montos, 'caja' => $caja, 'user' => $user_name]);
    return $pdf->stream('comprobante_caja_' . $pdfName . '.pdf');
  }


  public function pdfVentaDetalle($id)
  {
    $comprobantes = VentaDetalleController::findSalidas($id)->toArray();
    $venta = VentaDetalle::with('venta')->where('venta_id', $id)->get();
    $venta = $venta[0]->venta;
    $responsable = User::find(id: Venta::find($comprobantes[0]->venta_id)->usuario_id)->name;
    //dd(gettype($comprobante));
    $pdfDate = new DateTime($comprobantes[0]->created_at);
    $dateFormat = date_format($pdfDate, 'd-m-Y');
    foreach ($comprobantes as $comprobante) {
      $comprobante->subtotal = ($comprobante->cantidad * $comprobante->precio_venta);
      $comprobante->created_at = date_format(new DateTime($comprobante->created_at), 'd/m/Y H:i');
      $comprobante->updated_at = date_format(new DateTime($comprobante->updated_at), 'd/m/Y H:i');

      //dd($comprobante->subtotal);
    }
    $total = 0;
    //dd($comprobantes);
    foreach ($comprobantes as $comprobante) {
      $total += $comprobante->subtotal;
    }
    $pdf = Pdf::loadView('pdf.ventas.comprobanteindividual', ['comprobantes' => $comprobantes, 'fecha' => $dateFormat, 'total' => $total, 'responsable' => $responsable, 'venta' => $venta]);
    return $pdf->stream('comprobante_venta_' . $dateFormat . '.pdf');
  }


  public static function getHistorial($id)
  {
    $historiales = Historial::where('compra_detalle_id', $id)->get();
    $pdf = Pdf::loadView('pdf.historial.comprobantehistorial', ['historiales' => $historiales]);
    return $pdf->stream('comprobante_historial_' . Carbon::now()->format('d-m-y') . '.pdf');
  }
}

