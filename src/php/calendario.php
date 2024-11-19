<?php
// Iniciar la sesión para mantener el mes seleccionado


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

// Primer día del mes y el total de días en el mes
$firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
$numberDays = date('t', $firstDayOfMonth);
$monthName = $months[$month - 1];

// Calcular el día de la semana en el que comienza el mes
$dayOfWeek = date('N', $firstDayOfMonth) - 1; // Lunes = 0

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

// Recuperar citas para el mes actual, uniendo con las tablas de servicios y socios para obtener la descripción y otros detalles
$sql = "
    SELECT c.id, s2.nombre, c.fecha, c.hora, s.descripcion
    FROM citas c
    JOIN servicios s ON c.codigo_servicio = s.codigo_servicio
    JOIN socios s2 ON c.codigo_socio = s2.id_socio
    WHERE MONTH(c.fecha) = $month AND YEAR(c.fecha) = $year";
$result = $conexion->query($sql);

// Organizar citas en un array
$citas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dia = (int)date('j', strtotime($row['fecha'])); // Día de la cita
        if (!isset($citas[$dia])) {
            $citas[$dia] = [];
        }
        // Guardamos la descripción y hora de la cita
        $citas[$dia][] = [
            'id' => $row['id'],
            'hora' => date('H:i', strtotime($row['hora'])),
            'descripcion' => $row['descripcion']
            . ' - ' . $row['nombre']
        ];
    }
}

// Generar el calendario
echo "<h2>$monthName $year</h2>";
echo '<table class="calendar">';
echo '<tr>';
foreach ($daysOfWeek as $day) {
    echo "<th>$day</th>";
}
echo '</tr><tr>';

// Rellenar con días en blanco hasta el primer día del mes
if ($dayOfWeek > 0) {
    echo str_repeat('<td></td>', $dayOfWeek);
}

$day = 1;
while ($day <= $numberDays) {
    // Empezar una nueva fila en cada semana
    if (($dayOfWeek + $day) % 7 == 1) {
        echo '<tr>';
    }

    // Marcar el día actual
    $class = ($day == $currentDay && $month == $currentMonth && $year == $currentYear) ? 'current-day' : '';
    echo "<td class='$class'><div class='day'>$day</div>";

    // Mostrar citas del día
    if (isset($citas[$day])) {
        foreach ($citas[$day] as $cita) {
            echo "<a class='cita' href='./src/php/mostrarCita.php?id=" . $cita["id"] . "'>{$cita['hora']} - {$cita['descripcion']}</a><br><br>";
        }
    }

    echo "</td>";

    // Finalizar la fila de la semana
    if (($dayOfWeek + $day) % 7 == 0) {
        echo '</tr>';
    }

    $day++;
}

// Completar la última semana del mes con celdas vacías
if (($dayOfWeek + $numberDays) % 7 != 0) {
    echo str_repeat('<td></td>', 7 - (($dayOfWeek + $numberDays) % 7));
}

echo '</tr>';
echo '</table>';

// Botones de navegación
echo "<div class='nav-buttons'>";
echo "<a href='?month=$prevMonth&year=$prevYear' class='button'>&lt; Mes Anterior</a> ";
echo "<a href='?month=$nextMonth&year=$nextYear' class='button'>Mes Siguiente &gt;</a>";
echo "</div>";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/calendario.css">
</head>
<body>
    
</body>
</html>
