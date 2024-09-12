@extends('layouts.app')
@section('content')
@include('alerts.defaults')
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Product List</div>
            <div class="card-body">
                <a href="{{ route('condiciones-de-ventas.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Agregar Forma de Venta</a>
                <table class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Forma</th>
                        <th scope="col">Creada el:</th>
                        <th scope="col">Modificada el:</th>
                        <th scope="col">Accion</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($condiciones as $condicion)
              <tr>
              <td>{{ $condicion->condicion }}</td>
              <td>{{ $condicion->created_at }}</td>
              <td>{{ $condicion->updated_at }}</td>
              <td>
              <form action="{{ route('condiciones-de-ventas.destroy', $condicion->id) }}" method="post">
              @csrf
              @method('DELETE')

              <a href="{{ route('condiciones-de-ventas.show', $condicion->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Ver</a>

              <a href="{{ route('condiciones-de-ventas.edit', $condicion->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Editar</a>   

              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Querés eliminar esta Forma de Venta? No hay vuelta atrás.');"><i class="bi bi-trash"></i> Eliminar</button>
              </form>
              </td>
              </tr>
            @empty
                            <td colspan="6">
                                <span class="text-danger">
                                    <strong>No hay condiciones!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                  </table>

                  {{ $condiciones->links() }}

            </div>
        </div>
    </div>    
</div>
    
@endsection
