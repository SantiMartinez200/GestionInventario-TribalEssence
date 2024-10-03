var bar = document.getElementById("bar");
var cake = document.getElementById("cake");
var cakeProduct = document.getElementById("cakeProduct");

document.addEventListener("DOMContentLoaded", () => {
    fetch("/ventas-semanales")
        .then((response) => response.json())
        .then((data) => {
            new Chart(bar, {
                type: "bar",
                data: data,
                options: {
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                        },
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            position: "top",
                        },
                        title: {
                            display: true,
                            text: "Ventas semanales por Producto",
                        },
                    },
                },
            });
        })
        .catch((error) => console.error("Error al cargar los datos:", error));

    let ventasPorMarca = JSON.parse(
        document.getElementById("ventasPorMarca").value
    );

    let labels = ventasPorMarca.map((item) => item.nombre);
    let dataValues = ventasPorMarca.map((item) =>
        parseFloat(item.total_vendido_marca)
    );

    function getRandomColor() {
        const r = Math.floor(Math.random() * 256);
        const g = Math.floor(Math.random() * 256);
        const b = Math.floor(Math.random() * 256);
        return `rgba(${r}, ${g}, ${b}, 0.7)`;
    }
    let backgroundColors = labels.map(() => getRandomColor());

    new Chart(cake, {
        type: "pie", // Tipo de gráfico
        data: {
            labels: labels, // Etiquetas para cada segmento
            datasets: [
                {
                    label: "Total Vendido", // Etiqueta del gráfico
                    data: dataValues, // Datos simulados (porcentaje o cantidad)
                    backgroundColor: backgroundColors,
                    borderColor: [
                        // Colores del borde de cada segmento
                        "#000000",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: "Cantidad vendida por marca", // This is the title of the chart
                    font: {
                        size: 20,
                    },
                    padding: {
                        top: 10,
                        bottom: 30,
                    },
                },
                legend: {
                    position: "top", // Posición de la leyenda
                },
                tooltip: {
                    enabled: true, // Mostrar tooltips al pasar el ratón
                },
            },
        },
    });

    let ventasPorProducto = JSON.parse(
        document.getElementById("ventasPorProductoInput").value
    );

    let labelsS = ventasPorProducto.map((item) => item.nombre);
    let dataValuesS = ventasPorProducto.map((item) =>
        parseFloat(item.total_vendido_producto)
    );

    let backgroundColors2 = labelsS.map(() => getRandomColor());

    new Chart(cakeProduct, {
        type: "pie", // Tipo de gráfico
        data: {
            labels: labelsS, // Etiquetas para cada segmento
            datasets: [
                {
                    label: "Total Vendido", // Etiqueta del gráfico
                    data: dataValuesS, // Datos simulados (porcentaje o cantidad)
                    backgroundColor: backgroundColors2,
                    borderColor: [
                        // Colores del borde de cada segmento
                        "#000000",
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: "Cantidad vendida por producto", // This is the title of the chart
                    font: {
                        size: 20,
                    },
                    padding: {
                        top: 10,
                        bottom: 30,
                    },
                },
                legend: {
                    position: "top", // Posición de la leyenda
                },
                tooltip: {
                    enabled: true, // Mostrar tooltips al pasar el ratón
                },
            },
        },
    });
});
