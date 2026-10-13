<?php
    if(isset($_POST["btnEnviar"])){
        $error_nombre = $_POST["nombre"]== "";
        $error_sexo = empty($_POST["sexo"]);

        $error_formulario = $error_nombre || $error_sexo;
    }

    if (isset($_POST["btnEnviar"]) && !$error_formulario) {
        // Voy a poner pagina de recogida
    }
    else {
        // Voy a poner una pagina con el formulario
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica2</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1>Esta es mi super pagina</h1>
    <form action="index.php" method="POST">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($_POST['nombre'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            <?php if (isset($_POST["btnEnviar"]) && $error_nombre): ?>
                <span class="error">Campo obligatorio</span>
            <?php endif; ?>
        </p>
        <p>
            <label for="nacido">Nacido en:</label>
            <select name="nacido" id="nacido">
                <option value="">Selecciona tu lugar de nacimiento</option>
                <option value="Málaga">Málaga</option>
                <option value="Cadiz">Cádiz</option>
                <option value="Sevilla">Sevilla</option>
                <option value="Granada">Granada</option>
                <option value="Cordoba">Cordoba</option>
                <option value="Almeria">Almeria</option>
                <option value="Jaén">Jaén</option>
                <option value="Huelva">Huelva</option>
            </select>
        </p>
        <p>
            <label>Sexo:</label>
            <label for="hombre">Hombre</label>
            <input type="radio" name="sexo" id="hombre" value="Hombre">
            <label for="mujer">Mujer</label>
            <input type="radio" name="sexo" id="hombre" value="Mujer">
        </p>
        <p>
            <label>Aficiones</label>
            <input type="checkbox" name="aficiones[]" id="deportes" value="Deportes">
            <label for="deportes">Deportes</label>
            <input type="checkbox" name="lectura[]" id="lectura" value="Lectura">
            <label for="Lectura">Lectura</label>
            <input type="checkbox" name="otros[]" id="otros" value="Otros">
            <label for="Otros">Otros</label>
        </p>
        <p>
            <label for="comentarios">Comentarios</label>
            <textarea name="comentarios" id="comentarios"></textarea>
        </p>
        <p>
            <button name="btnEnviar" type="submit">Enviar</button>
        </p>
    </form>
</body>
</html>
<?php
}
?>