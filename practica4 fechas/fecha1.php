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

        $partes1 = explode("/", $fecha1);
        $partes2 = explode("/", $fecha2);

        if (count($partes1) != 3 || count($partes2) != 3) {

            $error = "Las fechas deben tener el formato DD/MM/YYYY.";

        } else {

            $dia1 = $partes1[0];
            $mes1 = $partes1[1];
            $anio1 = $partes1[2];

            $dia2 = $partes2[0];
            $mes2 = $partes2[1];
            $anio2 = $partes2[2];

            if (!checkdate($mes1, $dia1, $anio1) ||
                !checkdate($mes2, $dia2, $anio2)) {

                $error = "Alguna de las fechas no es correcta.";

            } else {

                $fecha1Objeto = new DateTime("$anio1-$mes1-$dia1");
                $fecha2Objeto = new DateTime("$anio2-$mes2-$dia2");

                $diferencia = $fecha1Objeto->diff($fecha2Objeto);

                $resultado = $diferencia->days;
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Fecha 1</title>

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

        <label>Introduzca una fecha: (DD/MM/YYYY)</label>
        <input type="text" name="fecha1" value="<?php echo $fecha1; ?>">

        <br>

        <label>Introduzca una fecha: (DD/MM/YYYY)</label>
        <input type="text" name="fecha2" value="<?php echo $fecha2; ?>">

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
        echo "<p>La diferencia en días entre las dos fechas introducidas es de $resultado</p>";
    }

    ?>

</div>

</body>
</html>