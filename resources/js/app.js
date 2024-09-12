import "./bootstrap";
import Swal from "sweetalert2";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

function showAlert(type, message) {
    const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    }
    });
    Toast.fire({
    icon: type,
    title: message
    });
}

window.showAlert = showAlert;
