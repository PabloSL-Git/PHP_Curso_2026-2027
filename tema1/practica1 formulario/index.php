<?php
$nombre = "";
$ciudad = "Malaga";
$sexo = "";
$aficiones = array();
$comentarios = "";

$error_nombre = false;
$error_sexo = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $ciudad = $_POST["ciudad"];
    if (isset($_POST["sexo"])) {
        $sexo = $_POST["sexo"];
    }
    if (isset($_POST["aficiones"])) {
        $aficiones = $_POST["aficiones"];
    }
    $comentarios = $_POST["comentarios"];

    $error_nombre = ($nombre == "");
    $error_sexo = ($sexo == "");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !$error_nombre && !$error_sexo) {
    require "vistas/vista_recogida.php";
} else {
    require "vistas/vista_formulario.php";
}