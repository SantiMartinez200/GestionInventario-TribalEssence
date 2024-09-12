@extends('layouts.app')

@section('content')

<div class="row justify-content-center mt-3">
  <div class="col-md-8">

    <div class="card">
      <div class="card-header">
        <div class="float-start">
          Agregar Marca
        </div>
        <div class="float-end">
          <a href="{{ route('marcas.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('marcas.store') }}" method="post">
          @csrf

          <div class="mb-3 row">
            <label for="nombre" class="col-md-4 col-form-label text-md-end text-start">Nombre</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre"
                value="{{ old('nombre') }}">
              @if ($errors->has('nombre'))
          <span class="text-danger">{{ $errors->first('nombre') }}</span>
        @endif
            </div>
          </div>

          

          <div class="mb-3 row">
            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Agregar Marca">
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection