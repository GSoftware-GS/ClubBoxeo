<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonios</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>


    <!-- Contenedor principal -->
    <div class="container">
        <!-- Barra de navegación en la parte superior -->

        <?php include './src/html/menu.php'; ?>

        <section class="testimonios">
            <h1>Testimonios</h1>
            <?php include './src/php/mostrarTestimonios.php'; ?>
        </section>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['rol'] !== 'admin') {
        echo "<a href='./src/forms/formularioTestimonio.php' class='boton'>Agregar testimonio</a>";
        }
        ?>
        <!-- Footer en la parte inferior -->

        <?php include './src/html/footer.html'; ?>

    </div>


</body>

</html>