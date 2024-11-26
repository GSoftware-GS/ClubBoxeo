<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar Servicio</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
    <script src="../js/validarBuscarServicio.js" defer></script>

</head>

<body>
    <div class="box">
    <div class="form-container">
        <?php include '../php/buscarServicio.php'; ?>
        <h1>Buscar servicio</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <label>Nombre:</label>
            <input type="text" name="descripcion">
            <span id="errorDescripcion" class="error"></span><br>


            <input type="submit" value="Buscar Servicio">
        </form>

        <a href='../../servicios.php'>Volver a la lista de servicios</a>

    </div>
    </div>
</body>

</html>