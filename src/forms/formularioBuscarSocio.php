<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar Socio</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
    <script src="../js/validarBuscarSocio.js" defer></script>

</head>

<body>
    <div class="box">
        <div class="form-container">
            <?php include '../php/buscarSocio.php'; ?>
            <h1>Buscar Socio</h1>
            <form method="POST" action="" enctype="multipart/form-data">
            <label>Nombre:</label>
                <input type="text" name="nombre" ><br>
                <span class="result" id="errorNombre"></span>

                <label>Teléfono:</label>
                <input type="tel" name="telefono" ><br>
                <span class="result" id="errorTelefono"></span>

                <input type="submit" value="Buscar socio">
            </form>

            <a href='../../socios.php'>Volver a la lista de socios</a>

        </div>
    </div>
</body>

</html>