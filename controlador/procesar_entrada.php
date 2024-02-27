<?php
// Incluir el archivo de conexión a la base de datos
require_once('../connections/conexion.php');

// Obtener los datos del formulario
$placa = $_POST['placa'];
$tipo = $_POST['tipo'];
$fecha_entrada = date('Y-m-d H:i:s'); // Fecha/hora actual

// Preparar la consulta para insertar el registro en la tabla de vehículos
$query = "INSERT INTO vehiculos (placa, tipo, fecha_entrada) VALUES ('$placa', '$tipo', '$fecha_entrada')";

// Ejecutar la consulta
if ($conexion->query($query) === TRUE) {
    echo "Registro de entrada exitoso.";
} else {
    echo "Error al registrar la entrada: " . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
