<?php
// Incluir el archivo de conexión a la base de datos
require_once('../connections/conexion.php');

// Obtener la fecha actual y el número de semana
$fecha_actual = date('Y-m-d');
$numero_semana = date('W');

// Calcular la fecha de inicio de la semana
$fecha_inicio_semana = date('Y-m-d', strtotime("-$numero_semana week"));

// Consulta para obtener los vehículos que ingresaron y salieron durante la semana actual
$query_semanal = "SELECT * FROM vehiculos WHERE fecha_entrada >= '$fecha_inicio_semana'";
$resultado_semanal = $conexion->query($query_semanal);

// Consulta para obtener el total de ingresos de la semana actual
$query_total_semanal = "SELECT SUM(valor_cobro) AS total_semanal FROM vehiculos WHERE fecha_entrada >= '$fecha_inicio_semana'";
$total_semanal = $conexion->query($query_total_semanal)->fetch_assoc();
$total_semanal = $total_semanal['total_semanal'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Semanal</title>
</head>
<body>
    <h1>Informe Semanal</h1>
    <h2>Semana: <?php echo $numero_semana; ?> (<?php echo $fecha_inicio_semana; ?> - <?php echo $fecha_actual; ?>)</h2>
    <h3>Vehículos que ingresaron durante la semana:</h3>
    <table border="1">
        <tr>
            <th>Placa</th>
            <th>Tipo</th>
            <th>Fecha Entrada</th>
            <th>Fecha Salida</th>
            <th>Valor Cobro</th>
        </tr>
        <?php while ($row = $resultado_semanal->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['placa']; ?></td>
            <td><?php echo $row['tipo']; ?></td>
            <td><?php echo $row['fecha_entrada']; ?></td>
            <td><?php echo $row['fecha_salida']; ?></td>
            <td>$<?php echo number_format($row['valor_cobro'], 2); ?></td>
        </tr>
        <?php } ?>
    </table>
    <h3>Total de ingresos de la semana: $<?php echo number_format($total_semanal, 2); ?></h3>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conexion->close();
?>
