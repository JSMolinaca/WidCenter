function editarCita(id) {
    window.location.href = `editar_cita.php?id=${id}`;
}

function eliminarCita(id) {
    if (confirm("Estas seguro de que deseas eliminar esta cita?")) {
        window.location.href = `eliminar_cita.php?id=${id}`;
        }
}
