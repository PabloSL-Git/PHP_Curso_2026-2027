<?php
//Comienzo con el control del baneo
try
    {
        @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
        mysqli_set_charset($conexion,"utf8");
    }
    catch(Exception $e)
    {
        session_destroy();
        die(error_page("Primer Login","<h1>Primer Login</h1><p>Error al conectarse a la BD: ".$e->getMessage()."</p>"));
    }

    try
    {
        $consulta="select * from usuarios where usuario='".$_SESSION["usuario"]."' and clave='".$_SESSION["clave"]."'";
        $resultado_baneo=mysqli_query($conexion,$consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        session_destroy();
        die(error_page("Primer Login","<h1>Primer Login</h1><p>Error al hacer la consulta: ".$e->getMessage()."</p>"));
    }


    $datos_usu_log=mysqli_fetch_assoc($resultado_baneo);
    mysqli_free_result($resultado_baneo);
    if(!$datos_usu_log)
    {
        session_unset();
        $_SESSION["seguridad"]="¡¡ Usted ya no se encuentra registrado en la BD !!";
        mysqli_close($conexion);
        header("Location:index.php");
        exit;
    }

    //He pasado el control de baneo y me toca el del tiempo de sesión

    if(time() - $_SESSION["ultima_accion"]> 60 * TIEMPO_SESION)
    {
        session_unset();
        $_SESSION["seguridad"]="¡¡ Su tiempo de sesión ha expirado. Por favor vuelva a loguearse !!";
        mysqli_close($conexion);
        header("Location:index.php");
        exit;
    }

    $_SESSION["ultima_accion"]=time();
?>