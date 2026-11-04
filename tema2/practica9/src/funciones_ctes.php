<?php
const SERVIDOR_BD="localhost";
const USUARIO_BD="jose";
const CLAVE_BD="josefa";
const NOMBRE_BD="bd_espacios_digitales";

function error_page($title, $body)
{
    return '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'.$title.'</title>
</head>
<body>'.$body.'
    
</body>
</html>';
}

function repetido_insert($conexion,$tabla,$columna, $valor)
{
    try
    {
        $consulta="select ".$columna." from ".$tabla." where ".$columna."='".$valor."'";
        $resultado=mysqli_query($conexion,$consulta);
        $repetido=mysqli_num_rows($resultado)>0;
        mysqli_free_result($resultado);
    }
    catch(Exception $e)
    {
        $repetido=$e->getMessage();
    }

    return $repetido;
}

function repetido_edit($conexion,$tabla,$columna, $valor,$columna_clave, $valor_clave)
{
    try
    {
        $consulta="select ".$columna." from ".$tabla." where ".$columna."='".$valor."' AND ".$columna_clave."<>'".$valor_clave."'";
        $resultado=mysqli_query($conexion,$consulta);
        $repetido=mysqli_num_rows($resultado)>0;
        mysqli_free_result($resultado);
    }
    catch(Exception $e)
    {
        $repetido=$e->getMessage();
    }

    return $repetido;
}
?>