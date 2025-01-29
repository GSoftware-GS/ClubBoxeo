<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club de Boxeo</title>
    <link rel="stylesheet" href="./styles/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;700&family=Montserrat:wght@300;400;700&display=swap"
        rel="stylesheet">
</head>

<body>

    <div class="container">
        <?php include './src/html/menu.php'; ?>
        <section class="noticias">
            <h1>Últimas Noticias</h1>
            <?php include './src/php/ultimasNoticias.php'; ?>
        </section>
        <section class="testimonios">
            <h1>Testimonios</h1>
            <?php include './src/php/mostrarTestimonios.php'; ?>
        </section>
        <div class="contacto">
            <h1>Contacto</h1>
            <?php include './src/forms/formularioContacto.php'; ?>
        </div>
        <?php include './src/html/footer.html'; ?>
    </div>

</body>

</html>