<?php
require "src/funciones_ctes.php";


try{
    @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
    mysqli_set_charset($conexion,"utf8");
}
catch(Exception $e)
{
    die(error_page("Examen2 DWESE 22-23","<h1>Nota de los alumnos</h1><p>Error al intentar conectarse a la BD: ".$e->getMessage()."</p>"));
}



if(isset($_POST["btnCambiar"]))
{
    $error_form=$_POST["nota"]=="" || !is_numeric($_POST["nota"]) ||  $_POST["nota"]<0 || $_POST["nota"]>10;
    if(!$error_form)
    {
        try{
            $consulta="update notas set nota='".$_POST["nota"]."' where cod_alu='".$_POST["alumno"]."' and cod_asig='".$_POST["btnCambiar"]."'";
            mysqli_query($conexion, $consulta);
        }
        catch(Exception $e)
        {
            mysqli_close($conexion);
            die(error_page("Examen2 DWESE 22-23","<h1>Nota de los alumnos</h1><p>Error al intentar conectarse a la BD: ".$e->getMessage()."</p>"));
        }

        $mensaje_accion="¡¡ Nota cambiada con éxito !!";
    }
}


if(isset($_POST["btnCalificar"]))
{
    try{
            $consulta="insert into notas (cod_alu,cod_asig,nota) values('".$_POST["alumno"]."','".$_POST["asignatura"]."','0')";
            mysqli_query($conexion, $consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die(error_page("Examen2 DWESE 22-23","<h1>Nota de los alumnos</h1><p>Error al intentar conectarse a la BD: ".$e->getMessage()."</p>"));
    }

    $mensaje_accion="¡¡ Asignatura calificada con un 0. Cambie la nota si lo estima necesario !!";

    $_POST["btnEditar"]=$_POST["asignatura"];
}




if(isset($_POST["btnBorrar"]))
{

    try{
        $consulta="delete from notas where cod_alu='".$_POST["alumno"]."' and cod_asig='".$_POST["btnBorrar"]."'";
        mysqli_query($conexion, $consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die(error_page("Examen2 DWESE 22-23","<h1>Nota de los alumnos</h1><p>Error al intentar conectarse a la BD: ".$e->getMessage()."</p>"));
    }

    $mensaje_accion="¡¡ Nota descalicada con éxito !!";

}






if(isset($_POST["alumno"]))
{
    
    
    try{
        $consulta="select notas.cod_asig, denominacion, nota from notas JOIN asignaturas USING (cod_asig) where cod_alu='".$_POST["alumno"]."'";
        $resultado_notas_alumno=mysqli_query($conexion, $consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die(error_page("Examen2 DWESE 22-23","<h1>Nota de los alumnos</h1><p>Error al intentar conectarse a la BD: ".$e->getMessage()."</p>"));
    }

    try{
        $consulta="select * from asignaturas where cod_asig not in (select notas.cod_asig from notas JOIN asignaturas USING (cod_asig) where cod_alu='".$_POST["alumno"]."')";
        $resultado_asigs_noeval_alumno=mysqli_query($conexion, $consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die(error_page("Examen2 DWESE 22-23","<h1>Nota de los alumnos</h1><p>Error al intentar conectarse a la BD: ".$e->getMessage()."</p>"));
    }

    

}


try{
   $consulta="select * from alumnos";
   $resultado_alumnos=mysqli_query($conexion, $consulta);
}
catch(Exception $e)
{
    mysqli_close($conexion);
    die(error_page("Examen2 DWESE 22-23","<h1>Nota de los alumnos</h1><p>Error al intentar conectarse a la BD: ".$e->getMessage()."</p>"));
}


mysqli_close($conexion);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 DWESE 22-23</title>
    <style>
        table,th, td{border:1px solid black}
        table{border-collapse:collapse; text-align:center}
        th{background-color: #CCC;}
        .enlace{background:none; border:none; text-decoration: underline;color:blue;cursor: pointer;}
        .mensaje{color:blue;font-size:1.25rem}
        .error{color:red}
    </style>
</head>
<body>
    <h1>Nota de los alumnos</h1>
    <?php
    if(mysqli_num_rows($resultado_alumnos)>0)
    {
    ?>
        <form action="index.php" method="post">
            <p>
                <label for="alumno">Seleccione un alumno: </label>
                <select id="alumno" name="alumno">
                <?php
                while($tupla=mysqli_fetch_assoc($resultado_alumnos))
                {
                    if(isset($_POST["alumno"]) && $_POST["alumno"]== $tupla["cod_alu"])
                    {
                        echo "<option selected value='".$tupla["cod_alu"]."'>".$tupla["nombre"]."</option>";
                        $nombre_alumno_selec=$tupla["nombre"];
                    }
                    else
                        echo "<option value='".$tupla["cod_alu"]."'>".$tupla["nombre"]."</option>";
                }
                mysqli_free_result($resultado_alumnos);
                ?>
                </select>
                <button type="submit" name="btnVerNota">Ver Notas</button>
            </p>
        </form>
    <?php
        if(isset($_POST["alumno"]))
        {
            echo "<h2>Notas del alumno ".$nombre_alumno_selec."</h2>";
            echo "<table>";
            echo "<tr><th>Asignatura</th><th>Nota</th><th>Acción</th></tr>";
            while($tupla=mysqli_fetch_assoc($resultado_notas_alumno))
            {
                echo "<tr>";
                echo "<td>".$tupla["denominacion"]."</td>";
                if((isset($_POST["btnEditar"]) && $_POST["btnEditar"]==$tupla["cod_asig"]) || (isset($_POST["btnCambiar"]) && $_POST["btnCambiar"]==$tupla["cod_asig"] && $error_form) )
                {
                    echo "<form action='index.php' method='post'>";
                    echo "<input type='hidden' name='alumno' value='".$_POST["alumno"]."'>";
                    if(isset($_POST["btnCambiar"]))
                        echo "<td><input type='text' name='nota' placeholder='Teclee un número entre 0 y 10' value='".$_POST["nota"]."'>";
                    else
                        echo "<td><input type='text' name='nota' placeholder='Teclee un número entre 0 y 10' value='".$tupla["nota"]."'>";
                    if(isset($_POST["btnCambiar"]) && $error_form)
                        echo "<br><span class='error'> * No has introducido un valor válido de Nota *</span>";
                    echo "</td>";
                    echo "<td><button class='enlace' name='btnCambiar' value='".$tupla["cod_asig"]."'>Cambiar</button> - <button class='enlace'>Atrás</button></td>";
                    echo "</form>";
                }
                else
                {
                    echo "<td>".$tupla["nota"]."</td>";
                    echo "<td><form action='index.php' method='post'><input type='hidden' name='alumno' value='".$_POST["alumno"]."'><button class='enlace' name='btnEditar' value='".$tupla["cod_asig"]."'>Editar</button> - <button name='btnBorrar' class='enlace' value='".$tupla["cod_asig"]."'>Borrar</button></form></td>";
                }
                
                echo "</tr>";
            }
            echo "</table>";

            mysqli_free_result($resultado_notas_alumno);

            if(isset($mensaje_accion))
            {
                echo "<p class='mensaje'>".$mensaje_accion."</p>";
            }

            //Aquí va un nuevo formulario o la frase de que el alumno ya tiene todo calificado
            if(mysqli_num_rows($resultado_asigs_noeval_alumno)>0)
            {
            ?>
                <form action="index.php" method="post">
                    <p>
                        <label for="asignatura">Asignaturas que a <strong><?php echo $nombre_alumno_selec;?></strong> aún le quedan por calificar:</label>
                        <select name="asignatura" id="asignatura">
                        <?php
                        while($tupla=mysqli_fetch_assoc($resultado_asigs_noeval_alumno))
                        {
                            echo "<option value='".$tupla["cod_asig"]."'>".$tupla["denominacion"]."</option>";
                        }
                        ?>
                        </select>
                        <input type="hidden" name="alumno" value="<?php echo $_POST["alumno"];?>">
                        <button type="submit" name="btnCalificar">Calificar</button>
                    </p>
                </form>

            <?php
                mysqli_free_result($resultado_asigs_noeval_alumno);
            }
            else
            {
                echo "<p>A <strong>".$nombre_alumno_selec."</strong> no le quedan asignaturas por calificar.</p>";
            }

        }
            

    }
    else
        echo "<p>En estos momentos no tenemos nungún alumno registrado en la BD</p>";
    ?>
</body>
</html>