<h2>Agregar un nuevo usuario</h2>
<form action="index.php" method="post" enctype="multipart/form-data">
    
    <p>
        <label for="usuario">Usuario</label><br>
        <input type="text" id="usuario" name="usuario" placeholder="Teclee un usuario" value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"];?>">
        <?php
        if(isset($_POST["btnContNuevo"]) && $error_usuario)
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
        <input type="password" id="clave" name="clave" placeholder="Teclee su contraseña" >
        <?php
        if(isset($_POST["btnContNuevo"]) && $error_clave)
            echo "<span class='error'> * Campo obligatorio *</span>";
        ?>
    </p>
        <p>
        <label for="nombre">Nombre</label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Teclee un nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>">
        <?php
        if(isset($_POST["btnContNuevo"]) && $error_nombre)
            echo "<span class='error'> * Campo obligatorio *</span>";
        ?>
    </p>
    <p>
        <label for="dni">DNI</label><br>
        <input type="text" id="dni" name="dni" placeholder="Teclee un DNI: 11223344N" value="<?php if(isset($_POST["dni"])) echo $_POST["dni"];?>" >
        <?php
        if(isset($_POST["btnContNuevo"]) && $error_dni)
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
        <input type="radio" name="sexo" id="hombre" value="Hombre" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="Hombre") echo "checked";?>>
        <label for="hombre">Hombre</label><br>
        <input type="radio" name="sexo" id="mujer" value="Mujer" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="Mujer") echo "checked";?>>
        <label for="mujer">Mujer</label>
        <?php
        if(isset($_POST["btnContNuevo"]) && $error_sexo)
            echo "<span class='error'> * Debes seleccionar un sexo *</span>";
        ?>
    </p>
    <p>
        <label for="archivo">Incluir mi foto: (Archivo imagen con extensión, Máx. 500KB)</label>
        <input type="file" id="archivo" name="foto" accept="image/*" >
        <?php
        if(isset($_POST["btnContNuevo"]) && $error_foto)
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
        <button type="submit" name="btnContNuevo">Guardar Cambios</button>
        <button type="submit" >Atrás</button>
    </p>
</form>