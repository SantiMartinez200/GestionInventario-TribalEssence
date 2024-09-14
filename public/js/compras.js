function fetchURL(selectElement) {
    var id = selectElement.value;
    console.log(id);
    fetch(`producto-precio/${id}`)
        .then((response) => {
            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            const productoJson = data.productoJson;
            var modal = document.getElementById("modalRegistrarMovimiento");
            var precioCostoInput = modal.querySelector("#precio_costo");
            precioCostoInput.value = productoJson.precio_costo;
            calcularPrecioVenta(productoJson.precio_costo);
        })
        .catch((error) => {
            console.error("Error en fetch:", error);
        });
}

function calcularPrecioVenta(precio) {
    //console.log("precio: ", precio);
    let precio_producto = parseInt(precio);
    document
        .getElementById("porcentaje_ganancia")
        .addEventListener("input", function (event) {
            if (
                event.target &&
                event.target.matches('input[name="porcentaje_ganancia"]')
            ) {
                console.log(event);

                let porcentaje_ganancia = parseInt(event.target.value);
                let calculo =
                    precio_producto +
                    (porcentaje_ganancia * precio_producto) / 100;
                console.log("porcentaje ganancia: ", porcentaje_ganancia);
                console.log("pproducot: ", precio_producto);

                let precio_venta = document.getElementById("precio_venta");
                precio_venta.value = "";
                if (isNaN(calculo)) {
                    console.log(calculo);

                    precio_venta.value = 0;
                } else {
                    precio_venta.value = Math.ceil(calculo);
                }
            }
        });
}
