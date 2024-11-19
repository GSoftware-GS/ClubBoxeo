<?php
require_once("conexion.php");

// Procesar el formulario de adición de un nuevo socio
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST['descripcion'];
    $duracion = $_POST['duracion'];
    $precio = $_POST['precio'];



    // Consulta para añadir un nuevo socio
    $insertar = "INSERT INTO servicios (descripcion, duracion, precio) VALUES ('$descripcion', $duracion, $precio)";
    $stmt = $conexion->prepare($insertar);

    if ($stmt->execute()) {
        echo "Nuevo Servicio añadido correctamente.";
    } else {
        echo "Error al añadir el socio: " . $conexion->error;
    }
} 



