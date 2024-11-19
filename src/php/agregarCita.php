<?php
    require_once("conexion.php");

    $socio = $_POST['socio'];
    $servicio = $_POST['servicio'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    $sql = "INSERT INTO citas (codigo_socio, codigo_servicio, fecha, hora) VALUES ($socio, $servicio, '$fecha', '$hora')";

    if ($conexion->query($sql) === TRUE) {
        echo "Cita agregada correctamente";
        echo "<a href='../../citas.php' class='boton'>Volver a la lista de citas</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    $conexion->close();


?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../../styles/style.css">
    </head>
    <body>

    </body>
</html>
