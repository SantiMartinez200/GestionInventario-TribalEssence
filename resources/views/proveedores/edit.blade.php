@extends('layouts.app')
@section('content')

<div class="row justify-content-center mt-3">
  <div class="col-md-8">

    @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
      {{ $message }}
    </div>
  @endif

    <div class="card">
      <div class="card-header">
        <div class="float-start">
          Editar Proveedor
        </div>
        <div class="float-end">
          <a href="{{ route('proveedores.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('proveedores.update', $proveedor->id) }}" method="post">
          @csrf
          @method("PUT")

          <div class="mb-3 row">
            <label for="nombre" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
            <div class="col-md-6">
              <input required type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"
                name="nombre" value="{{ $proveedor->nombre }}">
              @if ($errors->has('nombre'))
          <span class="text-danger">{{ $errors->first('nombre') }}</span>
        @endif
            </div>
          </div>

          <div class="mb-3 row">
            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Actualizar Proveedor">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection