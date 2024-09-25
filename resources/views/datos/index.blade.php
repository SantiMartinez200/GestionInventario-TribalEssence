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
<div class="card mt-5"><div class="card-header">('Histograma de ventas a lo largo de la semana aquí')</div></div>
@endsection