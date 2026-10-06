<?php

$resultado = "";

if (isset($_POST["texto"])) {

    $texto = strtolower($_POST["texto"]);

    if ($texto == strrev($texto)) {
        $resultado = "Es un palindromo o capicua.";
    } else {
        $resultado = "No es un palindromo ni capicua.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Palíndromo o capicúa</title>

</head>

<body>

<div class="contenedor">

    <div class="cuadro">
        <h1>Palíndromo o capicúa</h1>

        <form method="post">
            <input type="text" name="texto" placeholder="Palabra o número">
            <br>
            <input type="submit" value="Comprobar">
        </form>
    </div>

    <div class="cuadro resultado">

        <?php
        echo $resultado;
        ?>

    </div>

</div>

</body>
</html>