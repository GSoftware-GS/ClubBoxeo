<?php
// agregarProducto.php
include '../includes/auth.php';
session_start();
$targetDir = "../../img/productos/";
$response = array();

// Crear el directorio si no existe
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    
    // Procesar la imagen
    if(isset($_FILES["imagen"])) {
        $file = $_FILES["imagen"];
        $fileType = pathinfo($file["name"], PATHINFO_EXTENSION);
        
        // Validar el tipo de archivo
        $allowTypes = array('jpg','png','jpeg','gif');
        if (in_array(strtolower($fileType), $allowTypes)) {
            // Generar nombre único para la imagen
            $uniqueName = uniqid() . '.' . $fileType;
            $targetFilePath = $targetDir . $uniqueName;
            
            if(move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                // La imagen se subió correctamente, ahora enviamos los datos a la API
                $apiKey = $_SESSION['api_key'];
                $data = array(
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'imagen' => $uniqueName
                );
                
                // Configurar la solicitud a la API
                $ch = curl_init("http://localhost/Ejercicios%20Servidor/ClubBoxeo/api.php/$apiKey");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                
                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                
                if ($httpCode == 200) {
                    $result = json_decode($response, true);
                    if ($result['status'] === 'success') {
                        header("Location: ../../productos.php?success=1");
                        exit();
                    } else {
                        $error = "Error al agregar el producto: " . $result['message'];
                    }
                } else {
                    $error = "Error en la comunicación con la API";
                }
            } else {
                $error = "Error al subir la imagen";
            }
        } else {
            $error = "Solo se permiten archivos JPG, JPEG, PNG & GIF";
        }
    } else {
        $error = "No se ha enviado ninguna imagen";
    }
    
    if (isset($error)) {
        // Si hay error, redirigir con mensaje de error
        header("Location: ../../productos.php?error=" . urlencode($error));
        exit();
    }
}
?>