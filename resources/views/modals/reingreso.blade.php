<div class="modal fade" id="modalModificar" tabindex="-1" role="dialog" aria-labelledby="modalModifyLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalModifyLabel">Modificar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex align-items-center justify-content-center">
        <form action="{{ route('updateCompraData') }}" method="POST">
          @csrf
          @method('PATCH')
          
          <button type="submit" class="btn btn-primary mt-2">Modificar</button>
        </form>
      </div>
    </div>
  </div>
</div>