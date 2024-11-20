<?php


require_once("../php/conexion.php");


// Consulta para obtener los socios
$sqlSocios = "SELECT id_socio, nombre FROM socios";
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
</head>

<body>
    <div class="box">
        <div class="form-container">
            <?php
            include '../php/agregarTestimonio.php';



            // Consulta para obtener los socios
            $sqlSocios = "SELECT id_socio, nombre FROM socios";
            $socios = $conexion->query($sqlSocios);

            // Consulta para obtener los servicios
            $sqlServicios = "SELECT codigo_servicio, descripcion FROM servicios";
            $servicios = $conexion->query($sqlServicios);

            ?>
            <h1>Añadir nuevo testimonio</h1>
            <form method="POST" action="" enctype="multipart/form-data">
                <label for="socio">Socio:</label>
                <select name="socio" required>
                    <?php foreach ($socios as $socio): ?>
                        <option value="<?php echo $socio['id_socio']; ?>"><?php echo $socio['nombre']; ?></option>
                    <?php endforeach; ?>
                </select><br>

                <label>contenido:</label>
                <textarea id="contenido" name="contenido" required></textarea>

                <input type="submit" value="Añadir Testimonio">
            </form>
            <a href='../../testimonios.php'>Volver a la lista de testimonios</a>

        </div>
    </div>
</body>

</html>