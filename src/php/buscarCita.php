<?php
require_once("conexion.php");

// Procesar el formulario de adición de un nuevo socio
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $socio = $_POST['socio'];
    $servicio = $_POST['servicio'];
    $fecha = $_POST['fecha'];

    $sql = "SELECT citas.fecha, citas.hora, socios.nombre AS nombre_socio, servicios.descripcion AS descripcion_servicio
    FROM citas
    JOIN socios ON citas.codigo_socio = socios.id_socio
    JOIN servicios ON citas.codigo_servicio = servicios.codigo_servicio
    WHERE socios.id_socio = ? OR servicios.codigo_servicio = ? OR citas.fecha = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iss", $socio, $servicio, $fecha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "<div class='result-container'>";
        echo "<h2>Detalles de las Citas Encontradas</h2>";

        // Bucle para mostrar todas las citas
        while ($cita = $resultado->fetch_assoc()) {
            echo "<div class='cita'>";
            foreach ($cita as $key => $value) {
                echo "<p><strong>" . ucfirst($key) . ":</strong> $value</p>";
            }
            echo "</div><hr>";
        }

        echo "</div>";
    } else {
        echo "<div class='result-container error'>No se encontró ninguna cita.</div>";
    }
}
