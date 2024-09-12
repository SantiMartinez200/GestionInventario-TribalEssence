@extends('layouts.app')
@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Información de la Forma de Venta
                </div>
                <div class="float-end">
                    <a href="{{ route('condiciones-de-ventas.index') }}" class="btn btn-primary btn-sm">&larr; Volver</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="row d-flex align-items-center">
                        <label for="code" class="col-md-4 col-form-label text-md-end text-start"><strong>Condicion:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $condiciones_de_venta->condicion }}
                        </div>
                    </div>        
            </div>
        </div>
    </div>    
</div>
@endsection