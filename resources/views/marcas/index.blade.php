@extends('layouts.app')
@section('content')
@include('alerts.defaults')
<div class="row justify-content-center mt-3">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">Listado de marcas</div>
      <div class="card-body">
        <a href="{{ route('marcas.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
          Agregar Marca</a>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th class="text-left" scope="col">Nombre</th>
              {{-- <th class="text-left" scope="col">Agregada el</th>
              <th class="text-left" scope="col">Modificada el</th> --}}
              <th class="text-left" scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($marcas as $marca)
        <tr>
          <td class="text-left">{{ $marca->nombre }}</td>
          {{-- <td class="text-left">{{ $marca->created_at }}</td>
          <td class="text-left">{{ $marca->updated_at }}</td> --}}
          <td class="text-left">
          <form action="{{ route('marcas.destroy', $marca->id) }}" method="post">
          @csrf
          @method('DELETE')

          <a href="{{ route('marcas.show', $marca->id) }}" class="btn btn-warning btn-sm"><i
            class="bi bi-eye"></i> Ver</a>

          <a href="{{ route('marcas.edit', $marca->id) }}" class="btn btn-primary btn-sm"><i
            class="bi bi-pencil-square"></i> Editar</a>

          <button type="submit" class="btn btn-danger btn-sm"
          onclick="return confirm('¿Querés eliminar este marca? No hay vuelta atrás.');"><i class="bi bi-trash"></i>
          Eliminar</button>
          </form>
          </td>
        </tr>
        @empty
    <td colspan="6">
      <span class="text-danger">
      <strong>No hay marcas!</strong>
      </span>
    </td>
  @endforelse
          </tbody>
        </table>

        {{ $marcas->links() }}

      </div>
    </div>
  </div>
</div>

@endsection