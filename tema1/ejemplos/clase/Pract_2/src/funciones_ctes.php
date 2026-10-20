<?php
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
?>