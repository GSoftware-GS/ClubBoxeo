<?php
require_once("conexion.php");

// Procesar el formulario de adición de un nuevo socio
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);
    $apiKey = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));


    // Obtener la imagen del formulario y añadirla a la carpeta ../img/usuarios
    $imagen = $_FILES['foto']['tmp_name'];
    $imagen_destino = "../../img/usuarios/" . $_FILES['foto']['name'];
    

    // Verificar si la imagen se ha subido correctamente
    if (move_uploaded_file($imagen, $imagen_destino)) {
        $url_foto = "./img/usuarios/" . $_FILES['foto']['name'];

        // Consulta para añadir un nuevo socio
        $insertar = "INSERT INTO usuarios (nombre, edad, username,api_key,rol, email,password, foto) VALUES ('$nombre', $edad, '$usuario','$apiKey','socio', '$email','$password', '$url_foto')";                                                                                           
        $stmt = $conexion->prepare($insertar);

        if ($stmt->execute()) {
            echo "Nuevo socio añadido correctamente.";

        } else {
            echo "Error al añadir el socio: " . $conexion->error;
        }
    } else {
        echo "Error al subir la imagen.";
    }
}


