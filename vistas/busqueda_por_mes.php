<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe Mensual</title>
</head>

<body>
    <h1>Informe Mensual</h1>

    <!-- Formulario para seleccionar el mes y el año -->
    <form method="post">
        <label for="mes">Seleccione el mes:</label>
        <select name="mes" id="mes">
            <?php
            // Array asociativo con los nombres de los meses en español
            $meses = array(
                '01' => 'Enero',
                '02' => 'Febrero',
                '03' => 'Marzo',
                '04' => 'Abril',
                '05' => 'Mayo',
                '06' => 'Junio',
                '07' => 'Julio',
                '08' => 'Agosto',
                '09' => 'Septiembre',
                '10' => 'Octubre',
                '11' => 'Noviembre',
                '12' => 'Diciembre'
            );

            // Generar opciones para los meses del año en español
            foreach ($meses as $numero_mes => $nombre_mes) {
                printf('<option value="%s">%s</option>', $numero_mes, $nombre_mes);
            }
            ?>
        </select>

        <label for="anio">Seleccione el año:</label>
        <select name="anio" id="anio">
            <?php
            // Obtener el año actual y generar opciones para los años
            $anio_actual = date('Y');
            for ($i = $anio_actual; $i >= $anio_actual - 10; $i--) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>

        <input type="submit" value="Generar Informe">
    </form>

    <?php
    // Incluir el archivo de conexión a la base de datos
    require_once('../connections/conexion.php');

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener el mes y el año seleccionados
        $mes = $_POST["mes"];
        $anio = $_POST["anio"];

        // Construir la fecha de inicio y fin del mes seleccionado
        $primer_dia_mes = date("$anio-$mes-01");
        $ultimo_dia_mes = date("$anio-$mes-t");

        // Consulta para obtener los vehículos que ingresaron durante el mes seleccionado
        $query_mensual = "SELECT * FROM vehiculos WHERE fecha_entrada BETWEEN '$primer_dia_mes' AND '$ultimo_dia_mes'";
        $resultado_mensual = $conexion->query($query_mensual);

        // Consulta para obtener el total de ingresos del mes seleccionado
        $query_total_mensual = "SELECT SUM(valor_cobro) AS total_mensual FROM vehiculos WHERE fecha_entrada BETWEEN '$primer_dia_mes' AND '$ultimo_dia_mes'";
        $total_mensual = $conexion->query($query_total_mensual)->fetch_assoc();
        $total_mensual = $total_mensual['total_mensual'];
    ?>

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

    <?php
        // Liberar el resultado y cerrar la conexión a la base de datos
        $resultado_mensual->free();
    }
    ?>
</body>

</html>
