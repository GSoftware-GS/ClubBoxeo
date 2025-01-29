<?php
require_once("./src/php/conexion.php");

// Configuración de la API: Definimos la respuesta como JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Obtener la URL completa de la solicitud
$requestUri = $_SERVER['REQUEST_URI'];

// Extraer la API Key de la URL (por ejemplo, api.php/t7q7er9ye1F9OT2tKAcb38yewWoluINX)
$apiKey = extractApiKeyFromUrl($requestUri);

// Verificar si la API Key es válida y obtener el usuario
$user = isApiKeyValid($apiKey);

// Si la API Key no es válida, responder con un error
if (!$user) {
    echo json_encode([
        "status" => "error",
        "message" => "API Key inválida o no proporcionada"
    ]);
    exit;
}

// Guardar los datos del usuario para uso posterior
$userId = $user['id_usuario'];
$userRole = $user['rol']; // 'admin' o 'user'

// Obtener los parámetros de la query string (ejemplo: ?nombre=cafe)
$nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
// Método HTTP
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':

        if (isset($_GET['nombre'])) {
            // Buscar productos por subcadena en el nombre
            $nombre = $conexion->real_escape_string($_GET['nombre']);
            $consulta = "SELECT * FROM productos WHERE nombre LIKE '%$nombre%' ORDER BY nombre DESC";
            $resultado = $conexion->query($consulta);

            if ($resultado->num_rows > 0) {
                $productos = [];
                while ($producto = $resultado->fetch_assoc()) {
                    $productos[] = $producto;
                }

                echo json_encode([
                    "status" => "success",
                    "data" => $productos
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "No se encontraron productos con ese nombre"
                ]);
            }
        } elseif (isset($_GET['precio'])) {
            // Buscar productos cuyo precio sea menor al especificado
            $precio = floatval($_GET['precio']);
            $consulta = "SELECT * FROM productos WHERE precio < $precio ORDER BY precio ASC";
            $resultado = $conexion->query($consulta);

            if ($resultado->num_rows > 0) {
                $productos = [];
                while ($producto = $resultado->fetch_assoc()) {
                    $productos[] = $producto;
                }

                echo json_encode([
                    "status" => "success",
                    "data" => $productos
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "No se encontraron productos con un precio menor a $precio"
                ]);
            }
        }elseif(isset($_GET['id'])) {
            // Buscar producto por ID
            $id = intval($_GET['id']);
            $consulta = "SELECT * FROM productos WHERE id = $id";
            $resultado = $conexion->query($consulta);

            if ($resultado->num_rows > 0) {
                $producto = $resultado->fetch_assoc();
                echo json_encode([
                    "status" => "success",
                    "data" => $producto
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "No se encontraron productos con ese ID"
                ]);
            }

        } else {
            // Obtener todos los productos
            $consulta = "SELECT * FROM productos ORDER BY nombre DESC";
            $resultado = $conexion->query($consulta);

            if ($resultado->num_rows > 0) {
                $productos = [];
                while ($producto = $resultado->fetch_assoc()) {
                    $productos[] = $producto;
                }

                echo json_encode([
                    "status" => "success",
                    "data" => $productos
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "No hay productos disponibles"
                ]);
            }
        }
        break;

    case 'POST':
        // Leer el cuerpo de la solicitud
        $input = json_decode(file_get_contents("php://input"), true);

        if (isset($input['nombre']) && isset($input['precio']) && isset($input['imagen'])) {
            $nombre = $conexion->real_escape_string($input['nombre']);
            $precio = $conexion->real_escape_string($input['precio']);
            $imagen = $conexion->real_escape_string($input['imagen']);

            // Insertar el producto en la base de datos
            $consulta = "INSERT INTO productos (nombre, precio,imagen) VALUES ('$nombre', '$precio', '$imagen')";

            if ($conexion->query($consulta)) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Producto creado exitosamente",
                    "id" => $conexion->insert_id
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Error al crear el producto: " . $conexion->error
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Faltan datos necesarios (nombre, precio, imagen)"
            ]);
        }
        break;

    case 'PUT':
        // Leer el cuerpo de la solicitud
        $input = json_decode(file_get_contents("php://input"), true);

        // Verificar que los datos necesarios estén presentes
        if (isset($input['id']) && (isset($input['nombre']) || isset($input['precio']) || isset($input['imagen']))) {
            $id = intval($input['id']);
            $setClauses = [];

            // Construir la consulta dinámica dependiendo de los datos proporcionados
            if (isset($input['nombre'])) {
                $nombre = $conexion->real_escape_string($input['nombre']);
                $setClauses[] = "nombre = '$nombre'";
            }
            if (isset($input['precio'])) {
                $precio = $conexion->real_escape_string($input['precio']);
                $setClauses[] = "precio = '$precio'";
            }
            if (isset($input['descripcion'])) {
                $imagen = $conexion->real_escape_string($input['imagen']);
                $setClauses[] = "imagen = '$imagen'";
            }

            // Unir las cláusulas SET con comas
            $setClause = implode(", ", $setClauses);

            // Ejecutar la consulta de actualización
            $consulta = "UPDATE productos SET $setClause WHERE id = $id";

            if ($conexion->query($consulta)) {
                if ($conexion->affected_rows > 0) {
                    echo json_encode([
                        "status" => "success",
                        "message" => "Producto actualizado correctamente"
                    ]);
                } else {
                    echo json_encode([
                        "status" => "error",
                        "message" => "No se encontró el producto con ID $id o no se realizaron cambios"
                    ]);
                }
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Error al actualizar el producto: " . $conexion->error
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Datos incompletos: se necesita al menos 'id' y un campo para actualizar ('nombre', 'precio' o 'descripcion')"
            ]);
        }
        break;

    case 'DELETE':
        // Parse input data
        $input = json_decode(file_get_contents("php://input"), true);

        // Validate product ID
        if (!isset($input['id'])) {
            echo json_encode([
                "status" => "error",
                "message" => "ID de producto no proporcionado"
            ]);
            exit;
        }

        // Sanitize and convert ID to integer
        $id = intval($input['id']);

        // Prepare delete statement
        $consulta = "DELETE FROM productos WHERE id = ?";
        $stmt = $conexion->prepare($consulta);

        if (!$stmt) {
            echo json_encode([
                "status" => "error",
                "message" => "Error al preparar la eliminación: " . $conexion->error
            ]);
            exit;
        }

        // Bind and execute
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Producto eliminado correctamente"
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "No se encontró el producto con ID $id"
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Error al eliminar el producto: " . $stmt->error
            ]);
        }
}

