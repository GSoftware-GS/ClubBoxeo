<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir cita</title>
    <link rel="stylesheet" href="./styles/formulario.css">
</head>

<body>
    <?php
    // Conexión a la base de datos (ajusta los datos de conexión)
    
    require_once("./src/php/conexion.php");


    // Consulta para obtener los socios
    $sqlSocios = "SELECT id_socio, nombre FROM socios";
    $socios = $conexion->query($sqlSocios);

    // Consulta para obtener los servicios
    $sqlServicios = "SELECT codigo_servicio, descripcion FROM servicios";
    $servicios = $conexion->query($sqlServicios);
    ?>
    <form action="./src/php/agregarCita.php" method="POST">

        <label for="socio">Socio:</label>
        <select name="socio" required>
            <?php foreach ($socios as $socio): ?>
                <option value="<?php echo $socio['id_socio']; ?>"><?php echo $socio['nombre']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="servicio">Servicio:</label>
        <select name="servicio" required>
            <?php foreach ($servicios as $servicio): ?>
                <option value="<?php echo $servicio['codigo_servicio']; ?>"><?php echo $servicio['descripcion']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" required><br>

        <div class="input-container">
            <label for="hora">Hora:</label>
            <input type="time" name="hora" id="hora" required>
        </div>

        <input type="submit" value="Agregar Cita" class="boton">
    </form>
</body>

</html>