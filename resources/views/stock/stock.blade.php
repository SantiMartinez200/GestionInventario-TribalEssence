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
        <form action="{{ route('sumarStock') }}" method="POST" class="text-center">
          @csrf
          @method('POST')
          <input type="hidden" value="" name="stock" id="stock">
          <input type="hidden" value="" name="nombre_producto" id="nombre_producto">
          <label for="compra_detalle_id">Registro afectado</label>
          <input type="number" value="" name="compra_detalle_id" id="compra_detalle_id" readonly
            class="form-control mb-2">
          <label for="costo">Costo</label>
          <input type="number" value="" name="costo" id="costo" readonly class="form-control mb-2">
          <label for="input_increment">Cantidad a incrementar</label><br>
          <input required type="number" min="1" id="input_increment" name="cantidad" class="form-control mb-2"
            placeholder="Ingresa una cantidad" min="1" max="1000000">
          <label for="costo_calculado">Costo calculado</label>
          <input type="text" min="1" id="costo_calculado" name="costo_calculado" class="form-control mb-2"
            placeholder="Precio Calculado" min="1" max="1000000" readonly>
          <small>Se registrará automáticamente el costo en caja.</small><br>
          <small>Se verán afectadas las existencias iniciales.</small><br>
          <button type="submit" id="apply" class="btn btn-primary mt-2">Agregar</button>
          <div id="aviso"></div>
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
            <th class="text-right ">Código Compra</th>
            <th class="text-left  ">Producto</th>
            <th class="text-left  ">Marca</th>
            <th class="text-left  ">Aroma</th>
            <th class="text-left  ">Proveedor</th>
            <th class="text-right ">Precio al costo $</th>
            <th class="text-right ">Stock actualizado</th>
            <th class="text-center">Ult. Actualiz.</th>
            <th class="text-right ">Acción</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($compraDetalles as $compraDetalle)
          @if(isset($compraDetalle->id) && !empty($compraDetalle->id))

        <tr>
        <td class="text-right compra_detalle_id">{{$compraDetalle->id}}</td>
        <td class="text-left  nombre_producto">{{$compraDetalle->producto_nombre}}</td>
        <td class="text-left  nombre_marca">{{$compraDetalle->marca_nombre}}</td>
        <td class="text-left  nombre_aroma">{{$compraDetalle->aroma_nombre}}</td>
        <td class="text-left  nombre_proveedor">{{$compraDetalle->proveedor_nombre}}</td>
        <td class="text-right precio_costo costo">{{$compraDetalle->precio_costo}}</td>
        @if($compraDetalle->cantidad > 0)
      <td class="text-right stock">{{$compraDetalle->cantidad}}</td>
    @else
    <td class="text-right text-danger stock">{{$compraDetalle->cantidad}}</td>
  @endif
        <td class="text-right ">{{$compraDetalle->updated_at->format('d/m/Y H:i')}}</td>
        <td class="d-flex justify-content-center align-items-center ">
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#"
      title="Descargar historial">
      <i class="h3 bi bi-download"></i>
      </button> -->
        <div class="mx-1"></div>
        <button type="button" id="movimiento" class="btn btn-success sumar" data-toggle="modal"
        data-target="#modalReingreso" title="Ingresar más cantidades">
        <i class="h3 fas fa-plus"></i>
        </button>
        <div class="mx-1"></div>
        <a class="btn btn-secondary" title="Revisar Historial" href="{{route('historial', $compraDetalle->id)}}">
        <i class="h3 fas fa-history"></i>
        </a>

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


<script src="{{asset('js/verifyCajaOpen.js')}}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {

    const botonesSumar = document.querySelectorAll('.sumar');
    const input_costo_calculado = document.getElementById('costo_calculado');


    botonesSumar.forEach(function (boton) {
      boton.addEventListener('click', function () {
        let row = this.closest('tr');
        console.log(row);

        let td_compra_detalle = row.querySelector('.compra_detalle_id').textContent;
        let td_precio = row.querySelector('.precio_costo').textContent;
        console.log(td_precio);

        let td_stock = row.querySelector('.stock').textContent;
        let td_nombre_producto = row.querySelector('.nombre_producto').textContent;
        //console.log(td_compra_detalle, td_precio, td_stock, td_nombre_producto);

        let input_id = document.getElementById('compra_detalle_id')
        input_id.value = td_compra_detalle;

        let input_precio = document.getElementById('costo');
        //console.log(input_precio);

        input_precio.value = td_precio;


        let input_stock = document.getElementById('stock');
        input_stock.value = td_stock;

        let input_nombre_producto = document.getElementById('nombre_producto');
        input_nombre_producto.value = td_nombre_producto;

        //console.log(td_compra_detalle, td_precio);

        const input_cantidad = document.getElementById('input_increment');
        input_cantidad.addEventListener('input', () => {
          let calc = td_precio * input_cantidad.value;
          if (!isNaN(calc)) {
            input_costo_calculado.value = calc;
          }
        })

        const btn_close = document.querySelector('.close').addEventListener('click', () => {
          input_cantidad.value = '';
          input_costo_calculado.value = '';
        })
        window.addEventListener('click', function (event) {
          const modal = document.getElementById('modalReingreso');
          if (event.target == modal) {
            input_cantidad.value = '';
            input_costo_calculado.value = '';
          }
        });
      });
    });


  });
</script>
@endsection