<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<style>
    .error{color:red}
</style>
<body>
    
<h1>Esta es mi super página</h1>
    <form action="formulario.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Teclee un nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>">
        <?php
            if(isset($_POST["btnEnviar"]) && $error_nombre)
            echo "<span class='error'> * Campo obligatorio *</span>";
        ?>
    </p>

    <p>
        <label for="nacido">Nacido en: </label>
        <select name="nacido" id="nacido">
            <option value="Almería" <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Almería") echo "selected";?>>Almería</option>
            <option value="Cádiz" <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Cádiz") echo "selected";?>>Cádiz</option>
            <option value="Córdoba" <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Córdoba") echo "selected";?>>Córdoba</option>
            <option value="Granada" <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Granada") echo "selected";?>>Granada</option>
            <option value="Huelva" <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Huelva") echo "selected";?>>Huelva</option>
            <option value="Jaén" <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Jaén") echo "selected";?>>Jaén</option>
            <option value="Málaga" <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Málaga") echo "selected";?>>Málaga</option>
            <option value="Madrid" <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Madrid") echo "selected";?>>Madrid</option>
            <option value="Sevilla" <?php if(isset($_POST["nacido"]) && $_POST["nacido"]=="Sevilla") echo "selected";?>>Sevilla</option>
        </select>
    </p>

    <p>
        <label>Sexo: </label>
        <label for="sexo">Hombre</label>
        <input type="radio" id="hombre" name="sexo" value="hombre"
        <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="hombre") echo "checked";?>>
        <label for="sexo">Mujer</label>
        <input type="radio" id="mujer" name="sexo" value="mujer"
        <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="mujer") echo "checked";?>>
        <?php
            if(isset($_POST["btnEnviar"]) && $error_sexo)
            echo "<span class='error'> * Campo obligatorio *</span>";
        ?>
    </p>
    
    <p>
        <label>Aficiones: </label>
        <label for="deportes">Deportes</label>
        <input type="checkbox" id="deportes" name="aficiones[]" value="deportes"
        <?php if(isset($_POST["aficiones"]) && in_array("deportes", $_POST["aficiones"])) echo "checked";?>>
        <label for="lectura">Lectura</label>
        <input type="checkbox" id="lectura" name="aficiones[]" value="lectura">
        <label for="otros">Otros</label>
        <input type="checkbox" id="otros" name="aficiones[]" value="otros">
    </p>

    <p>
        <label for="texto">Comentarios: </label>
        <textarea name="comentario" id="comentario"><?php if(isset($_POST["comentario"])) echo $_POST["comentario"];?></textarea>
    </p>
    
    <p>
        <button type="submit" name="btnEnviar">Enviar</button>
    </p>

    </form>


</body>
</html>