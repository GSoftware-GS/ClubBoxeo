<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Servicio</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
    <script src="../js/validarServicio.js" defer></script>
</head>

<body>
    <div class="box">
        <div class="form-container">
            <?php include '../php/agregarServicio.php'; ?>
            <h1>Añadir nuevo Servicio</h1>
            <form method="POST" action="" enctype="multipart/form-data">
                <label>Descripcion:</label>
                <input type="text" name="descripcion" required>
                <span id="errorDescripcion" class="error"></span><br>

                <label>Duracion:</label>
                <input type="number" name="duracion" required>
                <span id="errorDuracion" class="error"></span><br>

                <label>Precio:</label>
                <input type="number" name="precio" required>
                <span id="errorPrecio" class="error"></span><br>



                <input type="submit" value="Añadir Servicio">
            </form>
            <a href='../../servicios.php'>Volver a la lista de servicios</a>

        </div>
    </div>
</body>

</html>