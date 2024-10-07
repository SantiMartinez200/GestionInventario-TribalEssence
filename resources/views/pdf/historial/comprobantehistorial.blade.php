<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Historial</title>
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
    margin-top: 80px;
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

  .separator {
    text-align: center;
    border: 1px solid;
    letter-spacing: 2px;
  }

  .separator.center {
    text-align: left;
    padding: 5px;
  }
</style>

<body>
  <div class="container">
    <img class="logo" src="{{ public_path('img/logo-tribal-essence.png') }}" alt="">
    <div class="header">
      <p><b>Historial de compra N°:</b>
        {{$historiales[0]->compra_detalle_id}}
      </p>
    </div>
    <table class="table">
      <thead class="table-header">
        <tr>
          <th>Descripcion</th>
          <th>Cantidad Movida</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody class="table-body">
        @forelse($historiales as $historial)
      <tr>
        <td>{{$historial->descripcion}}</td>
        <td>{{$historial->cantidad_movida}}</td>
        <td>{{$historial->created_at}}</td>
      </tr>
    @empty
    <tr>
      <td>No hay un historial registrado</td>
      <td></td>
      <td></td>
    </tr>
  @endforelse
      </tbody>
    </table>
  </div>
</body>

</html>