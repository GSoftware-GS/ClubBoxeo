<?php
require_once("conexion.php");

$idNoticia = $_GET['id'];

// Consulta para obtener la noticia
$consulta = "SELECT * FROM noticias WHERE id_noticia = $idNoticia";
$resultado = $conexion->query($consulta);
$noticia = $resultado->fetch_assoc();
echo "<div class='container-noticia'>";

if ($noticia) {
    echo "<article>";
    echo "<h2>" . $noticia["titulo"] . "</h2>";
    echo "<p>" . $noticia["contenido"] . "</p>";
    echo "<p>Fecha: " . $noticia["fecha_publicacion"] . "</p>";
    echo "<img src='" . "../../" . $noticia["imagen"] . "' alt='" . $noticia["titulo"] . "' width='100' height='100' class='imagen-noticia'><br>";
    echo "</article>";
} else {
    echo "<p>No se ha encontrado la noticia</p>";
}

echo "<a href='../../noticias.php' class='boton'>Volver</a>";
echo "</div>";
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Aquí corriges la manera en que insertas el título -->
        <title><?php echo htmlspecialchars($noticia['titulo']); ?></title>
        <link rel="stylesheet" href="../../styles/style.css">
    </head>
    <body>
    </body>
</html>
