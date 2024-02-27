<?php
// Datos de conexión a la base de datos
$hostname_conexion = "localhost"; // Cambiar si la base de datos no está en localhost
$database_conexion = "pepe"; // Nombre de tu base de datos
$username_conexion = "root"; // Nombre de usuario de MySQL
$password_conexion = ""; // Contraseña de MySQL (en este caso está vacía)

// Establecer la conexión
$conexion = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8
$conexion->set_charset("utf8");
?>
