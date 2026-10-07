<?php

$resultado = "";

if (isset($_POST["texto"])) {

    $texto = $_POST["texto"];

    $texto = str_replace("á", "a", $texto);
    $texto = str_replace("é", "e", $texto);
    $texto = str_replace("í", "i", $texto);
    $texto = str_replace("ó", "o", $texto);
    $texto = str_replace("ú", "u", $texto);

    $texto = str_replace("Á", "A", $texto);
    $texto = str_replace("É", "E", $texto);
    $texto = str_replace("Í", "I", $texto);
    $texto = str_replace("Ó", "O", $texto);
    $texto = str_replace("Ú", "U", $texto);

    $resultado = $texto;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Quitar acentos</title>
</head>

<body>

    <h1>Quitar acentos</h1>

    <form method="post">

        <input type="text" name="texto">

        <br><br>

        <input type="submit" value="Quitar acentos">

    </form>

    <h2>
        <?php echo $resultado; ?>
    </h2>

</body>

</html>