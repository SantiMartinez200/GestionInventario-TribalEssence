@extends('layouts.app')
@section('content')
@include('alerts.defaults')

<div class="row justify-content-center mt-3">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">Listado de Métodos de pago</div>
      <div class="card-body">
        <a href="{{ route('metodo_pagos.create') }}" class="btn btn-success btn-sm my-2"><i
            class="bi bi-plus-circle"></i>
          Agregar Método</a>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Agregado el</th>
              <th scope="col">Modificado el</th>
            </tr>
          </thead>
          <tbody>
            
            @forelse ($metodo_pagos as $metodo)
        <tr>
          <td>{{ $metodo->nombre }}</td>
          <td>{{ $metodo->created_at }}</td>
          <td>{{ $metodo->updated_at }}</td>
          <td>
          <form action="{{ route('metodo_pagos.destroy', $metodo->id) }}" method="post">
          @csrf
          @method('DELETE')

          <a href="{{ route('metodo_pagos.show', $metodo->id) }}" class="btn btn-warning btn-sm"><i
          class="bi bi-eye"></i> Ver</a>

          <a href="{{ route('metodo_pagos.edit', $metodo->id) }}" class="btn btn-primary btn-sm"><i
          class="bi bi-pencil-square"></i>
          Editar</a>

          <button type="submit" class="btn btn-danger btn-sm"
          onclick="return confirm('¿Querés eliminar este método de pago? No hay vuelta atrás.');"><i
          class="bi bi-trash"></i>
          Eliminar</button>
          </form>
          </td>
        </tr>
        @empty
    <td colspan="6">
      <span class="text-danger">
      <strong>No hay métodos de pago!</strong>
      </span>
    </td>
  @endforelse
          </tbody>
        </table>

        {{ $metodo_pagos->links() }}

      </div>
    </div>
  </div>
</div>

@endsection