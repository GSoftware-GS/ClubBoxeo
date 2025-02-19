<?php

require_once("conexion.php");

// Obtener el mes y el año desde la URL, o usar el actual
$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Configuración de días y meses en español
$daysOfWeek = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
$months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

// Obtener el día actual
$currentDay = date('j');
$currentMonth = date('m');
$currentYear = date('Y');

// Primer día del mes y total de días en el mes
$firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
$numberDays = date('t', $firstDayOfMonth);
$monthName = $months[$month - 1];

// Calcular el día de la semana en el que inicia el mes (Lunes = 0)
$dayOfWeek = date('N', $firstDayOfMonth) - 1;

// Calcular el mes anterior y siguiente
$prevMonth = $month - 1;
$nextMonth = $month + 1;
$prevYear = $year;
$nextYear = $year;

if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear = $year - 1;
}
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear = $year + 1;
}

// Consulta SQL base para obtener las citas del mes
$sql = "
    SELECT c.id, u.nombre, c.fecha, c.hora, s.descripcion, 
           COUNT(*) OVER (PARTITION BY DAY(c.fecha)) as citas_por_dia
    FROM citas c
    JOIN servicios s ON c.codigo_servicio = s.codigo_servicio
    JOIN usuarios u ON c.codigo_socio = u.id_usuario AND u.rol = 'socio'
    WHERE MONTH(c.fecha) = $month AND YEAR(c.fecha) = $year";

// Si el usuario no es admin, filtrar para mostrar solo sus citas
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    $userId = $_SESSION['id_usuario']; // Se utiliza el id_usuario de la sesión
    $sql .= " AND c.codigo_socio = $userId";
}

$result = $conexion->query($sql);

// Organizar citas en arrays
$citas = [];
$citasPorDia = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dia = (int) date('j', strtotime($row['fecha']));
        if (!isset($citas[$dia])) {
            $citas[$dia] = [];
        }
        $citas[$dia][] = [
            'id' => $row['id'],
            'hora' => date('H:i', strtotime($row['hora'])),
            'descripcion' => $row['descripcion'],
            'nombre' => $row['nombre']
        ];
        $citasPorDia[$dia] = $row['citas_por_dia'];
    }
}

// Generar el calendario
echo "<h2>$monthName $year</h2>";
echo '<div class="calendar-container">';
echo '<table class="calendar">';
echo '<tr>';
foreach ($daysOfWeek as $day) {
    echo "<th>$day</th>";
}
echo '</tr><tr>';

// Rellenar con celdas vacías hasta el primer día del mes
if ($dayOfWeek > 0) {
    echo str_repeat('<td></td>', $dayOfWeek);
}

$day = 1;
while ($day <= $numberDays) {
    // Iniciar una nueva fila si es el primer día de la semana
    if (($dayOfWeek + $day) % 7 == 1) {
        echo '<tr>';
    }

    // Marcar el día actual
    $class = ($day == $currentDay && $month == $currentMonth && $year == $currentYear) ? 'current-day' : '';
    echo "<td class='$class'>";
    echo "<div class='day'>$day</div>";

    // Si hay citas para ese día, se muestra el indicador y los detalles ocultos
    if (isset($citasPorDia[$day])) {
        echo "<div class='citas-indicator' onclick='mostrarDetallesCitas($day)'>";
        echo "<span class='citas-count'>{$citasPorDia[$day]} citas</span>";
        echo "</div>";

        // Contenedor oculto para detalles de citas
        echo "<div id='citas-dia-$day' class='citas-detalles' style='display: none;'>";
        foreach ($citas[$day] as $cita) {
            echo "<div class='cita-detalle'>";
            echo "<a href='./src/php/mostrarCita.php?id={$cita['id']}'>";
            echo "{$cita['hora']} - {$cita['nombre']}";
            echo "</a>";
            echo "</div>";
        }
        echo "</div>";
    }

    echo "</td>";

    // Cerrar la fila si se completa la semana
    if (($dayOfWeek + $day) % 7 == 0) {
        echo '</tr>';
    }

    $day++;
}

// Completar la última semana con celdas vacías, si es necesario
if (($dayOfWeek + $numberDays) % 7 != 0) {
    echo str_repeat('<td></td>', 7 - (($dayOfWeek + $numberDays) % 7));
}

echo '</tr></table>';
echo '</div>';

// Botones de navegación para cambiar de mes
echo "<div class='nav-buttons'>";
echo "<a href='?month=$prevMonth&year=$prevYear' class='button'>&lt; Mes Anterior</a> ";
echo "<a href='?month=$nextMonth&year=$nextYear' class='button'>Mes Siguiente &gt;</a>";
echo "</div>";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Citas</title>
    <link rel="stylesheet" href="./styles/calendario.css">
    <script>
        // Función para mostrar/ocultar detalles de las citas de un día
        function mostrarDetallesCitas(dia) {
            const detalles = document.getElementById(`citas-dia-${dia}`);
            if (detalles) {
                detalles.style.display = detalles.style.display === 'none' ? 'block' : 'none';
            }
        }
    </script>
</head>

<body>
</body>

</html>