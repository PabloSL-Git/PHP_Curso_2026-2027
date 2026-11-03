<?php

echo "<h2>Detalles del usuario con id:" . $_POST["btnDetalles"] . "</h2>";

if($tupla = mysqli_fetch_assoc($resultado)){

    echo "<p><strong>Nombre: </strong>" . $tupla["nombre"] . "</p>";
    echo "<p><strong>Usuario: </strong>" . $tupla["usuario"] . "</p>";
    echo "<p><strong>Clave: </strong>********</p>";
    echo "<p><strong>DNI: </strong>" . $tupla["dni"] . "</p>";
    echo "<p><strong>Sexo: </strong>" . $tupla["sexo"] . "</p>";
    echo "<p><img src='img/" . $tupla["foto"] . "' alt='Foto perfil' title='Foto perfil' width='100'></p>";

}
else
{
    echo "<p>El usuario ya no se encuentra en la BD</p>";
}

mysqli_free_result($resultado);

echo "<form action='index.php' method='post'><button>Atrás</button></form>";

?>