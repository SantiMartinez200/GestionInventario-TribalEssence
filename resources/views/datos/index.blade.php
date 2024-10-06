@extends('layouts.app')

@section('content')
@include('alerts.defaults')

<style>
  .bar {
    max-width: 800px;
    max-height: 500px;
  }

  canvas.bar {
    max-width: 800px;
  }

  .cake {
    max-width: 400px;
    max-height: 280px;
  }

  .order-card {
    color: #fff;
  }

  .bg-c-blue {
    background: linear-gradient(45deg, #4099ff, #73b4ff);
  }

  .bg-c-green {
    background: linear-gradient(45deg, #2ed8b6, #59e0c5);
  }

  .bg-c-yellow {
    background: linear-gradient(45deg, #FFB64D, #ffcb80);
  }

  .bg-c-pink {
    background: linear-gradient(45deg, #FF5370, #ff869a);
  }

  .card {
    border-radius: 5px;
    box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
    border: none;
    margin-bottom: 30px;
    transition: all 0.3s ease-in-out;
  }

  .card .card-block {
    padding: 25px;
  }

  .order-card i {
    font-size: 26px;
  }

  h6 {
    font-weight: 600;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
  }
</style>

<div class="container">
  <div class="row">

    <div class="col-md-4 col-xl-3">
      <div class="card bg-c-blue order-card">
        <div class="card-block">
          <h6 class="m-b-20">Productos Más Vendidos</h6>
          <table class="w-100 mt-3">
            <thead>
              <tr>
                <th>Prod.</th>
                <th>Marca</th>
                <th>Cant.</th>
              </tr>
            </thead>
            <tbody>
              @forelse($cuentaProductosMasVendidos as $productosMasVendidos)
          <tr>
          <td>{{ $productosMasVendidos->producto }}</td>
          <td>{{ $productosMasVendidos->marca }}</td>
          <td class="text-right">{{ $productosMasVendidos->total_vendido }}</td>
          </tr>
        @empty
        <tr>
        <td colspan="3">No se han vendido productos.</td>
        </tr>
      @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-xl-3">
      <div class="card bg-c-green order-card">
        <div class="card-block">
          <h6 class="m-b-20">Productos Menos Vendidos</h6>
          <table class="w-100 mt-3">
            <thead>
              <tr>
                <th>Prod.</th>
                <th>Marca</th>
                <th>Cant.</th>
              </tr>
            </thead>
            <tbody>
              @forelse($cuentaProductosMenosVendidos as $productosMenosVendidos)
          <tr>
          <td>{{ $productosMenosVendidos->producto }}</td>
          <td>{{ $productosMenosVendidos->marca }}</td>
          <td class="text-right">{{ $productosMenosVendidos->total_vendido }}</td>
          </tr>
        @empty
        <tr>
        <td colspan="3">No se han vendido productos.</td>
        </tr>
      @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

  <div class="col-md-4 col-xl-3">
    <div class="card bg-c-yellow order-card">
      <div class="card-block">
        <h6 class="m-b-20">Productos con Más Cantidades</h6>
        <table class="w-100 mt-3">
          <thead>
            <tr>
              <th>Prod.</th>
              <th>Marca</th>
              <th>Cant.</th>
            </tr>
          </thead>
          <tbody>
            @forelse($top as $key => $top3Mayor)
            @if($key != 'vacios')
            <tr>
            <td>{{ $top3Mayor->producto_nombre }}</td>
            <td>{{ $top3Mayor->marca_nombre }}</td>
            <td class="text-right">{{ $top3Mayor->cantidad }}</td>
            </tr>
          @endif
      @empty
    <tr>
      <td colspan="3">No se han vendido productos.</td>
    </tr>
  @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <div class="col-md-4 col-xl-3">
    <div class="card bg-c-pink order-card">
      <div class="card-block">
        <h6 class="m-b-20">Productos Sin Cantidades</h6>
        <table class="w-100 mt-3">
          <thead>
            <tr>
              <th>Prod.</th>
              <th>Marca</th>
              <th>Fecha</th>
            </tr>
          </thead>
          <tbody>
            @if(isset($top['vacios']) && count($top['vacios']) > 0)
        @foreach($top['vacios'] as $reg)
      <tr>
        <td>{{ $reg->producto_nombre }}</td>
        <td>{{ $reg->marca_nombre }}</td>
        <td class="text-right">{{ date_format($reg->updated_at, 'd/m/Y') }}</td>
      </tr>
    @endforeach
      @else
    <tr>
      <td colspan="3">No hay productos sin stock.</td>
    </tr>
  @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>



  </div>
</div>

<hr class="m-1">

<div class="mb-1"></div>
<div class="row d-flex justify-content-center mt-5">
  <div class="barContainer col-8 border">
    <canvas id="bar" class="bar"></canvas>
  </div>
  <div class="col-12 my-3"></div>
  <div class="col-8 border d-flex justify-content-center">
    <canvas id="cake" class="cake"></canvas>
  </div>
  <div class="col-12 my-3"></div>
  <div class="col-8 border d-flex justify-content-center">
    <canvas class="cake" id="cakeProduct"></canvas>
  </div>
  <input type="text" class="hidden" id="ventasPorMarca" value="{{ $ventasPorMarca }}">
  <input type="text" class="hidden" id="ventasPorProductoInput" value="{{ $ventasPorProducto }}">
</div>

<script src="{{ asset('js/graficos.js') }}"></script>
@endsection