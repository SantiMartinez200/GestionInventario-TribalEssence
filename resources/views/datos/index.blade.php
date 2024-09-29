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
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
  }

  .card .card-block {
    padding: 25px;
  }

  .order-card i {
    font-size: 26px;
  }

  .f-left {
    float: left;
  }

  .f-right {
    float: right;
  }

  h6 {
    font-weight: 600;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
  }

  .ask {
    font-size: 25px;
    background-color: #ffc107;
    border-radius: 100%;
    margin-bottom: 5px;
  }
</style>
<div class="container">
  <div class="d-flex justify-content-end"><button class="btn ask">?</button></div>
  <div class="row">
    <div class="col-md-4 col-xl-3">
      <div class="card bg-c-blue order-card">
        <div class="card-block">
          <h6 class="m-b-20">Productos Mas vendidos</h6>
          <div class="mt-3"></div>
          <table class="w-100">
            <th></th>
            <th></th>
            @foreach($cuentaProductosMasVendidos as $productosMasVendidos)
        <tr>
          <td>{{$productosMasVendidos->nombre}}</td>
          <td class="text-right">{{$productosMasVendidos->total_vendido}}</td>
        </tr>
      @endforeach
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-xl-3">
      <div class="card bg-c-green order-card">
        <div class="card-block">
          <h6 class="m-b-20">Productos Menos vendidos</h6>
          <div class="mt-3"></div>
          <table class="w-100">
            <th></th>
            <th></th>
            @foreach($cuentaProductosMenosVendidos as $productosMenosVendidos)
        <tr>
          <td>{{$productosMenosVendidos->nombre}}</td>
          <td class="text-right">{{$productosMenosVendidos->total_vendido}}</td>
        </tr>
      @endforeach
          </table>
        </div>
      </div>
    </div>


    <div class="col-md-4 col-xl-3">
      <div class="card bg-c-yellow order-card">
        <div class="card-block">
          <h6 class="m-b-20">Productos con más cantidades</h6>
          <div class="mt-3"></div>
          <table class="w-100">
            <th></th>
            <th></th>
            @foreach($top as $key => $top3Mayor)
        <tr>
          @if($key != 'vacios')
        <td>{{$top3Mayor->producto_nombre}}</td>
        <td class="text-right">{{$top3Mayor->cantidad}}</td>
      @endif
        </tr>
      @endforeach
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-xl-3">
      <div class="card bg-c-pink order-card">
        <div class="card-block">
          <h6 class="m-b-20">Productos sin cantidades</h6>
          <div class="mt-3"></div>
          <table class="w-100">
            <th></th>
            <th></th>
            @foreach($top as $key => $top3Mayor)
        @if($key == 'vacios')
      @foreach($top3Mayor as $reg)
      <tr>
      <td>{{$reg->producto_nombre}}</td>
      <td class="text-right">{{date_format($reg->updated_at, 'd/m/Y')}}</td>
      </tr>
    @endforeach
    @endif
      @endforeach
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
    <canvas id="bar" class="bar">

    </canvas>
  </div>
  <div class="col-12 my-3"></div>
  <div class="col-8 border d-flex justify-content-center">
    <canvas id="cake" class="cake">

    </canvas>
  </div>

  <input type="text" class="hidden" id="ingresosNetos" value="{{$ingresosNetos['ingresosNetos']}}">
  <input type="text" class="hidden" id="porcentajeCosto" value="{{$ingresosNetos['porcentajeCostos']}}">
  <input type="text" class="hidden" id="porcentajeGanancia" value="{{$ingresosNetos['porcentajeGanancias']}}">

</div>
<script>
  var bar = document.getElementById('bar');
  var cake = document.getElementById('cake');
  document.addEventListener("DOMContentLoaded", () => {
    fetch('/ventas-semanales')
      .then(response => response.json())
      .then(data => {
        const ctx = document.getElementById('bar');
        new Chart(ctx, {
          type: 'bar',
          data: data,
          options: {
            scales: {
              x: {
                stacked: true,
              },
              y: {
                stacked: true,
              }
            },
            responsive: true,
            plugins: {
              legend: {
                position: 'top',
              },
              title: {
                display: true,
                text: 'Ventas semanales por Producto'
              }
            }
          }
        });
      })
      .catch(error => console.error('Error al cargar los datos:', error));


    // Crear un nuevo gráfico tipo "doughnut" con datos simulados
    let profit = document.getElementById('porcentajeGanancia').value;
    let nonstonks = document.getElementById('porcentajeCosto').value;
    new Chart(cake, {

      type: 'doughnut', // Tipo de gráfico
      data: {
        labels: ['costos', 'ganancias'], // Etiquetas para cada segmento
        datasets: [{
          label: 'Porcentaje', // Etiqueta del gráfico
          data: [nonstonks, profit], // Datos simulados (porcentaje o cantidad)
          backgroundColor: [ // Colores para cada segmento
            'rgba(255, 99, 132, 0.7)',
            'rgba(75, 192, 192, 0.7)',
          ],
          borderColor: [ // Colores del borde de cada segmento
            '#000000',
            '#000000',
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Proporcion costo/ganancia%', // This is the title of the chart
            font: {
              size: 20
            },
            padding: {
              top: 10,
              bottom: 30
            }
          },
          legend: {
            position: 'top', // Posición de la leyenda
          },
          tooltip: {
            enabled: true // Mostrar tooltips al pasar el ratón
          }
        }
      }
    });
  });
</script>
@endsection