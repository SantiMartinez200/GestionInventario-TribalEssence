<form action="{{route('incrementar-stock')}}" method="POST">
    @method('POST')
    @csrf
  <div class="modal fade" id="incrementar-stock" tabindex="-1" aria-labelledby="incrementar-stockLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="incrementar-stockLabel">Incrementar Stock</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body mx-auto">
            <div class="form-group text-center" id="input_group">
                <input type="number" value="" name="id_increment" hidden readonly id="id_increment">
                <label for="old_stock_increment">Stock actual</label>
                <input type="number" value="" class="d-block" id="old_stock_increment" name="old_stock_increment" readonly>
                <div class="m-1"></div>
                <label for="precio_costo">Precio al costo</label>
                <input type="number" value="" class="d-block" id="precio_costo_increment" name="precio_costo_increment">
                <div class="m-1"></div>
                <label for="new_stock_increment">Sumar stock</label>
                <input type="number" placeholder="Expresar en unidades" value="" class="d-block" id="new_stock_increment" name="new_stock_increment">
                <div class="m-1"></div>
                <label for="input_total_increment">Costo Calculado</label>
                <input type="number" placeholder="Costo Calculado" value="" class="d-block" id="input_total_increment" name="input_total_increment">
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
    const input = document.getElementById("old_stock_increment")
    const inputId = document.getElementById("id_increment")
    const inputPrecio = document.getElementById("precio_costo_increment")
    const campoTotal = document.getElementById("input_total_increment");
    const new_stock = document.getElementById('new_stock_increment')

    function aumentarStock(cantidad,id,precio){  
        campoTotal.value = '';
        new_stock.value = '';


        input.value = cantidad;
        inputId.value = id;
        inputPrecio.value = precio;

        new_stock.addEventListener('input',(event) => {
          let calc = inputPrecio.value * event.target.value;
          campoTotal.value = 0;
          campoTotal.value = (calc);
        })
        
        }
</script>