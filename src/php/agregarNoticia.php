<?php
require_once("conexion.php");

// Procesar el formulario de adición de una nueva noticia
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $fecha = $_POST['fecha'];

    // Obtener la imagen del formulario y añadirla a la carpeta ../img
    $imagen = $_FILES['foto']['tmp_name'];
    $imagen_destino = "../../img/noticias/" . $_FILES['foto']['name'];
    
    // Verificar si la imagen se ha subido correctamente
    if (move_uploaded_file($imagen, $imagen_destino)) {
        $url_foto = "./img/noticias/" . $_FILES['foto']['name'];


        // Consulta para añadir una nueva noticia
        $insertar = "INSERT INTO noticias (titulo, contenido, imagen, fecha_publicacion) 
                     VALUES ('$titulo', '$contenido', '$url_foto', '$fecha')";
        $stmt = $conexion->prepare($insertar);

        if ($stmt->execute()) {
            echo "Nueva noticia añadida correctamente.";
            echo "<a href='../../noticias.php'>Volver a la lista de Noticias</a>";
        } else {
            echo "Error al añadir la noticia: " . $conexion->error;
        }
    } else {
        echo "Error al subir la imagen.";
    }
}
