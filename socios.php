<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Socios</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <div class="container">
        <?php include './src/html/menu.php'; ?>


            <section class="socios">
                <h1>Socios</h1>
                <?php include './src/php/mostrarSocios.php'; ?>
            </section>

            <div class="buttons">
                <a href="./src/forms/formularioSocio.php" class="boton">Agregar socio</a>
                <a href="./src/forms/formularioBuscarSocio.php" class="boton">Buscar socio</a>
            </div>


        <?php include './src/html/footer.html'; ?>

    </div>
</body>

</html>