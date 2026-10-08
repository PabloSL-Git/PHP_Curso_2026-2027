<?php

$dia1 = "";
$mes1 = "";
$anio1 = "";

$dia2 = "";
$mes2 = "";
$anio2 = "";

$resultado = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $dia1 = $_POST["dia1"];
    $mes1 = $_POST["mes1"];
    $anio1 = $_POST["anio1"];

    $dia2 = $_POST["dia2"];
    $mes2 = $_POST["mes2"];
    $anio2 = $_POST["anio2"];

    if ($dia1 == "" || $mes1 == "" || $anio1 == "" ||
        $dia2 == "" || $mes2 == "" || $anio2 == "") {

        $error = "No puede quedar ningún campo vacío.";

    } else {

        if (!checkdate($mes1, $dia1, $anio1) ||
            !checkdate($mes2, $dia2, $anio2)) {

            $error = "Alguna de las fechas no es correcta.";

        } else {

            $fecha1 = new DateTime("$anio1-$mes1-$dia1");
            $fecha2 = new DateTime("$anio2-$mes2-$dia2");

            $diferencia = $fecha1->diff($fecha2);

            $resultado = $diferencia->days;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Fecha 2</title>

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

        <p>Introduzca una fecha:</p>

        Día:
        <select name="dia1">

            <option value="">--</option>

            <?php
            for ($i = 1; $i <= 31; $i++) {

                if ($i == $dia1) {
                    echo "<option value='$i' selected>$i</option>";
                } else {
                    echo "<option value='$i'>$i</option>";
                }
            }
            ?>

        </select>

        Mes:
        <select name="mes1">

            <option value="">--</option>

            <?php

            $meses = array(
                1 => "Enero",
                2 => "Febrero",
                3 => "Marzo",
                4 => "Abril",
                5 => "Mayo",
                6 => "Junio",
                7 => "Julio",
                8 => "Agosto",
                9 => "Septiembre",
                10 => "Octubre",
                11 => "Noviembre",
                12 => "Diciembre"
            );

            foreach ($meses as $numero => $nombre) {

                if ($numero == $mes1) {
                    echo "<option value='$numero' selected>$nombre</option>";
                } else {
                    echo "<option value='$numero'>$nombre</option>";
                }
            }

            ?>

        </select>

        Año:
        <select name="anio1">

            <option value="">--</option>

            <?php

            for ($i = 1900; $i <= 2100; $i++) {

                if ($i == $anio1) {
                    echo "<option value='$i' selected>$i</option>";
                } else {
                    echo "<option value='$i'>$i</option>";
                }
            }

            ?>

        </select>


        <p>Introduzca otra fecha:</p>

        Día:
        <select name="dia2">

            <option value="">--</option>

            <?php
            for ($i = 1; $i <= 31; $i++) {

                if ($i == $dia2) {
                    echo "<option value='$i' selected>$i</option>";
                } else {
                    echo "<option value='$i'>$i</option>";
                }
            }
            ?>

        </select>

        Mes:
        <select name="mes2">

            <option value="">--</option>

            <?php

            foreach ($meses as $numero => $nombre) {

                if ($numero == $mes2) {
                    echo "<option value='$numero' selected>$nombre</option>";
                } else {
                    echo "<option value='$numero'>$nombre</option>";
                }
            }

            ?>

        </select>

        Año:
        <select name="anio2">

            <option value="">--</option>

            <?php

            for ($i = 1900; $i <= 2100; $i++) {

                if ($i == $anio2) {
                    echo "<option value='$i' selected>$i</option>";
                } else {
                    echo "<option value='$i'>$i</option>";
                }
            }

            ?>

        </select>

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