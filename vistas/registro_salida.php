<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Salida de Vehículos</title>
</head>
<body>
    <h1>Registro de Salida de Vehículos</h1>
    <form action="../controlador/procesar_salida.php" method="post">
        <label for="placa">Placa:</label>
        <input type="text" id="placa" name="placa" required><br><br>
        
        <input type="submit" value="Registrar Salida">
    </form>
    
    <h2>Vehículos sin salida:</h2>
    <table border="1">
        <tr>
            <th>Placa</th>
            <th>Ingreso</th>
            <!-- Agrega más columnas según los datos que quieras mostrar -->
        </tr>
        <?php
        // Conexión a la base de datos (debes ajustar los datos de conexión)
        $conexion = new mysqli("localhost", "root", "", "pepe");

        // Verificar conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        // Consulta para obtener los vehículos sin salida
        $consulta = "SELECT placa,  fecha_entrada FROM vehiculos WHERE fecha_salida IS NULL";
        $resultado = $conexion->query($consulta);

        // Mostrar los datos en la tabla
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$fila['placa']."</td>";
                echo "<td>".$fila['fecha_entrada']."</td>";
                // Agrega más celdas según los datos que quieras mostrar
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No hay vehículos sin salida</td></tr>";
        }

        // Cerrar conexión
        $conexion->close();
        ?>
    </table>
</body>
</html>
