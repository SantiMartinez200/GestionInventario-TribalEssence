<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>comprobante_venta_{{$fecha}}</title>
</head>
<style>
  body {
    font-family: monospace;
  }

  .logo {
    width: 150px;
    height: 150px;
    position: absolute;
  }

  .header {
    margin-left: 50%;
    margin-top: 50px;
  }

  .footer {
    margin-left: 25px;
  }

  .bodyDiv {
    width: 100%;
    margin: 0 auto;
    margin-top: 40px;
  }

  .table {
    width: 100%;
    border-collapse: collapse;
    /* Elimina el espacio entre bordes de las celdas */
  }

  .table,
  .table th,
  .table td {
    border: 1px solid #000;
    /* Define el color del borde */
  }

  .table-header th {
    background-color: #f2f2f2;
    /* Color de fondo del encabezado */
    padding: 10px;
    /* Espaciado interno */
    text-align: center;
    /* Alineación del texto en el centro */
    font-weight: bold;
    /* Negrita para los encabezados */
  }

  .table-body td {
    padding: 8px;
    /* Espaciado interno */
    text-align: center;
    /* Alineación del texto en el centro */
  }

  .table tr:nth-child(even) {
    background-color: #f9f9f9;
    /* Color de fondo alternado para filas pares */
  }

  .table-header-b {
    background-color: #f2f2f2;
    /* Color de fondo del encabezado */
    padding: 10px;
    /* Espaciado interno */
    text-align: end;
    /* Alineación del texto en el centro */
    font-weight: bold;
    /* Negrita para los encabezados */
  }

  .container {
    background-color: #F5F7F8;
    width: 100% !important;
  }
</style>

<body>
  <div class="container">
    <img class="logo" src="{{ public_path('img/logo-tribal-essence.png') }}" alt="">
    <div class="header">
      <p><b>Comprobante de venta:</b>
        @if(count($comprobantes) > 0)
      {{$comprobantes[0]->id}}
    @else
      {{$comprobantes->id}}
      </p>
    @endif
      <div class="responsible">
        <b>Venta realizada por: </b></span>
      </div>
    </div>
    <div class="bodyDiv">
      <table class="table">
        <thead class="table-header">
          <tr>
            <th>Fecha y Hora:</th>
            <th>Producto</th>
            <th>Marca</th>
            <th>Aroma</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subt.</th>
          </tr>
        </thead>
        <tbody class="table-body">
          @forelse($comprobantes as $comprobante)
        <tr>
        <td>{{$comprobante->created_at}}</td>
        <td>{{$comprobante->nombre_producto}}</td>
        <td>{{$comprobante->nombre_marca}}</td>
        <td>{{$comprobante->nombre_aroma}}</td>
        <td>{{$comprobante->cantidad}}</td>
        <td>{{$comprobante->precio_venta}}</td>
        <td>{{$comprobante->subtotal}}</td>
        </tr>
      @empty

      <tr>
      <td colspan="3">No se pudo generar el comprobante.</td>
      </tr>
    @endforelse
          <tr>
            <td><b>Total:</b></td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>{{$total}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>