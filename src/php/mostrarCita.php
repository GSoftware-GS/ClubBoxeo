<?php
include '../includes/auth.php';
require_once("conexion.php");

$idCita = $_GET['id'];

// Consulta para obtener la cita
$consulta = "SELECT s2.id_socio, s2.nombre, c.fecha, c.hora, s.descripcion
    FROM citas c
    JOIN servicios s ON c.codigo_servicio = s.codigo_servicio
    JOIN socios s2 ON c.codigo_socio = s2.id_socio
    WHERE c.id = '$idCita'";
$resultado = $conexion->query($consulta);
$cita = $resultado->fetch_assoc();

echo "<div class='container-cita'>";

if ($cita) {
    echo "<article>";
    echo "<h2>" . $cita["nombre"] . "</h2>";
    echo "<p>" . $cita["descripcion"] . "</p>";
    echo "<p>Fecha: " . $cita["fecha"] . "</p>";
    echo "<p>Hora: " . $cita["hora"] . "</p>";
    echo "</article>";

    // Comparar la fecha de la cita con la fecha actual
    $fechaCita = $cita["fecha"];
    $fechaActual = date("Y-m-d");

    // Mostrar botones solo si el usuario es admin y la fecha de la cita no ha pasado
    if (isset($_SESSION['loggedin']) && $_SESSION['rol'] === 'admin' && $fechaCita > $fechaActual) {
        echo "<a href='../forms/formularioModificarCita.php?id=" . $idCita . "' class='boton'>Modificar</a>";
        echo "<a href='./eliminarCita.php?id=" . $idCita . "' class='boton'>Eliminar</a>";
    }
} else {
    echo "<p>No se ha encontrado la cita</p>";
}

echo "<a href='../../citas.php' class='boton'>Volver</a>";
echo "</div>";
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