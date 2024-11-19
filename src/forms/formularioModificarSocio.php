<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar Socio</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
    <script src="../js/validarModificarSocio.js" defer></script>
</head>

<body>
    <div class="box">
        <div class="form-container">
            <?php include '../php/modificarSocio.php'; ?>
            <h1>Modificar datos de <?php echo htmlspecialchars($socio['nombre']); ?></h1>
            <form method="POST" action="" enctype="multipart/form-data">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($socio['nombre']); ?>"><br>
                <span class="result" id="errorNombre"></span>

                <label>Edad:</label>
                <input type="number" name="edad" value="<?php echo htmlspecialchars($socio['edad']); ?>"><br>
                <span class="result" id="errorEdad"></span>

                <label>Usuario:</label>
                <input type="text" name="usuario" value="<?php echo htmlspecialchars($socio['usuario']); ?>"><br>
                <span class="result" id="errorUsuario"></span>

                <label>Teléfono:</label>
                <input type="text" name="telefono" value="<?php echo htmlspecialchars($socio['telefono']); ?>"><br>
                <span class="result" id="errorTelefono"></span>

                <label>Foto:</label>
                <input type="file" name="foto" accept="image/*" ><br>
                <span class="result" id="errorFoto"></span>
                
                <input type="submit" value="Guardar cambios">
            </form>
            <a href='../../socios.php'>Volver a la lista de socios</a>
        </div>
    </div>
</body>

</html>