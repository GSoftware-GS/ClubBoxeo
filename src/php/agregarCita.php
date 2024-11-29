<?php
require_once("conexion.php");

$socio = $_POST['socio'];
$servicio = $_POST['servicio'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

// Verificar si ya existe una cita para el mismo socio en la misma fecha y hora
$consulta = "SELECT * FROM citas WHERE codigo_socio = ? AND fecha = ? AND hora = ?";
$stmt = $conexion->prepare($consulta);
$stmt->bind_param("iss", $socio, $fecha, $hora);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Si ya existe una cita
    echo "<p>El socio ya tiene una cita programada en esta fecha y hora.</p>";
    echo "<a href='../../citas.php' class='boton'>Volver a la lista de citas</a>";
} else {
    // Insertar la nueva cita si no existe conflicto
    $sql = "INSERT INTO citas (codigo_socio, codigo_servicio, fecha, hora) VALUES (?, ?, ?, ?)";
    $stmtInsert = $conexion->prepare($sql);
    $stmtInsert->bind_param("iiss", $socio, $servicio, $fecha, $hora);

    if ($stmtInsert->execute()) {
        echo "<p>Cita agregada correctamente.</p>";
        echo "<a href='../../citas.php' class='boton'>Volver a la lista de citas</a>";
    } else {
        echo "<p>Error al agregar la cita: " . $stmtInsert->error . "</p>";
    }
}

$conexion->close();
?>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../../styles/style.css">
    </head>
    <body>

    </body>
</html>
