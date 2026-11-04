<h2>Agregar un nuevo dispositivo</h2>
<form action="index.php" method="post">
    <p>
        <label for="machine_id">Machine ID</label><br>
        <!-- Si el formulario vuelve por un error, se conserva lo que se había escrito -->
        <input type="text" id="machine_id" name="machine_id" maxlength="64" placeholder="Teclee un machine ID" value="<?php if(isset($_POST["machine_id"])) echo $_POST["machine_id"];?>">
        <?php
        //Solo se muestran errores si se ha enviado el formulario
        if(isset($_POST["btnContNuevo"]) && $error_machine)
        {
            //Hay dos posibles errores: campo vacío o machine_id repetido
            if($_POST["machine_id"]=="")
                echo "<span class='error'> * Campo obligatorio *</span>";
            else
                echo "<span class='error'> * Machine ID ya en uso *</span>";
        }
        ?>
    </p>
    <p>
        <label for="descripcion">Descripción</label><br>
        <input type="text" id="descripcion" name="descripcion" maxlength="50" placeholder="Teclee una descripción" value="<?php if(isset($_POST["descripcion"])) echo $_POST["descripcion"];?>">
    </p>
    <p>
        <label for="recurso_aula">Recurso aula</label><br>
        <input type="number" id="recurso_aula" name="recurso_aula" value="<?php if(isset($_POST["recurso_aula"])) echo $_POST["recurso_aula"];?>">
    </p>
    <p>
        <!-- btnContNuevo es el botón que activa la inserción en index.php -->
        <button type="submit" name="btnContNuevo">Guardar Cambios</button>
        <!-- Sin name: solo recarga la página y vuelve al listado -->
        <button type="submit">Atrás</button>
    </p>
</form>