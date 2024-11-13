@extends('layouts.app')
@section('content')

<body>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="separator">
          <h1 class="h3">Ventas entre las fechas seleccionadas</h1>
        </div>

        <table class="table">
          <thead class="table-header">
            <tr>
              <th style="text-align: left;">Fecha vendido</th>
              <th style="text-align: left;">Producto</th>
              <th style="text-align: left;">Marca</th>
              <th style="text-align: left;">Aroma</th>
              <th style="text-align: right ;">Cantidad</th>
              <th style="text-align: right ;">Precio (U)</th>
            </tr>
          </thead>
          <tbody class="table-body">
            @forelse($comprobantes as $comprobante)
        <tr>
          <td class="text-left">{{ \Carbon\Carbon::parse(time: $comprobante->created_at)->format('d/m/Y H:i') }}
          </td>
          <td style="text-align: left;">{{$comprobante->nombre_producto}}</td>
          <td style="text-align: left;">{{$comprobante->nombre_marca}}</td>
          <td style="text-align: left;">{{$comprobante->nombre_aroma}}</td>
          <td style="text-align:right  ;">{{$comprobante->cantidad}}</td>
          <td style="text-align:right  ;">$ {{$comprobante->precio_venta}}</td>
        </tr>
      @empty

    <tr>
      <td colspan="3">No hay ventas en estas fechas.</td>
    </tr>
  @endforelse

          </tbody>
        </table>
      </div>
    </div>
  </div>

  @endsection