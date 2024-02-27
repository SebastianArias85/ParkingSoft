<?php
// Incluir el archivo de conexión a la base de datos
require_once('../connections/conexion.php');

// Obtener la fecha actual y el año y mes actuales
$fecha_actual = date('Y-m-d');
$anio_actual = date('Y');
$mes_actual = date('m');

// Construir la fecha de inicio y fin del mes actual
$primer_dia_mes = date('Y-m-01');
$ultimo_dia_mes = date('Y-m-t');

// Consulta para obtener los vehículos que ingresaron y salieron durante el mes actual
$query_mensual = "SELECT * FROM vehiculos WHERE fecha_entrada BETWEEN '$primer_dia_mes' AND '$ultimo_dia_mes'";
$resultado_mensual = $conexion->query($query_mensual);

// Consulta para obtener el total de ingresos del mes actual
$query_total_mensual = "SELECT SUM(valor_cobro) AS total_mensual FROM vehiculos WHERE fecha_entrada BETWEEN '$primer_dia_mes' AND '$ultimo_dia_mes'";
$total_mensual = $conexion->query($query_total_mensual)->fetch_assoc();
$total_mensual = $total_mensual['total_mensual'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Mensual</title>
</head>
<body>
    <h1>Informe Mensual</h1>
    <h2>Mes: <?php echo date('F Y', strtotime($primer_dia_mes)); ?></h2>
    <h3>Vehículos que ingresaron durante el mes:</h3>
    <table border="1">
        <tr>
            <th>Placa</th>
            <th>Tipo</th>
            <th>Fecha Entrada</th>
            <th>Fecha Salida</th>
            <th>Valor Cobro</th>
        </tr>
        <?php while ($row = $resultado_mensual->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['placa']; ?></td>
            <td><?php echo $row['tipo']; ?></td>
            <td><?php echo $row['fecha_entrada']; ?></td>
            <td><?php echo $row['fecha_salida']; ?></td>
            <td>$<?php echo number_format($row['valor_cobro'], 2); ?></td>
        </tr>
        <?php } ?>
    </table>
    <h3>Total de ingresos del mes: $<?php echo number_format($total_mensual, 2); ?></h3>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conexion->close();
?>
