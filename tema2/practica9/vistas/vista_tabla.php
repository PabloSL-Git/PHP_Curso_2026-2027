<h3>Listado de los dispositivos</h3>
<table>
    <tr>
        <th>Id</th>
        <th>Machine</th>
        <th><form action="index.php" method="post"><button class="enlace" name="btnNuevo">Dispositivos+</button></form></th>
    </tr>
    <?php
    while($tupla=mysqli_fetch_assoc($resultado_dispositivos))
    {
        echo "<tr>";
        echo "<td>".$tupla["id_dispositivo"]."</td>";
        echo "<td><form action='index.php' method='post'><button title='Ver detalles' class='enlace' name='btnDetalles' value='".$tupla["id_dispositivo"]."'>".$tupla["machine_id"]."</button></form></td>";
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnBorrar' value='".$tupla["id_dispositivo"]."'>Borrar</button> - <button class='enlace' name='btnEditar' value='".$tupla["id_dispositivo"]."'>Editar</button></form></td>";
        echo "</tr>";
    }

    mysqli_free_result($resultado_dispositivos);
    ?>
</table>