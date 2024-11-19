<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Noticia</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
</head>

<body>
    <div class="box">
        <div class="form-container">
            <?php include '../php/agregarNoticia.php'; ?>
            <h1>Añadir nueva noticia</h1>
            <form method="POST" action="" enctype="multipart/form-data">
                <label>titulo:</label>
                <input type="text" name="titulo" required><br>

                <label>contenido:</label>
                <textarea id="contenido" name="contenido" required></textarea>

                <label>Foto:</label>
                <input type="file" name="foto" accept="image/*" required><br>

                <input type="submit" value="Añadir Noticia">
            </form>
            <a href='../../noticias.php'>Volver a la lista de Noticias</a>

        </div>
    </div>
</body>

</html>