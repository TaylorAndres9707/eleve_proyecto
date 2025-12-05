<?php
$host = "localhost";
$user = "root";     // Cambia si tu MySQL usa otro usuario
$pass = "";         // Si usas XAMPP esto normalmente queda vacío
$db   = "restaurante";    // Nombre de tu base de datos

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>