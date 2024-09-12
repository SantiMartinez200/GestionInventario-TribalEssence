@extends('layouts.app')
@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Información del aroma
                </div>
                <div class="float-end">
                    <a href="{{ route('aromas.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">

                    <div class="row d-flex align-items-center">
                        <label for="nombre" class="col-md-4 col-form-label text-md-end text-start"><strong>Nombre:</strong></label>
                        <div class="col-md-6" style="line-height: 35px;">
                            {{ $aroma->nombre }}
                        </div>
                    </div>
            </div>
        </div>
    </div>    
</div>
    
@endsection