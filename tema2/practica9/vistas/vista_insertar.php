<h2>Agregar un dispositivo</h2>
<form action="index.php" method="post">
    <p>
        <label for="machine_id">Machine Id:</label><br>
        <!-- Si el formulario vuelve por un error, se conserva lo que se había escrito -->
        <input type="text" id="machine_id" name="machine_id" maxlength="64" value="<?php if(isset($_POST["machine_id"])) echo $_POST["machine_id"];?>">
        <?php
        //Solo se muestran errores si se ha enviado el formulario
        if(isset($_POST["btnContCrear"]) && $error_machine)
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
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" maxlength="50"><?php if(isset($_POST["descripcion"])) echo $_POST["descripcion"];?></textarea>
    </p>
    <p>
        <label for="recurso_aula">Lugar: </label>
        <select id="recurso_aula" name="recurso_aula">
            <optgroup label="Aulas">
            <?php
            //Una opción por cada aula. El value es el id y el texto es el nombre
            while($tupla=mysqli_fetch_assoc($resultado_aulas))
            {
                if(isset($_POST["recurso_aula"]) && $_POST["recurso_aula"]==$tupla["id_aula"])
                    echo "<option selected value='".$tupla["id_aula"]."'>".$tupla["nombre"]."</option>";
                else
                    echo "<option value='".$tupla["id_aula"]."'>".$tupla["nombre"]."</option>";
            }
            mysqli_free_result($resultado_aulas);
            ?>
            </optgroup>
            <optgroup label="Recursos">
            <?php
            //Una opción por cada recurso
            while($tupla=mysqli_fetch_assoc($resultado_recursos))
            {
                if(isset($_POST["recurso_aula"]) && $_POST["recurso_aula"]==$tupla["id_recurso"])
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
        <!-- btnContCrear es el botón que activa la inserción en index.php -->
        <button type="submit" name="btnContCrear">Guardar cambios</button>
        <!-- Sin name: solo recarga la página y vuelve al listado -->
        <button type="submit">Atrás</button>
    </p>
</form>