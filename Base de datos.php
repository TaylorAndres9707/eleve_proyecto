<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'restaurante';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Obtener los datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta SQL para insertar los datos en la base de datos
$sql = "INSERT INTO usuarios (username, password) VALUES (:username, :password)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['username' => $username, 'password' => $password]);

// Redireccionar al usuario a la página de inicio de sesión exitosa
header('Location: login_success.php');
exit();
?>