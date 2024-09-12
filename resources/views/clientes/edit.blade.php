@extends('layouts.app')
@section('content')
@include('alerts.defaults')

<div class="row justify-content-center mt-3">
  <div class="col-md-8">


    <div class="card">
      <div class="card-header">
        <div class="float-start">
          Editar cliente
        </div>
        <div class="float-end">
          <a href="{{ route('clientes.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('clientes.update', $cliente->id) }}" method="post">
          @csrf
          @method("PUT")
          <div class="mb-3 row">
            <label for="dni" class="col-md-4 col-form-label text-md-end text-start">DNI</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni"
                value="{{ $cliente->dni }}">
              @if ($errors->has('dni'))
          <span class="text-danger">{{ $errors->first('dni') }}</span>
      @endif
            </div>
          </div>
          <div class="mb-3 row">
            <label for="nombre" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"
                value="{{ $cliente->nombre }}">
              @if ($errors->has('nombre'))
          <span class="text-danger">{{ $errors->first('nombre') }}</span>
        @endif
            </div>
          </div>

          <div class="mb-3 row">
            <label for="apellido" class="col-md-4 col-form-label text-md-end text-start">Apellido</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido"
                name="apellido" value="{{ $cliente->apellido }}">
              @if ($errors->has('apellido'))
          <span class="text-danger">{{ $errors->first('apellido') }}</span>
        @endif
            </div>
          </div>

          <div class="mb-3 row">
            <label for="telefono" class="col-md-4 col-form-label text-md-end text-start">Telefono</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                name="telefono" value="{{ $cliente->telefono }}">
              @if ($errors->has('telefono'))
          <span class="text-danger">{{ $errors->first('telefono') }}</span>
        @endif
            </div>
          </div>

          <div class="mb-3 row">
            <label for="direccion_calle" class="col-md-4 col-form-label text-md-end text-start">Calle</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('direccion_calle') is-invalid @enderror"
                id="direccion_calle" name="direccion_calle" value="{{ $cliente->direccion_calle }}">
              @if ($errors->has('direccion_calle'))
          <span class="text-danger">{{ $errors->first('direccion_calle') }}</span>
        @endif
            </div>
          </div>

          <div class="mb-3 row">
            <label for="direccion_numero" class="col-md-4 col-form-label text-md-end text-start">N° de Calle</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('direccion_numero') is-invalid @enderror"
                id="direccion_numero" name="direccion_numero" value="{{ $cliente->direccion_numero }}">
              @if ($errors->has('direccion_numero'))
          <span class="text-danger">{{ $errors->first('direccion_numero') }}</span>
        @endif
            </div>
          </div>
          <div class="mb-3 row">
            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Actualizar cliente">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection