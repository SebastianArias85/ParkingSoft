<?php
// Incluir el archivo de conexión a la base de datos
require_once('../connections/conexion.php');

// Obtener la placa del vehículo desde el formulario
$placa = $_POST['placa'];

// Obtener el registro del vehículo desde la base de datos
$query = "SELECT * FROM vehiculos WHERE placa = '$placa' AND fecha_salida IS NULL";
$resultado = $conexion->query($query);

if ($resultado->num_rows > 0) {
    // Obtener la fecha/hora de salida (actual)
    $fecha_salida = date('Y-m-d H:i:s');
    
    // Calcular el tiempo de estancia y el valor a cobrar (asumiendo una tarifa fija por hora)
    $vehiculo = $resultado->fetch_assoc();
    $fecha_entrada = strtotime($vehiculo['fecha_entrada']);
    $fecha_salida_timestamp = strtotime($fecha_salida);
    $duracion = ($fecha_salida_timestamp - $fecha_entrada) / 3600; // Duración en horas
    $tarifa_hora = 10; // Ejemplo de tarifa por hora (puedes cambiarlo según tus necesidades)
    $valor_cobro = $duracion * $tarifa_hora;
    
    // Actualizar la fecha/hora de salida y el valor a cobrar en la base de datos
    $update_query = "UPDATE vehiculos SET fecha_salida = '$fecha_salida', valor_cobro = $valor_cobro WHERE placa = '$placa' AND fecha_salida IS NULL";
    if ($conexion->query($update_query) === TRUE) {
        echo "Registro de salida exitoso. Valor a cobrar: $" . number_format($valor_cobro, 2);
    } else {
        echo "Error al registrar la salida: " . $conexion->error;
    }
} else {
    echo "No se encontró ningún vehículo con la placa proporcionada o ya ha salido.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
