<?php
// Conexión a la base de datos
$host = "localhost";
$usuario_db = "root";
$password_db = "";
$base_datos = "restaurante";

$conn = new mysqli($host, $usuario_db, $password_db, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre  = $_POST['nombre'];
$correo  = $_POST['correo'];
$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Validar usuario o correo existente
$sql_verificar = "SELECT * FROM usuarios WHERE usuario = ? OR correo = ?";
$stmt = $conn->prepare($sql_verificar);
$stmt->bind_param("ss", $usuario, $correo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<h2>❌ El usuario o correo ya está registrado</h2>";
    exit();
}

// Insertar datos
$sql = "INSERT INTO usuarios (nombre_completo, correo, usuario, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nombre, $correo, $usuario, $password);

if ($stmt->execute()) {
    echo "<h2>✔ Registro exitoso</h2>";
    echo "<a href='login.html'>Iniciar sesión</a>";
} else {
    echo "<h2>❌ Error al registrar</h2>";
}

$conn->close();
?>
