<?php

require "src/funciones_ctes.php";





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
    $error_dni=!dni_bien_escrito($_POST["dni"]) || !dni_valido($_POST["dni"]);
    $error_sexo=!isset($_POST["sexo"]);
    $error_comentarios=$_POST["comentarios"]=="";
    $error_foto= $_FILES["foto"]["name"]==!"" && ( $_FILES["foto"]["error"] || $_FILES["foto"]["size"] >500*1024 || !tiene_extension($_FILES["foto"]["name"]) || !mi_getimagesize($_FILES["foto"]));
  

    $error_formulario=$error_nombre || $error_apellidos || $error_clave || $error_dni || $error_sexo || $error_comentarios || $error_foto;
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
