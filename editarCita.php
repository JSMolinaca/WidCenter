<?php 
include 'conexion.php';

//VERIFICAR SI SE PASO UN ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $consulta = $conexion->query("SELECT * FROM citas WHERE id = $id");
    $cita = $consulta->fetch_assoc();
}

//Actualizar la cita cuando se envia el form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $motivo = $_POST['motivo'];

    // ACTUALIZAR BD
    $conexion->query("UPDATE citas SET fecha = '$fecha', hora = '$hora', motivo = '$motivo' WHERE id = $id");

    header("Location: citas.php");
    exit();
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
