<?php
require_once("conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "ID de cita no especificado.".$_GET['id'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_servicio = $_POST['servicio'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];


    $actualizar = "UPDATE citas SET  codigo_servicio = ?, fecha = ?, hora = ? WHERE id = ?";
    $stmt = $conexion->prepare($actualizar);
    $stmt->bind_param("issi", $codigo_servicio, $fecha, $hora, $id);

    if ($stmt->execute()) {
        echo "<div class='form-container'";
        echo "<p>Datos actualizados correctamente.</p>";
        echo "<a href='../../citas.php'>Volver a la lista de citas</a>";
        echo "</div>";
    } else {
        echo "Error al actualizar los datos: " . $conexion->error;
    }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar cita</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
</head>
<body>
    
</body>
</html>