@extends('layouts.app')
@section('content')

<div class="row justify-content-center mt-3">
  <div class="col-md-8">

    <div class="card">
      <div class="card-header">
        <div class="float-start">
          Agregar Forma de Venta
        </div>
        <div class="float-end">
          <a href="{{ route('condiciones-de-ventas.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('condiciones-de-ventas.store') }}" method="post">
          @csrf

          <div class="mb-3 row">
            <label for="condicion" class="col-md-4 col-form-label text-md-end text-start">condicion</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('condicion') is-invalid @enderror" id="condicion" name="condicion"
                value="{{ old('condicion') }}">
              @if ($errors->has('condicion'))
          <span class="text-danger">{{ $errors->first('condicion') }}</span>
        @endif
            </div>
          </div>
          <div class="mb-3 row">
            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Agregar Forma de Venta">
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection