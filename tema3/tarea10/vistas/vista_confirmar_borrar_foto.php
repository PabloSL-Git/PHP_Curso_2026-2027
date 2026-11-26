<?php
echo "<h2>Borrado de la foto del usuario con : ".$_POST["btnBorrarFoto"]."</h2>";
if($tupla=mysqli_fetch_assoc($resultado_detalles_usuario))
{

    echo "<form action='index.php' method='post'>";
    echo "<p><img src='Img/".$tupla["foto"]."' title='Foto de perfil' alt='Foto de perfil'></p>";
    echo "<p>¿ Estás seguro de que quieres borrar la foto de perfil del usuario <strong>".$tupla["nombre"]."</strong> ?</p>";
    echo "<p><button name='btnContBorrarFoto' value='".$_POST["btnBorrarFoto"]."'>Continuar</button> <button>Cancelar</button></p>";
    echo "<input type='hidden' name='foto' value='".$tupla["foto"]."'>";
    echo "</form>";  
}
else
{
    echo "<p>El usuario ya no se encuentra en la BD</p>";
    echo "<form action='index.php' method='post'><button>Atrás</button></form>";
}

mysqli_free_result($resultado_detalles_usuario);
?>