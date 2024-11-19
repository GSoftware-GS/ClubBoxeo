<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Servicio</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
</head>

<body>
    <div class="box">
        <div class="form-container">
        <?php include '../php/agregarServicio.php'; ?>
    <h1>Añadir nuevo Servicio</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Descripcion:</label>
        <input type="text" name="descripcion" required><br>

        <label>Duracion:</label>
        <input type="number" name="duracion" required><br>

        <label>Precio:</label>
        <input type="number" name="precio" required><br>


        <input type="submit" value="Añadir Servicio">
    </form>
    <a href='../../servicios.php'>Volver a la lista de servicios</a>

        </div>
    </div>
</body>

</html>