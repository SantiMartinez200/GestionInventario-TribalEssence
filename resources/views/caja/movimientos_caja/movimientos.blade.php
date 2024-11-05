@extends('layouts.app')
@section('content')
<style>
  .bolder {
    font-size: 14px;
  }
</style>
<div class="card w-100" id="card" tabindex="-1" role="dialog">
  <div class="">
    <div class="card-header">
      <h5 class="h5">Movimientos de Caja <span id="fecha-caja">{{$datosAdicionales["caja_fecha"]}}</span></h5>
      <br>
      <h5 class="form-control bolder" id="h5Inicial"><b>Monto Inicial: </b><span
          id="monto-inicial"></span>{{$montos["monto_inicial"]}}</h5>
    </div>
    <div class="card-body">
      <table class="table table-bordered" id="movimientosTable">
        <thead id="table-head">
          <tr>
            <th>Fecha Movimiento</th>
            <th>Descripción</th>
            <th>Monto</th>
            <th>Tipo de Movimiento</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($movimientos as $movimiento)
        <tr>
        <td>{{$movimiento->created_at->format('Y/m/d H:i')}}</td>
        <td>{{$movimiento->descripcion}}</td>
        <td>{{$movimiento->monto}}</td>
        <td>{{$movimiento->tipo_movimiento}}</td>
        </tr>
      @empty
      <td colspan="3"><span class="text text-danger">
        No se registran Movimientos para la caja</span></td>
    @endforelse
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      <h5 class="form-control mb-2 bolder" id="h5Monto"><b>Monto total actualizado: </b><span
          id="monto-final">{{$montos["monto_final"]}}</span></h5>
      @if(count($movimientos) > 0)
      <a href="{{route('pdf-caja', $movimientos[0]->caja_id)}}" id="link" type="button" class="btn btn-danger"
      style="font-size: 30px;"><i class="bi bi-filetype-pdf"></i></a>
    @else
      <a href="{{route('pdf-caja', $caja->id)}}" id="link" type="button" class="btn btn-danger"
      style="font-size: 30px;"><i class="bi bi-filetype-pdf"></i></a>
    @endif
    </div>
  </div>
</div>
@endsection