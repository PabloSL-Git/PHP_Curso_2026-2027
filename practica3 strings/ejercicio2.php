<?php

$resultado = "";

if (isset($_POST["texto"])) {

    $texto = $_POST["texto"];

    $invertido = strrev($texto);

    if ($texto == $invertido) {

        $resultado = "Es un palindromo o un número capicua.";

    } else {

        $resultado = "No es un palindromo ni un número capicua.";
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

    <h1>Palíndromo o capicúa</h1>

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