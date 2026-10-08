<?php

$fecha1 = "";
$fecha2 = "";
$resultado = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fecha1 = $_POST["fecha1"];
    $fecha2 = $_POST["fecha2"];

    if ($fecha1 == "" || $fecha2 == "") {

        $error = "No puede quedar ningún campo vacío.";

    } else {

        $partes1 = explode("-", $fecha1);
        $partes2 = explode("-", $fecha2);

        $anio1 = $partes1[0];
        $mes1 = $partes1[1];
        $dia1 = $partes1[2];

        $anio2 = $partes2[0];
        $mes2 = $partes2[1];
        $dia2 = $partes2[2];

        if (!checkdate($mes1, $dia1, $anio1) ||
            !checkdate($mes2, $dia2, $anio2)) {

            $error = "Alguna de las fechas no es correcta.";

        } else {

            $fecha1Objeto = new DateTime($fecha1);
            $fecha2Objeto = new DateTime($fecha2);

            $diferencia = $fecha1Objeto->diff($fecha2Objeto);

            $resultado = $diferencia->days;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Fecha 3</title>

    <style>
        .formulario {
            background-color: lightblue;
            border: 2px solid black;
            padding: 20px;
            margin-bottom: 15px;
        }

        .respuesta {
            background-color: lightgreen;
            border: 2px solid black;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>

<div class="formulario">

    <h1>Fechas - Formulario</h1>

    <form method="post">

        <label>Introduzca una fecha:</label>
        <input type="date" name="fecha1" value="<?php echo $fecha1; ?>">

        <br>

        <label>Introduzca otra fecha:</label>
        <input type="date" name="fecha2" value="<?php echo $fecha2; ?>">

        <br><br>

        <input type="submit" value="Calcular">

    </form>

</div>

<div class="respuesta">

    <h1>Fechas - Respuesta</h1>

    <?php

    if ($error != "") {
        echo "<p>$error</p>";
    }

    if ($resultado != "") {
        echo "<p>La diferencia en días entre las dos fechas es de: $resultado</p>";
    }

    ?>

</div>

</body>
</html>