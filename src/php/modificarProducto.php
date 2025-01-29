<?php
// modificarProducto.php
include '../includes/auth.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $imagen_actual = $_POST['imagen_actual'];
    $apiKey = $_SESSION['api_key'];

    // Preparar datos para la API
    $data = array(
        'id' => $id,
        'nombre' => $nombre,
        'precio' => $precio
    );

    // Procesar nueva imagen si se subió una
    if (!empty($_FILES['imagen']['name'])) {
        $targetDir = "../../img/productos/";
        $file = $_FILES["imagen"];
        $fileType = pathinfo($file["name"], PATHINFO_EXTENSION);

        // Validar el tipo de archivo
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array(strtolower($fileType), $allowTypes)) {
            // Generar nombre único para la imagen
            $uniqueName = uniqid() . '.' . $fileType;
            $targetFilePath = $targetDir . $uniqueName;

            if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                // Agregar el nuevo nombre de imagen a los datos
                $data['imagen'] = $uniqueName;

                // Eliminar la imagen anterior si existe y no es la predeterminada
                if ($imagen_actual && file_exists($targetDir . $imagen_actual)) {
                    unlink($targetDir . $imagen_actual);
                }
            } else {
                $error = "Error al subir la nueva imagen";
                header("Location: ../../productos.php?error=" . urlencode($error));
                exit();
            }
        } else {
            $error = "Solo se permiten archivos JPG, JPEG, PNG & GIF";
            header("Location: ../../productos.php?error=" . urlencode($error));
            exit();
        }
    }

    // Configurar la solicitud PUT a la API
    $ch = curl_init("http://localhost/Ejercicios%20Servidor/ClubBoxeo/api.php/$apiKey");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen(json_encode($data))
    ));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode == 200) {
        $result = json_decode($response, true);
        if ($result['status'] === 'success') {
            header("Location: ../../productos.php?success=1");
            exit();
        } else {
            $error = "Error al modificar el producto: " . $result['message'];
        }
    } else {
        $error = "Error en la comunicación con la API";
    }

    if (isset($error)) {
        header("Location: ../../productos.php?error=" . urlencode($error));
        exit();
    }
} else {
    header("Location: ../../productos.php?error=Método no válido o ID no proporcionado");
    exit();
}
?>