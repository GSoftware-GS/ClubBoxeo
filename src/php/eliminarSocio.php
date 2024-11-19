    <?php
   require_once("conexion.php");


    // Verificar si se recibe el ID del socio
    if (isset($_GET['id'])) {
        $id_socio = $_GET['id'];

        // Consultar los datos del socio por su ID
        $consulta = "DELETE FROM socios WHERE id_socio = ?";
        $stmt = $conexion->prepare($consulta);
        $stmt->bind_param("i", $id_socio);
        $stmt->execute();
        $resultado = $stmt->get_result();

       
    } else {
        echo "ID de socio no especificado.";
        exit;
    }
    if ($stmt->affected_rows > 0) {
        echo "Socio eliminado exitosamente.";
    } else {
        echo "No se pudo eliminar el socio.";
    }

    echo "<a href='../../socios.php' class='boton'>Volver a la lista de socios</a>";

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

