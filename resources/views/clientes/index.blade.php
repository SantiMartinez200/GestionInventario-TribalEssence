@extends('layouts.app')
@section('content')
@include('alerts.defaults')

<div class="row justify-content-center mt-3">
  <div class="col-md-12">

    <div class="card">
      <div class="card-header">Listado de Clientes</div>
      <div class="card-body">
        <a href="{{ route('clientes.create') }}" class="btn btn-success btn-sm my-2"><i
            class="bi bi-plus-circle"></i>
          Agregar Cliente</a>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th class="text-left"  scope="col">Nombre</th>
              <th class="text-left"  scope="col">Apellido</th>
              <th class=""  scope="col">Accion</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($clientes as $cliente)
        <tr>
          <td class="text-left" >{{ $cliente->nombre }}</td>
          <td class="text-left" >{{ $cliente->apellido }}</td>

          <td class="text-left" >
          <form action="{{ route('clientes.destroy', $cliente->id) }}" method="post">
          @csrf
          @method('DELETE')

          {{-- <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-warning btn-sm"><i
          class="bi bi-eye"></i> Ver</a> --}}

          <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary btn-sm"><i
          class="bi bi-pencil-square"></i> Editar</a>

          <button type="submit" class="btn btn-danger btn-sm"
          onclick="return confirm('¿Querés eliminar este client? No hay vuelta atrás.');"><i
          class="bi bi-trash"></i>
          Eliminar</button>
          </form>
          </td>
        </tr>
        @empty
    <td colspan="9">
      <span class="text-danger">
      <strong>No hay clientes!</strong>
      </span>
    </td>
  @endforelse
          </tbody>
        </table>

        {{ $clientes->links() }}

      </div>
    </div>
  </div>
</div>

@endsection