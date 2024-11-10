function verifyThroughModals(params) {
    document.addEventListener("DOMContentLoaded", () => {
        const btnModal = document.getElementById("apply");
        const aviso = document.getElementById("aviso");
        let btn = document.getElementById("movimiento");
        if (btn) {
            btn.addEventListener("click", () => {
                fetch("/caja-is-open")
                    .then((response) => response.json())
                    .then((bool) => {
                        if (bool === false) {
                            btnModal.disabled = true;
                            if (!document.getElementById("avisoText")) {
                                let avisoText = document.createElement("p");
                                avisoText.setAttribute("id", "avisoText");
                                avisoText.textContent =
                                    "Debes abrir una caja antes de hacer cualquier operacion.";
                                avisoText.classList.add("text-danger");
                                aviso.appendChild(avisoText);
                            }
                        }
                    });
            });
        } else {
            verifyThroughForms();
        }
    });
}
verifyThroughModals();

function verifyThroughForms(params) {
    const btn = document.getElementById("guardar");
    const aviso = document.getElementById("aviso");
    fetch("/caja-is-open")
        .then((response) => response.json())
        .then((bool) => {
            if (bool === false) {
                btn.disabled = true;
                if (!document.getElementById("avisoText")) {
                    let avisoText = document.createElement("p");
                    avisoText.setAttribute("id", "avisoText");
                    avisoText.textContent =
                        "Debes abrir una caja antes de hacer cualquier operacion.";
                    avisoText.classList.add("text-danger");
                    aviso.appendChild(avisoText);
                }
            }
        });
}
