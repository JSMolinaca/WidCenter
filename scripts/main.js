function editarCita(id) {
    window.location.href = `editarCita.php?id=${id}`;
}

function eliminarCita(id) {
    if (confirm("Estas seguro de que deseas eliminar esta cita?")) {
        window.location.href = `eliminarCita.php?id=${id}`;
        }
}