<?php
require_once("conexion.php");

if (isset($_SESSION['loggedin']) && $_SESSION['rol'] === 'user') {
    $fechaActual = date('Y-m-d'); // Obtener la fecha actual
    // Mostrar solo las noticias que han sido publicadas hasta la fecha actual y ordenarlas por fecha
    $consulta = "SELECT * FROM noticias WHERE fecha_publicacion <= '$fechaActual' ORDER BY fecha_publicacion DESC LIMIT 3";
} else {
    // Para todos los demás, mostrar las últimas 3 noticias ordenadas por fecha
    $consulta = "SELECT * FROM noticias ORDER BY fecha_publicacion DESC LIMIT 3";
}




$noticias = $conexion->query($consulta);

// Convertir el objeto en un array de noticias
$array_noticias = [];
if ($noticias->num_rows > 0) {
    while ($noticia = $noticias->fetch_assoc()) {
        $array_noticias[] = $noticia;
    }
}

// // Invertir el array de noticias
// $array_noticias = array_reverse($array_noticias);

// Mostrar las noticias en el orden invertido
if (count($array_noticias) > 0) {
    foreach ($array_noticias as $noticia) {
        echo "<article>";
        echo "<h2>" . $noticia["titulo"] . "</h2>";
        echo "<p>" . substr($noticia["contenido"], 0, 50)."..." . "</p>";
        echo "<p>Fecha: " . $noticia["fecha_publicacion"] . "</p>";
        echo "<img src='" . "./".$noticia["imagen"] . "' alt='" . $noticia["titulo"] . "' width='100' height='100' class='imagen-noticia'><br>";
        echo "<a href='./src/php/mostrarNoticia.php?id=" . $noticia["id_noticia"] . "' class='boton'>Leer Más </a>";
        echo "</article>";
    }
} else {
    echo "<p>No hay noticias disponibles</p>";
}
