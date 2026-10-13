<?php
if(isset($_POST["btnReset"]))
{
    unset($_POST);
}


if(isset($_POST["btnEnviar"]))
{
    //cuando se hace submit compruebo errores formulario
    
    $error_nombre=$_POST["nombre"]=="";
    $error_apellidos=$_POST["apellidos"]=="";
    $error_clave=$_POST["clave"]=="";
    $error_dni=strlen($_POST["dni"])!=9;
    $error_sexo=!isset($_POST["sexo"]);
    $error_comentarios=$_POST["comentarios"]=="";
  

    $error_formulario=$error_nombre || $error_apellidos || $error_clave || $error_dni || $error_sexo || $error_comentarios ;
}

if(isset($_POST["btnEnviar"]) && !$error_formulario)
{
    //Por aquí muestro una nueva de recogida de datos
    require "vistas/vista_recogida.php";
}
else
{
    require "vistas/vista_formulario.php";
}
?>
