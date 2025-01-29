<?php
session_start();
include './src/php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Mantener como texto plano

    $stmt = $conexion->prepare('SELECT password, rol, api_key FROM usuarios WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($dbPassword, $rol, $api_key);
        $stmt->fetch();

        // Verificar contraseña CORRECTAMENTE
        if (password_verify($password, $dbPassword)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['rol'] = $rol;
            $_SESSION['username'] = $username;
            $_SESSION['api_key'] = $api_key;
            header('Location: index.php');
            exit;
        } else {
            $error = "Credenciales inválidas"; // Mensaje genérico por seguridad
        }
    } else {
        $error = "Credenciales inválidas"; // Evita revelar si el usuario existe
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
    <?php include './src/html/menu.php'; ?>
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