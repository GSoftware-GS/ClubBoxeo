<?php include './src/php/session_start.php';


// URL de la API
$apiUrl = "https://newsdata.io/api/1/news";
$apiKey = "pub_654822d8fd6c998a2b8e17f2ec4a4cd18f042";
$query = "boxing";
$language = "es";
$category = "sports";

// Construir la URL completa con parámetros
$requestUrl = sprintf(
    "%s?apikey=%s&q=%s&language=%s&category=%s",
    $apiUrl,
    $apiKey,
    urlencode($query),
    $language,
    $category
);

// Opciones de contexto para manejar cabeceras HTTP
$options = [
    "http" => [
        "method" => "GET",
        "header" => "Accept: application/json\r\n",
    ],
];
$context = stream_context_create($options);

// Realizar la solicitud a la API
$response = file_get_contents($requestUrl, false, $context);

// Verificar si la solicitud fue exitosa
if ($response === FALSE) {
    die("Error al conectarse a la API");
}

// Convertir la respuesta JSON a un array de PHP
$data = json_decode($response, true);

// Verificar si hay noticias en la respuesta
if (isset($data['results']) && is_array($data['results'])) {
    $news = $data['results'];
} else {
    die("No se encontraron noticias o hubo un error en la respuesta");
}

// Configurar paginación
$noticiasPorPagina = 5;
$totalNoticias = count($news);
$paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $noticiasPorPagina;
$paginatedNews = array_slice($news, $offset, $noticiasPorPagina);
$totalPaginas = ceil($totalNoticias / $noticiasPorPagina);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noticias de Boxeo</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <div class="container">
        <?php include './src/html/menu.php'; ?>

        <section class="noticias">

            <h1>Noticias Mundiales</h1>

            <?php if (!empty($paginatedNews)): ?>
                <?php foreach ($paginatedNews as $item): ?>
                    <article>
                        <h2><?= htmlspecialchars($item['title']) ?></h2>
                        <?php if (!empty($item['image_url'])): ?>
                            <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['title']) ?>"
                                width="100" height="100" class="imagen-noticia">
                        <?php endif; ?>
                        <p><?= htmlspecialchars(substr($item['description'] ?? 'Sin descripción disponible.', 0, 100)) ?>...</p>
                        <?php if (!empty($item['keywords'])): ?>
                            <p><strong>Palabras clave:</strong> <?= htmlspecialchars(implode(", ", $item['keywords'])) ?></p>
                        <?php endif; ?>
                        <p><small>Autor: <?= htmlspecialchars(implode(", ", $item['creator'] ?? ['Desconocido'])) ?></small></p>
                        <p><small>Fecha: <?= date("d/m/Y", strtotime($item['pubDate'])) ?></small></p>
                        <a href="<?= htmlspecialchars($item['link']) ?>" class="boton" target="_blank">Leer Más</a>
                    </article>
                <?php endforeach; ?>

                <div class="paginacion">
                    <?php if ($paginaActual > 1): ?>
                        <a href="?pagina=<?= $paginaActual - 1 ?>" class="boton">Anterior</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                        <?php if ($i == $paginaActual): ?>
                            <strong class="pagina-actual"><?= $i ?></strong>
                        <?php else: ?>
                            <a href="?pagina=<?= $i ?>" class="boton"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <?php if ($paginaActual < $totalPaginas): ?>
                        <a href="?pagina=<?= $paginaActual + 1 ?>" class="boton">Siguiente</a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <p>No hay noticias disponibles</p>
            <?php endif; ?>

        </section>
        <?php include './src/html/footer.html'; ?>
    </div>
</body>

</html>