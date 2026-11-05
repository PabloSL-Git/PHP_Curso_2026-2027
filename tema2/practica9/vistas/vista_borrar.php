<?php
echo "<h2>Borrado del dispositivo con id: ".$_POST["btnBorrar"]."</h2>";
//Se intenta coger la fila del dispositivo que se quiere borrar
if($tupla=mysqli_fetch_assoc($resultado_detalles_dispositivo))
{
    //Se pide confirmación. Continuar envía btnContBorrar con el id como valor
    echo "<form action='index.php' method='post'>";
    echo "<p>¿ Estás seguro de que quieres borrar el Recurso/Aula: <strong>".$tupla["machine_id"]."</strong> ?</p>";
    echo "<p><button name='btnContBorrar' value='".$_POST["btnBorrar"]."'>Continuar</button> <button>Cancelar</button></p>";
    echo "</form>";
}
else
{
    //Si no hay fila, el dispositivo se borró desde que se cargó la tabla
    echo "<p>El dispositivo ya no se encuentra en la BD</p>";
    echo "<form action='index.php' method='post'><button>Atrás</button></form>";
}

mysqli_free_result($resultado_detalles_dispositivo);
?>