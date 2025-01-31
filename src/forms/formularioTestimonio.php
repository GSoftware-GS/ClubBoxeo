<?php


require_once("../php/conexion.php");


// Consulta para obtener los socios
$sqlSocios = "SELECT id_usuario, nombre FROM usuarios WHERE rol = 'socio'";
$socios = $conexion->query($sqlSocios);

// Consulta para obtener los servicios
$sqlServicios = "SELECT codigo_servicio, descripcion FROM servicios";
$servicios = $conexion->query($sqlServicios);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Testimonio</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
    <script src="../js/validarTestimonio.js" defer></script>
</head>

<body>
    <div class="box">
        <div class="form-container">
        <?php include '../php/agregarTestimonio.php'; ?>
            <h1>Añadir nuevo testimonio</h1>
            <form method="POST" action="" enctype="multipart/form-data">
                <label for="socio">Socio:</label>

                <input type="hidden" name="socio" value="<?php echo $_SESSION['id_usuario']; ?>"><?php echo $_SESSION['username']; ?></input> <br>
                <span id="errorSocio" class="error"></span><br>

                <label>contenido:</label>
                <textarea id="contenido" name="contenido" required></textarea>
                <span id="errorContenido" class="error"></span><br>

                <input type="submit" value="Añadir Testimonio">
            </form>
            <a href='../../testimonios.php'>Volver a la lista de testimonios</a>

        </div>
    </div>
</body>

</html>