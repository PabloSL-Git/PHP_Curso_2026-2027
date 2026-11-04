<?php
echo "<h2>Detalles del Recurso/Aula con id: ".$_POST["btnDetalles"]."</h2>";
//Se intenta coger la fila del dispositivo
if($tupla=mysqli_fetch_assoc($resultado_detalles_dispositivo))
{
    echo "<p><strong>Machine Id: </strong>".$tupla["machine_id"]."</p>";
    //Según el tipo, se muestran los datos del aula o los del recurso
    if($tupla["tipo"]=="aula")
    {
        echo "<p><strong>Nombre aula: </strong>".$tupla["nombre_aula"]."</p>";
        if($tupla["reservable_aula"])
            echo "<p><strong>Reservable: </strong>Sí</p>";
        else
            echo "<p><strong>Reservable: </strong>No</p>";
    }
    else
    {
        echo "<p><strong>Nombre recurso: </strong>".$tupla["nombre_recurso"]."</p>";
        echo "<p><strong>Lugar: </strong>".$tupla["lugar_recurso"]."</p>";
    }
}
else
{
    //Si no hay fila, el dispositivo se ha borrado desde que se cargó la tabla
    echo "<p>El dispositivo ya no se encuentra en la BD</p>";
}

mysqli_free_result($resultado_detalles_dispositivo);

echo "<form action='index.php' method='post'><button>Atrás</button></form>";
?>