const optionMarca = document.createElement("option");
const optionProducto = document.createElement("option");
const optionProveedor = document.createElement("option");
const optionAroma = document.createElement("option");

function getData(id,cantidad) {
    let compra_detalle_modify = document.getElementById("compra_detalle_id");
    let marca_id_modify = document.getElementById("marca_modify");
    let proveedor_id_modify = document.getElementById("proveedor_modify");
    let producto_id_modify = document.getElementById("producto_id_modify");
    let aroma_id_modify = document.getElementById("aroma_modify");
    let precio_costo_modify = document.getElementById("precio_costo_modify");
    let cantidad_modify = document.getElementById("cantidad_modify");
    let porcentaje_ganancia_modify = document.getElementById(
        "porcentaje_ganancia_modify"
    );
  let precio_venta_modify = document.getElementById("precio_venta_modify");
  let stock_minimo_modify = document.getElementById("stock_minimo_modify");

    compra_detalle_modify.value = id;
    

    fetch(`findEntradaById/${id}`)
        .then((response) => response.json())
        .then((data) => {
            

            optionMarca.text = data[0].nombre_marca;
            optionMarca.value = data[0].marca_id;
            optionMarca.setAttribute("selected", "selected");
            marca_id_modify.appendChild(optionMarca);

            
            optionProducto.textContent = data[0].nombre_producto;
            optionProducto.value = data[0].producto_id;
            optionProducto.setAttribute("selected", "selected");
            proveedor_id_modify.appendChild(optionProducto);

            
            optionProveedor.text = data[0].nombre_proveedor;
            optionProveedor.value = data[0].proveedor_id;
            optionProveedor.setAttribute("selected", "selected");
            producto_id_modify.appendChild(optionProveedor);

            
            optionAroma.text = data[0].nombre_aroma;
            optionAroma.value = data[0].aroma_id;
            optionAroma.setAttribute("selected", "selected");
            aroma_id_modify.appendChild(optionAroma);

            precio_venta_modify.value = data[0].precio_costo;
            precio_costo_modify.value = data[0].precio_costo;
            cantidad_modify.value = cantidad;

          porcentaje_ganancia_modify.value = data[0].porcentaje_ganancia;
          console.log(data[0].stock_minimo);
          
          stock_minimo_modify.value = data[0].stock_minimo;
        });
}

function fetchURL_modify(selectElement) {
    var idModificar = selectElement.value;
    fetch(`producto-precio/${idModificar}`)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            const productoJsonModificar = data.productoJson;
            var modalModificar = document.getElementById("modalModificar");
            var precioCostoInputModificar = modalModificar.querySelector(
                "#precio_costo_modify"
            );
            precioCostoInputModificar.value =
                productoJsonModificar.precio_costo;
            calcularPrecioVenta_modify(productoJsonModificar.precio_costo);
        })
        .catch((error) => {
            console.error("Error en fetch:", error);
        });
}

function calcularPrecioVenta_modify(precio) {
    //console.log("precio: ", precio);
    let precio_producto_modify = parseInt(precio);
    document
        .getElementById("porcentaje_ganancia_modify")
        .addEventListener("input", function (event) {
            if (
                event.target &&
                event.target.matches('input[name="porcentaje_ganancia_modify"]')
            ) {
                console.log(event);
                let porcentaje_ganancia_modify = parseInt(event.target.value);
                let calculo_modify =
                    precio_producto_modify +
                    (porcentaje_ganancia_modify * precio_producto_modify) / 100;
                console.log(
                    "porcentaje ganancia: ",
                    porcentaje_ganancia_modify
                );
                console.log("pproducot: ", precio_producto_modify);

                let precio_venta_modify = document.getElementById(
                    "precio_venta_modify"
                );
                precio_venta_modify.value = "";
                if (isNaN(calculo_modify)) {
                    console.log(calculo_modify);

                    precio_venta_modify.value = 0;
                } else {
                    precio_venta_modify.value = Math.ceil(calculo_modify);
                }
            }
        });
}
