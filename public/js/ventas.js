function fetchURL() {
    document
        .getElementById("tbody")
        .addEventListener("input", function (event) {
            if (
                event.target &&
                event.target.matches('input[name="search[]"]')
            ) {
                let search = event.target.value;
                var row = event.target.closest("tr");
                var bodyDiv = row.querySelector(".fetch");
                var list = row.querySelector(".ulSuggest");

                if (search === "") {
                    search = 0;
                    list.hidden = true;
                } else {
                    fetch(`/buscar-entrada/${search}`)
                        .then((response) => {
                            if (!response.ok) {
                                list.hidden = true;
                                clearList(list);
                            }
                            return response.json();
                        })
                        .then((data) => {
                            clearList(list);
                            list.classList.add(
                                "block",
                                "bg-white",
                                "border",
                                "border-gray-300",
                                "rounded-lg",
                                "list-group-item"
                            );
                            if (data.length > 0) {
                                data.forEach((data) => {
                                    //console.log(data);

                                    let suggestItem =
                                        document.createElement("li");

                                    // Formatear la fecha 'created_at'
                                    suggestItem.textContent =
                                        " Producto: " +
                                        data.nombre_producto +
                                        " Fecha de Entrada: " +
                                        formatDate(data.created_at) + // Llama a la función de formateo
                                        " Entrada N°: " +
                                        data.id;
                                    suggestItem.classList.add("mt-1", "item");
                                    list.hidden = false;

                                    suggestItem.addEventListener(
                                        "click",
                                        function () {
                                            let row = this.closest("tr");
                                            clickList(data, row, list);
                                            list.hidden = true;
                                        }
                                    );

                                    list.appendChild(suggestItem);
                                });
                            } else {
                                list.hidden = false;
                                noResults(list);
                            }
                            bodyDiv.appendChild(list);

                            // Cálculos
                            document
                                .getElementById("tbody")
                                .addEventListener("input", function (event) {
                                    if (
                                        event.target &&
                                        event.target.matches(
                                            'input[name="cantidad[]"]'
                                        )
                                    ) {
                                        verificarCantidad();
                                    }
                                });
                        })
                        .catch((error) =>
                            console.warn("Error fetching data:", error)
                        );
                }
            }
        });
}

// Función para formatear la fecha
function formatDate(dateString) {
    // Convertir el string en un objeto Date
    const [datePart, timePart] = dateString.split(" "); // Separa la fecha y la hora
    const [year, month, day] = datePart.split("-"); // Separa el año, mes y día

    // Formatea la fecha
    const dia = String(day).padStart(2, "0");
    const mes = String(month).padStart(2, "0");
    const anio = year;
    const [horas, minutos] = timePart.split(":"); // Separa las horas y minutos

    return `${dia}/${mes}/${anio} ${horas}:${minutos}`;
}

fetchURL();

function noResults(list) {
    let suggestItem = document.createElement("li");
    suggestItem.textContent = "No está en existencias";
    list.appendChild(suggestItem);
}

function clearList(list) {
    while (list.firstChild) {
        list.removeChild(list.firstChild);
    }
}

function denyMinus() {
    document
        .getElementById("tbody")
        .addEventListener("keydown", function (event) {
            if (event.key === "-") {
                event.preventDefault();
            }
        });
}
denyMinus();

