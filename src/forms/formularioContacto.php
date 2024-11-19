<html>

<head>
    <meta charset="UTF-8">
    <title>Formulario de contacto</title>
    <link rel="stylesheet" href="./styles/formulario.css">
</head>

<body>
    <form>
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>

        <label for="mensaje">Mensaje</label>
        <textarea id="mensaje" name="mensaje" required></textarea>

        <button type="submit" class="boton">Enviar</button>
    </form>
</body>

</html>