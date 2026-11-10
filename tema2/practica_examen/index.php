<?php
require "src/funciones_ctes.php";

try {
    $consulta = "SELECT * FROM alumnos";
    $resultado_alumnos = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die(error_page("Practica examen", "<h1>Practica examen</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 DWESE 22-23</title>
</head>
<body>
    <h1>Nota de los alumnos</h1>
    <?php
    if (mysqli_num_rows($resultado_alumnos) > 0) {
    ?>
        <form action="index.php" method="post">
            <p>
                <label for="alumnos">Seleccione un alumno: </label>
                <select id="alumnos" name="alumnos">
                    <?php
                    while ($tupla = mysqli_fetch_assoc($resultado_alumnos)) {
                        if (isset($_POST["alumnos"]) && $_POST["alumnos"])
                            echo "<option value='".$tupla["cod_alu"]."'>".$tupla["nombre"]."</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="btnVerNota">Ver Notas</button>
            </p>
        </form>
    <?php
        if (isset($_POST["alumnos"]))
            echo "<h3>El alumno seleccionado ha sido: ".$_POST["alumnos"]."</h3>";
    } else {
        echo "<p>En estos momentos no tenemos ningún alumno registrado en la BD</p>";
    }

    mysqli_close($conexion);
    ?>
</body>
</html>