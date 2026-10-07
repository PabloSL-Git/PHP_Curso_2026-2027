<?php

$resultado = "";

if (isset($_POST["romano"])) {

    $romano = strtoupper($_POST["romano"]);

    $numero = 0;

    for ($i = 0; $i < strlen($romano); $i++) {

        switch ($romano[$i]) {

            case "I":
                $numero = $numero + 1;
                break;

            case "V":
                $numero = $numero + 5;
                break;

            case "X":
                $numero = $numero + 10;
                break;

            case "L":
                $numero = $numero + 50;
                break;

            case "C":
                $numero = $numero + 100;
                break;

            case "D":
                $numero = $numero + 500;
                break;

            case "M":
                $numero = $numero + 1000;
                break;
        }
    }

    $resultado = "El número es: " . $numero;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Números romanos</title>
</head>

<body>

    <h1>Convertir números romanos</h1>

    <form method="post">

        <input type="text" name="romano">

        <br><br>

        <input type="submit" value="Convertir">

    </form>

    <h2>
        <?php echo $resultado; ?>
    </h2>

</body>

</html>