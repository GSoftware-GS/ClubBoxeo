<?php
require_once("conexion.php");


$consulta = "SELECT * FROM servicios";

$servicios = $conexion->query($consulta);

if ($servicios->num_rows > 0) {
    while ($servicio = $servicios->fetch_assoc()) {
        echo "<article>";
        echo "<h2>" . $servicio["descripcion"] . "</h2>";
        echo "<p>Duracion: " . $servicio["duracion"] . "</p>";
        echo "<p>Precio: " . $servicio["precio"] . "</p>";
        if (isset($_SESSION['loggedin']) && $_SESSION['rol'] === 'admin') {
        echo "<a href='./src/forms/formularioModificarServicio.php?codigo_servicio=" . $servicio["codigo_servicio"] . "' class ='boton'>Modificar </a>";
        }
        echo "</article>";
    }
} else {
    echo "<p>No hay servicios disponibles</p>";
}

$conexion->close();
?>