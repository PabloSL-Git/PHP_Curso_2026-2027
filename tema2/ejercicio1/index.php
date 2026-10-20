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
        <label for="asigantura">Elige una asignatura</label>
        <select name="asigantura" id= "asignatura">

        <?php
        for ($i = 0; $i < $n_tuplas; $i++) {
            $fila = mysqli_fetch_assoc($resultado);
            echo "<option value='" . $fila[0] . "'>" . $fila[1] . "</option>";
        }
        ?>

        </select>
    </p>

    </form>




    <?php

    # alumnos

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

    $tupla = mysqli_fetch_assoc($resultado);


    mysqli_data_seek($resultado, 0);

    echo "<h3>Nota de los alumnos de Lengua</h3>";
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

    mysqli_free_result($resultado);

    mysqli_close($conexion);
    ?>
</body>
</html>