function clickList(data, row, list) {
    console.log(data);
    fetch(`/calculateThisStock/${data.compra_id}`)
        .then((response) => response.json())
        .then((cantidad_calculada) => {
            let compra_select = row.querySelectorAll(
                "td select[name='compra-select[]']"
            )[0];

            let readInput = row.querySelectorAll(
                "td input[name='search[]']"
            )[0];
            let proveedor = row.querySelectorAll(
                "td select[name='proveedor[]']"
            )[0];

            let marca = row.querySelectorAll("td select[name='marca[]']")[0];
            let producto = row.querySelectorAll(
                "td select[name='producto[]']"
            )[0];
            let aroma = row.querySelectorAll("td select[name='aroma[]']")[0];
            let cantidad = row.querySelectorAll("td input[name='stock[]']")[0];
            let precio = row.querySelectorAll("td input[name='precio[]']")[0];
            //console.log(data);

            if (producto.children) {
                console.log(producto.children);
                for (let index = 0; index < producto.children.length; index++) {
                    compra_select.remove("option");
                    proveedor.remove("option");
                    marca.remove("option");
                    producto.remove("option");
                    aroma.remove("option");
                }
            }

            const productoId = document.createElement("option");
            const compraId = document.createElement("option");
            const aromaId = document.createElement("option");
            const proveedorId = document.createElement("option");
            const marcaId = document.createElement("option");

            productoId.value = data.producto_id;
            productoId.textContent = data.nombre_producto;
            producto.appendChild(productoId);

            compraId.value = data.compra_id;
            compra_select.appendChild(compraId);

            aromaId.value = data.aroma_id;
            aromaId.textContent = data.nombre_aroma;
            aroma.appendChild(aromaId);

            proveedorId.value = data.proveedor_id;
            proveedorId.textContent = data.nombre_proveedor;
            proveedor.appendChild(proveedorId);

            marcaId.value = data.marca_id;
            marcaId.textContent = data.nombre_marca;
            marca.appendChild(marcaId);

            readInput.value = data.nombre_producto;
            cantidad.value = cantidad_calculada;
            precio.value = data.precio_venta;
            clearList(list);
        });
}

function actualizarTotal() {
    let totalGeneral = 0;
    // Recorre todas las filas y suma los totales
    document.querySelectorAll("#tbody tr").forEach((row) => {
        const cantidad = row.querySelector('input[name="cantidad[]"]').value;
        const precio = row.querySelector('input[name="precio[]"]').value;
        const subtotal = cantidad * precio;
        totalGeneral += Math.ceil(subtotal);
    });
    // Muestra el total general
    if (totalGeneral > 0) {
        document.getElementById("total-compraLabel").hidden = false;
        const compraDetailsInput = document.getElementById("total-compra");
        compraDetailsInput.value = totalGeneral;
        compraDetailsInput.hidden = false;
    } else {
        document.getElementById("total-compraLabel").hidden = true;
        document.getElementById("total-compra").hidden = true;
    }
}

function agregarFila() {
    // Obtener fila
    var templateRow = document.querySelector(".template-row");
    // Clonar fila
    var newRow = templateRow.cloneNode(true);
    // Limpiar fila nueva
    newRow.querySelectorAll("input").forEach((input) => (input.value = ""));
    newRow.querySelectorAll("select").forEach((select) => {
        while (select.firstChild) {
            select.removeChild(select.firstChild); // Eliminar todas las opciones del select
        }
    });
    // Añadir fila a la tabla
    document.getElementById("tbody").appendChild(newRow);
}

function eliminarFila(button) {
    let rowCount = document.querySelectorAll("#tbody tr").length;
    if (rowCount == 1) {
        //console.log(rowCount);
        showAlert("info", "No se puede eliminar la ultima fila");
    } else {
        // Elimina la fila correspondiente al botón de eliminar
        button.closest("tr").remove();
        // actualiza el total
        actualizarTotal();
    }
}

function verificarCantidad() {
    let rows = document.querySelectorAll("#tbody tr");
    rows.forEach((row) => {
        // Obtener inputs de cantidad&stock
        let cantidadInput = row.querySelector('input[name="cantidad[]"]');
        let stockInput = row.querySelector('input[name="stock[]"]');
        let cantidad = parseInt(cantidadInput.value);
        let stock = parseInt(stockInput.value);
        if (cantidad > stock) {
            //se remueve el último caracter en caso de que la cantidad ingresada supere al stock.
            event.target.value = cantidadInput.value.slice(0, -1);
        } else {
            actualizarTotal();
        }
    });
}
