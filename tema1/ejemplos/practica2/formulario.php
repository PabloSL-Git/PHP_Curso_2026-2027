<?php
if(isset($_POST["btnEnviar"])){
    $error_nombre=$_POST["nombre"]=="";
    $error_sexo=!isset($_POST["sexo"]);

    $error_formulario = $error_nombre || $error_sexo;
}

if (isset($_POST["btnEnviar"]) && !$error_formulario) {
    require "vistas/vista_recogida.php";
} else {
    require "vistas/vista_formulario.php";
}
?>