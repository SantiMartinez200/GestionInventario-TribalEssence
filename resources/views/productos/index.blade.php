@extends('layouts.app')
@section('content')
@include('alerts.defaults')

<div class="row justify-content-center mt-3">
  <div class="col-md-12">
    <!-- <div class="card mb-3">
      <div class="card-header">Filtros</div>
      <div class="card-body d-flex align-items-center justify-content-center">
        <form action="#" method="GET" class="">
          <select name="" id="">
            <option selected value="">Producto</option> Colocar el nombre del producto
            <label for=""></label>
          </select>
          <select name="" id="">
            <option selected value="">Aroma</option> Colocar nombre del aroma
            <label for=""></label>
          </select>
      </div>
    </div> -->

    <div class="card">
      <div class="card-header">Listado de productos</div>
      <div class="card-body">
        <a href="{{ route('productos.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
          Agregar Producto</a>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <!-- <th scope="col">Code</th> -->
              <th class="text-left"  scope="col">Producto</th>
              <th class="text-right"  scope="col">Precio al Costo</th>
              <th class="text-left"  scope="col">Descripción</th>
              {{-- <th class="text-"  scope="col">Agregado el</th>
              <th class="text-"  scope="col">Modificado el</th> --}}
              <th class="text-left"  scope="col">Acción</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($productos as $producto)
        <tr>
          <td class="text-left" >{{ $producto->nombre }}</td>
          <td class="text-right" >$ {{ $producto->precio_costo}}</td>
          <td class="text-left" >{{ $producto->descripcion }}</td>
          {{-- <td class="text-" >{{ $producto->created_at }}</td>
          <td class="text-" >{{ $producto->updated_at }}</td> --}}
          <td class="text-left" >
          <form action="{{ route('productos.destroy', $producto->id) }}" method="post">
            @csrf
            @method('DELETE')
            <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-warning btn-sm"><i
              class="bi bi-eye"></i> Ver</a>

            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary btn-sm"><i
              class="bi bi-pencil-square"></i> Editar</a>

            <button type="submit" class="btn btn-danger btn-sm"
            onclick="return confirm('¿Querés eliminar este producto? no hay vuelta atrás.');"><i
              class="bi bi-trash"></i> Eliminar</button>
          </form>
          </td>
        </tr>
      @empty
    <td colspan="7">
      <span class="text-danger">
      <strong>No hay productos!</strong>
      </span>
    </td>
  @endforelse
          </tbody>
        </table>

        {{ $productos->links() }}

      </div>
    </div>
  </div>
</div>

@endsection