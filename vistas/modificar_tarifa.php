<?php
// Incluir el archivo de conexión a la base de datos
require_once('../connections/conexion.php');

// Obtener el tipo de vehículo de la URL
$tipo_vehiculo = $_GET['tipo'];

// Obtener la tarifa actual del tipo de vehículo
$query_tarifa_actual = "SELECT precio FROM tarifas WHERE tipo = '$tipo_vehiculo'";
$resultado_tarifa_actual = $conexion->query($query_tarifa_actual);
$tarifa_actual = $resultado_tarifa_actual->fetch_assoc()['precio'];

// Manejar el formulario enviado para actualizar la tarifa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la nueva tarifa del formulario
    $nueva_tarifa = $_POST["nueva_tarifa"];

    // Verificar si el campo de la nueva tarifa está vacío
    if (empty($nueva_tarifa)) {
        echo "<script>alert('Por favor, ingrese un valor para la nueva tarifa.');</script>";
    } else {
        // Actualizar la tarifa en la base de datos
        $query_update_tarifa = "UPDATE tarifas SET precio = $nueva_tarifa WHERE tipo = '$tipo_vehiculo'";
        $resultado_update_tarifa = $conexion->query($query_update_tarifa);

        // Redirigir a la página anterior
        header("Location: gestion_tarifas.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Tarifa</title>
</head>

<body>
    <h1>Modificar Tarifa</h1>
    <form method="post">
        <label for="nueva_tarifa">Nueva Tarifa para <?php echo $tipo_vehiculo; ?>:</label>
        <input type="text" name="nueva_tarifa" value="<?php echo $tarifa_actual; ?>"><br><br>

        <input type="submit" value="Modificar">
        <a href="gestion_tarifas.php">Volver</a>
    </form>
</body>

</html>

<?php
// Cerrar la conexión a la base de datos
$conexion->close();
?>
