@extends('layouts.app')
@section('content')

<div class="row justify-content-center mt-3">
  <div class="col-md-8">

    <div class="card">
      <div class="card-header">
        <div class="float-start">
          Información del producto
        </div>
        <div class="float-end">
          <a href="{{ route('productos.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
        </div>
      </div>
      <div class="card-body">
        <div class="row d-flex align-items-center">
          <label for="codigo" class="col-md-4 col-form-label text-md-end text-start"><strong>Codigo:</strong></label>
          <div class="col-md-6" style="line-height: 35px;">
            {{ $producto->codigo }}
          </div>
        </div>


        <div class="row d-flex align-items-center">
          <label for="nombre" class="col-md-4 col-form-label text-md-end text-start"><strong>Nombre:</strong></label>
          <div class="col-md-6" style="line-height: 35px;">
            {{ $producto->nombre }}
          </div>
        </div>

        <div class="row d-flex align-items-center">
          <label for="condicion_venta_id" class="col-md-4 col-form-label text-md-end text-start"><strong>¿Cómo se
              vende?:</strong></label> <!-- Agregar relacion -->
          <div class="col-md-6" style="line-height: 35px;">
            {{ $producto->condicion_venta_id }}
          </div>
        </div>

        <div class="row d-flex align-items-center">
          <label for="aroma_id" class="col-md-4 col-form-label text-md-end text-start"><strong>Aroma:</strong></label>
          <!-- Agregar relacion -->
          <div class="col-md-6" style="line-height: 35px;">
            {{ $producto->aroma_id }}
          </div>
        </div>

        <div class="row d-flex align-items-center">
          <label for="precio_costo" class="col-md-4 col-form-label text-md-end text-start"><strong>Precio al
              Costo:</strong></label>
          <!-- Agregar relacion -->
          <div class="col-md-6" style="line-height: 35px;">
            {{ $producto->precio_costo }}
          </div>
        </div>

        <div class="row d-flex align-items-center">
          <label for="descripcion"
            class="col-md-4 col-form-label text-md-end text-start"><strong>Descripcion:</strong></label>
          <div class="col-md-6" style="line-height: 35px;">
            {{ $producto->descripcion }}
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection