<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>comprobante_caja_{{$datosAdicionales["caja_fecha"]}}</title>
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
  }

  .footer {
    margin-left: 25px;
  }

  .bodyDiv {
    width: 100%;
    margin: 0 auto;
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
  }
</style>

<body>
  <div class="container">
    <img class="logo" src="{{ public_path('img/logo-tribal-essence.png') }}" alt="">
    <div class="header">
      <p><b>Comprobante de la Caja:</b>
        @if(count($movimientos) > 0)
      {{$movimientos[0]->caja_id}}
    @else
      {{$caja->id}}
      </p>
    @endif
      <p><b>Fecha apertura:</b> {{$datosAdicionales["caja_fecha"]}}</p>
      <p><b>Fecha cierre:</b> {{$datosAdicionales["caja_cierre"]}}</p>
      <div class="responsible">
        <b>Caja abierta por: </b>{{$user}}</span>
      </div>
      <p>
        <b>Monto al inicio del período:</b> {{$montos["monto_inicial"]}}
      </p>
    </div>
    <div class="bodyDiv">
      <table class="table">
        <thead class="table-header">
          <tr>
            <th>Fecha Movimiento</th>
            <th>Descripcion</th>
            <th style="width: 70px;">Monto</th>
          </tr>
        </thead>
        <tbody class="table-body">
          @forelse($movimientos as $movimiento)
        <tr>
        <td>{{date_format($movimiento->created_at, 'd/m/Y H:i')}}</td>
        <td>{{$movimiento->descripcion}}</td>
        <td>{{$movimiento->monto}}</td>
        </tr>
      @empty
      <tr>
      <td colspan="3">No se registran Movimientos para la caja</td>
      </tr>
    @endforelse
        </tbody>
      </table>
    </div>
    <div class="footer">
      <h3>Monto Final: {{$montos["monto_final"]}}</h3>
    </div>
  </div>
</body>

</html>