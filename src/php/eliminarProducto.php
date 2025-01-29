<?php
// eliminarProducto.php
include '../includes/auth.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $apiKey = $_SESSION['api_key'];

    // Primero obtenemos la información del producto para saber qué imagen eliminar
    $apiUrl = "http://localhost/Ejercicios%20Servidor/ClubBoxeo/api.php/" . $apiKey;
    $response = file_get_contents($apiUrl);
    $productosData = json_decode($response, true);

    if ($productosData && $productosData["status"] === "success") {
        // Buscar el producto específico por ID
        $producto = null;
        foreach ($productosData["data"] as $prod) {
            if ($prod["id"] == $id) {
                $producto = $prod;
                break;
            }
        }

        if ($producto) {
            // Guardar el nombre de la imagen antes de eliminar el producto
            $imagen = $producto['imagen'];

            // Configurar la solicitud DELETE a la API
            $ch = curl_init("http://localhost/Ejercicios%20Servidor/ClubBoxeo/api.php/$apiKey");
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['id' => $id]));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            ));

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode == 200) {
                $result = json_decode($response, true);
                if ($result['status'] === 'success') {
                    // Eliminar la imagen si existe
                    $rutaImagen = "../../img/productos/" . $imagen;
                    if (file_exists($rutaImagen)) {
                        unlink($rutaImagen);
                    }
                    
                    header("Location: ../../productos.php?success=1&message=Producto eliminado correctamente");
                    exit();
                } else {
                    $error = "Error al eliminar el producto: " . $result['message'];
                }
            } else {
                $error = "Error en la comunicación con la API";
            }
        } else {
            $error = "No se encontró el producto con ID $id";
        }
    } else {
        $error = "Error al obtener la información del producto";
    }
} else {
    $error = "Método no válido o ID no proporcionado";
}

if (isset($error)) {
    header("Location: ../../productos.php?error=" . urlencode($error));
    exit();
}
?>