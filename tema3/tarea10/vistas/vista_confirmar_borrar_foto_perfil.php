<?php
echo "<h2>Borrado de la foto de su Perfil</h2>";

echo "<form action='index.php' method='post'>";
echo "<p><img src='Img/".$datos_usu_log["foto"]."' title='Foto de perfil' alt='Foto de perfil'></p>";
echo "<p>¿ Estás seguro de que quieres borrar la foto ?</p>";
echo "<p><button name='btnContBorrarFoto' value='".$_POST["btnBorrarFoto"]."'>Continuar</button> <button>Cancelar</button></p>";
echo "<input type='hidden' name='foto' value='".$datos_usu_log["foto"]."'>";
echo "</form>"; 
?>