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


//---------- BORRAR: se entra aquí al pulsar "Continuar" en la confirmación ----------
if(isset($_POST["btnContBorrar"]))
{
    try
    {
        $consulta="delete from dispositivos_1 where id_dispositivo='".$_POST["btnContBorrar"]."'";
        mysqli_query($conexion,$consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die(error_page("Práctica 9","<h1>Práctica 9</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
    }

    $mensaje_accion="Dispositivo borrado correctamente";
}


//---------- INSERTAR: se entra aquí al pulsar "Guardar cambios" en el formulario de crear ----------
if(isset($_POST["btnContCrear"]))
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
            $consulta="insert into dispositivos_1 (machine_id, descripcion, recurso_aula) values('".$_POST["machine_id"]."','".$_POST["descripcion"]."','".$_POST["recurso_aula"]."')";
            mysqli_query($conexion,$consulta);
        }
        catch(Exception $e)
        {
            mysqli_close($conexion);
            die(error_page("Práctica 9","<h1>Práctica 9</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
        }

        $mensaje_accion=" Dispositivo creado correctamente ";
    }
}


//---------- EDITAR: se entra aquí al pulsar "Guardar cambios" en el formulario de editar ----------
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


//---------- LISTAS DE AULAS Y RECURSOS: hacen falta para el desplegable de crear y de editar ----------
if(isset($_POST["btnCrear"]) || (isset($_POST["btnContCrear"]) && $error_form) || isset($_POST["btnEditar"]) || (isset($_POST["btnContEditar"]) && $error_form))
{
    try
    {
        $consulta="select * from aulas_1";
        $resultado_aulas=mysqli_query($conexion,$consulta);

        $consulta="select * from recursos_1";
        $resultado_recursos=mysqli_query($conexion,$consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die(error_page("Práctica 9","<h1>Práctica 9</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
    }
}


//---------- EDITAR (primera vez): se necesitan los datos del dispositivo ----------
if(isset($_POST["btnEditar"]))
{
    try
    {
        $consulta="select * from dispositivos_1 where id_dispositivo='".$_POST["btnEditar"]."'";
        $resultado_detalles_dispositivo=mysqli_query($conexion, $consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die(error_page("Práctica 9","<h1>Práctica 9</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
    }
}


//---------- DETALLES y BORRAR: se consulta el dispositivo junto con su aula o recurso ----------
if(isset($_POST["btnDetalles"]) || isset($_POST["btnBorrar"]))
{
    //Se obtiene el id del dispositivo según el botón que se haya pulsado
    if(isset($_POST["btnDetalles"]))
        $id_dispositivo=$_POST["btnDetalles"];
    else
        $id_dispositivo=$_POST["btnBorrar"];

    try
    {
        $consulta="SELECT
            d.id_dispositivo,
            d.machine_id,
            d.recurso_aula AS id_recurso_aula,
            a.nombre AS nombre_aula,
            a.reservable AS reservable_aula,
            r.nombre AS nombre_recurso,
            r.lugar AS lugar_recurso,
            CASE
                WHEN a.id_aula IS NOT NULL THEN 'aula'
                ELSE 'recurso'
            END AS tipo
        FROM dispositivos_1 d
        LEFT JOIN aulas_1 a
            ON d.recurso_aula = a.id_aula
        LEFT JOIN recursos_1 r
            ON d.recurso_aula = r.id_recurso
        WHERE d.id_dispositivo = '".$id_dispositivo."'";

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
    //Si se ha hecho alguna acción (crear, editar, borrar), se muestra su mensaje
    if(isset($mensaje_accion))
    {
        echo "<p class='mensaje'>".$mensaje_accion."</p>";
    }

    //Se pulsó el machine_id de un dispositivo: se muestran sus detalles
    if(isset($_POST["btnDetalles"]))
    {
        require "vistas/vista_detalles.php";
    }

    //Se pulsó "Borrar": se pide confirmación
    if(isset($_POST["btnBorrar"]))
    {
        require "vistas/vista_borrar.php";
    }

    //Se pulsó "Dispositivos+", o se envió el formulario de crear con errores: se muestra el formulario
    if(isset($_POST["btnCrear"]) || (isset($_POST["btnContCrear"]) && $error_form))
    {
        require "vistas/vista_insertar.php";
    }

    //Se pulsó "Editar", o se envió el formulario de editar con errores: se muestra el formulario
    if(isset($_POST["btnEditar"]) || (isset($_POST["btnContEditar"]) && $error_form))
    {
        require "vistas/vista_editar.php";
    }

    //La tabla se muestra siempre
    require "vistas/vista_tabla.php";
    ?>
</body>
</html>