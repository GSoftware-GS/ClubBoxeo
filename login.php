<?php
session_start();
include './src/php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar y ejecutar la consulta
    $stmt = $conexion->prepare('SELECT password, rol FROM usuarios WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($dbPassword, $rol);
        $stmt->fetch();

        // Comparar la contraseña
        if ($password === $dbPassword) {
            $_SESSION['loggedin'] = true;
            $_SESSION['rol'] = $rol; // Guardar el rol en la sesión
            header('Location: index.php');
            exit;
        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./styles/formulario.css">
</head>
<body>
<div class="box">
<div class="form-container">
    
        <h1>Iniciar Sesión</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit" class="boton">Entrar</button>
        </form>
        </div>
        </div> 
    </div>
</body>
</html>
