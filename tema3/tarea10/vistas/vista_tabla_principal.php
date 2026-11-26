<h3>Listado de los usuarios</h3>
<table>
    <tr>
        <th>#</th>
        <th>Foto</th>
        <th>Nombre</th>
        <th><form action="index.php" method="post"><button class="enlace" name="btnNuevo">Usuarios+</button></form></th>
    </tr>
    <?php
    while($tupla=mysqli_fetch_assoc($resultado_usuarios))
    {
        echo "<tr>";
        echo "<td>".$tupla["id_usuario"]."</td>";
        if($tupla["foto"]==NOMBRE_NO_IMAGEN_BD)
            echo "<td><img src='Img/".$tupla["foto"]."' alt='Foto de perfil' title='Foto de perfil'></td>";
        else
            echo "<td><form action='index.php' method='post'><button type='submit' name='btnBorrarFoto' value='".$tupla["id_usuario"]."'><img src='Img/".$tupla["foto"]."' alt='Foto de perfil' title='Borrar foto de perfil'></button></form></td>";
        echo "<td><form action='index.php' method='post'><button title='Ver detalles' class='enlace' name='btnDetalles' value='".$tupla["id_usuario"]."'>".$tupla["nombre"]."</button></form></td>";
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnBorrar' value='".$tupla["id_usuario"]."'>Borrar</button> - <button class='enlace' name='btnEditar' value='".$tupla["id_usuario"]."'>Editar</button></form></td>";
        echo "</tr>";
    }    

    mysqli_free_result($resultado_usuarios);
    ?>
</table>