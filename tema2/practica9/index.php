<?php
require "src/funciones_ctes.php";

try
{
    @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
    mysqli_set_charset($conexion,"utf8");
}
catch(Exception $e)
{
    die(error_page("Práctica 9","<h1>Práctica 9</h1><p>Error al intentar conectarse a la BD: ".$e->getMessage()."</p>"));
}


if(isset($_POST["btnContNuevo"]))
{
    $error_machine=$_POST["machine_id"]=="";
    if(!$error_machine)
    {
        $error_machine=repetido_insert($conexion,"dispositivos_1","machine_id",$_POST["machine_id"]);
        if(is_string($error_machine))
        {
            mysqli_close($conexion);
            die(error_page("Práctica 9","<h1>Práctica 9</h1><p>Error al intentar realizar la consulta: ".$error_machine."</p>"));
        }
    }

    $error_form=$error_machine;

    if(!$error_form)
    {
        try
        {
            if($_POST["recurso_aula"]=="")
                $consulta="insert into dispositivos_1 (machine_id, descripcion) values('".$_POST["machine_id"]."','".$_POST["descripcion"]."')";
            else
                $consulta="insert into dispositivos_1 (machine_id, descripcion, recurso_aula) values('".$_POST["machine_id"]."','".$_POST["descripcion"]."','".$_POST["recurso_aula"]."')";

            mysqli_query($conexion,$consulta);
        }
        catch(Exception $e)
        {
            mysqli_close($conexion);
            die(error_page("Práctica 9","<h1>Práctica 9</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
        }

        $mensaje_accion="¡¡ Dispositivo creado correctamente !!";
    }
}


if(isset($_POST["btnContEditar"]))
{
    $error_machine=$_POST["machine_id"]=="";
    if(!$error_machine)
    {
        $error_machine=repetido_edit($conexion,"dispositivos_1","machine_id",$_POST["machine_id"],"id_dispositivo",$_POST["btnContEditar"]);
        if(is_string($error_machine))
        {
            mysqli_close($conexion);
            die(error_page("Práctica 9","<h1>Práctica 9</h1><p>Error al intentar realizar la consulta: ".$error_machine."</p>"));
        }
    }

    $error_form=$error_machine;

    if(!$error_form)
    {
        try
        {
            if($_POST["recurso_aula"]=="")
                $consulta="update dispositivos_1 set machine_id='".$_POST["machine_id"]."', descripcion='".$_POST["descripcion"]."', recurso_aula=NULL where id_dispositivo='".$_POST["btnContEditar"]."'";
            else
                $consulta="update dispositivos_1 set machine_id='".$_POST["machine_id"]."', descripcion='".$_POST["descripcion"]."', recurso_aula='".$_POST["recurso_aula"]."' where id_dispositivo='".$_POST["btnContEditar"]."'";

            mysqli_query($conexion,$consulta);
        }
        catch(Exception $e)
        {
            mysqli_close($conexion);
            die(error_page("Práctica 9","<h1>Práctica 9</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
        }

        $mensaje_accion="Dispositivo editado con éxito";
    }
}


if(isset($_POST["btnDetalles"]) || isset($_POST["btnEditar"]))
{
    if(isset($_POST["btnDetalles"]))
        $id_dispositivo=$_POST["btnDetalles"];
    else
        $id_dispositivo=$_POST["btnEditar"];

    try
    {
        $consulta="select * from dispositivos_1 where id_dispositivo='".$id_dispositivo."'";
        $resultado_detalles_dispositivo=mysqli_query($conexion, $consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die(error_page("Práctica 9","<h1>Práctica 9</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
    }
}


// Consulta para mostrar tabla principal

try
{
    $consulta="select * from dispositivos_1";
    $resultado_dispositivos=mysqli_query($conexion, $consulta);
}
catch(Exception $e)
{
    mysqli_close($conexion);
    die(error_page("Práctica 9","<h1>Práctica 9</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
}

mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 9</title>
    <style>
        table, td, th{border:1px solid black}
        table{border-collapse:collapse; width:90%; margin:0 auto;text-align:center}
        th{background-color:#CCC}
        .enlace{border:none; background:none;color:blue;text-decoration:underline;cursor:pointer}
        .error{color:red}
        .mensaje{color:blue;font-size: 1.5rem;}
    </style>
</head>
<body>
    <h1>Práctica 9</h1>
    <?php
    if(isset($mensaje_accion))
    {
        echo "<p class='mensaje'>".$mensaje_accion."</p>";
    }

    if(isset($_POST["btnDetalles"]))
    {
        require "vistas/vista_detalles.php";
    }

    if(isset($_POST["btnNuevo"]) || (isset($_POST["btnContNuevo"]) && $error_form))
    {
        require "vistas/vista_insertar.php";
    }

    if(isset($_POST["btnEditar"]) || (isset($_POST["btnContEditar"]) && $error_form))
    {
        require "vistas/vista_editar.php";
    }

    require "vistas/vista_tabla_principal.php";
    ?>
</body>
</html>