<?php
   require_once("conexion.php");


    // Verificar si se recibe el ID del socio
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Consultar los datos del socio por su ID
        $consulta = "DELETE FROM citas WHERE id = ?";
        $stmt = $conexion->prepare($consulta);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

       
    } else {
        echo "ID de cita no especificado.";
        exit;
    }
    if ($stmt->affected_rows > 0) {
        echo "Cita eliminada exitosamente.";
    } else {
        echo "No se pudo eliminar la cita.";
    }

    echo "<a href='../../citas.php' class='boton'>Volver a citas</a>";

    $conexion->close();


    ?>  

    <html>
        <head>
            <title>Eliminar socio</title>
            <link rel="stylesheet" href="../../styles/style.css">
        </head>
        <body>
        </body>
    </html>

