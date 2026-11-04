<?php
if(isset($_POST["btnEditar"]))
{
    //Cojo los datos de la BD
    if($tupla=mysqli_fetch_assoc($resultado_detalles_dispositivo))
    {
        $id_dispositivo=$tupla["id_dispositivo"];
        $machine_id=$tupla["machine_id"];
        $descripcion=$tupla["descripcion"];
        $recurso_aula=$tupla["recurso_aula"];
    }
    else
    {
        $error_existencial=true;
    }

    mysqli_free_result($resultado_detalles_dispositivo);
}
else
{
    //Vengo de un error: recojo lo que había escrito el usuario
    $id_dispositivo=$_POST["btnContEditar"];
    $machine_id=$_POST["machine_id"];
    $descripcion=$_POST["descripcion"];
    $recurso_aula=$_POST["recurso_aula"];
}

if(isset($error_existencial))
{
    echo "<h2>Editando el dispositivo con ID: ".$_POST["btnEditar"]."</h2>";
    echo "<p>El dispositivo ya no se encuentra en la BD</p>";
    echo "<form action='index.php' method='post'><button>Atrás</button></form>";
}
else
{
?>
<h2>Editando el dispositivo con ID: <?php echo $id_dispositivo;?></h2>
<form action="index.php" method="post">
    <p>
        <label for="machine_id">Machine ID</label><br>
        <input type="text" id="machine_id" name="machine_id" maxlength="64" value="<?php echo $machine_id;?>">
        <?php
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
        <label for="descripcion">Descripción</label><br>
        <input type="text" id="descripcion" name="descripcion" maxlength="50" value="<?php echo $descripcion;?>">
    </p>
    <p>
        <label for="recurso_aula">Recurso aula</label><br>
        <input type="number" id="recurso_aula" name="recurso_aula" value="<?php echo $recurso_aula;?>">
    </p>
    <p>
        <button type="submit" value="<?php echo $id_dispositivo;?>" name="btnContEditar">Guardar Cambios</button>
        <button type="submit">Atrás</button>
    </p>
</form>
<?php
}
?>