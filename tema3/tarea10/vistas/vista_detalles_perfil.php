<?php
echo "<h2>Detalles de mi Perfil</h2>";

echo "<p><strong>Nombre: </strong>".$datos_usu_log["nombre"]."</p>";
echo "<p><strong>Usuario: </strong>".$datos_usu_log["usuario"]."</p>";
echo "<p><strong>Clave: </strong>********</p>";
echo "<p><strong>DNI: </strong>".$datos_usu_log["dni"]."</p>";
echo "<p><strong>Sexo: </strong>".$datos_usu_log["sexo"]."</p>";


if($datos_usu_log["foto"]==NOMBRE_NO_IMAGEN_BD)
    echo "<p><img src='Img/".$datos_usu_log["foto"]."' alt='Foto de perfil' title='Foto de perfil'></p>";
else
    echo "<p><form action='index.php' method='post'><button type='submit' name='btnBorrarFoto' value='".$datos_usu_log["id_usuario"]."'><img src='Img/".$datos_usu_log["foto"]."' alt='Foto de perfil' title='Borrar foto de perfil'></button></form></p>";



echo "<form action='index.php' method='post' ><button name='btnEditar' value='".$datos_usu_log["id_usuario"]."'>Editar Perfil</button></form>";
?>