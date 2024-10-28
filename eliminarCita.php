<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $conexion->query("SELECT * FROM citas WHERE id = $id");
    $cita = $consulta->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conexion->query("DELETE FROM citas WHERE id = $id");
        
    header( "Location: citas.php");
    exit();
    }
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