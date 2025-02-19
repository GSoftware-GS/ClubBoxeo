<?php
require_once("conexion.php");

// Configuración de paginación
$productosPorPagina = 4;
$paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$offset = max(0, ($paginaActual - 1) * $productosPorPagina);

// Procesamiento de filtros
$nombreFiltro = isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre'], ENT_QUOTES, 'UTF-8') : '';
$precioFiltro = isset($_GET['precio']) ? (float) $_GET['precio'] : 0;

// Construcción de URL de la API
$params = [];
if (!empty($nombreFiltro))
    $params['nombre'] = $nombreFiltro;
if (!empty($precioFiltro))
    $params['precio'] = $precioFiltro;

$apiUrl = "http://localhost/ClubBoxeo/api.php/" . 
    urlencode($_SESSION['api_key'] ?? '') . 
    (!empty($params) ? '?' . http_build_query($params) : '');

// Obtención de datos de la API
$apiResponse = @file_get_contents($apiUrl);
if ($apiResponse === false) {
    $errorAPI = "Error al conectar con el servidor de productos";
}
$productosData = $apiResponse ? json_decode($apiResponse, true) : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Club Boxeo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <?php if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin'): ?>
        <!-- Solo se carga el script del carrito si NO es admin -->
        <script src="./src/js/carrito.js" defer></script>
    <?php endif; ?>
</head>
<body>
    <?php if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin'): ?>
    <!-- Carrito (sólo se muestra si el usuario no es admin) -->
    <div class="cart-overlay">
        <aside class="cart">
            <button class="cart-close"><i class="fas fa-times"></i></button>
            <header>
                <h3 class="text-slanted">Carrito de compras</h3>
                <button class="cart-vaciar btn">Vaciar carrito</button>
            </header>
            <div class="cart-items"></div>
            <footer>
                <button class="cart-checkout btn">Finalizar compra</button>
            </footer>
        </aside>
    </div>
    <?php endif; ?>

    <!-- Contenido principal -->
    <section class="products">
        <div class="filters">
            <?php if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin'): ?>
            <div class="toggle-container">
                <button class="toggle-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-item-count">0</span>
                </button>
            </div>
            <?php endif; ?>
            <form method="GET" class="search-form">
                <input type="text" name="nombre" placeholder="Buscar por nombre..." value="<?= $nombreFiltro ?>">
                <input type="number" step="0.01" name="precio" placeholder="Precio máximo..." value="<?= $precioFiltro ?>">
                <button type="submit" class="boton"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <!-- Mensajes y alertas -->
        <div class="alerta"></div>

        <!-- Listado de productos -->
        <div class="products-container">
            <?php if (isset($errorAPI)): ?>
                <p class="error"><?= $errorAPI ?></p>
            <?php elseif ($productosData && $productosData["status"] === "success"): ?>
                <?php
                $productos = $productosData["data"];
                $totalProductos = count($productos);
                $productosPagina = array_slice($productos, $offset, $productosPorPagina);
                $totalPaginas = ceil($totalProductos / $productosPorPagina);
                ?>

                <?php foreach ($productosPagina as $producto): ?>
                    <article class="product">
                        <div class="product-container" data-id="<?= $producto['id'] ?>">
                            <img src="./img/productos/<?= $producto['imagen'] ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>" class="product-img">
                            <div class="product-icons">
                                <?php if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin'): ?>
                                <button class="product-cart-btn">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>
                        <footer>
                            <h3 class="product-name"><?= htmlspecialchars($producto['nombre']) ?></h3>
                            <p class="product-price"><?= number_format($producto['precio'], 2) ?> €</p>
                            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
                                <div class="admin-buttons">
                                    <a href="./src/forms/formualrioModificarProducto.php?id=<?= $producto['id'] ?>" class="btn">Editar</a>
                                    <a href="./src/php/eliminarProducto.php?id=<?= $producto['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Eliminar este producto?')">Eliminar</a>
                                </div>
                            <?php endif; ?>
                        </footer>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- Paginación -->
            <?php if ($totalPaginas > 1): ?>
                <div class="paginacion">
                    <?php if ($paginaActual > 1): ?>
                        <a href="?<?= http_build_query(array_merge($_GET, ['pagina' => $paginaActual - 1])) ?>" class="btn">Anterior</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <a href="?<?= http_build_query(array_merge($_GET, ['pagina' => $i])) ?>" class="btn <?= $i === $paginaActual ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>

                    <?php if ($paginaActual < $totalPaginas): ?>
                        <a href="?<?= http_build_query(array_merge($_GET, ['pagina' => $paginaActual + 1])) ?>" class="btn">Siguiente</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php else: ?>
                <p class="info">No se encontraron productos</p>
            <?php endif; ?>
    </section>
</body>
</html>
<?php
if (isset($conexion) && $conexion instanceof mysqli) {
    $conexion->close();
}
?>
