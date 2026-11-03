<?php
echo "<h2>Borrado del usuario con id: ".$_POST["btnBorrar"]."</h2>";
if($tupla=mysqli_fetch_assoc($resultado))
{
    echo "<form action='index.php' method='post'>";
    echo "<p>¿ Estás seguro de que quieres borrar al usuario <strong>".$tupla["nombre"]."</strong> ?</p>";
    echo "<p><button name='btnContBorrar' value='".$_POST["btnBorrar"]."'>Continuar</button> <button>Cancelar</button></p>";
    echo "<input type='hidden' name='foto' value='".$tupla["foto"]."'>";
    echo "</form>";  
}
else
{
    echo "<p>El usuario ya no se encuentra en la BD</p>";
    echo "<form action='index.php' method='post'><button>Atrás</button></form>";
}

mysqli_free_result($resultado);
?>