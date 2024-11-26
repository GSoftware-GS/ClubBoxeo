<?php
require_once("conexion.php");


// Número de noticias por página
$noticiasPorPagina = 4;

// Página actual, si no se especifica será la primera (1)
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $noticiasPorPagina;

// Contar el total de noticias
$totalNoticiasConsulta = "SELECT COUNT(*) as total FROM noticias";
$totalNoticiasResultado = $conexion->query($totalNoticiasConsulta);
$totalNoticias = $totalNoticiasResultado->fetch_assoc()['total'];

// Calcular el total de páginas
$totalPaginas = ceil($totalNoticias / $noticiasPorPagina);

if (isset($_SESSION['loggedin']) && $_SESSION['rol'] === 'user') {
    $fechaActual = date('Y-m-d'); // Obtener la fecha actual
    $consulta = "SELECT * FROM noticias WHERE fecha_publicacion <= '$fechaActual' LIMIT $offset, $noticiasPorPagina";
} else {
    // Si es un 'admin', no hay filtro por fecha
    $consulta = "SELECT * FROM noticias LIMIT $offset, $noticiasPorPagina";
}

$noticias = $conexion->query($consulta);

if ($noticias->num_rows > 0) {
    while ($noticia = $noticias->fetch_assoc()) {
        echo "<article>";
        echo  "<h2>" . $noticia["titulo"] . "</h2>";
        echo substr($noticia["contenido"], 0, 100)."..." . "</p>";
        echo "<p>Fecha: " . $noticia["fecha_publicacion"] . "</p>";
        echo "<img src='"."./" . $noticia["imagen"] . "' alt='" . $noticia["titulo"] . "' width='100' height='100' class='imagen-noticia'><br>";
        echo "<a href='./src/php/mostrarNoticia.php?id=" . $noticia["id_noticia"] . "' class='boton'>Leer Más </a>";
        echo "</article>";
    }
} else {
    echo "<p>No hay noticias disponibles</p>";
}

// Mostrar botones de paginación
echo "<div class='paginacion'>";
if ($paginaActual > 1) {
    echo "<a href='?pagina=" . ($paginaActual - 1) . "' class='boton'>Anterior</a> ";
}

for ($i = 1; $i <= $totalPaginas; $i++) {
    if ($i == $paginaActual) {
        echo "<strong style='color: red;'>$i</strong> ";
    } else {
        echo "<a href='?pagina=$i' style='color: white; text-decoration: none;'>$i</a> ";
    }
}

if ($paginaActual < $totalPaginas) {
    echo "<a href='?pagina=" . ($paginaActual + 1) . "' class='boton'>Siguiente</a>";
}
echo "</div>";

$conexion->close();
?>
