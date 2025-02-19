<?php
require_once("conexion.php");

// Procesar el formulario de adición de un nuevo socio
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['socio'];
    $servicio = $_POST['servicio'];
    $fecha = $_POST['fecha'];

    // Inicializamos los arrays para los parámetros y las condiciones
    $params = [];
    $conditions = [];
    $types = '';

    // Condicional para agregar parámetros según estén vacíos o no
    if (!empty($usuario)) {
        $conditions[] = "usuarios.id_usuario = ?";
        $params[] = $usuario;
        $types .= 'i';  // 'i' para entero
    }
    if (!empty($servicio)) {
        $conditions[] = "servicios.codigo_servicio = ?";
        $params[] = $servicio;
        $types .= 'i';  // 'i' para entero, si el servicio es un número
    }
    if (!empty($fecha)) {
        $conditions[] = "citas.fecha = ?";
        $params[] = $fecha;
        $types .= 's';  // 's' para string, asumiendo que la fecha es una cadena
    }

    // Si no se ingresó ningún valor, mostramos un error
    if (count($conditions) == 0) {
        echo "<div class='result-container error'>Por favor, ingrese al menos un valor para realizar la búsqueda.</div>";
        exit;
    }

    // Construimos la consulta con las condiciones no vacías
    // Usamos 'AND' en lugar de 'OR' para asegurarnos de que todas las condiciones deben cumplirse
    $sql = "SELECT citas.fecha, citas.hora, usuarios.nombre AS nombre_usuario, servicios.descripcion AS descripcion_servicio
            FROM citas
            JOIN usuarios ON citas.codigo_socio = usuarios.id_usuario
            JOIN servicios ON citas.codigo_servicio = servicios.codigo_servicio
            WHERE " . implode(" AND ", $conditions);

    // Preparar la consulta SQL
    $stmt = $conexion->prepare($sql);

    // Vincular los parámetros dinámicamente
    $stmt->bind_param($types, ...$params);

    // Ejecutar la consulta
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
?>
