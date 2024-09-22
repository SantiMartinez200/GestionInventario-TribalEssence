<form action="{{route('decrementar-stock')}}" method="POST">
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
                <input type="text" value="" name="id_decrement" hidden  id="id_decrement">
                <label for="old_stock_decrement">Stock actual</label>
                <input type="text" class="d-block" id="old_stock_decrement" name="old_stock_decrement" >
                <div class="m-1"></div>
                <label for="precio_costo_decrement">Precio al costo</label>
                <input type="text" placeholder="Expresar en unidades" value="" class="d-block" id="precio_costo_decrement"
                  name="precio_costo_decrement">
                <div class="m-1"></div>
                <label for="new_stock_decrement">Disminuir stock</label>
                <input type="text" placeholder="Expresar en unidades" value="" class="d-block" id="new_stock_decrement" name="new_stock_decrement">
                <div class="m-1"></div>
                <label for="ajuste_caja">Corrección en Caja:</label>
                <input type="text" placeholder="Valor que será debitado" value="" class="d-block" id="ajuste_caja"
                  name="ajuste_caja">
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
  const input_decrement = document.getElementById("old_stock_decrement")
  const inputId_decrement = document.getElementById("id_decrement")
  const inputPrecio_decrement = document.getElementById("precio_costo_decrement")
  const campoTotal_decrement = document.getElementById("ajuste_caja");
  const new_stock_decrement = document.getElementById('new_stock_decrement')

  function disminuirStock(cantidad, id, precio) {
    campoTotal_decrement.value = '';
    new_stock_decrement.value = '';

    console.log(cantidad,id,precio);
    

    input_decrement.value = cantidad;
    inputId_decrement.value = id;
    inputPrecio_decrement.value = precio;

    new_stock_decrement.addEventListener('input', (event) => {
      let calc = inputPrecio_decrement.value * event.target.value;
      campoTotal_decrement.value = 0;
      campoTotal_decrement.value = calc;
    })

  }
</script>