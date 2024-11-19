<?php
require_once("conexion.php");

// Procesar el formulario de adición de un nuevo socio
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = $_POST['descripcion'];

    // Usamos un parámetro vinculado para prevenir inyecciones SQL
    $sql = "SELECT * FROM servicios WHERE descripcion = ?";
    $stmt = $conexion->prepare($sql);
    
    // Vinculamos el parámetro
    $stmt->bind_param("s", $descripcion);
    
    // Ejecutamos la consulta
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Comprobamos si se encontraron resultados
    if ($resultado->num_rows > 0) {
        echo "<div class='result-container'>";
        echo "<h2>Detalles del Servicio Encontrado</h2>";
        $servicio = $resultado->fetch_assoc();
        foreach ($servicio as $key => $value) {
            echo "<p><strong>" . ucfirst($key) . ":</strong> $value</p>";
        }
        echo "</div>";
    } else {
        echo "<div class='result-container error'>No se encontró el servicio.</div>";
    }

    // Cerramos la declaración
    $stmt->close();
}
?>
