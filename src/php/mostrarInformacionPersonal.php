<?php
require_once("conexion.php");



 $usuarioSesion = $_SESSION["username"];


    $consulta = "SELECT nombre, username, rol, email, api_key FROM usuarios WHERE nombre = '$usuarioSesion'";
    $resultado = $conexion->query($consulta);
    $usuario = $resultado->fetch_assoc();




    echo "<div class='result-container'>";
    echo "<h2>Detalles del Usuario</h2>";
    foreach ($usuario as $key => $value) {
        echo "<p><strong>" . ucfirst($key) . ":</strong> $value</p>";
    }
    echo "</div>";

