@extends('layouts.app')
@section('content')

<div class="card">
  <div class="card-header">
    <h2>Cajas</h2>
  </div>
  <div class="card-body">
    
    <div class="container">
      <table class="table table-bordered mt-4 text-center">
        <thead>
          <tr>
            <th>ID de caja</th>
            <th>Estado</th>
            <th>Abierta Por</th>
            <th>Fecha abierta</th>
            <th>Fecha Cierre</th>
            <th>Movimientos</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($cajas as $caja)
      <tr>
      <td>{{$caja->id}}</td>
      <td>{{$caja->estado}}</td>
      <td>{{$caja->usuario_id}}</td>
      <td>{{$caja->created_at}}</td>
      <td>@if(!$caja->fecha_cierre)
          N/D
        @else
        {{$caja->fecha_cierre}}
    @endif
      </td>
      <td><a href="{{route('caja.movimientos', $caja->id)}}"><button type="button" class="btn btn-primary">Ver
        Movimientos
        </button></a></td>
      </tr>
      @endforeach
        </tbody>
      </table>
    </div>
    {{$cajas->links()}}
  </div>
</div>
@endsection