// Función para verificar si la API Key es válida y obtener el usuario correspondiente
function isApiKeyValid($apiKey)
{
    global $conexion;

    // Check for empty or null API key
    if (empty($apiKey)) {
        return false;
    }

    // Prepare and execute the query to find the user with the given API key
    $consulta = "SELECT id_usuario, rol FROM usuarios WHERE api_key = ?";
    $stmt = $conexion->prepare($consulta);

    // Check if the statement preparation was successful
    if (!$stmt) {
        error_log("Preparation error: " . $conexion->error);
        return false;
    }

    // Bind the API key parameter
    $stmt->bind_param("s", $apiKey);

    // Execute the query
    if (!$stmt->execute()) {
        error_log("Execution error: " . $stmt->error);
        $stmt->close();
        return false;
    }

    // Get the result
    $resultado = $stmt->get_result();

    // Check if a user was found
    if ($resultado->num_rows > 0) {
        $userData = $resultado->fetch_assoc();
        $stmt->close();
        return $userData; // Return user data (id_usuario and rol)
    } else {
        $stmt->close();
        return false; // API Key not found
    }
}

function extractApiKeyFromUrl($requestUri)
{
    // Split the URI by '/'
    $parts = explode('/', $requestUri);

    // The API key is typically the last part of the URL
    // Remove any query string parameters
    $apiKey = strtok(end($parts), '?');

    return $apiKey;
}

// Cerrar la conexión
$conexion->close();
?>