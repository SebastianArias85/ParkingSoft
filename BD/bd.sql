-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS pepe;

-- Usar la base de datos pepe
USE pepe;

-- Crear la tabla vehiculos
CREATE TABLE IF NOT EXISTS vehiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(20) NOT NULL,
    tipo VARCHAR(20) NOT NULL, -- Por ejemplo: Moto, Carro, Camioneta
    fecha_entrada DATETIME NOT NULL,
    fecha_salida DATETIME,
    valor_cobro DECIMAL(10, 2)
);

-- Insertar datos de ejemplo en la tabla vehiculos (opcional)
INSERT INTO vehiculos (placa, tipo, fecha_entrada, fecha_salida, valor_cobro) 
VALUES 
    ('ABC123', 'Carro', '2024-02-28 10:00:00', NULL, NULL),
    ('XYZ789', 'Moto', '2024-02-28 12:30:00', NULL, NULL),
    ('DEF456', 'Camioneta', '2024-02-28 14:45:00', NULL, NULL);

-- Crear la tabla tarifas (si es necesario)
CREATE TABLE IF NOT EXISTS tarifas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(20) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
);

-- Insertar datos de ejemplo en la tabla tarifas (opcional)
INSERT INTO tarifas (tipo, precio) 
VALUES 
    ('Carro', 10.00),
    ('Moto', 5.00),
    ('Camioneta', 15.00);

