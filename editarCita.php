<?php
// Incluye el archivo de conexión
include 'conexion.php';

// Verifica si el ID de la cita está presente
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Realiza la consulta para obtener los detalles de la cita
    $consulta = "SELECT * FROM citas WHERE id = $id";
    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        $cita = $resultado->fetch_assoc();
    } else {
        echo "Cita no encontrada.";
        exit();
    }
} else {
    echo "ID de cita no especificado.";
    exit();
}

// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $motivo = $_POST['motivo'];

    // Actualiza la cita en la base de datos
    $actualizarConsulta = "UPDATE citas SET fecha = '$fecha', hora = '$hora', motivo = '$motivo' WHERE id = $id";
    if ($conexion->query($actualizarConsulta) === TRUE) {
        echo "Cita actualizada correctamente.";
        header("Location: citas.php"); // Redirige a la página principal de citas
        exit();
    } else {
        echo "Error al actualizar la cita: " . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cita</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <main>
        <div class="citas-container">
            <h2 class="cita">Editar Cita</h2>
            <form method="POST" class="form-editar">
                <label class="cita">Fecha:</label>
                <input type="date" name="fecha" value="<?php echo $cita['fecha']; ?>" required class="input-cita">

                <label class="cita">Hora:</label>
                <input type="time" name="hora" value="<?php echo $cita['hora']; ?>" required class="input-cita">

                <label class="cita">Motivo:</label>
                <textarea name="motivo" required class="textarea-cita"><?php echo $cita['motivo']; ?></textarea>

                <button type="submit" class="btn-cita">Actualizar cita</button>
            </form>
        </div>
    </main>
</body>
</html>
