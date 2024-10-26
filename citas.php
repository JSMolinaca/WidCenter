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
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="">
<header class="header">
        <div class="header-div">
            <nav class="nav-bar">
                <figure>
                    <a href="../index.html"><img class="logo" src="assets/images/Logo.png" alt="" width="120px"></a>
                </figure>
                <figure>
                    <img class="tittle" src="assets/images/tittle.png" alt="">
                </figure>
                <ol class="list-nav">
                    <a href="./salud.html">
                        <li class="li-header">Salud</li>
                    </a>
                    <a href="./certificaciones.html">
                        <li class="li-header">Certificaciones</li>
                    </a>
                    <a href="./afiliate.html">
                        <li class="li-header">Afiliate</li>
                    </a>
                    <a href="./sobreNosotros.html">
                        <li class="li-header">Sobre Nosotros</li>
                    </a>
                    <a href="./login.html">
                        <li class="login li-header">Iniciar sesion</li>
                    </a>
                    <a href="./register.html">
                        <li class="register li-header">Registrarse</li>
                    </a>
                </ol>
            </nav>
        </div>
    </header>
    <main class="citas-section">
        <h2 class="cita">Pedir una cita</h2>
        <div class="citas-container">
        <form method="POST">
            <label class="citaa cita">Fecha:</label>
            <input type="date" name="fecha" required>
            <label class="citaa cita">Hora:</label>
            <input type="time" name="hora" required>
            <label class="citaa cita">Motivo:</label>
            <textarea name="motivo" required></textarea>
            <button type="submit" class="btn-cita">Pedir cita</button>
        </form>
        </div>
        <h2 class="cita">Tus citas</h2>
        <table class="table-citas">
            <tr class="cita">
                <th>Fecha</th>
                <th>Hora</th>
                <th>Motivo</th>
            </tr>
            <?php while ($cita = $citas->fetch_assoc()): ?>
            <tr>
                <td class="cita"><?php echo $cita['fecha']; ?></td>
                <td class="cita"><?php echo $cita['hora']; ?></td>
                <td class="cita"><?php echo $cita['motivo']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>
</html>