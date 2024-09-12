<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

class ProductoController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): View
  {
    return view('productos.index', [
      'productos' => Producto::latest()->paginate(3)
    ]);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create(): View
  {
    return view('productos.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreProductoRequest $request): RedirectResponse
  {
    Producto::create($request->all());
    return redirect()->route('productos.index')
      ->withSuccess('Has añadido un nuevo producto correctamente.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Producto $producto): View
  {
    return view('productos.show', [
      'producto' => $producto
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Producto $producto): View
  {
    return view('productos.edit', [
      'producto' => $producto
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateProductoRequest $request, Producto $producto): RedirectResponse
  {
    $producto->update($request->all());
    return redirect()->back()
      ->withSuccess('Has modificado un producto correctamente.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Producto $producto): RedirectResponse
  {
    $producto->delete();
    return redirect()->route('productos.index')
      ->with('warning','Has eliminado el producto.');
  }

  public function precio($id)
  {
    $productResponse = Producto::find($id);
    return response()->json(['productoJson' => $productResponse]);
  }
}