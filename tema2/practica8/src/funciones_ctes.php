<?php
    Const SERVIDOR_BD="localhost";
    Const USUARIO_BD="jose";
    Const CLAVE_BD="josefa";
    Const NOMBRE_BD="bd_cv";

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

    function tiene_extension($name)
    {
        $extension=false;
        $array=explode(".", $name);
        if(count($array)>1)
            $extension=end($array);

        return $extension;
    }

    function mi_getimagesize($info_foto)
    {
        $respuesta=false;
        if($info_foto["size"]>0)
            $respuesta=getimagesize($info_foto["tmp_name"]);

        return $respuesta;
    }

    function LetraNIF ($numero) {
        return substr("TRWAGMYFPDXBNJZSQVHLCKE", $numero % 23, 1); 
    }

    function dni_bien_escrito($texto)
    {
        $dni=strtoupper($texto);
        return strlen($dni)==9 && is_numeric(substr($dni,0,8)) && substr($dni,-1)>="A" && substr($dni,-1)<="Z";
    }

    function dni_valido($texto)
    {
        $dni=strtoupper($texto);
        return LetraNIF(substr($dni,0,8))==substr($dni,-1);
    }

    function repetido($conexion,$tabla,$columna, $valor)
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
?>