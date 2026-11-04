<h3>Listado de los dispositivos</h3>
<table>
    <tr>
        <th>Id</th>
        <th>Machine</th>
        <!-- Este botón envía btnNuevo para abrir el formulario de añadir -->
        <th><form action="index.php" method="post"><button class="enlace" name="btnNuevo">Dispositivos+</button></form></th>
    </tr>
    <?php
    //Se recorre el resultado de la consulta: cada vuelta del while es una fila de la tabla
    while($tupla=mysqli_fetch_assoc($resultado_dispositivos))
    {
        echo "<tr>";
        echo "<td>".$tupla["id_dispositivo"]."</td>";
        //El machine_id es un botón que envía btnDetalles con el id del dispositivo como valor
        echo "<td><form action='index.php' method='post'><button title='Ver detalles' class='enlace' name='btnDetalles' value='".$tupla["id_dispositivo"]."'>".$tupla["machine_id"]."</button></form></td>";
        //Botones Borrar y Editar, cada uno con el id del dispositivo como valor
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnBorrar' value='".$tupla["id_dispositivo"]."'>Borrar</button> - <button class='enlace' name='btnEditar' value='".$tupla["id_dispositivo"]."'>Editar</button></form></td>";
        echo "</tr>";
    }

    //Se libera la memoria del resultado
    mysqli_free_result($resultado_dispositivos);
    ?>
</table>