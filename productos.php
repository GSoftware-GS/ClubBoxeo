<?php include './src/includes/auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="./styles/productos.css">
</head>

<body>
    <div class="container">
        <?php include './src/html/menu.php'; ?>

        <section class="productos">
            <h1>Productos</h1>

            <?php include './src/php/mostrarProductos.php'; ?>
        </section>
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['rol'] === 'admin') {
            echo "<div class='buttons'>";
            echo "<a href='./src/forms/formularioAgregarProducto.php' class='boton'>Agregar Producto</a>";
            echo "</div>";
        }
        ?>



        <?php include './src/html/footer.html'; ?>
    </div>
</body>

</html>