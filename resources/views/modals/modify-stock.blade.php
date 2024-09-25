<div class="modal fade" id="modalModificar" tabindex="-1" role="dialog"
  aria-labelledby="modalModifyLabel" aria-hidden="true">
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
          <input type="hidden" name="compra_detalle_id" id="compra_detalle_id" value="">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="marca_modify">Marca</label>
                <select name="marca_id_modify" id="marca_modify" class="form-control">
                  
                  @foreach ($marcas as $marca)
            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
          @endforeach
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="proveedor_modify">Proveedor</label>
                <select name="proveedor_id_modify" id="proveedor_modify" class="form-control">
                 
                  @foreach ($proveedores as $proveedor)
            <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
          @endforeach
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="producto_id_modify">Producto</label>
                <select name="producto_id_modify" onchange="fetchURL_modify(this)" id="producto_id_modify" class="form-control">
                 
                  @foreach ($productos as $producto)
            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
          @endforeach
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="aroma_modify">Aroma</label>
                <select name="aroma_id_modify" id="aroma_modify" class="form-control">
                 
                  @foreach ($aromas as $aroma)
            <option value="{{ $aroma->id }}">{{ $aroma->nombre }}</option>
          @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="precio_costo_modify">Costo</label>
                <input type="text" name="precio_costo_modify" id="precio_costo_modify" class="form-control">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="cantidad_modify">Existencia Inicial</label>
                <input type="number" name="cantidad_modify" id="cantidad_modify" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col"> 
              <div class="form-group">
                <label for="porcentaje_ganancia_modify">Porcentaje de ganancia</label>
                <input type="number" name="porcentaje_ganancia_modify" id="porcentaje_ganancia_modify" class="form-control">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="precio_venta_modify">Precio de venta (C/U)</label>
                <input type="text" name="precio_venta_modify" id="precio_venta_modify" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="stock_minimo_modify">Notificación de stock mínimo:</label>
                <input type="number" name="stock_minimo_modify" id="stock_minimo_modify" class="form-control"
                  placeholder="Expresar en cantidades">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-2">Modificar</button>
        </form>
      </div>
    </div>
  </div>
</div>