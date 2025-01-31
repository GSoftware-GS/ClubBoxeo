<?php
require_once("conexion.php");

// Procesar el formulario de adición de un nuevo socio
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    // Modificamos la consulta para usar LIKE y buscar por subcadena
    $sql = "SELECT nombre, edad, usuario, email FROM usuarios WHERE (nombre LIKE ? OR email LIKE ?) AND rol = 'socio'";
    $stmt = $conexion->prepare($sql);

    // Añadimos los símbolos % para buscar la subcadena en cualquier parte del campo
    $param_nombre = "%" . $nombre . "%";
    $param_email = "%" . $email . "%";

    $stmt->bind_param("ss", $param_nombre, $param_email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "<div class='result-container'>";
        echo "<h2>Detalles del Socio Encontrado</h2>";
        while ($socio = $resultado->fetch_assoc()) {
            foreach ($socio as $key => $value) {
                echo "<p><strong>" . ucfirst($key) . ":</strong> $value</p>";
            }
            echo "<hr>"; // Separador entre socios
        }
        echo "</div>";
    } else {
        echo "<div class='result-container error'>No se encontró el socio.</div>";
    }
}
?>