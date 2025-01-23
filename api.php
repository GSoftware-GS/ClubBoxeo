<?php
require_once("./src/php/conexion.php");

// Configuración de la API: Definimos la respuesta como JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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

        if (isset($input['nombre']) && isset($input['precio']) ) {
            $nombre = $conexion->real_escape_string($input['nombre']);
            $precio = $conexion->real_escape_string($input['precio']);

            // Insertar el producto en la base de datos
            $consulta = "INSERT INTO productos (nombre, precio) VALUES ('$nombre', '$precio' )";
            
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
                "message" => "Faltan datos necesarios (nombre, precio, descripcion)"
            ]);
        }
        break;

    case 'PUT':
        // Aquí implementarás la actualización de un producto existente en el futuro
        echo json_encode([
            "status" => "error",
            "message" => "Método PUT no implementado aún"
        ]);
        break;

    case 'DELETE':
        // Aquí implementarás la eliminación de un producto en el futuro
        echo json_encode([
            "status" => "error",
            "message" => "Método DELETE no implementado aún"
        ]);
        break;

    default:
        // Respuesta para métodos no soportados
        echo json_encode([
            "status" => "error",
            "message" => "Método no soportado"
        ]);
        break;
}

// Cerrar la conexión
$conexion->close();
?>
