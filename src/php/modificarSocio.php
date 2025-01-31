<?php
require_once("conexion.php");

// Verificar si se recibe el ID del usuario
if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    // Consultar los datos del usuario por su ID
    $consulta = "SELECT nombre, edad, username, email, password, foto FROM usuarios WHERE id_usuario = ?";
    $stmt = $conexion->prepare($consulta);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
    } else {
        echo "No se encontró el usuario.";
        exit;
    }
} else {
    echo "ID de usuario no especificado.";
    exit;
}

// Procesar el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $username = $_POST['usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Obtener la imagen del formulario y añadirla a la carpeta ../img
    if ($_FILES['foto']['tmp_name']) {
        $imagen = $_FILES['foto']['tmp_name'];
        $imagen_destino = "../../img/usuarios/" . $_FILES['foto']['name'];
        move_uploaded_file($imagen, $imagen_destino);
        $url_foto = "./img/usuarios/" . $_FILES['foto']['name'];
    } else {
        // Si no se sube una nueva imagen, mantener la imagen actual
        $url_foto = $usuario['foto'];
    }

    // Actualizar los datos del usuario
    $actualizar = "UPDATE usuarios SET nombre = ?, edad = ?, username = ?, email = ?, password = ?, foto = ? WHERE id_usuario = ?";
    $stmt = $conexion->prepare($actualizar);
    $stmt->bind_param("sissssi", $nombre, $edad, $username, $email, $password, $url_foto, $id_usuario);

    if ($stmt->execute()) {
        echo "<p>Datos actualizados correctamente.</p>";    
    } else {
        echo "Error al actualizar los datos: " . $conexion->error;
    }
}
?>