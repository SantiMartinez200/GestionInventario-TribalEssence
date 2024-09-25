@extends('layouts.app')
@section('content')
@include('alerts.defaults')

<style>
  /* CSS personalizado para ajustar los tamaños de las columnas */
  select {
    appearance: none;
  }

  .min-width {
    min-width: 80px;
    max-width: 130px;
  }

  input[type="number"]::-webkit-inner-spin-button,
  input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  .small-width {
    width: 60px;
  }

  select,
  input[type="number"],
  input[type="text"] {
    max-width: 100%;
    padding: 0.25rem;
  }
</style>
</head>
<div class="container-fluid">
  <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
    <form action="{{route('storeVentaDetalle')}}" method="POST" autocomplete="off">
      @csrf
      <div class="card-header mt-3 text-center"><h3 class="h5">Seleccionar Cliente y método de pago</h3>
        <div class="d-flex justify-content-center align-items-center">
          <select name="cliente_id" id="" class="w-25 mr-2 form-control">
            <option value="" selected>Cliente</option>
            @foreach($clientes as $cliente)
                <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
            @endforeach
          </select>
          <select name="metodo_pago_id" id="" class="w-25 ml-2 form-control">
            <option value="" selected>Método de pago</option>
            @foreach($metodos as $metodo)
                <option value="{{$metodo->id}}">{{$metodo->nombre}}</option>
            @endforeach
          </select>

        </div>
      </div>
      <table class="table table-striped text-center">
        <thead>
          <tr>
            <th scope="col">X</th>
            <th scope="col" class="small-width">Nom. Producto</th>
            <th scope="col">Marca</th>
            <th scope="col">Producto</th>
            <th scope="col">Aroma</th>
            <th scope="col" class="small-width">Stock</th>
            <th scope="col" class="small-width">Precio <br> de Venta</th>
            <th scope="col" class="small-width">C/Venta</th>
          </tr>
        </thead>
        <tbody id="tbody">
          <tr class="template-row">
            <td>
              <button type="button" class="btn" onclick="eliminarFila(this)" tabindex="-1">
                <i class="bi bi-bag-x" style="font-size: 2rem; color: red;"></i>
              </button>
            </td>
            <td class="small-width">
              <input type="text" name="search[]" id="compra-select" class="">
              <div id="fetch" class="fetch block">
                <ul class="text-start ulSuggest" style="width:500px;" id="ulSuggest" hidden></ul>
              </div>
            </td>
            <td class="hidden">
              <select type="text" name="compra-select[]" class="form-control form-control" tabindex="-1" id="compra">

              </select>
            </td>
            <td class="min-width" hidden>
              <select type="text" name="proveedor[]" class="form-control form-control" tabindex="-1" id="proveedor">

              </select>
            </td>
            <td class="min-width">
              <select type="text" name="marca[]" class="form-control form-control" readonly tabindex="-1" id="marca">

              </select>
            </td>
            <td class="min-width">
              <select type="text" name="producto[]" class="form-control form-control" tabindex="-1" readonly
                id="producto">

              </select>
            </td>
            <td class="min-width">
              <select type="text" name="aroma[]" class="form-control form-control" tabindex="-1" readonly id="aroma">

              </select>
            </td>
            <td class="small-width">
              <input type="number" name="stock[]" class="form-control form-control" tabindex="-1" readonly id="stock">
            </td>
            <td class="min-width">
              <input type="number" name="precio[]" class="form-control form-control" tabindex="-1" id="precio" readonly>
            </td>
            <td class="small-width">
              <input type="number" name="cantidad[]" class="form-control form-control" pattern="^[0-9]" min="1">
            </td>
          </tr>
        </tbody>
      </table>
      <div class="form-group">
        <button type="button" class="btn btn-primary mr-2" onclick="agregarFila()" id="agregar">Agregar Fila</button>
        <input type="submit" value="Venta Nueva" class="btn btn-success" id="guardar">
        <div class="container" id="">
          <div class="d-flex align-items-center mt-2">
            <p id="handle" class="text text-danger" hidden></p>
            <label class="mt-2" for="total-compra" id="total-compraLabel" hidden>TOTAL: </label>
            <input type="number" name="total-compra" id="total-compra" value=""
              class="form-control form-control-sm w-25 ml-1" hidden>
          </div>
        </div>
      </div>
    </form>
  </div>

  <div class="card shadow p-3 rounded">
    <div class="card-header rounded">
      <h3 class="h3">Ventas Realizadas</h3>
    </div>
    <div class="card-body">
      <table class="table table-responsive text-center">
        <thead>
          <th>Caja Afectada</th>
          <th>Fecha Venta</th>
          <th>Usuario</th>
          <th>Total $</th>
          <th>Comprobante</th>
        </thead>
        <tbody id="bodyTabla">
          @forelse($ventas as $venta)
        <tr>
        <td>{{$venta->caja_id}}</td>
        <td>{{$venta->created_at}}</td>
        <td>{{$venta->name}}</td>
        <td>{{$venta->total}}</td>
        <td>
          <a href="{{route('comprobantes', $venta->id)}}">
          <button class="btn btn-danger">
            <i class="bi bi-filetype-pdf h2"></i>
          </button>
          </a>
        </td>
        </tr>
      @empty
      <tr>
      <td colspan="5">No hay ventas registradas</td>
      </tr>
    @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="{{asset('js/ventas.js')}}"></script>


@endsection