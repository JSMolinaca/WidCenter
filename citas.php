<?php
session_start();
include 'conexion.php'; //conexion bd

//Verificar usuario logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: pages/login.html");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

//Solicitud nueva cita
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $motivo = $_POST['motivo'];

    $query = "INSERT INTO citas (usuario_id, fecha, hora, motivo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $usuario_id, $fecha, $hora, $motivo);
    $stmt->execute();
    echo "Cita registrada exitosamente";
}

//Consult de citas
$query = "SELECT * FROM citas WHERE usuario_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$citas = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis citas</title>
</head>
<body>
    <h2>Pedir una cita</h2>
    <form method="POST">
        <label>Fecha:</label>
        <input type="date" name="fecha" required>
        <label>Hora:</label>
        <input type="time" name="hora" required>
        <label>Motivo:</label>
        <textarea name="motivo" required></textarea>
        <button type="submit">Pedir cita</button>
    </form>

    <h2>Tus citas</h2>
    <table>
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Motivo</th>
        </tr>
        <?php while ($cita = $citas->fetch_assoc()): ?>
        <tr>
            <td><?php echo $cita['fecha']; ?></td>
            <td><?php echo $cita['hora']; ?></td>
            <td><?php echo $cita['motivo']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>