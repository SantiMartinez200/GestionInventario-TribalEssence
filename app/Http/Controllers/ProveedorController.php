<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreProveedorRequest;
use App\Http\Requests\UpdateProveedorRequest;

class ProveedorController extends Controller
{
  public function index(): View
  {
    return view('proveedores.index', [
      'proveedores' => Proveedor::latest()->paginate(3)
    ]);
  }
  public function create(): View
  {
    return view('proveedores.create');
  }
  public function store(StoreProveedorRequest $request): RedirectResponse
  {
    Proveedor::create($request->all());
    return redirect()->route('proveedores.index')
      ->withSuccess('Has añadido un nuevo proveedor correctamente.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Proveedor $proveedor): View
  {
    return view('proveedores.show', [
      'proveedor' => $proveedor
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Proveedor $proveedor): View
  {
    return view('proveedores.edit', [
      'proveedor' => $proveedor
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateProveedorRequest $request, Proveedor $proveedor): RedirectResponse
  {
    $proveedor->update($request->all());
    return redirect()->back()
      ->withSuccess('Has modificado un proveedor correctamente.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Proveedor $proveedor): RedirectResponse
  {
    $proveedor->delete();
    return redirect()->route('proveedores.index')
      ->with('warning', 'Has eliminado el proveedor.');
  }
}
