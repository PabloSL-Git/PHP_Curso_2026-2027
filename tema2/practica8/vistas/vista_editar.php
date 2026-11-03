<?php
if(isset($_POST["btnEditar"]))
{
    //Cojo los datos de la BD
    if($tupla=mysqli_fetch_assoc($resultado))
    {
        $id_usuario=$tupla["id_usuario"];
        $nombre=$tupla["nombre"];
        $usuario=$tupla["usuario"];
        $dni=$tupla["dni"];
        $sexo=$tupla["sexo"];
        $foto=$tupla["foto"];
    }
    else
    {
        $error_existencial=true;
    }

    mysqli_free_result($resultado);
}
else
{
    $id_usuario=$_POST["btnContEditar"];
    $nombre=$_POST["nombre"];
    $usuario=$_POST["usuario"];
    $dni=$_POST["dni"];
    $sexo=$_POST["sexo"];
    $foto=$_POST["foto_en_bd"];
}


//Monto un formulario editar con los datos ya recogidos o muestro mensaje de que el usuario
// ya no está en la BD

if(isset($error_existencial))
{
    echo "<h2>Editando el usuario con ID:".$_POST["btnEditar"]."</h2>";
    echo "<p>El usuario ya no se encuentra en la BD</p>";
    echo "<form action='index.php' method='post'><button>Atrás</button></form>";
}
else
{
?>
<h2>Editando el usuario con ID: <?php echo $id_usuario;?></h2>
<form action="index.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="usuario">Usuario</label><br>
        <input type="text" id="usuario" name="usuario" placeholder="Teclee un usuario" value="<?php echo $usuario;?>">
        <?php
        if(isset($_POST["btnContEditar"]) && $error_usuario)
        {
            if($_POST["usuario"]=="")
                echo "<span class='error'> * Campo obligatorio *</span>";
            else
                echo "<span class='error'> * Usuario ya en uso *</span>";
        }
            
        ?>
    </p>
    <p>
        <label for="clave">Contraseña</label><br>
        <input type="password" id="clave" name="clave" placeholder="Teclee nueva contraseña" >
    </p>
    <p>
        <label for="nombre">Nombre</label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Teclee un nombre" value="<?php echo $nombre;?>">
        <?php
        if(isset($_POST["btnContEditar"]) && $error_nombre)
            echo "<span class='error'> * Campo obligatorio *</span>";
        ?>
    </p>
    <p>
        <label for="dni">DNI</label><br>
        <input type="text" id="dni" name="dni" placeholder="Teclee un DNI: 11223344N" value="<?php echo $dni;?>" >
        <?php
        if(isset($_POST["btnContEditar"]) && $error_dni)
            if(!dni_bien_escrito($_POST["dni"]))
                echo "<span class='error'> * DNI no está bien escrito *</span>";
            elseif(!dni_valido($_POST["dni"]))
                echo "<span class='error'> * DNI no es válido *</span>";
            else
                echo "<span class='error'> * DNI repetido *</span>";
        ?>
    </p>
    <p>
        <label>Sexo</label><br>
        <input type="radio" name="sexo" id="hombre" value="Hombre" <?php if(strtolower($sexo)=="hombre") echo "checked";?>>
        <label for="hombre">Hombre</label><br>
        <input type="radio" name="sexo" id="mujer" value="Mujer" <?php if(strtolower($sexo)=="mujer") echo "checked";?>>
        <label for="mujer">Mujer</label>
    </p>
    <p>
        <label for="archivo">Incluir mi foto: (Archivo imagen con extensión, Máx. 500KB)</label>
        <input type="file" id="archivo" name="foto" accept="image/*" >
        <?php
        if(isset($_POST["btnContEditar"]) && $error_foto)
        {
            if($_FILES["foto"]["error"])
                echo "<span class='error'> * Error en la subida del fichero al servidor </span>";
            elseif(!tiene_extension($_FILES["foto"]["name"]))
                echo "<span class='error'> * El fichero seleccionado no tienen extensión </span>";
            elseif(!mi_getimagesize($_FILES["foto"]))
                echo "<span class='error'> * El archivo seleccionado no es un archivo imagen </span>";
            else
                echo "<span class='error'> * El archivo seleccionado supera los 500KB </span>";
        }
        ?>
    </p>
    <p>
        <input type="hidden" value="<?php echo $foto;?>" name="foto_en_bd">
        <button type="submit" value='<?php echo $id_usuario;?>' name="btnContEditar">Guardar Cambios</button>
        <button type="submit" >Atrás</button>
    </p>
</form>
<?php
}
?>