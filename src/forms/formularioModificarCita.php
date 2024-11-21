<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar cita</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
    <script src="../js/validarModificarCita.js" defer></script>
</head>

<body>
    <?php
    // Conexión a la base de datos (ajusta los datos de conexión)
    require_once("../php/conexion.php");
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        echo "ID de cita no especificado.".$_GET['id'];
    }

    // Ver los datos de fecha y hora
    $sql = "SELECT * FROM citas WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $cita = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Consulta para obtener los servicios
    $sqlServicios = "SELECT codigo_servicio, descripcion FROM servicios";
    $servicios = $conexion->query($sqlServicios);
    ?>

<div class="box">
        <div class="form-container">
            <form action="" method="POST">
                
                    
                        <label for="servicio">Servicio:</label>
                        <select name="servicio" required>
                        <option value="" >Seleccionar servicio</option>
                            <?php foreach ($servicios as $servicio): ?>
                                <option value="<?php echo $servicio['codigo_servicio']; ?>"
                                    <?php echo $servicio['codigo_servicio'] == $cita['codigo_servicio'] ? 'selected' : ''; ?>>
                                    <?php echo $servicio['descripcion']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select><br>
                        <span id="errorServicio" class="error"></span><br>


                        <label for="fecha">Fecha:</label>
                        <input type="date" name="fecha" value="<?php echo $cita['fecha']; ?>" required><br>
                        <span id="errorFecha" class="error"></span><br>


                        <div class="input-container">
                            <label for="hora">Hora:</label>
                            <input type="time" name="hora" value="<?php echo $cita['hora']; ?>" id="hora" required>
                        </div>

                        <input type="submit" value="Modificar Cita" class="boton">
                        <?php include("../php/modificarCita.php");  ?>

                        <a href='../../citas.php'>Volver a la lista de citas</a>
                    
            </form>
        </div>
    </div>
</body>

</html>
