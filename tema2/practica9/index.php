<?php
require "src/funciones_ctes.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 9</title>
</head>
<body>

<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
    $resultado = mysqli_query($conexion, "SELECT * FROM dispositivos_1");
} catch (Exception $e) {
    die("<p>Error: " . $e->getMessage() . "</p></body></html>");
}

echo "<table border='1'>";
echo "<tr><th>#</th><th>Machine</th></tr>";

while ($tupla = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td>" . $tupla['id_dispositivo'] . "</td>";
    echo "<td>" . $tupla['machine_id'] . "</td>";
    echo "</tr>";
}

echo "</table>";
mysqli_free_result($resultado);
mysqli_close($conexion);

?>

</body>
</html>