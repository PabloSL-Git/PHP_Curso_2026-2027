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
    ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica1 BD</title>
</head>
<body>
    <h1>Practica1 BD</h1>

    <form action="index.php" method="post">
    <p>
        <label for="asignatura">Elige una asignatura</label>
        <select name="asignatura" id="asignatura">

        <?php

        # Select de las asignaturas

        try {
            $consulta = "SELECT cod_asig, denominacion FROM asignaturas";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            die("<p>Error no se ha podido hacer la consulta: " . $e->getMessage() . "</p>
            </body>
            </html>");
        }

        $asignaturas_tuplas = mysqli_num_rows($resultado);

        for ($i = 0; $i < $asignaturas_tuplas; $i++) {
            $fila = mysqli_fetch_assoc($resultado);

            echo "<option value='" . $fila['cod_asig'] . "'>" . $fila['denominacion'] . "</option>";
        }

        ?>

        </select>
        <input type="submit" name="btnEnviar" value="Enviar">
    </p>
</form>


    <?php

    # Lengua española

    try
    {
        $consulta="SELECT * FROM notas";
        $resultado = mysqli_query($conexion, $consulta);
    }
    catch (Exception $e)
    {
        die("<p>Error no se ha podido hacer la consulta: " .$e->getMessage() ."</p>
        </body>
        </html>");
    }

    $notaslengua_tuplas = mysqli_num_rows($resultado);

    echo "<h3>Notas de los alumnos de Lengua</h3>";
    echo "<table border='1'>";
    echo "<tr><th>cod_alu</th><th>cod_asig</th><th>nota</th></tr>";
    while($tupla = mysqli_fetch_assoc($resultado))
    {
        echo "<tr>";
        echo "<td>" . $tupla['cod_alu'] . "</td>";
        echo "<td>" . $tupla['cod_asig'] . "</td>";
        echo "<td>" . $tupla['nota'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    mysqli_free_result($resultado);

    mysqli_close($conexion);
    ?>
</body>
</html>