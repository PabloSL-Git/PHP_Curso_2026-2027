<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recogida</title>
</head>
<body>
    <h1>Estos son los datos enviados:</h1>

    <p>El nombre enviado ha sido: <?php echo htmlspecialchars($nombre); ?></p>
    <p>Ha nacido en: <?php echo htmlspecialchars($ciudad); ?></p>
    <p>El sexo es: <?php echo htmlspecialchars($sexo); ?></p>

    <?php if (count($aficiones) == 0): ?>
        <p>No has seleccionado ninguna afición</p>
    <?php else: ?>
        <?php if (count($aficiones) == 1): ?>
            <p>La afición seleccionada ha sido:</p>
        <?php else: ?>
            <p>Las aficiones seleccionadas han sido:</p>
        <?php endif; ?>
        <ol>
            <?php foreach ($aficiones as $aficion): ?>
                <li><?php echo htmlspecialchars($aficion); ?></li>
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>

    <?php if ($comentarios == ""): ?>
        <p>No has hecho ningún comentario</p>
    <?php else: ?>
        <p>El comentario enviado ha sido: <?php echo htmlspecialchars($comentarios); ?></p>
    <?php endif; ?>
</body>
</html>