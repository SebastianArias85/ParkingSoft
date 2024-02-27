<?php
// Incluir el archivo de conexión a la base de datos
require_once('../connections/conexion.php');

// Consulta para obtener las tarifas actuales
$query_tarifas = "SELECT * FROM tarifas";
$resultado_tarifas = $conexion->query($query_tarifas);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tarifas</title>
</head>

<body>
    <h1>Gestión de Tarifas</h1>
    <table border="1">
        <tr>
            <th>Tipo</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $resultado_tarifas->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['tipo']; ?></td>
                <td>$<?php echo number_format($row['precio'], 2); ?></td>
                <td><a href="modificar_tarifa.php?tipo=<?php echo $row['tipo']; ?>">Modificar</a></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>

<?php
// Cerrar la conexión a la base de datos
$conexion->close();
?>
