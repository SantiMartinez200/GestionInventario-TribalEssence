@extends('layouts.app')
@section('content')
@include('alerts.defaults')

<div class="row justify-content-center mt-3">
  <div class="col-md-12">



    <div class="card">
      <div class="card-header">Listado de Aromas</div>
      <div class="card-body">
        <a href="{{ route('aromas.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i>
          Agregar Aroma</a>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th class="text-left" scope="col">Nombre</th>
              {{-- <th class="text-left" scope="col">Agregado el</th> --}}
              {{-- <th class="text-left" scope="col">Modificado el</th> --}}
              <th class="text-left" scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($aromas as $aroma)
        <tr>
          <td class="text-left">{{ $aroma->nombre }}</td>
          {{-- <td class="text-left">{{ $aroma->created_at }}</td> --}}
          {{-- <td class="text-left">{{ $aroma->updated_at }}</td> --}}
          <td>
          <form action="{{ route('aromas.destroy', $aroma->id) }}" method="post">
            @csrf
            @method('DELETE')

            <!-- <a href="{{ route('aromas.show', $aroma->id) }}" class="btn btn-warning btn-sm"><i
          class="bi bi-eye"></i> Ver</a> -->

            <a href="{{ route('aromas.edit', $aroma->id) }}" class="btn btn-primary btn-sm"><i
              class="bi bi-pencil-square"></i> Editar</a>

            <button type="submit" class="btn btn-danger btn-sm"
            onclick="return confirm('¿Querés eliminar este aroma? No hay vuelta atrás.');"><i
              class="bi bi-trash"></i>
            Eliminar</button>
          </form>
          </td>
        </tr>
      @empty
    <td colspan="6">
      <span class="text-danger">
      <strong>No hay aromas!</strong>
      </span>
    </td>
  @endforelse
          </tbody>
        </table>

        {{ $aromas->links() }}

      </div>
    </div>
  </div>
</div>

@endsection