<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Entrada de Vehículos</title>
</head>
<body>
    <h1>Registro de Entrada de Vehículos</h1>
    <form action="../controlador/procesar_entrada.php" method="post">
        <label for="placa">Placa:</label>
        <input type="text" id="placa" name="placa" required><br><br>
        
        <label for="tipo">Tipo de Vehículo:</label>
        <select name="tipo" id="tipo">
            <option value="Coche">Coche</option>
            <option value="Motocicleta">Motocicleta</option>
            <option value="Camión">Camión</option>
            <!-- Agrega más opciones según tus necesidades -->
        </select><br><br>
        
        <input type="submit" value="Registrar Entrada">
    </form>
</body>
</html>
