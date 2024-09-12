<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreMarcaRequest;
use App\Http\Requests\UpdateMarcaRequest;

class marcaController extends Controller
{
  public function index(): View
  {
    return view('marcas.index', [
      'marcas' => marca::latest()->paginate(3)
    ]);
  }
  public function create(): View
  {
    return view('marcas.create');
  }
  public function store(StoreMarcaRequest $request): RedirectResponse
  {
    marca::create($request->all());
    return redirect()->route('marcas.index')
      ->withSuccess('Has añadido una nueva marca correctamente.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Marca $marca): View
  {
    return view('marcas.show', [
      'marca' => $marca
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Marca $marca): View
  {
    return view('marcas.edit', [
      'marca' => $marca
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateMarcaRequest $request, Marca $marca): RedirectResponse
  {
    $marca->update($request->all());
    return redirect()->back()
      ->withSuccess('Has modificado una marca correctamente.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(marca $marca): RedirectResponse
  {
    $marca->delete();
    return redirect()->route('marcas.index')
      ->with('warning', 'Has eliminado la marca.');
  }
}