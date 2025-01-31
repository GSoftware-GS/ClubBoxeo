<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar Socio</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
    <script src="../js/validarModificarSocio.js" defer></script> <!-- Cambiado a validarUsuario.js -->
</head>

<body>
    <div class="box">
        <div class="form-container">
            <?php include '../php/modificarSocio.php'; ?> <!-- Cambiado a modificarUsuario.php -->
            <h1>Modificar datos de <?php echo htmlspecialchars($usuario['nombre']); ?></h1>
            <form method="POST" action="" enctype="multipart/form-data">
                <label>Nombre:</label>
                <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>"><br>
                <span class="result" id="errorNombre"></span>

                <label>Edad:</label>
                <input type="number" name="edad" value="<?php echo htmlspecialchars($usuario['edad']); ?>"><br>
                <span class="result" id="errorEdad"></span>

                <label>Usuario:</label>
                <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuario['username']); ?>"><br>
                <span class="result" id="errorUsuario"></span>

                <label>Email:</label> <!-- Nuevo campo para el email -->
                <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>"><br>
                <span class="result" id="errorEmail"></span>

                <label>Contraseña:</label> <!-- Nuevo campo para la contraseña -->
                <input type="password" name="password" value="<?php echo htmlspecialchars($usuario['password']); ?>"><br>
                <span class="result" id="errorPassword"></span>

                <label>Foto:</label>
                <input type="file" name="foto" accept="image/*"><br>
                <span class="result" id="errorFoto"></span>
                
                <input type="submit" value="Guardar cambios">
            </form>
            <a href='../../Socios.php'>Volver a la lista de usuarios</a> <!-- Cambiado a usuarios.php -->
        </div>
    </div>
</body>

</html>