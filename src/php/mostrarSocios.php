<?php
require_once("conexion.php");


$consulta = "SELECT id_socio, nombre, edad, usuario, telefono, foto FROM socios";

$socios = $conexion->query($consulta);

if ($socios->num_rows > 0) {
    while ($socio = $socios->fetch_assoc()) {
        echo "<article class='socio'>";
        echo "<h2>" . $socio["nombre"] . "</h2>";
        echo "<p>Edad: " . $socio["edad"] . "</p>";
        echo "<p>Usuario: " . $socio["usuario"] . "</p>";
        echo "<p>Telefono: " . $socio["telefono"] . "</p>";
        echo "<div class='profile-image'>";
        echo "<img src='./$socio[foto]' alt='$socio[nombre]' width='100' height='100'><br>";
        echo "</div>";
        echo "<a href='./src/forms/formularioModificarSocio.php?id=" . $socio["id_socio"] . "' class='boton'>Modificar </a>";
        echo "<a href='./src/php/eliminarSocio.php?id=" . $socio["id_socio"] . "'class='boton'>Eliminar</a>";
        echo "</article>";
    }
} else {
    echo "<p>No hay socios registrados</p>";
}

$conexion->close();
?>


