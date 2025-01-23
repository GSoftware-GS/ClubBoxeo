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
            <form onsubmit="agregarProducto(event)">
                <label>Nombre:</label>
                <input type="text" id="nombre" required>
                <span class="result" id="errorNombre"></span>

                <label>Precio:</label>
                <input type="number" id="precio" step="0.01" required>
                <span class="result" id="errorPrecio"></span>

                <label>URL de imagen:</label>
                <input type="text" id="imagen" required>
                <span class="result" id="errorImagen"></span>

                <input type="submit" value="Añadir producto">
            </form>
            <a href='productos.php'>Volver a la lista de productos</a>
        </div>
    </div>

    <script>
        async function agregarProducto(event) {
            event.preventDefault();

            const nombre = document.getElementById('nombre').value;
            const precio = document.getElementById('precio').value;
            const imagen = document.getElementById('imagen').value;
            const apiKey = '
            <?php include './src/php/session_start.php';
            $_SESSION["api_key"]; ?>';

            try {
                const response = await fetch(`http://localhost/Ejercicios%20Servidor/ClubBoxeo/api.php/${apiKey}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nombre: nombre,
                        precio: precio,
                        imagen: imagen
                    })
                });

                const result = await response.json();

                if (result.status === 'success') {
                    alert('Producto agregado exitosamente');
                    event.target.reset();
                } else {
                    document.getElementById('errorNombre').textContent = result.message;
                }
            } catch (error) {
                document.getElementById('errorNombre').textContent = 'Error en la solicitud: ' + error;
            }
        }
    </script>
</body>

</html>