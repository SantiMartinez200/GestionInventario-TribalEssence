const ul = document.getElementById("lista_notificaciones");
const exclamation = document.querySelector("#exclamation");
const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

async function getNotificaciones() {
    // Limpiar la lista de notificaciones antes de agregar nuevas
    ul.innerHTML = ""; // Esto asegura que no haya duplicados

    // Hacemos fetch a las notificaciones
    await fetch("/notificaciones")
        .then((response) => response.json())
        .then((notificaciones) => {
            console.log(notificaciones);

            if (notificaciones.length > 0) {
                exclamation.classList.remove("hidden");
                notificaciones.forEach((notif) => {
                    let li = document.createElement("li");

                    let a = document.createElement("a");
                    let icon = document.createElement("i");
                    icon.classList.add(
                        "fas",
                        "fa-check-square",
                        "text-success",
                        "fa-lg"
                    );
                    icon.setAttribute("title", "Marcar como leido");

                    li.setAttribute("id", notif.id);
                    a.classList.add("text-white");
                    a.appendChild(icon);
                    a.setAttribute("href", "#");
                    a.setAttribute("id", notif.id);

                    a.addEventListener("click", (e) => {
                        e.preventDefault();
                        marcarComoLeida(notif.id, li);
                    });

                    li.textContent = notif.descripcion + "  ";
                    li.appendChild(a);
                    ul.appendChild(li);
                });
            } else {
                exclamation.classList.add("hidden");
            }
        });
}

getNotificaciones();

// Función para marcar la notificación como leída y eliminarla del DOM
function marcarComoLeida(notificacionId, liElemento) {
    fetch("marcar-notificacion", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken, // Token CSRF
        },
        body: JSON.stringify({
            id: notificacionId, // Pasamos el ID de la notificación
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                getNotificaciones(); // Recargamos la lista de notificaciones
                liElemento.remove(); // Eliminamos la notificación del DOM
            } else {
                alert("Error al marcar la notificación como leída.");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
}
