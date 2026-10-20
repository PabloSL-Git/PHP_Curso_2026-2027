<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría BD</title>
</head>
<body>
    <h1>Teoría BD</h1>
    <?php
    Const SERVIDOR_BD="localhost";
    Const USUARIO_BD="jose";
    Const CLAVE_BD="josefa";
    Const NOMBRE_BD="bd_teoria";

    try
    {
        $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    }
    catch (Exception $e)
    {
        die("<p>Error no se ha podido conectar a la BD: " .$e->getMessage() ."</p>
        </body>
        </html>");
    }

    echo "<p>Conexión a la BD realizada correctamente</p>";


    try
    {
        $consulta="select * from alumnos";
        $resultado = mysqli_query($conexion, $consulta);
    }
    catch (Exception $e)
    {
        die("<p>Error no se ha podido hacer la consulta: " .$e->getMessage() ."</p>
        </body>
        </html>");
    }

    echo "<p>Consulta: <em>" . $consulta . " </em>realizada con exito</p>";


    $n_tuplas=mysqli_num_rows($resultado);

    echo "<p>El número de tuplas devueltas es: <em>" . $n_tuplas . "</em></p>";

    $tupla = mysqli_fetch_assoc($resultado);

    echo "<h3>Leida primera tupla, estos son sus datos:</h3>";
    echo "<p><strong>cod_alu </strong>: " . $tupla['cod_alu'] . "</p>";
    echo "<p><strong>nombre </strong>: " . $tupla['nombre'] . "</p>";
    echo "<p><strong>telefono </strong>: " . $tupla['telefono'] . "</p>";
    echo "<p><strong>codigo postal</strong>: " . $tupla['cp'] . "</p>";

    $tupla = mysqli_fetch_object($resultado);

    echo "<h3>Leida segunda tupla, estos son sus datos:</h3>";
    echo "<p><strong>cod_alu </strong>: " . $tupla->cod_alu . "</p>";
    echo "<p><strong>nombre </strong>: " . $tupla->nombre . "</p>";
    echo "<p><strong>telefono </strong>: " . $tupla->telefono . "</p>";
    echo "<p><strong>codigo postal</strong>: " . $tupla->cp . "</p>";

    $tupla = mysqli_fetch_row($resultado);

    echo "<h3>Leida tercera tupla, estos son sus datos:</h3>";
    echo "<p><strong>cod_alu </strong>: " . $tupla[0] . "</p>";
    echo "<p><strong>nombre </strong>: " . $tupla[1] . "</p>";
    echo "<p><strong>telefono </strong>: " . $tupla[2]   . "</p>";
    echo "<p><strong>codigo postal</strong>: " . $tupla[3] . "</p>";

    mysqli_data_seek($resultado, 0);

    echo "<h3>Informacion de los alumnos en una tabla</h3>";
    echo "<table border='1'>";
    echo "<tr><th>cod_alu</th><th>nombre</th><th>telefono</th><th>cp</th></tr>";
    while($tupla = mysqli_fetch_assoc($resultado))
    {
        echo "<tr>";
        echo "<td>" . $tupla['cod_alu'] . "</td>";
        echo "<td>" . $tupla['nombre'] . "</td>";
        echo "<td>" . $tupla['telefono'] . "</td>";
        echo "<td>" . $tupla['cp'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    musqli_free_result($resultado);

    mysqli_close($conexion);
    ?>
</body>
</html>