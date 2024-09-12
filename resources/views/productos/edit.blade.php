@extends('layouts.app')
@section('content')
@include('alerts.defaults')

<div class="row justify-content-center mt-3">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <div class="float-start">
          Editar Producto
        </div>
        <div class="float-end">
          <a href="{{ route('productos.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('productos.update', $producto->id) }}" method="post">
          @csrf
          @method("PUT")

          <div class="mb-3 row">
            <label for="nombre" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"
                value="{{ $producto->nombre }}">
              @if ($errors->has('nombre'))
          <span class="text-danger">{{ $errors->first('nombre') }}</span>
        @endif
            </div>
          </div>

          <div class="mb-3 row">
            <label for="codigo" class="col-md-4 col-form-label text-md-end text-start">codigo</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('codigo') is-invalid @enderror" id="codigo" name="codigo"
                value="{{ $producto->nombre }}">
              @if ($errors->has('codigo'))
          <span class="text-danger">{{ $errors->first('codigo') }}</span>
        @endif
            </div>
          </div>

          <div class="mb-3 row">
            <label for="aroma_id" class="col-md-4 col-form-label text-md-end text-start">Aroma</label>
            <div class="col-md-6">
              <input type="number" class="form-control @error('aroma_id') is-invalid @enderror" id="aroma_id"
                name="aroma_id" value="{{ $producto->aroma_id }}">
              @if ($errors->has('aroma_id'))
          <span class="text-danger">{{ $errors->first('aroma_id') }}</span>
        @endif
            </div>
          </div>

          <div class="mb-3 row">
            <label for="condicion_venta_id" class="col-md-4 col-form-label text-md-end text-start">¿Cómo se
              vende?</label>
            <div class="col-md-6">
              <select class="form-control @error('condicion_venta_id') is-invalid @enderror" id="condicion_venta_id"
                name="condicion_venta_id" value="{{ old('condicion_venta_id') }}">
                <option selected value="{{$producto->condicion_venta_id}}">{{$producto->condicion_venta_id}}</option>
                <!--Traer opcion cargada-->
                <option value="1">Unitario</option> <!--Traer opciones de la BD-->
                <option value="2">Suelto</option> <!--Traer opciones de la BD-->
              </select>
              @if ($errors->has('condicion_venta_id'))
          <span class="text-danger">{{ $errors->first('condicion_venta_id') }}</span>
        @endif
            </div>
          </div>

          <div class="mb-3 row">
            <label for="descripcion" class="col-md-4 col-form-label text-md-end text-start">Descripcion</label>
            <div class="col-md-6">
              <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion"
                name="descripcion">{{ $producto->descripcion }}</textarea>
              @if ($errors->has('descripcion'))
          <span class="text-danger">{{ $errors->first('descripcion') }}</span>
        @endif
            </div>
          </div>

          <div class="mb-3 row">
            <label for="precio_costo" class="col-md-4 col-form-label text-md-end text-start">Precio al Costo</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('precio_costo') is-invalid @enderror" id="precio_costo" name="precio_costo"
                value="{{ $producto->precio_costo }}">
              @if ($errors->has('precio_costo'))
          <span class="text-danger">{{ $errors->first('precio_costo') }}</span>
      @endif
            </div>
          </div>

          <div class="mb-3 row">
            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Actualizar Producto">
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection