<?php
require_once("conexion.php");

// Verificar si se recibe el ID de la cita
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar la fecha de la cita
    $consultaFecha = "SELECT fecha FROM citas WHERE id = ?";
    $stmtFecha = $conexion->prepare($consultaFecha);
    $stmtFecha->bind_param("i", $id);
    $stmtFecha->execute();
    $resultadoFecha = $stmtFecha->get_result();

    if ($resultadoFecha->num_rows > 0) {
        $fila = $resultadoFecha->fetch_assoc();
        $fechaCita = $fila['fecha'];
        $fechaActual = date("Y-m-d");

        // Verificar si la fecha de la cita es actual o pasada
        if ($fechaCita <= $fechaActual) {
            echo "La cita no puede eliminarse porque corresponde a una fecha pasada.";
        } else {
            // Eliminar la cita si es válida
            $consultaEliminar = "DELETE FROM citas WHERE id = ?";
            $stmtEliminar = $conexion->prepare($consultaEliminar);
            $stmtEliminar->bind_param("i", $id);
            $stmtEliminar->execute();

            if ($stmtEliminar->affected_rows > 0) {
                echo "Cita eliminada exitosamente.";
            } else {
                echo "No se pudo eliminar la cita.";
            }
        }
    } else {
        echo "Cita no encontrada.";
    }
} else {
    echo "ID de cita no especificado.";
}

echo "<a href='../../citas.php' class='boton'>Volver a citas</a>";

$conexion->close();
?>


<html>
        <head>
            <title>Eliminar Cita</title>
            <link rel="stylesheet" href="../../styles/style.css">
        </head>
        <body>
        </body>
    </html>