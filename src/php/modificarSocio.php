<?php
require_once("conexion.php");


// Verificar si se recibe el ID del socio
if (isset($_GET['id'])) {
    $id_socio = $_GET['id'];

    // Consultar los datos del socio por su ID
    $consulta = "SELECT nombre, edad, usuario, telefono, foto FROM socios WHERE id_socio = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("i", $id_socio);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $socio = $resultado->fetch_assoc();
    } else {
        echo "No se encontró el socio.";
        exit;
    }
} else {
    echo "ID de socio no especificado.";
    exit;
}

// Procesar el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $usuario = $_POST['usuario'];
    $telefono = $_POST['telefono'];
    // Obtener la imagen del formulario y añadirla a la carpeta ../img
    $imagen = $_FILES['foto']['tmp_name'];
    $imagen_destino = "../../img/usuarios/" . $_FILES['foto']['name'];

    move_uploaded_file($imagen, $imagen_destino);
    $url_foto = "./img/usuarios/" . $_FILES['foto']['name'];

    $actualizar = "UPDATE socios SET nombre = ?, edad = ?, usuario = ?, telefono = ?, foto = ? WHERE id_socio = ?";
    $stmt = $conexion->prepare($actualizar);
    $stmt->bind_param("sisssi", $nombre, $edad, $usuario, $telefono, $url_foto, $id_socio);

    if ($stmt->execute()) {
        echo "<p>Datos actualizados correctamente.</p>";
        echo "<a href='../../socios.php'>Volver a la lista de socios</a>";
    } else {
        echo "Error al actualizar los datos: " . $conexion->error;
    }
}
?>