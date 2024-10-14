@extends('layouts.app')
@section('content')
@include('alerts.defaults')
@include('modals.modify-stock')
<!-- Modal Structure -->
<div class="modal fade" id="modalRegistrarMovimiento" tabindex="-1" role="dialog"
  aria-labelledby="modalRegistrarMovimientoLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRegistrarMovimientoLabel">Formulario de Ingreso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex align-items-center justify-content-center">
        <form action="{{ route('storeCompraData') }}" method="POST">
          @csrf
          @method('POST')
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="marca">Marca</label>
                <select name="marca_id" id="marca" class="form-control">
                  <option value="N/E" selected>Seleccione</option>
                  @foreach ($marcas as $marca)
            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
          @endforeach
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="proveedor">Proveedor</label>
                <select name="proveedor_id" id="proveedor" class="form-control">
                  <option value="N/E" selected>Seleccione</option>
                  @foreach ($proveedores as $proveedor)
            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
          @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="producto_id">Producto</label>
                <select name="producto_id" onchange="fetchURL(this)" id="producto_id" class="form-control">
                  <option value="N/E" selected>Seleccione</option>
                  @foreach ($productos as $producto)
            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
          @endforeach
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="aroma">Aroma</label>
                <select name="aroma_id" id="aroma" class="form-control">
                  <option value="N/E" selected>Seleccione</option>
                  @foreach ($aromas as $aroma)
            <option value="{{ $aroma->id }}">{{ $aroma->nombre }}</option>
          @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="precio_costo">Costo</label>
                <input type="text" name="precio_costo" id="precio_costo" class="form-control">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="cantidad">Existencia Inicial</label>
                <input type="number" name="cantidad" id="cantidad" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="porcentaje_ganancia">Porcentaje de ganancia</label>
                <input type="number" name="porcentaje_ganancia" id="porcentaje_ganancia" class="form-control">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="precio_venta">Precio de venta (C/U)</label>
                <input type="text" name="precio_venta" id="precio_venta" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="stock_minimo">Notificación de stock mínimo:</label>
                <input type="number" name="stock_minimo" id="stock_minimo" class="form-control"
                  placeholder="Expresar en cantidades">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-2">Aplicar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="buttonsDiv ">
    <button id="movimiento" type="button" class="mb-4 btn btn-success btn-movimiento" data-toggle="modal"
      data-target="#modalRegistrarMovimiento" title="ingreso nuevo">
      <i class="h3 fas fa-plus-circle"></i>
    </button>

    

  </div>
  <div class="card ">
    <div class="card-header">
      <h3 class="h3">Compras</h3>
    </div>
    <div class="card-body">
      <table class="table table-striped text-center">
        <thead>
          <tr>
            <th class="text-right" >Código Compra</th>
            <th class="text-left"  >Producto</th>
            <th class="text-left"  >Marca</th>
            <th class="text-left"  >Aroma</th>
            <th class="text-left"  >Proveedor</th>
            <th class="text-right" >Precio</th>
            <th class="text-right" >Existencias iniciales</th>
            <th class="text-center">Ult. Actualiz.</th>
            <th class=text-right>Acción</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($compraDetalles as $compraDetalle)
        @if(isset($compraDetalle->id) && !empty($compraDetalle->id))
      <tr>
      <td class="text-right" >{{$compraDetalle->id}}</td>
      <td class="text-left"  >{{$compraDetalle->producto_nombre}}</td>
      <td class="text-left"  >{{$compraDetalle->marca_nombre}}</td>
      <td class="text-left"  >{{$compraDetalle->aroma_nombre}}</td>
      <td class="text-left"  >{{$compraDetalle->proveedor_nombre}}</td>
      <td class="text-right" >{{$compraDetalle->precio_costo}}</td>
      <td class="text-right" >{{$compraDetalle->cantidad}}</td>
      <td class="text-center">{{date_format($compraDetalle->updated_at,'d/m/Y H:i')}}</td>
      <td class="d-flex justify-content-end align-items-center ">
        <button id="movimiento" type="button" class="btn btn-primary btn-movimiento" data-toggle="modal"
        title="Modificar" data-target="#modalModificar"
        onclick="getData({{$compraDetalle->id}},{{$compraDetalle->cantidad}})">
        <i class="h3 bi bi-pencil-square"></i>
        </button>
      </td>
      </tr>
    @endif
      @empty
      <tr>
      <td colspan="9" class="text-danger">No hay ingresos realizados</td>
      </tr>
    @endforelse
        </tbody>
      </table>
      {{$compraDetalles->links()}}
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


<script src="{{asset('js/compras.js')}}"></script>
<script src="{{asset('js/modificaciones.js')}}"></script>