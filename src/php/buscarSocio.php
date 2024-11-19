<?php
require_once("conexion.php");

// Procesar el formulario de adición de un nuevo socio
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];

    $sql = "SELECT nombre, edad, usuario, telefono FROM socios WHERE nombre = ? OR telefono = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $nombre, $telefono);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "<div class='result-container'>";
        echo "<h2>Detalles del Socio Encontrado</h2>";
        $socio = $resultado->fetch_assoc();
        foreach ($socio as $key => $value) {
            echo "<p><strong>" . ucfirst($key) . ":</strong> $value</p>";
        }
        echo "</div>";
        
    } else {
        echo "<div class='result-container error'>No se encontró el socio.</div>";
    }
}

?>

