<?php
// Conexión a la base de datos (reemplaza con tus propios detalles)
$servername = "localhost";
$username = "gabriel";
$password = "root";
$dbname = "pureos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoger datos del formulario
$usuario = isset($_POST['username']) ? $_POST['username'] : '';
$contrasena = isset($_POST['password']) ? $_POST['password'] : '';

// Insertar datos en la base de datos (con sentencia preparada)
$sql = "INSERT INTO usuarios (nombre_usuario, contrasena) VALUES (?, ?)";
$stmt = $conn->prepare($sql);

// Verificar la preparación de la sentencia
if ($stmt === false) {
    die("Error en la preparación de la sentencia: " . $conn->error);
}

// Vincular parámetros y ejecutar la sentencia
$stmt->bind_param("ss", $usuario, $contrasena);
$stmt->execute();

// Verificar si hubo algún error al ejecutar la sentencia
if ($stmt->error) {
    die("Error al ejecutar la sentencia: " . $stmt->error);
}

echo "Registro exitoso!!!";
header("Location: index.html");
die();
// Cerrar la conexión y la sentencia preparada
$stmt->close();
$conn->close();
?>
