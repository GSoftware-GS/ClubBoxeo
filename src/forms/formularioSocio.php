<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Socio</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
    <script src="../js/validarSocio.js" defer></script>
</head>

<body>
    <div class="box">
        <div class="form-container">
            <?php include '../php/agregarSocio.php'; ?>
            <h1>Añadir nuevo socio</h1>
            <form method="POST" action="" enctype="multipart/form-data">
                <label>Nombre:</label>
                <input type="text" name="nombre" ><br>
                <span class="result" id="errorNombre"></span>

                <label>Edad:</label>
                <input type="number" name="edad" ><br>
                <span class="result" id="errorEdad"></span>

                <label>Usuario:</label>
                <input type="text" name="usuario" ><br>
                <span class="result" id="errorUsuario"></span>

                <label>Teléfono:</label>
                <input type="tel" name="telefono" ><br>
                <span class="result" id="errorTelefono"></span>

                <label>Foto:</label>
                <input type="file" name="foto" accept="image/*" ><br>
                <span class="result" id="errorFoto"></span>

                <input type="submit" value="Añadir socio">
            </form>
            <a href='../../socios.php'>Volver a la lista de socios</a>
        </div>
    </div>
</body>

</html>