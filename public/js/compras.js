function fetchURL() {
    document.addEventListener("DOMContentLoaded", function () {
        var selectProductID = document.getElementById("producto_id");
        if (selectProductID) {
            selectProductID.addEventListener("change", function (event) {
                if (
                    event.target &&
                    event.target.matches('select[name="producto_id"]')
                ) {
                    let id = event.target.value;
                    fetch(`producto-precio/${id}`)
                        .then((response) => {
                            if (!response.ok) {
                                throw new Error(
                                    `Error en la solicitud: ${response.status}`
                                );
                            } else {
                                return response.json();
                            }
                        })
                        .then((data) => {
                            const productoJson = data.productoJson;
                            const precio =
                                document.getElementById("precio_costo");
                            precio.value = productoJson.precio_costo;
                            calcularPrecioVenta(precio.value);
                        });
                }
            });
        }
    });
}
fetchURL();

function calcularPrecioVenta(precio) {
    let precio_producto = parseInt(precio);
    document
        .getElementById("porcentaje_ganancia")
        .addEventListener("input", function (event) {
            if (
                event.target &&
                event.target.matches('input[name="porcentaje_ganancia"]')
            ) {
                let porcentaje_ganancia = parseInt(event.target.value);
                let calculo =
                precio_producto +
                    (porcentaje_ganancia * precio_producto) / 100;
                let precio_venta = document.getElementById("precio_venta");
                precio_venta.textContent = "";
                if (isNaN(calculo)) {
                    precio_venta.value = 0;
                } else {
                    precio_venta.value = Math.ceil(calculo);
                }
            }
        });
}


