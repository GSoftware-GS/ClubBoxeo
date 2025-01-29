<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
</head>
<body>
    <?php
    // Obtener el producto actual
    include '../includes/auth.php';
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    if ($id > 0) {
        $apiKey = $_SESSION['api_key'];
        // Construir la URL de la API correctamente
        $apiUrl = "http://localhost/Ejercicios%20Servidor/ClubBoxeo/api.php/" . $apiKey;
        
        // Obtener todos los productos
        $response = file_get_contents($apiUrl);
        $productosData = json_decode($response, true);
        
        if ($productosData && $productosData["status"] === "success") {
            // Buscar el producto específico por ID
            $producto = null;
            foreach ($productosData["data"] as $prod) {
                if ($prod["id"] == $id) {
                    $producto = $prod;
                    break;
                }
            }
            
            if ($producto) {
    ?>
    <div class="box">
        <div class="form-container">
            <h1>Modificar producto</h1>
            <form action="../php/modificarProducto.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
                <span class="result" id="errorNombre"></span>
                
                <label>Precio:</label>
                <input type="number" name="precio" step="0.01" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
                <span class="result" id="errorPrecio"></span>
                
                <label>Imagen actual:</label>
                <img src="../../img/productos/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="Imagen actual" style="max-width: 200px;">
                
                <label>Nueva imagen (dejar vacío para mantener la actual):</label>
                <input type="file" name="imagen" accept="image/*">
                <input type="hidden" name="imagen_actual" value="<?php echo htmlspecialchars($producto['imagen']); ?>">
                <span class="result" id="errorImagen"></span>
                
                <input type="submit" value="Modificar producto">
            </form>
            <a href='../../productos.php'>Volver a la lista de productos</a>
        </div>
    </div>
    <?php
            } else {
                echo "<p>Error: No se encontró el producto con ID $id.</p>";
            }
        } else {
            echo "<p>Error: No se pudo obtener la información de los productos.</p>";
        }
    } else {
        echo "<p>Error: ID de producto no válido.</p>";
    }
    ?>
</body>
</html>