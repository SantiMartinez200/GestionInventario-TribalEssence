@extends('layouts.app')
@section('content')

<div class="card">
  <table class="table table-striped text-center">
    <thead>
      <th class="text-right ">Código Compra</th>
      <th class="text-left  ">Producto</th>
      <th class="text-left  ">Marca</th>
      <th class="text-left  ">Aroma</th>
      <th class="text-left  ">Proveedor</th>
      <th class="text-right ">Precio al costo $</th>
      <th class="text-right ">Stock actualizado</th>
      <th class="text-center">Ult. Actualiz.</th>

    </thead>
    <tbody>
      @forelse ($compraDetalles as $compraDetalle)
      @if(isset($compraDetalle->id) && !empty($compraDetalle->id))

      <tr>
      <td class="text-right compra_detalle_id">{{$compraDetalle->id}}</td>
      <td class="text-left  nombre_producto">{{$compraDetalle->producto_nombre}}</td>
      <td class="text-left  nombre_marca">{{$compraDetalle->marca_nombre}}</td>
      <td class="text-left  nombre_aroma">{{$compraDetalle->aroma_nombre}}</td>
      <td class="text-left  nombre_proveedor">{{$compraDetalle->proveedor_nombre}}</td>
      <td class="text-right precio_costo costo">{{$compraDetalle->precio_costo}}</td>
      @if($compraDetalle->cantidad > 0)
      <td class="text-right stock">{{$compraDetalle->cantidad}}</td>
    @else
      <td class="text-right text-danger stock">{{$compraDetalle->cantidad}}</td>
    @endif
      <td class="text-right ">{{$compraDetalle->updated_at->format('d/m/Y H:i')}}</td>
      <td class="d-flex justify-content-center align-items-center ">
      <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#"
      title="Descargar historial">
      <i class="h3 bi bi-download"></i>
      </button> -->

      </a>

      </td>
      </tr>
    @endif
    @empty
      <tr>
      <td colspan="9" class="text-danger">No hay Stock registrado</td>
      </tr>
    @endforelse
    </tbody>
  </table>
</div>

@endsection