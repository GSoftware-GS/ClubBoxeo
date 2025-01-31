<?php
require_once("conexion.php");


$consulta = "SELECT testimonios.id_testimonio, usuarios.nombre AS autor_nombre, usuarios.foto AS foto, testimonios.contenido, testimonios.fecha FROM testimonios JOIN usuarios ON testimonios.autor = usuarios.id_usuario ORDER BY testimonios.fecha DESC;
";

$testimonios = $conexion->query($consulta);

if ($testimonios->num_rows > 0) {
    while ($testimonio = $testimonios->fetch_assoc()) {
        echo "<article>";
        echo "<h2>\"" . $testimonio["autor_nombre"] . "\"</h2>";
        echo "<img src='./$testimonio[foto]' alt='$testimonio[autor_nombre]' width='100' height='100' class='profile-image'><br>";
        echo "<p>\" " . $testimonio["contenido"] . " \"</p>";
        echo "<p>" . $testimonio["fecha"] . "</p>";
        echo "</article>";

    }
} else {
    echo "<p>No hay servicios disponibles</p>";
}

$conexion->close();
?>