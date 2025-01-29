<?php include './src/includes/auth.php'; 
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <div class="container">
        <?php include './src/html/menu.php'; ?>



        <section class="calendario">
            <h1>Calendario</h1>

            <?php include './src/php/calendario.php'; ?>
        </section>

        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['rol'] === 'admin') {
            echo "<section class='addCitas'>";
            echo "<h1>Agregar Cita</h1>";
            include './src/forms/formularioCita.php';
            echo "</section>";
        }
        ?>


        <div class="buttons">
            <a href="./src/forms/formularioBuscarCita.php" class="boton">Buscar Cita</a>
        </div>


        <?php include './src/html/footer.html'; ?>
    </div>
</body>

</html>