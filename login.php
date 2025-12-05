<?php
// Datos de conexión 
$host = "localhost";
$usuario_db = "root";
$password_db = "";
$base_datos = "restaurante";

// Conexión
$conn = new mysqli($host, $usuario_db, $password_db, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir datos del formulario
$usuario = $_POST['usuario'];
$password = $_POST['password'];

// Consulta SQL (busca por usuario)
$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

// Validación
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Comparar contraseñas SIN encriptar 
    if ($password === $row['password']) {
        // Login correcto
        header("Location: menu.html");
        exit();
    } else {
        echo "<h2>❌ Contraseña incorrecta</h2>";
    }

} else {
    echo "<h2>❌ Usuario no encontrado</h2>";
}

$conn->close();
?>
