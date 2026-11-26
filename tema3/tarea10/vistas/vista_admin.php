<?php

if(isset($_POST["btnContBorrarFoto"]))
{
    try
    {
        $consulta="update usuarios set foto='".NOMBRE_NO_IMAGEN_BD."' where id_usuario='".$_POST["btnContBorrarFoto"]."'";
        mysqli_query($conexion,$consulta);
    }
    catch(Exception $e)
    {
        session_destroy();
         mysqli_close($conexion);
        die(error_page("Práctica 10","<h1>Práctica 10</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
    }
    if(file_exists("Img/".$_POST["foto"]))
        unlink("Img/".$_POST["foto"]);
    
    $_SESSION["mensaje_accion"]="¡¡ Foto de perfil borrada con éxito !!";
    header("Location:index.php");
    exit;
}


if(isset($_POST["btnContBorrar"]))
{
    try
    {
        $consulta="delete from usuarios where id_usuario='".$_POST["btnContBorrar"]."'";
        mysqli_query($conexion,$consulta);
    }
    catch(Exception $e)
    {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Práctica 10","<h1>Práctica 10</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
    }

    if($_POST["foto"]!=NOMBRE_NO_IMAGEN_BD && file_exists("Img/".$_POST["foto"]) )
    {
        unlink("Img/".$_POST["foto"]);
    }

    $_SESSION["mensaje_accion"]="¡¡ Usuario borrado correctamente!!";
    header("Location:index.php");
    exit;
}


if(isset($_POST["btnContEditar"]))
{
    $error_nombre=$_POST["nombre"]=="";
    $error_usuario=$_POST["usuario"]=="";
    if(!$error_usuario)
    {
        $error_usuario=repetido_edit($conexion,"usuarios","usuario",$_POST["usuario"],"id_usuario",$_POST["btnContEditar"]);
        if(is_string($error_usuario))
        {
            session_destroy();
            mysqli_close($conexion);
            die(error_page("Práctica 10","<h1>Práctica 10</h1><p>Error al intentar realizar la consulta: ".$error_usuario."</p>"));
        }
    }
    $error_dni=!dni_bien_escrito($_POST["dni"]) || !dni_valido($_POST["dni"]);
    if(!$error_dni)
    {
        $error_dni=repetido_edit($conexion,"usuarios","dni",strtoupper($_POST["dni"]),"id_usuario",$_POST["btnContEditar"]);
        if(is_string($error_dni))
        {
            session_destroy();
             mysqli_close($conexion);
            die(error_page("Práctica 10","<h1>Práctica 10</h1><p>Error al intentar realizar la consulta: ".$error_dni."</p>"));
        }
    }
    $error_foto= $_FILES["foto"]["name"]==!"" && ( $_FILES["foto"]["error"] || $_FILES["foto"]["size"] >500*1024 || !tiene_extension($_FILES["foto"]["name"]) || !mi_getimagesize($_FILES["foto"]));

    $error_form=$error_nombre || $error_usuario  || $error_dni  || $error_foto;

    if(!$error_form)
    {
        //Actualizar usuario
        //Puedo hacer dos tipos de consultas: Una si hay clave nueva y otra si no hay clave
        try
        {
            if($_POST["clave"]=="")
            {
                $consulta="update usuarios set nombre='".$_POST["nombre"]."', usuario='".$_POST["usuario"]."', dni='".strtoupper($_POST["dni"])."', sexo='".$_POST["sexo"]."' where id_usuario='".$_POST["btnContEditar"]."'";
            }
            else
            {
                $consulta="update usuarios set nombre='".$_POST["nombre"]."', usuario='".$_POST["usuario"]."', clave='".md5($_POST["clave"])."', dni='".strtoupper($_POST["dni"])."', sexo='".$_POST["sexo"]."' where id_usuario='".$_POST["btnContEditar"]."'";
            }

            mysqli_query($conexion,$consulta);

        }
        catch(Exception $e)
        {
            session_destroy();
            mysqli_close($conexion);
            die(error_page("Práctica 10","<h1>Práctica 10</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
        }

        $_SESSION["mensaje_accion"]="Usuario editado con éxito";

        if($_FILES["foto"]["name"]!="")
        {
            $array_nombre=explode(".",$_FILES["foto"]["name"]);
            $ext=".".end($array_nombre);
            $nombre_nuevo="img_".$_POST["btnContEditar"].$ext;
            @$var=move_uploaded_file($_FILES["foto"]["tmp_name"],"Img/".$nombre_nuevo);
            if($var)
            {
                if($nombre_nuevo!=$_POST["foto_en_bd"])
                {
                    try
                    {
                        $consulta="update usuarios set foto='".$nombre_nuevo."' where id_usuario='".$_POST["btnContEditar"]."'";
                        mysqli_query($conexion,$consulta);
                        if($_POST["foto_en_bd"]!=NOMBRE_NO_IMAGEN_BD && file_exists("Img/".$_POST["foto_en_bd"]))
                            unlink("Img/".$_POST["foto_en_bd"]);
                    }
                    catch(Exception $e)
                    {
                        if(file_exists("Img/".$nombre_nuevo))
                             unlink("Img/".$nombre_nuevo);

                        $_SESSION["mensaje_accion"]="¡¡ Usuario editado correctamente, pero con la imagen por defecto por problemas con la BD !!";
                    }
                }
            }
            else
            {
                $_SESSION["mensaje_accion"]="¡¡ Usuario editado correctamente, pero con la imagen por defecto: No se ha podido mover imagen a la carpeta destino !!";
            }
        }
        header("Location:index.php");
        exit;
    }
}

if(isset($_POST["btnContNuevo"]))
{
    $error_nombre=$_POST["nombre"]=="";
    $error_usuario=$_POST["usuario"]=="";
    if(!$error_usuario)
    {
        $error_usuario=repetido_insert($conexion,"usuarios","usuario",$_POST["usuario"]);
        if(is_string($error_usuario))
        {
            session_destroy();
            mysqli_close($conexion);
            die(error_page("Práctica 10","<h1>Práctica 10</h1><p>Error al intentar realizar la consulta: ".$error_usuario."</p>"));
        }
    }

    $error_clave=$_POST["clave"]=="";
    $error_dni=!dni_bien_escrito($_POST["dni"]) || !dni_valido($_POST["dni"]);
    if(!$error_dni)
    {
        $error_dni=repetido_insert($conexion,"usuarios","dni",strtoupper($_POST["dni"]));
        if(is_string($error_dni))
        {
            session_destroy();
            mysqli_close($conexion);
            die(error_page("Práctica 10","<h1>Práctica 10</h1><p>Error al intentar realizar la consulta: ".$error_dni."</p>"));
        }
    }

    $error_sexo=!isset($_POST["sexo"]);

    $error_foto= $_FILES["foto"]["name"]==!"" && ( $_FILES["foto"]["error"] || $_FILES["foto"]["size"] >500*1024 || !tiene_extension($_FILES["foto"]["name"]) || !mi_getimagesize($_FILES["foto"]));

    $error_form=$error_nombre || $error_usuario || $error_clave || $error_dni || $error_sexo || $error_foto;


    if(!$error_form)
    {
        //Insertaría en la BD un nuevo usuario

        try
        {
            $consulta="insert into usuarios (nombre, usuario, clave, dni, sexo) values('".$_POST["nombre"]."','".$_POST["usuario"]."','".md5($_POST["clave"])."','".strtoupper($_POST["dni"])."','".$_POST["sexo"]."')";
            mysqli_query($conexion,$consulta);
        }
        catch(Exception $e)
        {
            session_destroy();
            mysqli_close($conexion);
            die(error_page("Práctica 10","<h1>Práctica 10</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
        }

        $_SESSION["mensaje_accion"]="¡¡ Usuario creado correctamente!!";

        //Si has subido foto tengo que moverla a Img y actualizar base de datos
        //  $ultm_id=mysqli_insert_id($conexion);

        if($_FILES["foto"]["name"]!="")
        {
            $ultm_id=mysqli_insert_id($conexion);
            $array_nombre=explode(".",$_FILES["foto"]["name"]);
            $ext=".".end($array_nombre);
            $nombre_nuevo="img_".$ultm_id.$ext;
            @$var=move_uploaded_file($_FILES["foto"]["tmp_name"],"Img/".$nombre_nuevo);
            if($var)
            {
                try
                {
                    $consulta="update usuarios set foto='".$nombre_nuevo."' where id_usuario='".$ultm_id."'";
                    mysqli_query($conexion,$consulta);
                }
                catch(Exception $e)
                {
                    if(file_exists("Img/".$nombre_nuevo))
                    {
                        unlink("Img/".$nombre_nuevo);
                    }
                    $_SESSION["mensaje_accion"]="¡¡ Usuario creado correctamente, pero con la imagen por defecto por problemas con la BD !!";
                }
            }
            else
            {
                $_SESSION["mensaje_accion"]="¡¡ Usuario creado correctamente, pero con la imagen por defecto: No se ha podido mover imagen a la carpeta destino !!";
            }
        }

        header("Location:index.php");
        exit;

    }



}


if(isset($_POST["btnDetalles"]) || isset($_POST["btnBorrar"]) || isset($_POST["btnEditar"]) || isset($_POST["btnBorrarFoto"]))
{
    if(isset($_POST["btnDetalles"]))
        $id_usuario=$_POST["btnDetalles"];
    elseif(isset($_POST["btnBorrar"]))
        $id_usuario=$_POST["btnBorrar"];
    elseif(isset($_POST["btnEditar"]))
        $id_usuario=$_POST["btnEditar"];
    else
        $id_usuario=$_POST["btnBorrarFoto"];

    try
    {
        $consulta="select * from usuarios where id_usuario='".$id_usuario."'";
        $resultado_detalles_usuario=mysqli_query($conexion, $consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die(error_page("Práctica 10","<h1>Práctica 10</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
    }


}



// Consulta para mostrar tabla principal
// Se hace siempre
try
{
    $consulta="select * from usuarios where tipo='normal'";
    $resultado_usuarios=mysqli_query($conexion, $consulta);
}
catch(Exception $e)
{
    session_destroy();
    mysqli_close($conexion);
    die(error_page("Práctica 10","<h1>Práctica 10</h1><p>Error al intentar realizar la consulta: ".$e->getMessage()."</p>"));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 10</title>
    <style>
        table, td, th{border:1px solid black}
        table{border-collapse:collapse; width:90%; margin:0 auto;text-align:center}
        th{background-color:#CCC}
        img{height:100px}
        .enlace{border:none; background:none;color:blue;text-decoration:underline;cursor:pointer}
        .error{color:red}
        .mensaje{color:blue;font-size: 1.5rem;}
        button img {border:none; cursor:pointer}
    </style>
       
</head>
<body>
    <h1>Práctica 10</h1>
    <form action="index.php" method="post">
        <p>Bienvenido <strong><?php echo $datos_usu_log["nombre"];?></strong> - <button type="submit" class='enlace' name="btnCerrarSesion">Salir</button></p>
    </form>
    <?php
    if(isset($_SESSION["mensaje_accion"]))
    {
        echo "<p class='mensaje'>".$_SESSION["mensaje_accion"]."</p>";
        unset($_SESSION["mensaje_accion"]);
    }

    if(isset($_POST["btnBorrarFoto"]))
    {
        require "vistas/vista_confirmar_borrar_foto.php";
    }

     if(isset($_POST["btnNuevo"]) || (isset($_POST["btnContNuevo"]) && $error_form))
    {
        //Aquí formulario Nuevo Usuario
        require "vistas/vista_formulario_insertar.php";
    }

    if(isset($_POST["btnDetalles"]))
    {
        require "vistas/vista_detalles.php";
    }

    if(isset($_POST["btnEditar"]) || (isset($_POST["btnContEditar"]) && $error_form))
    {

        require "vistas/vista_formulario_editar.php";

    }

    if(isset($_POST["btnBorrar"]))
    {
        require "vistas/vista_confirmar_borrar.php";

    }

    require "vistas/vista_tabla_principal.php";

    ?>

</body>
</html>