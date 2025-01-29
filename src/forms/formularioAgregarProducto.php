<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
</head>
<body>
    <div class="box">
        <div class="form-container">
            <h1>Añadir nuevo producto</h1>
            <form action="../php/agregarProducto.php" method="POST" enctype="multipart/form-data">
                <label>Nombre:</label>
                <input type="text" name="nombre" required>
                <span class="result" id="errorNombre"></span>
                
                <label>Precio:</label>
                <input type="number" name="precio" step="0.01" required>
                <span class="result" id="errorPrecio"></span>
                
                <label>Imagen del producto:</label>
                <input type="file" name="imagen" accept="image/*" required>
                <span class="result" id="errorImagen"></span>
                
                <input type="submit" value="Añadir producto">
            </form>
            <a href='../../productos.php'>Volver a la lista de productos</a>
        </div>
    </div>
</body>
</html>