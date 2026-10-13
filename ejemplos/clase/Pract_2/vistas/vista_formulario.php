<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pract_1 - Formulario</title>
    <style>
        .error{color:red}
    </style>
</head>
<body>
    <h1>Rellena tu CV</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Nombre</label><br>
            <input type="text" id="nombre" name="nombre" placeholder="Teclee un nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>">
            <?php
            if(isset($_POST["btnEnviar"]) && $error_nombre)
                echo "<span class='error'> * Campo obligatorio *</span>";
            ?>
        </p>
        <p>
            <label for="apellidos">Apellidos</label><br>
            <input type="text" id="apellidos" name="apellidos" placeholder="Teclee los apellidos" value="<?php if(isset($_POST["apellidos"])) echo $_POST["apellidos"];?>">
             <?php
            if(isset($_POST["btnEnviar"]) && $error_apellidos)
                echo "<span class='error'> * Campo obligatorio *</span>";
            ?>
        </p>
         <p>
            <label for="clave">Contraseña</label><br>
            <input type="password" id="clave" name="clave" placeholder="Teclee su contraseña" >
            <?php
            if(isset($_POST["btnEnviar"]) && $error_clave)
                echo "<span class='error'> * Campo obligatorio *</span>";
            ?>
        </p>
        <p>
            <label for="dni">DNI</label><br>
            <input type="text" id="dni" name="dni" placeholder="Teclee un DNI: 11223344N" value="<?php if(isset($_POST["dni"])) echo $_POST["dni"];?>" >
            <?php
            if(isset($_POST["btnEnviar"]) && $error_dni)
                if(!dni_bien_escrito($_POST["dni"]))
                    echo "<span class='error'> * DNI no está bien escrito *</span>";
                else
                    echo "<span class='error'> * DNI no es válido *</span>";
            ?>
        </p>
        <p>
            <label>Sexo</label><br>
            <input type="radio" name="sexo" id="hombre" value="Hombre" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="Hombre") echo "checked";?>>
            <label for="hombre">Hombre</label><br>
            <input type="radio" name="sexo" id="mujer" value="Mujer" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="Mujer") echo "checked";?>>
            <label for="mujer">Mujer</label>
            <?php
            if(isset($_POST["btnEnviar"]) && $error_sexo)
                echo "<span class='error'> * Debes seleccionar un sexo *</span>";
            ?>
        </p>
        <p>
            <label for="archivo">Incluir mi foto: </label>
            <input type="file" id="archivo" name="foto" accept="image/*" >
            <?php
            if(isset($_POST["btnEnviar"]) && $error_foto)
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
            <label for="nacido">Nacido en: </label>
            <select name="nacido" id="nacido">
                <option value="Málaga" <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Málaga") echo "selected";?>>Málaga</option>
                <option value="Granada" <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Granada") echo "selected";?>>Granada</option>
                <option value="Almería" <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Almería") echo "selected";?>>Almería</option>
            </select>
        </p>
        <p>
            <label for="comentarios">Comentarios</label>
            <textarea name="comentarios" id="comentarios" cols="40" rows="10"><?php if(isset($_POST["comentarios"])) echo $_POST["comentarios"];?></textarea>
             <?php
            if(isset($_POST["btnEnviar"]) && $error_comentarios)
                echo "<span class='error'> * Campo Obligatorio*</span>";
            ?>
        </p>
        <p>
            <input type="checkbox" name="subscripcion" <?php if(!isset($_POST["btnEnviar"])|| isset($_POST["subscripcion"]) ) echo "checked"; ?> id="subscripcion">
            <label for="subscripcion">Subscribirse al boletín de Novedades</label>
        </p>
        <p>
            <button type="submit" name="btnEnviar">Guardar Cambios</button>
            <button type="submit" name="btnReset">Borrar los campos introducidos</button>
        </p>
    </form>
</body>
</html>