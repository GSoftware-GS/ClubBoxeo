<?php
require_once("conexion.php");

// Número de productos por página
$productosPorPagina = 4;

// Página actual, si no se especifica será la primera (1)
$paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $productosPorPagina;

// Parámetros de búsqueda
$nombreFiltro = isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre'], ENT_QUOTES, 'UTF-8') : '';
$precioFiltro = isset($_GET['precio']) ? (float) $_GET['precio'] : '';

// Construcción de la URL de la API con los filtros
$apiKey = htmlspecialchars($_SESSION['api_key'], ENT_QUOTES, 'UTF-8');
$apiUrl = "http://localhost/Ejercicios%20Servidor/ClubBoxeo/api.php/" . $apiKey;
if (!empty($nombreFiltro)) {
    $apiUrl .= "?nombre=" . urlencode($nombreFiltro);
} elseif (!empty($precioFiltro)) {
    $apiUrl .= "?precio=" . urlencode($precioFiltro);
}

// Obtener los productos desde la API
$apiResponse = file_get_contents($apiUrl);
$productosData = json_decode($apiResponse, true);

// Formulario de búsqueda (siempre visible)
echo "<form method='GET' action=''>
    <label for='nombre'>Buscar por nombre:</label>
    <input type='text' name='nombre' id='nombre' value='" . htmlspecialchars($nombreFiltro) . "'>
    <label for='precio'>Buscar por precio menor a:</label>
    <input type='number' step='0.01' name='precio' id='precio' value='" . htmlspecialchars($precioFiltro) . "'>
    <button type='submit'>Buscar</button>
</form>";

if ($productosData && $productosData["status"] === "success") {
    $productos = $productosData["data"];

    // Calcular total de productos y páginas
    $totalProductos = count($productos);
    $totalPaginas = ceil($totalProductos / $productosPorPagina);

    // Seleccionar los productos para la página actual
    $productosPagina = array_slice($productos, $offset, $productosPorPagina);

    // Mostrar productos
    if (!empty($productosPagina)) {
        foreach ($productosPagina as $producto) {
            echo "<article>";
            echo "<h2>" . htmlspecialchars($producto["nombre"]) . "</h2>";
            echo "<p>" . htmlspecialchars($producto["precio"]) . " €</p>";
            echo "<img src='./img/productos/" . htmlspecialchars($producto["imagen"]) . "' alt='" . htmlspecialchars($producto["nombre"]) . "' width='100' height='100' class='imagen-producto'><br>";
            echo "</article>";
        }
    } else {
        echo "<p>No hay productos disponibles en esta página</p>";
    }

    // Mostrar botones de paginación
    echo "<div class='paginacion'>";
    if ($paginaActual > 1) {
        echo "<a href='?pagina=" . ($paginaActual - 1) . "&nombre=$nombreFiltro&precio=$precioFiltro' class='boton'>Anterior</a> ";
    }

    for ($i = 1; $i <= $totalPaginas; $i++) {
        if ($i == $paginaActual) {
            echo "<strong style='color: red;'>$i</strong> ";
        } else {
            echo "<a href='?pagina=$i&nombre=$nombreFiltro&precio=$precioFiltro' style='color: white; text-decoration: none;'>$i</a> ";
        }
    }

    if ($paginaActual < $totalPaginas) {
        echo "<a href='?pagina=" . ($paginaActual + 1) . "&nombre=$nombreFiltro&precio=$precioFiltro' class='boton'>Siguiente</a>";
    }
    echo "</div>";
} else {
    echo "<p>No se pudo obtener la lista de productos</p>";
}

$conexion->close();
?>
