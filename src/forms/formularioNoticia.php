<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Noticia</title>
    <link rel="stylesheet" href="../../styles/formulario.css">
    <script src="../js/validarNoticia.js" defer></script>
</head>

<body>
    <div class="box">
        <div class="form-container">
            <?php include '../php/agregarNoticia.php'; ?>
            <h1>Añadir nueva noticia</h1>
            <form method="POST" action="" enctype="multipart/form-data">
                <label>Título:</label>
                <input type="text" name="titulo" required>
                <span id="errorTitulo" class="error"></span><br>

                <label>Contenido:</label>
                <textarea id="contenido" name="contenido" required></textarea>
                <span id="errorContenido" class="error"></span><br>

                <label>Fecha de publicación:</label>
                <input type="date" name="fecha" required>
                <span id="errorFecha" class="error"></span><br>

                <label>Foto:</label>
                <input type="file" name="foto" accept="image/jpeg" required>
                <span id="errorFoto" class="error"></span><br>

                <input type="submit" value="Añadir Noticia">
            </form>
            <a href='../../noticias.php'>Volver a la lista de Noticias</a>

        </div>
    </div>
</body>

</html>