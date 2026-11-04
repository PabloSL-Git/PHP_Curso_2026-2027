<?php
//Se cargan las constantes de conexión y las funciones auxiliares
require "src/funciones_ctes.php";

//Se intenta conectar con la BD. Si falla, se muestra una página de error y se termina
try
{
    @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
    mysqli_set_charset($conexion,"utf8");
}
catch(Exception $e)
{
    die(error_page("Práctica 9","<h1>Práctica 9</h1><p>Error al intentar conectarse a la BD: ".$e->getMessage()."</p>"));
}


//---------- INSERTAR: se entra aquí al pulsar "Guardar Cambios" en el formulario de nuevo dispositivo ----------
if(isset($_POST["btnContNuevo"]))
{
    //Se comprueba que el machine_id no esté vacío
    $error_machine=$_POST["machine_id"]=="";
    if(!$error_machine)
    {
        //Si no está vacío, se comprueba que no exista ya en la tabla
        $error_machine=repetido_insert($conexion,"dispositivos_1","machine_id",$_POST["machine_id"]);
        //Si la función devuelve un texto, es que ha fallado la consulta
        if(is_string($error_machine))
        {
            mysqli_close($conexion);
            die(error_page("Práctica 9","<h1>Práctica 9</h1><p>Error al intentar realizar la consulta: ".$error_machine."</p>"));
        }
    }

    //Solo hay un campo obligatorio, así que el error del formulario es el error del machine_id
    $error_form=$error_machine;

    //Si no hay errores, se inserta el dispositivo
    if(!$error_form)
    {
        try
        {
            //Si no se rellena el recurso del aula, no se incluye en el insert y queda en NULL
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

        //Mensaje que se mostrará encima de la tabla
        $mensaje_accion="Dispositivo creado correctamente";
    }
}


//---------- EDITAR: se entra aquí al pulsar "Guardar Cambios" en el formulario de editar ----------
if(isset($_POST["btnContEditar"]))
{
    //Se comprueba que el machine_id no esté vacío
    $error_machine=$_POST["machine_id"]=="";
    if(!$error_machine)
    {
        //Se comprueba que no lo tenga otro dispositivo distinto del que se edita
        $error_machine=repetido_edit($conexion,"dispositivos_1","machine_id",$_POST["machine_id"],"id_dispositivo",$_POST["btnContEditar"]);
        if(is_string($error_machine))
        {
            mysqli_close($conexion);
            die(error_page("Práctica 9","<h1>Práctica 9</h1><p>Error al intentar realizar la consulta: ".$error_machine."</p>"));
        }
    }

    $error_form=$error_machine;

    //Si no hay errores, se actualiza el dispositivo
    if(!$error_form)
    {
        try
        {
            //Si el recurso del aula viene vacío, se guarda NULL; si no, se guarda su valor
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


//---------- DETALLES y EDITAR (primera vez): se necesitan los datos de un dispositivo concreto ----------
if(isset($_POST["btnDetalles"]) || isset($_POST["btnEditar"]))
{
    //Se obtiene el id del dispositivo según el botón que se haya pulsado
    if(isset($_POST["btnDetalles"]))
        $id_dispositivo=$_POST["btnDetalles"];
    else
        $id_dispositivo=$_POST["btnEditar"];

    //Se consultan sus datos. El resultado se recorrerá en la vista correspondiente
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


//---------- TABLA PRINCIPAL: esta consulta se hace siempre ----------
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

//Ya no hacen falta más consultas, se cierra la conexión
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
        /* Hace que los botones parezcan enlaces */
        .enlace{border:none; background:none;color:blue;text-decoration:underline;cursor:pointer}
        .error{color:red}
        .mensaje{color:blue;font-size: 1.5rem;}
    </style>
</head>
<body>
    <h1>Práctica 9</h1>
    <?php
    //Si se ha hecho alguna acción (insertar, editar), se muestra su mensaje
    if(isset($mensaje_accion))
    {
        echo "<p class='mensaje'>".$mensaje_accion."</p>";
    }

    //Se pulsó el machine_id de un dispositivo: se muestran sus detalles
    if(isset($_POST["btnDetalles"]))
    {
        require "vistas/vista_detalles.php";
    }

    //Se pulsó "Dispositivos+", o se envió el formulario de nuevo con errores: se muestra el formulario
    if(isset($_POST["btnNuevo"]) || (isset($_POST["btnContNuevo"]) && $error_form))
    {
        require "vistas/vista_insertar.php";
    }

    //Se pulsó "Editar", o se envió el formulario de editar con errores: se muestra el formulario
    if(isset($_POST["btnEditar"]) || (isset($_POST["btnContEditar"]) && $error_form))
    {
        require "vistas/vista_editar.php";
    }

    //La tabla principal se muestra siempre
    require "vistas/vista_tabla.php";
    ?>
</body>
</html>