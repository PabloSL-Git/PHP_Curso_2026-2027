<?php
if($tupla=mysqli_fetch_assoc($resultado))
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

mysqli_free_result($resultado);

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
        <input type="text" id="machine_id" name="machine_id" maxlength="64" value="<?php echo htmlspecialchars($machine_id);?>">
    </p>
    <p>
        <label for="descripcion">Descripción</label><br>
        <input type="text" id="descripcion" name="descripcion" maxlength="50" value="<?php echo htmlspecialchars($descripcion ?? "");?>">
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