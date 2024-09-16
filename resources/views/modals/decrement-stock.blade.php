<form action="decrementar-stock" method="POST">
    @method('POST')
    @csrf
  <div class="modal fade" id="decrementar-stock" tabindex="-1" aria-labelledby="decrementar-stockLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="decrementar-stockLabel">Decrementar Stock</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mx-auto">
            <div class="form-group text-center" id="input_group">
                {{-- <input type="number" value="" name="id" hidden  id="id"> --}}
                <label for="dd">Stock actual</label>
                <input type="number" class="d-block" id="dd" name="old_field" >
                <div class="m-1"></div>
                <label for="new_stock">Disminuir stock</label>
                <input type="number" placeholder="Expresar en unidades" value="" class="d-block" id="new_stock" name="new_stock">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Actualizar Stock</button>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
    function disminuirStock(cantidad,id){  
        console.log(cantidad,id);
        
        var input = document.getElementById("dd");
        var inputId = document.getElementById("id");

        var cant = cantidad;
        var idReg = id

        input = '';
        inputId = '';
        
        input.value = cant;        
        inputId.value = idReg;
       
    }
</script>