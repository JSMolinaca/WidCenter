<?php
// Datos de conexión
$servername = "localhost"; // Cambia esto por tu servidor
$username_db = "root";      // Cambia esto por tu usuario de la base de datos
$password_db = "";          // Cambia esto por tu contraseña de la base de datos
$dbname = "login_widcenter"; // Cambia esto por el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escapar los datos para evitar inyección SQL
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    
    // Consulta para verificar el nombre de usuario y la contraseña
    $sql = "SELECT * FROM usuarios WHERE usuario = '$username' AND contraseña = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si el usuario existe, redirigir a una nueva página o mostrar un mensaje de éxito
        header("Location: ./pages/afiliate.html");
        exit();
        // Redirigir al usuario (ejemplo)
        // header("Location: pagina_principal.php");
    } else {
        // Si no existe, mostrar un mensaje de error
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}

$conn->close();
?>
