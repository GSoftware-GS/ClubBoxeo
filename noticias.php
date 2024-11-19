<?php include './src/php/session_start.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <div class="container">
        <?php include './src/html/menu.php'; ?>

        <section class="noticias">
            <h1>Noticias</h1>

            <?php include './src/php/mostrarNoticias.php'; ?>
        </section>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['rol'] === 'admin') {
            echo "<div class='buttons'>";
            echo "<a href='./src/forms/formularioNoticia.php' class='boton'>Agregar Noticia</a>";
            echo "</div>";
        }
        ?>


        <?php include './src/html/footer.html'; ?>
    </div>
</body>

</html>