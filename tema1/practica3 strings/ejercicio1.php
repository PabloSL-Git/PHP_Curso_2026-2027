<?php

$resultado = "";

if (isset($_POST["palabra1"]) && isset($_POST["palabra2"])) {

    $palabra1 = $_POST["palabra1"];
    $palabra2 = $_POST["palabra2"];

    $ultimas3_1 = substr($palabra1, -3);
    $ultimas3_2 = substr($palabra2, -3);

    $ultimas2_1 = substr($palabra1, -2);
    $ultimas2_2 = substr($palabra2, -2);

    if ($ultimas3_1 == $ultimas3_2) {

        $resultado = "Las palabras riman.";

    } else if ($ultimas2_1 == $ultimas2_2) {

        $resultado = "Las palabras riman un poco.";

    } else {

        $resultado = "Las palabras no riman.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Rimas</title>
</head>

<body>

    <h1>Comprobar rimas</h1>

    <form method="post">

        <input type="text" name="palabra1">
        <br>

        <input type="text" name="palabra2">
        <br>

        <input type="submit" value="Comprobar">

    </form>

    <h2>
        <?php echo $resultado; ?>
    </h2>

</body>

</html>