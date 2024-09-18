<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aroma;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreAromaRequest;
use App\Http\Requests\UpdateAromaRequest;

class AromaController extends Controller
{
  public function index(): View
  {
    return view('aromas.index', [
      'aromas' => Aroma::latest()->paginate(Auth::user()->paginado)
    ]);
  }
  public function create(): View
  {
    return view('aromas.create');
  }
  public function store(StoreAromaRequest $request): RedirectResponse
  {
    Aroma::create($request->all());
    return redirect()->route('aromas.index')
      ->withSuccess('Has añadido un nuevo aroma correctamente.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Aroma $aroma): View
  {
    return view('aromas.show', [
      'aroma' => $aroma
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Aroma $aroma): View
  {
    return view('aromas.edit', [
      'aroma' => $aroma
    ]);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateAromaRequest $request, Aroma $aroma): RedirectResponse
  {
    $aroma->update($request->all());
    return redirect()->back()
      ->withSuccess('Has modificado un aroma correctamente.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Aroma $aroma): RedirectResponse
  {
    $aroma->delete();
    return redirect()->route('aromas.index')
      ->with('warning', 'Has eliminado el aroma.');
  }
}