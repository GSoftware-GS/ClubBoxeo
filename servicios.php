<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <div class="container">
        <?php include './src/html/menu.php'; ?>

        <section class="servicios">
            <h1>Servicios</h1>

            <?php include './src/php/mostrarServicios.php'; ?>
        </section>

        <div class="buttons">
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['rol'] === 'admin') {
            echo "<a href='./src/forms/formularioServicio.php' class='boton'>Agregar servicio</a>";
        }
        ?>
            <a href="./src/forms/formularioBuscarServicio.php" class="boton">Buscar servicio</a>
        </div>

        <?php include './src/html/footer.html'; ?>
    </div>
</body>

</html>