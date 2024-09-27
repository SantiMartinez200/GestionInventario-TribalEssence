@extends('layouts.app')
@section('content')
@include('alerts.defaults')

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
<div class="row">
  <div class="col-6">
    <canvas id="bar"  width="400" height="400">

    </canvas>
  </div>
  <div class="col-6">
    <canvas id="cake" width="400" height="400">

    </canvas>
  </div>
</div>

<script>
  var bar = document.getElementById('bar');
  var cake = document.getElementById('cake');
  document.addEventListener("DOMContentLoaded", () => {
    new Chart(bar, {
      type: 'bar',
      data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
          label: '# of Votes',
          data: [12, 19, 3, 5, 2, 3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
    // Crear un nuevo gráfico tipo "doughnut" con datos simulados
    new Chart(cake, {
      type: 'doughnut',  // Tipo de gráfico
      data: {
        labels: ['Chocolate', 'Vanilla', 'Strawberry', 'Lemon', 'Red Velvet'],  // Etiquetas para cada segmento
        datasets: [{
          label: 'Cake Flavors',  // Etiqueta del gráfico
          data: [30, 20, 15, 10, 25],  // Datos simulados (porcentaje o cantidad)
          backgroundColor: [  // Colores para cada segmento
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)'
          ],
          borderColor: [  // Colores del borde de cada segmento
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top',  // Posición de la leyenda
          },
          tooltip: {
            enabled: true  // Mostrar tooltips al pasar el ratón
          }
        }
      }
    });
  });
</script>
@endsection