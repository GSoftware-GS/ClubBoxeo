<?php
require_once("conexion.php");


// Número de noticias por página
$productosPorPagina = 4;

// Página actual, si no se especifica será la primera (1)
$paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $productosPorPagina;

// Contar el total de productos
$totalProductosConsulta = "SELECT COUNT(*) as total FROM productos";
$totalProductosResultado = $conexion->query($totalProductosConsulta);
$totalProductos = $totalProductosResultado->fetch_assoc()['total'];

// Calcular el total de páginas
$totalPaginas = ceil($totalProductos / $productosPorPagina);


$consulta = "SELECT * FROM productos  ORDER BY nombre DESC LIMIT $offset, $productosPorPagina";


$productos = $conexion->query($consulta);

if ($productos->num_rows > 0) {
    while ($producto = $productos->fetch_assoc()) {
        echo "<article>";
        echo "<h2>" . $producto["nombre"] . "</h2>";
        echo "<p>" . $producto["precio"] . " €</p>";
        echo "</article>";
    }
} else {
    echo "<p>No hay productos disponibles</p>";
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