<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MetodoPago;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreMetodoPagoRequest;
use App\Http\Requests\UpdateMetodoPagoRequest;


class MetodoPagoController extends Controller
{
  public function index(): View
  {
    return view('metodos-de-pago.index', [
      'metodo_pagos' => MetodoPago::latest()->paginate(3)
    ]);
  }
  public function create(): View
  {
    return view('metodos-de-pago.create');
  }
  public function store(StoreMetodoPagoRequest $request): RedirectResponse
  {
    MetodoPago::create($request->all());
    return redirect()->route('metodo_pagos.index')
      ->withSuccess('Has añadido un nuevo método de pago correctamente.');
  }

  /**
   * Display the specified resource.
   */
  public function show(MetodoPago $metodo_pago): View
  {
    return view('metodos-de-pago.show', [
      'metodo' => $metodo_pago
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(MetodoPago $metodo_pago): View
  {
    return view('metodos-de-pago.edit', [
      'metodo' => $metodo_pago
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateMetodoPagoRequest $request, MetodoPago $metodo_pago): RedirectResponse
  {
    $metodo_pago->update($request->all());
    return redirect()->back()
      ->withSuccess('Has modificado un método de pago correctamente.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(MetodoPago $metodo_pago): RedirectResponse
  {
    $metodo_pago->delete();
    return redirect()->route('metodo_pagos.index')
      ->with('warning', 'Has eliminado el método de pago.');
  }
}
