<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovimientosCajaController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrosCajaController;
use App\Http\Controllers\ReingresoAjusteController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\VentaDetalleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AromaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CondicionVentaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\CompraDetalleController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovimientoController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

//use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::Post('create-user', UserController::Class); //Ruta externa a middleware auth

Route::get('/', function () {
  return redirect()->route('dashboard');
});

// Route::get('/dashboard', function () {
//   return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::resource('productos', ProductoController::class);
  Route::get('producto-precio/{producto}', [ProductoController::class, 'precio'])->name('producto.precio');

  Route::resource('clientes', ClienteController::class);
  Route::resource('aromas', AromaController::class);
  Route::resource('marcas', MarcaController::class);
  Route::resource('proveedores', ProveedorController::class)->parameters(['proveedores' => 'proveedor']); //////?????????ruta bug que requiere ser redeclarada por las convenciones.
  Route::resource('metodo_pagos', MetodoPagoController::class)->parameters(['metodo_pagos' => 'metodo_pago']);

  Route::resource('caja', CajaController::class);
  Route::post('storeMovimientoCaja', [MovimientosCajaController::class, 'store'])->name('storeMovimiento');

  Route::post('storeCompraData', [CompraDetalleController::class, 'store'])->name('storeCompraData');
  Route::patch('updateCompraData', [CompraDetalleController::class, 'update'])->name('updateCompraData');


  Route::get('compras', [CompraDetalleController::class, 'index'])->name('compras');
  Route::get('buscar-entrada/{search}', [CompraDetalleController::class, 'findEntrada'])->name('buscar-entrada');

  Route::get('vender', [VentaDetalleController::class, 'index'])->name('vender');
  Route::post('storeVentaDetalle', [VentaDetalleController::class, 'store'])->name('storeVentaDetalle');
  Route::get('ventas', [VentaDetalleController::class, 'getVentas'])->name('ventas');
  Route::get('comprobantes/{id}', [VentaDetalleController::class, 'findsalidas'])->name('comprobantes');

  Route::get('login', [LoginController::class, 'vista']);
  Route::post('autenticacion', [LoginController::class, 'autenticacion'])->name('login.autenticacion');


  Route::get('movimientos', [MovimientosCajaController::class, 'index'])->name('movimientos');


  Route::get('caja/{id}/movimientos', [MovimientosCajaController::class, 'getMovimientos'])->name('caja.movimientos');
  Route::get('caja/{id}/monto', [MovimientosCajaController::class, 'getMonto']);
  Route::get('caja/{id}/cerrar', [CajaController::class, 'close'])->name('caja.close');

  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


  Route::get('stock', [StockController::class, 'index'])->name('stock');
  Route::get('calculateThisStock/{id}', [StockController::class, 'calculateThisStock'])->name('calcuateThisStock');


  Route::get('pdf-caja/{id}', [PdfController::class, 'pdfMovimientos'])->name('pdf-caja');


  Route::get('findEntradaById/{id}', [CompraDetalleController::class, 'findEntradaById'])->name('findEntradaById');
});


// route::get('getCompraData', [VentaDetalleController::class, 'getCompraData'])->name('getCompraData');
require __DIR__ . '/auth.php';

