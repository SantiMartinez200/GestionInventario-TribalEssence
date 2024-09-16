<form action="incrementar-stock" method="POST">
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
                <input type="number" value="" name="id" hidden readonly id="id">
                <label for="old_stock">Stock actual</label>
                <input type="number" value="" class="d-block" id="old_stock" name="old_stock" readonly>
                <div class="m-1"></div>
                <label for="precio_costo">Precio al costo</label>
                <input type="number" value="" class="d-block" id="precio_costo" name="precio_costo">
                <div class="m-1"></div>
                <label for="new_stock">Sumar stock</label>
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
    function aumentarStock(cantidad,id,precio){  
        let input = document.getElementById("old_stock")
        let inputId = document.getElementById("id")
        let inputPrecio = document.getElementById("precio_costo")
        input.value = '';
        inputId.value = '';
        inputPrecio.value = '';

        input.value = cantidad;
        inputId.value = id;
        inputPrecio.value = precio;

        let campoTotal = document.getElementById("input_total");
        console.log(campoTotal);
        
        if(campoTotal == null){
          const inputTotal = document.createElement("input")
          input.type = "number";
          input.id ="input_total"
          const labelTotal = document.createElement("label");
          labelTotal.setAttribute("for","input_total");
          labelTotal.textContent="Costo total Calculado";
          labelTotal.classList.add("mt-1")
        }else{
            document.addEventListener('input',function(){
            let cantidadIngresada = document.getElementById("new_stock")
            let calc = inputPrecio.value * cantidadIngresada.value;
            inputTotal.value = 0;
            inputTotal.value=calc;
          })
          let br = document.createElement("br")
          let div = document.getElementById("input_group");
          div.appendChild(labelTotal);
          div.appendChild(br);
          div.appendChild(inputTotal);
        }
    }
</script>