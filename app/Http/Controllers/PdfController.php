<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\User;
use App\Http\Controllers\MovimientosCajaController;
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
    $datosAdicionales = ['caja_fecha' => date_format($caja->created_at, 'd/m/Y')];
    $pdfName = date_format($caja->created_at, 'Y-m-d');
    $pdf = Pdf::loadView('pdf.caja.registroscaja', ['movimientos' => $movimientos, 'datosAdicionales' => $datosAdicionales, 'montos' => $montos, 'caja' => $caja, 'user' => $user_name]);
    return $pdf->stream('comprobante_caja_' . $pdfName . '.pdf');
  }


  public function pdfVentaDetalle($id)
  {
    $comprobante = VentaDetalleController::findSalidas($id);
    $pdfName = date_format($comprobante[0]->created_at, 'Y-m-d');
    $pdf = Pdf::loadView('pdf.ventas.comprobanteindividual', ['comprobante' => $comprobante]);
    return $pdf->stream('comprobante_venta_' . $pdfName . '.pdf');
  }
}

