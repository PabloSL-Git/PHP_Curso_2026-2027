<?php
echo "<h2>Detalles del dispositivo con id: ".$_POST["btnDetalles"]."</h2>";
if($tupla=mysqli_fetch_assoc($resultado_detalles_dispositivo))
{
    echo "<p><strong>ID: </strong>".$tupla["id_dispositivo"]."</p>";
    echo "<p><strong>Machine ID: </strong>".$tupla["machine_id"]."</p>";
    echo "<p><strong>Descripción: </strong>".$tupla["descripcion"]."</p>";
    echo "<p><strong>Recurso aula: </strong>".$tupla["recurso_aula"]."</p>";
}
else
{
    echo "<p>El dispositivo ya no se encuentra en la BD</p>";
}

mysqli_free_result($resultado_detalles_dispositivo);

echo "<form action='index.php' method='post'><button>Atrás</button></form>";
?>