@extends('layouts.app')
@section('content')
@include('alerts.defaults')

<div class="container d-grid">
  <div class="row">
    <div class="col">
      <!-- existencias totales  -->
      <div class="row w-75 infobox bg-teal" id="">
        <div class="col-sm-8 p-2 rounded" style="background-color:#C80036">
          <h3 class="text-white">Gastos Mercadería:</h3>
          <h1>{{$gastosCompras}}</h1>
        </div>
        <div class="col-sm-4 d-flex justify-content-center p-2 rounded" style="background-color:#0C1844">
          <i class="bi bi-cart-check-fill icon"></i>
        </div>
      </div>
    </div>
    <div class="col">
      <!-- existencias totales  -->
      <div class="row w-75 infobox bg-teal" id="">
        <div class="col-sm-8 p-2 rounded" style="background-color:#C80036">
          <h3 class="text-white">Ingresos en Bruto:</h3>
          <h1>{{$ingresosBrutos}}</h1>
        </div>
        <div class="col-sm-4 d-flex justify-content-center p-2 rounded" style="background-color:#0C1844">
          <i class="bi bi-wallet2 icon"></i>
        </div>
      </div>
    </div>
    <div class="col">
      <!-- existencias totales  -->
      <div class="row w-75 infobox bg-teal" id="">
        <div class="col-sm-8 p-2 rounded" style="background-color:#C80036">
          <h3 class="text-white">Ingresos en Neto:</h3>
          <h1>{{$ingresosNetos}}</h1>
        </div>
        <div class="col-sm-4 d-flex justify-content-center p-2 rounded" style="background-color:#0C1844">
          <i class="bi bi-currency-dollar icon"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="row m-3"></div>
  <div class="row">
    <div class="col">
      <!-- existencias totales  -->
      <div class="row w-75 infobox bg-teal" id="">
        <div class="col-sm-8 p-2 rounded" style="background-color:#C80036">
          <h3 class="text-white">Existencias totales:</h3>
          <h1>{{$existenciasTotales}}</h1>
        </div>
        <div class="col-sm-4 d-flex justify-content-center p-2 rounded" style="background-color:#0C1844">
          <i class="bi bi-bag-plus-fill icon"></i>
        </div>
      </div>
    </div>
    <div class="col">
      <!-- existencias vendidas -->
      <div class="row w-75 infobox bg-teal" id="">
        <div class="col-sm-8 p-2 rounded" style="background-color:#C80036">
          <h3 class="text-white">Existencias Vendidas:</h3>
          <h1>{{$existenciasVendidas}}</h1>
        </div>
        <div class="col-sm-4 d-flex justify-content-center p-2 rounded" style="background-color:#0C1844">
          <i class="bi bi-bag-dash-fill icon"></i>
        </div>
      </div>
    </div>
    <div class="col">
      <!-- existencias actuales -->
      <div class="row w-75 infobox bg-teal" id="">
        <div class="col-sm-8 p-2 rounded" style="background-color:#C80036">
          <h3 class="text-white">Existencias actuales:</h3>
          <h1>{{$existenciasActuales}}</h1>
        </div>
        <div class="col-sm-4 d-flex justify-content-center p-2 rounded" style="background-color:#0C1844">
          <i class="bi bi-bag-check-fill icon"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="row m-3"></div>
  <div class="row">
    <div class="col">
      <!-- existencias totales  -->
      <div class="row w-75 infobox bg-teal" id="">
        <div class="col-sm-8 p-2 rounded" style="background-color:#C80036">
          <h3 class="text-white">Gastos Extras:</h3>
          <h1>["ElGastoExtra"]</h1>
        </div>
        <div class="col-sm-4 d-flex justify-content-center p-2 rounded" style="background-color:#0C1844">
          <i class="bi bi-exclamation-circle icon"></i>
        </div>
      </div>
    </div>
    <div class="col">
      <!-- existencias totales  -->
      <div class="row w-75 infobox bg-teal" id="">
        <div class="col-sm-8 p-2 rounded" style="background-color:#C80036">
          <h3 class="text-white">Ingresos Extras:</h3>
          <h1>["ElIngresoExtra"]</h1>
        </div>
        <div class="col-sm-4 d-flex justify-content-center p-2 rounded" style="background-color:#0C1844">
          <i class="bi bi-rocket-takeoff-fill icon"></i>
        </div>
      </div>
    </div>
    <div class="col">
      <!-- existencias totales  -->
      <div class="row w-75 infobox bg-teal" id="">
        <div class="col-sm-8 p-2 rounded" style="background-color:#C80036">
          <h3 class="text-white">Vendedor Destacado:</h3>
          <h1>["ElVendedorDestacado"]</h1>
        </div>
        <div class="col-sm-4 d-flex justify-content-center p-2 rounded" style="background-color:#0C1844">
          <i class="bi bi-person-heart icon"></i>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection