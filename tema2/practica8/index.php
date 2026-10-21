<?php
    Const SERVIDOR_BD="localhost";
    Const USUARIO_BD="jose";
    Const CLAVE_BD="josefa";
    Const NOMBRE_BD="bd_cv";

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
    <title>Practica 8</title>
</head>
<body>
    <h1>Practica 8</h1>
    <h2>Listado Usuarios</h2>

    <?php

        # Select de las asignaturas

        try {
            $consulta = "SELECT * FROM usuarios";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            die("<p>Error no se ha podido hacer la consulta: " . $e->getMessage() . "</p>
            </body>
            </html>");
        }


        echo "<table border='1'>";
        echo "<tr><th>imagen</th><th>nombre</th><th>Usuario+</th></tr>";

        while ($tupla = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td><img src='img/" . $tupla['foto'] . "' alt='Foto perfil' title='Foto perfil' width='100'></td>";
            echo "<td>" . $tupla['nombre'] . "</td>";
            echo "<td>" . $tupla[''] . "</td>";
            echo "</tr>";
        }

        echo "</table>";

    ?>

</body>
</html>