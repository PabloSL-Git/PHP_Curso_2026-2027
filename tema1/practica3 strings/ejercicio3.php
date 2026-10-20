<?php

$resultado = "";

if (isset($_POST["texto"])) {

    $texto = $_POST["texto"];

    $textoSinEspacios = str_replace(" ", "", $texto);

    $invertido = strrev($textoSinEspacios);

    if ($textoSinEspacios == $invertido) {

        $resultado = "La frase es palíndroma.";

    } else {

        $resultado = "La frase no es palíndroma.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Frase palíndroma</title>
</head>

<body>

    <h1>Frase palíndroma</h1>

    <form method="post">

        <input type="text" name="texto">

        <br><br>

        <input type="submit" value="Comprobar">

    </form>

    <h2>
        <?php echo $resultado; ?>
    </h2>

</body>

</html>