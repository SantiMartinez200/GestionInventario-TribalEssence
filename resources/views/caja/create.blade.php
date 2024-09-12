@extends('layouts.app')
@section('content')

<div class="row justify-content-center mt-3">
  <div class="col-md-8">

    <div class="card">
      <div class="card-header d-grid">
        <div class="float-start">
          Agregar caja inicial
        </div>
        <div class="d-flex justify-content-end">
          <a href="{{ route('caja.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
        </div>
      </div>
      <div class="card-body">
        <form action="{{ route('caja.store') }}" method="post">
          @csrf

          <div class="mb-3 row">
            <label for="monto_inicial" class="col-md-4 col-form-label text-md-end text-start">Monto</label>
            <div class="col-md-6">
              <input type="text" class="form-control @error('monto_inicial') is-invalid @enderror" id="monto_inicial"
                name="monto_inicial" value="{{ old('monto_inicial') }}">
              @if ($errors->has('monto_inicial'))
          <span class="text-danger">{{ $errors->first('monto_inicial') }}</span>
        @endif
            </div>
          </div>



          <div class="mb-3 row">
            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Agregar caja inicial">
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection