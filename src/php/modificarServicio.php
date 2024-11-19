<?php
require_once("conexion.php");



// Verificar si se recibe el ID del Servicio
if (isset($_GET['codigo_servicio'])) {
    $codigo_servicio = $_GET['codigo_servicio'];

    // Consultar los datos del Servicio por su ID
    $consulta = "SELECT descripcion, duracion, precio FROM servicios WHERE codigo_servicio = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("i", $codigo_servicio);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $servicio = $resultado->fetch_assoc();
    } else {
        echo "No se encontró el servicio.";
        exit;
    }
} else {
    echo "ID de servicio no especificado.";
    exit;
}

// Procesar el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST['descripcion'];
    $duracion = $_POST['duracion'];
    $precio = $_POST['precio'];

    $actualizar = "UPDATE servicios SET descripcion = ?, duracion = ?, precio = ? WHERE codigo_servicio = ?";
    $stmt = $conexion->prepare($actualizar);
    $stmt->bind_param("sisi", $descripcion, $duracion, $precio, $codigo_servicio);

    if ($stmt->execute()) {
        echo "Datos actualizados correctamente.";
        echo "<a href='../../servicios.php'>Volver a la lista de servicios</a>";
    } else {
        echo "Error al actualizar los datos: " . $conexion->error;
    }
}



