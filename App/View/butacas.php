<?php

use App\Lib\BaseDatos;

require __DIR__ . '/../Lib/BaseDatos.php';

// Instanciar la clase BaseDatos
$baseDatos = new \App\Lib\BaseDatos();

// Obtener la conexión a la base de datos
$conexion = $baseDatos->getConnection();

// Consulta para obtener todas las butacas
$stmt = $conexion->prepare("SELECT * FROM butacas ORDER BY fila, columna");
$stmt->execute();
$butacas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Butacas</title>
    <style>
        table {
            border-collapse: collapse;
            margin: 20px auto;
            width: 80%;
        }
        th, td {
            width: 40px;
            height: 40px;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #000;
        }
        .libre {
            background-color: #a8e6cf;
        }
        .ocupada {
            background-color: #ff8b94;
        }
        .reservada {
            background-color: #ffd3b6;
        }
        th {
            background-color: #d3d3d3;
        }
    </style>
</head>
<body>
    <h1>Bienvenido al Teatro IES Francisco Ayala</h1>
   
    <p>¿Desea reservar ahora sus butacas? 
        <a href="<?= BASE_URL ?>/views/reservas/reserva.php">Reserva</a>
    </p>
    
    <h2>Escenario:</h2>
    <table>
        <thead>
            <tr>
                <th></th> <!-- Celda vacía en la esquina superior izquierda -->
                <?php for ($col = 1; $col <= 10; $col++): ?>
                    <th><?= $col ?></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            // Reorganizar los datos por fila y columna
            $butacasPorFila = [];
            foreach ($butacas as $butaca) {
                $butacasPorFila[$butaca['fila']][$butaca['columna']] = $butaca['estado'];
            }

            // Renderizar las filas
            for ($fila = 1; $fila <= 10; $fila++) {
                echo '<tr>';
                echo "<th>$fila</th>"; // Número de la fila
                for ($columna = 1; $columna <= 10; $columna++) {
                    $estado = $butacasPorFila[$fila][$columna] ?? 'libre'; // Estado o 'libre' si no existe
                    echo "<td class='$estado'></td>";
                }
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>