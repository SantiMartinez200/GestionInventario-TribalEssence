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
</style>

<div class="container ">
  <div class="row">
    <div class="col-3">
      <!-- existencias totales  -->
      <div class="row w-75 infobox bg-teal" id="">
        <div class="col-sm-8 p-2 rounded" style="background-color:#C80036">
          <h3 class="text-white">Productos con mayor cantidad:</h3>
          <p>(p1)</p>
          <p>(p2)</p>
          <p>(p3)</p>
        </div>
        <div class="col-sm-4 d-flex justify-content-center p-2 rounded" style="background-color:#0C1844">
          <i class="bi bi-bag-plus-fill icon"></i>
        </div>
      </div>
    </div>
    <div class="col-3">
      <!-- existencias vendidas -->
      <div class="row w-75 infobox bg-teal" id="">
        <div class="col-sm-8 p-2 rounded" style="background-color:#C80036">
          <h3 class="text-white">Productos más vendidos:</h3>
          <p>p1</p>
          <p>p2</p>
          <p>p3</p>
        </div>
        <div class="col-sm-4 d-flex justify-content-center p-2 rounded" style="background-color:#0C1844">
          <i class="bi bi-currency-dollar icon"></i>
        </div>
      </div>
    </div>
    <div class="col-3">
      <!-- existencias actuales -->
      <div class="row w-75 infobox bg-teal" id="">
        <div class="col-sm-8 p-2 rounded" style="background-color:#C80036">
          <h3 class="text-white">Productos menos vendidos:</h3>
          <p>p1</p>
          <p>p2</p>
          <p>p3</p>
        </div>
        <div class="col-sm-4 d-flex justify-content-center p-2 rounded" style="background-color:#0C1844">
          <i class="bi bi-currency-dollar icon"><span class="">-</span></i>
        </div>
      </div>
    </div>
    <div class="col-3">
      <!-- existencias totales  -->
      <div class="row w-75 infobox bg-teal" id="">
        <div class="col-sm-8 p-2 rounded" style="background-color:#C80036">
          <h3 class="text-white">Productos con menor cantidad:</h3>
          <p>p1</p>
          <p>p2</p>
          <p>p3</p>
        </div>
        <div class="col-sm-4 d-flex justify-content-center p-2 rounded" style="background-color:#0C1844">
          <i class="bi bi-bag-dash-fill icon"></i>
        </div>
      </div>
    </div>
  </div>
</div>
<hr class="m-5">
<div class="row d-flex justify-content-center">
  <div class="barContainer col-8 border">
    <canvas id="bar" class="bar">

    </canvas>
  </div>
  <div class="col-12 my-5"></div>
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