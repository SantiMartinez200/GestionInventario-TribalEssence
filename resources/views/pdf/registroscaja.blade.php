<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>
<style>
  body {
    font-family: monospace;
  }

  .container {
    min-width: 415px;
    max-width: 75%;
    border: 1px solid;
    border-color: #808d7c;
    margin: 0 auto;
  }

  .header {
    display: flex;
    justify-content: space-between;
    background-color: #5f6f65;
    text-align: center;
    border: 1px solid;
    padding: 0.5rem;
  }

  .footer {
    background-color: #5f6f65;
  }

  img,
  .title,
  .amount {
    min-width: 100px;
  }

  img {
    margin: 0 auto;
    width: 100px;
    height: 100px;
  }

  .amount-span {
    font-size: 3rem;
  }

  .title {
    margin-top: auto;
    margin-bottom: auto;
  }

  .body,
  .footer {
    border: 2px solid;
  }

  .title,
  .amount {
    font-size: 18px;
    font-weight: 500;
    color: #ffffff;
  }

  .title-content,
  .amount-span {
    font-weight: 500;
  }

  .title,
  .title-content {
    padding-left: 0.5rem;
  }

  .body {
    display: grid;
    grid-template-columns: 1fr;
    text-align: center;
  }

  table {
    width: 100%;
    border: 1px solid;
    border-collapse: collapse;
  }

  th,
  tr,
  td {
    font-size: 15px;
    border: 1px solid;
    padding: 8px;
    text-align: center;
  }

  .grid-item {
    font-size: 14px;
    font-weight: 700;
    border: 1px solid;
    word-wrap: break-word;
  }

  .responsible {
    margin: 2px;
  }

  .amount {
    text-align: end;
  }

  .footer {
    text-align: end;
    padding: 0.5rem;
  }
</style>

<body>
  <div class="header">
    <div class="logo"><img src="{{ public_path('img/logo-tribal-essence-white.jpg') }}" alt="" /></div>

    <div class="title">
      Comprobante de la Caja <br /><span class="title-content">
        @if(count($movimientos) > 0)
      {{$movimientos[0]->caja_id}}
    @else
    {{$caja->id}}
  @endif
      </span>
      <br />
      <span class="title">Al</span> <br /><span class="title-content">{{$datosAdicionales["caja_fecha"]}}</span>
      <div class="responsible">
        Caja abierta por:<span class="title-content">Brago</span>
      </div>
    </div>
    <div class="amount">
      Monto al inicio del período: <br /><span class="amount-span">{{$montos["monto_inicial"]}}</span>
    </div>
  </div>
  <div class="body">
    <table>
      <thead>
        <th>Descripcion</th>
        <th>Monto</th>
        <th>Tipo de Movimiento</th>
      </thead>
      <tbody>
        @forelse($movimientos as $movimiento)
      <tr>
        <td>{{$movimiento->descripcion}}</td>
        <td>{{$movimiento->monto}}</td>
        <td>{{$movimiento->tipo_movimiento}}</td>
      </tr>
    @empty
    <tr>
      <td>
      No se registran Movimientos para la caja
      </td>
      <td>0</td>
      <td>N/D</td>
    </tr>
  @endforelse
      </tbody>
    </table>
  </div>
  <div class="footer">
    <div class="title">
      <div>
        <h3>Monto Final: {{$montos["monto_final"]}}</h3>
      </div>
    </div>
  </div>
</body>

</html>