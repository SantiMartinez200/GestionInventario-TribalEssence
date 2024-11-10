@extends('layouts.app')
@section('content')

<div class="row justify-content-center mt-3">
  <div class="col-md-8">

    <div class="card">
      <div class="card-header">
        <div class="float-start">
          Agregar nuevo producto
        </div>
        <div class="float-end">
          <a href="{{ route('productos.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('productos.store') }}" method="post">
          @csrf

          <div class="mb-3 row">
            <label for="nombre" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
            <div class="col-md-6">
              <input required type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                name="nombre" value="{{ old('nombre') }}">
              @if ($errors->has('nombre'))
          <span class="text-danger">{{ $errors->first('nombre') }}</span>
        @endif
            </div>
          </div>

          <!-- <div class="mb-3 row">
            <label for="codigo" class="col-md-4 col-form-label text-md-end text-start">Codigo</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('codigo') is-invalid @enderror" id="codigo" name="codigo"
                value="{{ old('codigo') }}">
              @if ($errors->has('codigo'))
          <span class="text-danger">{{ $errors->first('codigo') }}</span>
        @endif
            </div>
          </div> -->

          <div class="mb-3 row">
            <label for="precio_costo" class="col-md-4 col-form-label text-md-end text-start">Precio al Costo</label>
            <div class="col-md-6">
              <input required type="number" class="form-control @error('precio_costo') is-invalid @enderror"
                id="precio_costo" name="precio_costo" value="{{ old('precio_costo') }}">
              @if ($errors->has('precio_costo'))
          <span class="text-danger">{{ $errors->first('precio_costo') }}</span>
        @endif
            </div>
          </div>

          <div class="mb-3 row">
            <label for="descripcion" class="col-md-4 col-form-label text-md-end text-start">Descripcion</label>
            <div class="col-md-6">
              <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion"
                name="descripcion">{{ old('descripcion') }}</textarea>
              @if ($errors->has('descripcion'))
          <span class="text-danger">{{ $errors->first('descripcion') }}</span>
        @endif
            </div>
          </div>

          <div class="mb-3 row">
            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Agregar Producto">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection