<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./styles/menu.css">
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="./index.php">
                <img src="./img/assets/logo.png" alt="Logo">
            </a>
        </div>

        <button class="menu-toggle" aria-label="Toggle menu">&#9776;</button>
        <nav class="menu">
            <ul>
                <li><a href="./index.php">Home</a></li><?php
                if (isset($_SESSION['loggedin']) && $_SESSION['rol'] === 'admin') {
                    echo "<li><a href='./socios.php'>Socios</a></li>";
                }
                ?>

                <li><a href="./servicios.php">Servicios</a></li>
                <li><a href="./testimonios.php">Testimonios</a></li>
                <li><a href="./productos.php">Productos</a></li>
                <li class="submenu">
                    <a href="#">Noticias</a>
                    <ul>
                        <li><a href="./noticias.php">Noticias del Gimnasio</a></li>
                        <li><a href="./noticiasMundiales.php">Noticias Mundiales</a></li>
                    </ul>
                </li>
                <li><a href="./citas.php">Citas</a></li>
                <?php if (isset($_SESSION['loggedin'])): ?>
                    <li><a class="logout" href="./logout.php">Cerrar Sesion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- Mueve el script aquí, al final del body -->
    <script>
        document.querySelector('.menu-toggle').addEventListener('click', function () {
            document.querySelector('.menu').classList.toggle('active');
        });
    </script>
</body>

</html>