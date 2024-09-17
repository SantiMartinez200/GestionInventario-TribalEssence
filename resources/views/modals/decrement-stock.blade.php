<form action="incrementar-stock" method="POST">
  @method('POST')
  @csrf
  <div class="modal fade" id="decrementar-stock" tabindex="-1" aria-labelledby="decrementar-stockLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="decrementar-stockLabel">Disminuir Stock</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mx-auto">
          <div class="form-group text-center" id="input_group">
            <input type="number" value="" name="id_decrement" readonly id="id_decrement"><br>
            <label for="this_stock">Stock actual</label>
            <input type="number" value="" class="d-block" id="this_stock" name="this_stock" readonly>
            <div class="m-1"></div>
            <label for="decrement_input">Disminuir stock</label>
            <input type="number" placeholder="Expresar en unidades" value="" class="d-block" id="decrement_input"
              name="decrement_input">
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
  function disminuirStock(cantidad, id) {
    let input = document.getElementById("this_stock");
    let inputId = document.getElementById("id_decrement");
    let decrementInput = document.getElementById("decrement_input")
    decrementInput.value = "";

    input.value = cantidad;
    inputId.value = id;
  }
</script>