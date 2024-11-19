<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar Servicio</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
</head>

<body>
    <div class="box">
        <div class="form-container">
        <?php include '../php/modificarServicio.php'; ?>
    <h1>Modificar datos de <?php echo htmlspecialchars($servicio['descripcion']); ?></h1>
    <form method="POST" action="">
        <label>Descripcion:</label>
        <input type="text" name="descripcion" value="<?php echo htmlspecialchars($servicio['descripcion']); ?>" required><br>

        <label>Duracion:</label>
        <input type="number" name="duracion" value="<?php echo htmlspecialchars($servicio['duracion']); ?>" required><br>

        <label>Precio:</label>
        <input type="text" name="precio" value="<?php echo htmlspecialchars($servicio['precio']); ?>" required><br>

        <input type="submit" value="Guardar cambios">
    </form>
    <a href='../../servicios.php'>Volver a la lista de servicios</a>
    </div>
    </div>
</body>

</html>