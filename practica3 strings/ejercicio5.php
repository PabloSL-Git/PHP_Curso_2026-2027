<?php

$resultado = "";

if (isset($_POST["numero"])) {

    $numero = $_POST["numero"];

    $romano = "";

    while ($numero >= 1000) {
        $romano = $romano . "M";
        $numero = $numero - 1000;
    }

    while ($numero >= 500) {
        $romano = $romano . "D";
        $numero = $numero - 500;
    }

    while ($numero >= 100) {
        $romano = $romano . "C";
        $numero = $numero - 100;
    }

    while ($numero >= 50) {
        $romano = $romano . "L";
        $numero = $numero - 50;
    }

    while ($numero >= 10) {
        $romano = $romano . "X";
        $numero = $numero - 10;
    }

    while ($numero >= 5) {
        $romano = $romano . "V";
        $numero = $numero - 5;
    }

    while ($numero >= 1) {
        $romano = $romano . "I";
        $numero = $numero - 1;
    }

    $resultado = "El número romano es: " . $romano;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Números romanos</title>
</head>

<body>

    <h1>Convertir a números romanos</h1>

    <form method="post">

        <input type="text" name="numero">

        <br><br>

        <input type="submit" value="Convertir">

    </form>

    <h2>
        <?php echo $resultado; ?>
    </h2>

</body>

</html>