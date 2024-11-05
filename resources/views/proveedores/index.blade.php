@extends('layouts.app')
@section('content')

<div class="row justify-content-center mt-3">
  <div class="col-md-12">

    @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
      {{ $message }}
    </div>
  @endif

    @if ($message = Session::get('warning'))
    <div class="alert alert-warning" role="alert">
      {{ $message }}
    </div>
  @endif

    <div class="card">
      <div class="card-header">Listado de proveedores</div>
      <div class="card-body">
        <a href="{{ route('proveedores.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
          Agregar proveedor</a>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th  class="text-left" scope="col">Nombre</th>
              {{-- <th  class="text-left" scope="col">Agregado el</th>
              <th  class="text-left" scope="col">Modificado el</th> --}}
              <th  class="text-left" scope="col">Accion</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($proveedores as $proveedor)
        <tr>
          <td class="text-left" >{{ $proveedor->nombre }}</td>
          {{-- <td>{{ $proveedor->created_at }}</td>
          <td>{{ $proveedor->updated_at }}</td> --}}
          <td class="text-left" >
          <form action="{{ route('proveedores.destroy', $proveedor->id) }}" method="post">
          @csrf
          @method('DELETE')

          <a href="{{ route('proveedores.show', $proveedor->id) }}" class="btn btn-warning btn-sm"><i
            class="bi bi-eye"></i> Ver</a>

          <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-primary btn-sm"><i
            class="bi bi-pencil-square"></i> Editar</a>

          <button type="submit" class="btn btn-danger btn-sm"
          onclick="return confirm('¿Querés eliminar este proveedor? No hay vuelta atrás.');"><i class="bi bi-trash"></i>
          Eliminar</button>
          </form>
          </td>
        </tr>
        @empty
    <td colspan="6">
      <span class="text-danger">
      <strong>No hay proveedores!</strong>
      </span>
    </td>
  @endforelse
          </tbody>
        </table>

        {{ $proveedores->links() }}

      </div>
    </div>
  </div>
</div>

@endsection