<?php
//Primera vez que se abre el formulario (se pulsó "Editar")
if(isset($_POST["btnEditar"]))
{
    //Se cogen los datos de la BD
    if($tupla=mysqli_fetch_assoc($resultado_detalles_dispositivo))
    {
        $id_dispositivo=$tupla["id_dispositivo"];
        $machine_id=$tupla["machine_id"];
        $descripcion=$tupla["descripcion"];
        $recurso_aula=$tupla["recurso_aula"];
    }
    else
    {
        //El dispositivo se ha borrado mientras tanto
        $error_existencial=true;
    }

    mysqli_free_result($resultado_detalles_dispositivo);
}
else
{
    //El formulario vuelve por un error: se recogen los datos que había escrito el usuario
    $id_dispositivo=$_POST["btnContEditar"];
    $machine_id=$_POST["machine_id"];
    $descripcion=$_POST["descripcion"];
    $recurso_aula=$_POST["recurso_aula"];
}

//Si el dispositivo ya no existe, solo se muestra un aviso y el botón Atrás
if(isset($error_existencial))
{
    echo "<h2>Editando el dispositivo con ID: ".$_POST["btnEditar"]."</h2>";
    echo "<p>El dispositivo ya no se encuentra en la BD</p>";
    echo "<form action='index.php' method='post'><button>Atrás</button></form>";
}
else
{
//Si existe, se monta el formulario con los datos ya recogidos
?>
<h2>Editando el dispositivo con ID: <?php echo $id_dispositivo;?></h2>
<form action="index.php" method="post">
    <p>
        <label for="machine_id">Machine Id:</label><br>
        <input type="text" id="machine_id" name="machine_id" maxlength="64" value="<?php echo $machine_id;?>">
        <?php
        //Errores del machine_id: solo si se envió el formulario
        if(isset($_POST["btnContEditar"]) && $error_machine)
        {
            if($_POST["machine_id"]=="")
                echo "<span class='error'> * Campo obligatorio *</span>";
            else
                echo "<span class='error'> * Machine ID ya en uso *</span>";
        }
        ?>
    </p>
    <p>
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" maxlength="50"><?php echo $descripcion;?></textarea>
    </p>
    <p>
        <label for="recurso_aula">Lugar: </label>
        <select id="recurso_aula" name="recurso_aula">
            <optgroup label="Aulas">
            <?php
            //Se marca como seleccionada el aula que tiene ahora el dispositivo
            while($tupla=mysqli_fetch_assoc($resultado_aulas))
            {
                if($recurso_aula==$tupla["id_aula"])
                    echo "<option selected value='".$tupla["id_aula"]."'>".$tupla["nombre"]."</option>";
                else
                    echo "<option value='".$tupla["id_aula"]."'>".$tupla["nombre"]."</option>";
            }
            mysqli_free_result($resultado_aulas);
            ?>
            </optgroup>
            <optgroup label="Recursos">
            <?php
            //Lo mismo con los recursos
            while($tupla=mysqli_fetch_assoc($resultado_recursos))
            {
                if($recurso_aula==$tupla["id_recurso"])
                    echo "<option selected value='".$tupla["id_recurso"]."'>".$tupla["nombre"]."</option>";
                else
                    echo "<option value='".$tupla["id_recurso"]."'>".$tupla["nombre"]."</option>";
            }
            mysqli_free_result($resultado_recursos);
            ?>
            </optgroup>
        </select>
    </p>
    <p>
        <!-- El value lleva el id, para que index.php sepa qué dispositivo actualizar -->
        <button type="submit" value="<?php echo $id_dispositivo;?>" name="btnContEditar">Guardar cambios</button>
        <button type="submit">Atrás</button>
    </p>
</form>
<?php
}
?>