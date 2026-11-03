<?php
require "src/funciones_ctes.php";

# Edición de un dispositivo
if(isset($_POST["btnContEditar"]))
{
    $error_machine=$_POST["machine_id"]=="";
    if(!$error_machine)
    {
        $error_machine=repetido_edit($conexion,"dispositivos_1","machine_id",$_POST["machine_id"],"id_dispositivo",$_POST["btnContEditar"]);
        if(is_string($error_machine))
        {
            mysqli_close($conexion);
            die(error_page("Práctica 9","<p>Error no se ha podido hacer la consulta: ".$error_machine."</p>"));
        }
    }

    $error_form=$error_machine;

    if(!$error_form)
    {
        if($_POST["recurso_aula"]=="")
            $recurso="NULL";
        else
            $recurso="'".$_POST["recurso_aula"]."'";

        try
        {
            $consulta="UPDATE dispositivos_1 SET machine_id='".$_POST["machine_id"]."', descripcion='".$_POST["descripcion"]."', recurso_aula=".$recurso." where id_dispositivo='".$_POST["btnContEditar"]."'";
            mysqli_query($conexion,$consulta);
        }
        catch(Exception $e)
        {
            mysqli_close($conexion);
            die(error_page("Práctica 9","<p>Error no se ha podido hacer la consulta: ".$e->getMessage()."</p>"));
        }

        $mensaje_accion="Dispositivo editado con éxito";
    }
}
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
if(isset($_POST["btnEditar"]))
{
    try {
        $consulta = "SELECT * FROM dispositivos_1 WHERE id_dispositivo='" . $_POST["btnEditar"] . "'";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Práctica 9", "<p>Error no se ha podido hacer la consulta: " . $e->getMessage() . "</p>"));
    }

    require "vistas/vista_editar.php";
}
?>

<?php
if(isset($mensaje_accion))
    
{
    echo "<p>".$mensaje_accion."</p>";
}
?>

<?php

    try {

        $resultado = mysqli_query($conexion, "SELECT * FROM dispositivos_1");
    } catch (Exception $e) {
        mysqli_close($conexion);
        die("<p>Error no se ha podido hacer la consulta: " . $e->getMessage() . "</p></body></html>");
    }

    echo "<table border='1'>";

    echo "<tr>
            <th>Id</th>
            <th>Machine</th>
            <th><form action='index.php' method='post'><button class='enlace' name='btnNuevo'>Dispositivos+</button></form></th>
        </tr>";

    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . $tupla['id_dispositivo'] . "</td>";
        echo "<td>" . $tupla['machine_id'] . "</td>";
        echo "<td>
                <form action='index.php' method='post'>
                    <button class='enlace' name='btnBorrar' value='" . $tupla['id_dispositivo'] . "'>Borrar</button> -
                    <button class='enlace' name='btnEditar' value='" . $tupla['id_dispositivo'] . "'>Editar</button>
                </form>
            </td>";
        echo "</tr>";
    }

    echo "</table>";

    mysqli_free_result($resultado);
    mysqli_close($conexion);

    ?>

</body>
</html>