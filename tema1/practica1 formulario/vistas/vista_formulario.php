<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi primera página PHP</title>
</head>

<body>
    <h1> Esta es mi super pagina</h1>
    
<form action="index.php" method="POST">

    Nombre:
    
    <input type="text" name="nombre"
    value="<?php echo htmlspecialchars($nombre); ?>">

    <?php if ($error_nombre): ?>
    <span style="color:red">* Campo obligatorio *</span>
    <?php endif; ?>

    <br><br>

    Nacido en:
    
    <select name="ciudad">

        <option value="Malaga"<?php if ($ciudad == "Malaga") echo "selected"; ?>>
            Málaga
        </option>

        <option value="Sevilla"<?php if ($ciudad == "Sevilla") echo "selected"; ?>>
            Sevilla
        </option>

        <option value="Granada"<?php if ($ciudad == "Granada") echo "selected"; ?>>
            Granada
        </option>

    </select>

    <br><br>

    Sexo:

    
    Hombre
    <input type="radio" name="sexo" value="Hombre"<?php if ($sexo == "Hombre") echo "checked"; ?>>

    Mujer
    <input type="radio" name="sexo" value="Mujer"<?php if ($sexo == "Mujer") echo "checked"; ?>>

    <?php if ($error_sexo): ?>
    <span style="color:red">* Campo obligatorio *</span>
    <?php endif; ?>
        
    <br><br>

    Aficiones:

    Deportes
    <input type="checkbox" name="aficiones[]" value="Deportes"<?php if (in_array("Deportes", $aficiones)) echo "checked"; ?>>

    Lectura
    <input type="checkbox" name="aficiones[]" value="Lectura"<?php if (in_array("Lectura", $aficiones)) echo "checked"; ?>>

     Otros
    <input type="checkbox" name="aficiones[]" value="Otros"<?php if (in_array("Otros", $aficiones)) echo "checked"; ?>>

    <br><br>

    Comentarios:
    
    <textarea name="comentarios"><?php echo htmlspecialchars($comentarios); ?></textarea>

    <br><br>

    <input type="submit" value="Enviar">

</form>
</body>
</html>