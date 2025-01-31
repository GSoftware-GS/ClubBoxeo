<?php
require_once("conexion.php");
session_start();

// Procesar el formulario de adición de una nueva noticia
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $socio = $_POST['socio'];
    $contenido = $_POST['contenido'];
    // Fecha actual para la publicación
    $fecha_publicacion = date("Y-m-d");



    $id_socio = $_POST['socio'];

    // Consulta para añadir una nueva noticia
    $insertar = "INSERT INTO testimonios (autor, contenido, fecha) 
                     VALUES ($socio, '$contenido', '$fecha_publicacion')";
    $stmt = $conexion->prepare($insertar);


    if ($stmt->execute()) {
        echo "Nuevo testimonio añadido correctamente.";
        echo "<a href='../../testimonios.php'>Volver a la lista de Testimonios</a>";
    } else {
        echo "Error al añadir el testimonio: ";
    }
}


