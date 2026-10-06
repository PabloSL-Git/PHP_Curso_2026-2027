<?php

if (isset($_POST["btnEnviar"])) {

    $palabra = $_POST["palabra"];
    $palabraInvertida = strrev($palabra);

    if ($palabra == $palabraInvertida) {
        $resultado = "La palabra es capicúa";
    } else {
        $resultado = "La palabra no es capicúa";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palabra capicúa</title>
</head>

<body>

    <form method="post">

        <p>Introduce una palabra:</p>
    
        <input type="text" name="palabra">

        <p>
            <input type="submit" name="btnEnviar" value="Comprobar">
        </p>

    </form>

    <?php

    if (isset($resultado)) {
        echo "<p>$resultado</p>";
    }

    ?>

</body>
</html>