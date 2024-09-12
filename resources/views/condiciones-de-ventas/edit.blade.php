@extends('layouts.app')
@section('content')
@include('alerts.defaults')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Editar Forma de Venta
                </div>
                <div class="float-end">
                    <a href="{{ route('condiciones-de-ventas.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('condiciones-de-ventas.update', $condiciones_de_venta->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="condicion" class="col-md-4 col-form-label text-md-end text-start">Condicion</label>
                        <div class="col-md-6">
                          <input type="text" class="form-control @error('condicion') is-invalid @enderror" id="condicion" name="condicion" value="{{ $condiciones_de_venta->condicion }}">
                            @if ($errors->has('condicion'))
                                <span class="text-danger">{{ $errors->first('condicion') }}</span>
                            @endif
                        </div>
                    </div>
              
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Actualizar Forma de Venta">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection