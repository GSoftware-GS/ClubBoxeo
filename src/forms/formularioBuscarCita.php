<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Buscar Cita</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
    <script src="../js/validarBuscarCita.js" defer></script>
</head>

<body>
    <?php
    // Conexión a la base de datos (ajusta los datos de conexión)
    
    require_once("../php/conexion.php");


    // Consulta para obtener los socios
    $sqlSocios = "SELECT id_usuario, nombre FROM usuarios WHERE rol = 'socio'";
    $socios = $conexion->query($sqlSocios);

    // Consulta para obtener los servicios
    $sqlServicios = "SELECT codigo_servicio, descripcion FROM servicios";
    $servicios = $conexion->query($sqlServicios);
    ?>
    <div class="box">
        <div class="form-container">
            <?php include '../php/buscarCita.php'; ?>
            <h1>Buscar Cita</h1>
            <form method="POST" action="" enctype="multipart/form-data">

                <label for="socio">Socio:</label>
                <select name="socio" >
                    <option value="">Seleccione un socio</option>
                    <?php foreach ($socios as $socio): ?>
                        <option value="<?php echo $socio['id_usuario']; ?>"><?php echo $socio['nombre']; ?></option>
                    <?php endforeach; ?>
                </select><br>
                <span id="errorSocio" class="error"></span><br>


                <label for="servicio">Servicio:</label>
                <select name="servicio" >
                    <option value="">Seleccione un servicio</option>
                    <?php foreach ($servicios as $servicio): ?>
                        <option value="<?php echo $servicio['codigo_servicio']; ?>"><?php echo $servicio['descripcion']; ?>
                        </option>
                    <?php endforeach; ?>
                </select><br>
                <span id="errorServicio" class="error"></span><br>


                <label>Fecha:</label>
                <input type="date" name="fecha">
                <span id="errorFecha" class="error"></span><br>

                <input type="submit" value="Buscar Cita">
            </form>

            <a href='../../citas.php'>Volver a la lista de citas</a>

        </div>
    </div>
</body>

</html>