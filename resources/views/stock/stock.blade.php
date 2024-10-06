@extends('layouts.app')
@section('content')
@include('alerts.defaults')
<div class="modal fade" id="modalReingreso" tabindex="-1" role="dialog" aria-labelledby="modalReingresoLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalReingresoLabel">Modificar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body d-flex justify-content-center align-items-center">
      <form action="{{ route('updateCompraData') }}" method="POST" class="text-center">
        @csrf
        @method('POST')
        <input type="hidden" value="" name="compra_detalle_id">
        <label for="input_increment">Cantidad a incrementar</label><br>
        <input type="number" min="1" id="input_increment" name="cantidad" class="form-control mb-2" placeholder="Ingresa una cantidad">
        <small>Se registrará automáticamente el costo en caja.</small><br>
        <button type="submit" class="btn btn-primary mt-2">Agregar</button>
      </form>
    </div>

    </div>
  </div>
</div>
<div class="container">
  <div class="card ">
    <div class="card-header">
      <h3 class="h3">Stocks</h3>
    </div>
    <div class="card-body">
      <table class="table table-striped text-center">
        <thead>
          <tr>
            <th>Código Compra</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Aroma</th>
            <th>Proveedor</th>
            <th>Stock actualizado</th>
            <th>Ult. Actualiz.</th>
            <th>X</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($compraDetalles as $compraDetalle)
          @if(isset($compraDetalle->id) && !empty($compraDetalle->id))
        <tr>
        <td>{{$compraDetalle->id}}</td>
        <td>{{$compraDetalle->producto_nombre}}</td>
        <td>{{$compraDetalle->marca_nombre}}</td>
        <td>{{$compraDetalle->aroma_nombre}}</td>
        <td>{{$compraDetalle->proveedor_nombre}}</td>
        <td>{{$compraDetalle->cantidad}}</td>
        <td>{{$compraDetalle->updated_at}}</td>
        <td class="d-flex justify-content-center align-items-center ">
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#"
      title="Descargar historial">
      <i class="h3 bi bi-download"></i>
      </button> -->
        <div class="mx-1"></div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalReingreso"
        title="Ingresar más cantidades">
        <i class="h3 fas fa-plus"></i>
        </button>

        </td>
        </tr>
      @endif
      @empty
      <tr>
      <td colspan="9" class="text-danger">No hay Stock registrado</td>
      </tr>
    @endforelse
        </tbody>
      </table>
      {{$compraDetalles->links()}}
    </div>
  </div>
</div>

<script>

</script>
@endsection