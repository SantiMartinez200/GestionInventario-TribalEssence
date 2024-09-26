@extends('layouts.app')
@section('content')
@include('alerts.defaults')
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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#decrementar-stock"
        title="Imprimir historial">
        <i class="h3 bi bi-printer"></i>
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
    </div>
  </div>
</div>


@endsection
<!-- <script>
  let botonModal = document.querySelectorAll('[data-target="#modalRegistrarMovimiento"]');
  botonModal.forEach(btn => {
    btn.addEventListener('click', function () {
      // Obtener columnas desde TR padre:
      let tds = this.closest('tr').querySelectorAll('td');
      // Obtener ID desde el botón
      let id = this.dataset.id;
      // Asignar datos a ventana modal:
      document.querySelector('#caja_id').value = id;
      //document.querySelector('#estudiante').value = nombre;
      //document.querySelector('#cedula').value = cedula;
      console.log('abrir modal');
      $('#modalGenerarMovimiento').modal();
    });
  });
</script> -->