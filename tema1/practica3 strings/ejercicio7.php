<?php

$resultado = "";

if (isset($_POST["numeros"])) {

    $numeros = $_POST["numeros"];

    $correcto = true;

    for ($i = 0; $i < strlen($numeros); $i++) {

        $caracter = $numeros[$i];

        if ($caracter != "0" &&
            $caracter != "1" &&
            $caracter != "2" &&
            $caracter != "3" &&
            $caracter != "4" &&
            $caracter != "5" &&
            $caracter != "6" &&
            $caracter != "7" &&
            $caracter != "8" &&
            $caracter != "9" &&
            $caracter != "." &&
            $caracter != "," &&
            $caracter != " ") {

            $correcto = false;
        }
    }

    if ($correcto == true) {

        $numeros = str_replace(",", ".", $numeros);

        $resultado = $numeros;

    } else {

        $resultado = "Has introducido caracteres incorrectos.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Números</title>
</head>

<body>

    <h1>Convertir números</h1>

    <form method="post">

        <input type="text" name="numeros">

        <br><br>

        <input type="submit" value="Convertir">

    </form>

    <h2>
        <?php echo $resultado; ?>
    </h2>

</body>

</html>