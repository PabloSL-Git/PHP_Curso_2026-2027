<?php
session_name("Primer_Login_26_27");
session_start();

require "src/funciones_ctes.php";

if(isset($_POST["btnCerrarSesion"]))
{
    session_destroy();
    header("Location:index.php");
    exit;
}


if(isset($_SESSION["usuario"]))
{
    //Estás logueado

    //Control de seguridad: baneo y tiempo inactivo

    require "src/seguridad.php";

    if($datos_usu_log["tipo"]=="normal")
        require "vistas/vista_normal.php";
    else
        require "vistas/vista_admin.php";

    mysqli_close($conexion);
}
else
{

    //NO estás logueado
    require "vistas/vista_login.php";
}

?>