<?php

    Const HOST_BD = "localhost";
    Const USUARIO_BD = "jose";
    Const CLAVE_BD = "josefa";
    Const NOMBRE_BD = "bd_exam_cole";

    try(

        $conexion = mysqli_connect(HOST_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");

    ) else (


    )

?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Examen2</title>
    </head>
    <body>
        <h3>Nota en las Asignaturas de los Alumnos</h3>

        <?php

            $consulta = "SELECT * notas";
            mysqli_query($conexion, $consulta);

            <table>Notas de las asignaturas</table>

            <th><td>Alumno</td><td>Nota</td><td>Accion</td></th>

            <th>
                <tr>$cod_alu</tr>
                <tr>$nota</tr>
                <tr>"Editar"</tr> 
            </th>
        ?>

    </body>
</html>