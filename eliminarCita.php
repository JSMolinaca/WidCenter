<?php 

include 'conexion.php';

if (!isset($conexion)) {
    die("Error: no se pudo establecer la conexion a la base de datos");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Realiza la consulta para eliminar la cita
    $consulta = "DELETE FROM citas WHERE id = $id";

    if ($conexion->query($consulta) === TRUE) {
        echo "Cita eliminada correctamente.";
        header("Location: citas.php"); // Redirige a la página principal de citas
        exit();
    } else {
        echo "Error al eliminar la cita: " . $conexion->error;
    }
} else {
    echo "ID de cita no especificado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Cita</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <main>
        <div class="citas-container">
            <h2 class="cita">Eliminar Cita</h2>
            <p class="cita">¿Estas seguro que deseas eliminar esta cita?</p>
            <p class="cita"><strong>Fecha:</strong> <?php echo $cita['fecha']; ?></p>
            <p class="cita"><strong>Hora:</strong> <?php echo $cita['hora']; ?></p>
            <p class="cita"><strong>Motivo:</strong> <?php echo $cita['motivo']; ?></p>

            <form method="POST" style="display: inline;">
                <button type="submit" class="btn-eliminar">Confirmar</button>
            </form>

            <a href="citas.php" class="btn-cancelar">Cancelar</a>
        </div>
    </main>
</body>
</html>