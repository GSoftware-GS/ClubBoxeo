<?php session_start();
if(_(!isset($_SESSION['loggedin']))){
    header("Location: login.php");
}
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajustes</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>


    <!-- Contenedor principal -->
    <div class="container">
        <!-- Barra de navegación en la parte superior -->

        <?php include './src/html/menu.php'; ?>

        <section class="ajustes">
            <h1>Ajustes</h1>
            <?php include './src/php/mostrarInformacionPersonal.php'; ?>
        </section>
      
        <!-- Footer en la parte inferior -->

        <?php include './src/html/footer.html'; ?>

    </div>


</body>

</html>