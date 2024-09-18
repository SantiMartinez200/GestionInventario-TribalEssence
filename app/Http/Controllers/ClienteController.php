<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;

class ClienteController extends Controller
{
  public function index(): View
  {
    return view('clientes.index', [
      'clientes' => Cliente::latest()->paginate(Auth::user()->paginado)
    ]);
  }
  public function create(): View
  {
    return view('clientes.create');
  }
  public function store(StoreClienteRequest $request): RedirectResponse
  {
    Cliente::create($request->all());
    return redirect()->route('clientes.index')
      ->withSuccess('Has añadido un nuevo Cliente correctamente.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Cliente $cliente): View
  {
    return view('clientes.show', [
      'cliente' => $cliente
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Cliente $cliente): View
  {
    return view('clientes.edit', [
      'cliente' => $cliente
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateClienteRequest $request, Cliente $cliente): RedirectResponse
  {
    $cliente->update($request->all());
    return redirect()->back()
      ->withSuccess('Has modificado un Cliente correctamente.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Cliente $cliente): RedirectResponse
  {
    $cliente->delete();
    return redirect()->route('clientes.index')
      ->with('warning', 'Has eliminado el Cliente.');
  }
}
