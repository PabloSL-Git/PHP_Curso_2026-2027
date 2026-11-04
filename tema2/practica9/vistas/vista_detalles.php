<?php
echo "<h2>Detalles del dispositivo con id: ".$_POST["btnDetalles"]."</h2>";
//Se intenta coger la fila del dispositivo. Solo puede haber una, por eso basta un if
if($tupla=mysqli_fetch_assoc($resultado_detalles_dispositivo))
{
    //Se muestran todos los campos de la tabla
    echo "<p><strong>ID: </strong>".$tupla["id_dispositivo"]."</p>";
    echo "<p><strong>Machine ID: </strong>".$tupla["machine_id"]."</p>";
    echo "<p><strong>Descripción: </strong>".$tupla["descripcion"]."</p>";
    echo "<p><strong>Recurso aula: </strong>".$tupla["recurso_aula"]."</p>";
}
else
{
    //Si no hay fila, el dispositivo se ha borrado desde que se cargó la tabla
    echo "<p>El dispositivo ya no se encuentra en la BD</p>";
}

mysqli_free_result($resultado_detalles_dispositivo);

//Botón para volver al listado
echo "<form action='index.php' method='post'><button>Atrás</button></form>";
?>