<?php
// Incluir el archivo de conexión a la base de datos
require_once('../connections/conexion.php');

// Obtener la fecha actual
$fecha_actual = date('Y-m-d');

// Consulta para obtener los vehículos que ingresaron y salieron hoy
$query_diario = "SELECT * FROM vehiculos WHERE fecha_entrada LIKE '$fecha_actual%' OR fecha_salida LIKE '$fecha_actual%'";
$resultado_diario = $conexion->query($query_diario);

// Consulta para obtener el total de ingresos del día actual
$query_total_diario = "SELECT SUM(valor_cobro) AS total_diario FROM vehiculos WHERE fecha_salida LIKE '$fecha_actual%'";
$total_diario = $conexion->query($query_total_diario)->fetch_assoc();
$total_diario = $total_diario['total_diario'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Diario</title>
</head>
<body>
    <h1>Informe Diario</h1>
    <h2>Fecha: <?php echo $fecha_actual; ?></h2>
    <h3>Vehículos que ingresaron y salieron hoy:</h3>
    <table border="1">
        <tr>
            <th>Placa</th>
            <th>Tipo</th>
            <th>Fecha Entrada</th>
            <th>Fecha Salida</th>
            <th>Valor Cobro</th>
        </tr>
        <?php while ($row = $resultado_diario->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['placa']; ?></td>
            <td><?php echo $row['tipo']; ?></td>
            <td><?php echo $row['fecha_entrada']; ?></td>
            <td><?php echo $row['fecha_salida']; ?></td>
            <td>$<?php echo number_format($row['valor_cobro'], 2); ?></td>
        </tr>
        <?php } ?>
    </table>
    <h3>Total de ingresos del día: $<?php echo number_format($total_diario, 2); ?></h3>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conexion->close();
?>
