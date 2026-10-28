<?php
    require "src/funciones_ctes.php";

    try
    {
        @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    }
    catch (Exception $e)
    {
        die(error_page("Practica 8","<h1>Practica 8</h1><p>Error no se ha podido conectar a la BD: " .$e->getMessage() ."</p>"));
    }

    # Alta de nuevo usuario (validación e inserción)
    if(isset($_POST["btnContNuevo"]))
    {
        $error_nombre=$_POST["nombre"]=="";
        $error_usuario=$_POST["usuario"]=="";
        if(!$error_usuario)
        {
            $error_usuario=repetido($conexion,"usuarios","usuario",$_POST["usuario"]);
            if(is_string($error_usuario))
            {
                mysqli_close($conexion);
                die(error_page("Practica 8","<h1>Practica 8</h1><p>Error no se ha podido hacer la consulta: ".$error_usuario."</p>"));
            }
        }

        $error_clave=$_POST["clave"]=="";
        $error_dni=!dni_bien_escrito($_POST["dni"]) || !dni_valido($_POST["dni"]);
        if(!$error_dni)
        {
            $error_dni=repetido($conexion,"usuarios","dni",strtoupper($_POST["dni"]));
            if(is_string($error_dni))
            {
                mysqli_close($conexion);
                die(error_page("Practica 8","<h1>Practica 8</h1><p>Error no se ha podido hacer la consulta: ".$error_dni."</p>"));
            }
        }

        $error_sexo=!isset($_POST["sexo"]);

        $error_foto=$_FILES["foto"]["name"]!="" && ($_FILES["foto"]["error"] || $_FILES["foto"]["size"]>500*1024 || !tiene_extension($_FILES["foto"]["name"]) || !mi_getimagesize($_FILES["foto"]));

        $error_form=$error_nombre || $error_usuario || $error_clave || $error_dni || $error_sexo || $error_foto;

        if(!$error_form)
        {
            try
            {
                $consulta="insert into usuarios (nombre, usuario, clave, dni, sexo) values('".$_POST["nombre"]."','".$_POST["usuario"]."','".md5($_POST["clave"])."','".strtoupper($_POST["dni"])."','".$_POST["sexo"]."')";
                mysqli_query($conexion,$consulta);
            }
            catch(Exception $e)
            {
                mysqli_close($conexion);
                die(error_page("Practica 8","<h1>Practica 8</h1><p>Error no se ha podido hacer la consulta: ".$e->getMessage()."</p>"));
            }

            $mensaje_accion="¡¡ Usuario creado correctamente!!";

            //Si has subido foto tengo que moverla a img y actualizar base de datos
            //  $ultm_id=mysqli_insert_id($conexion);
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 8</title>
    <style>
        table, td, th{border:1px solid black}
        table{border-collapse:collapse; width:90%; margin:0 auto;text-align:center}
        th{background-color:#CCC}
        .enlace{border:none; background:none;color:blue;text-decoration:underline;cursor:pointer}
        .error{color:red}
        .mensaje{color:blue;font-size: 1.5rem;}
    </style>
</head>
<body>
    <h1>Practica 8</h1>

    <?php
        if(isset($mensaje_accion))
        {
            echo "<p class='mensaje'>".$mensaje_accion."</p>";
        }

        # Detalles de un usuario
        if(isset($_POST["btnDetalles"]))
        {
            try {
                $consulta = "SELECT * FROM usuarios WHERE id_usuario='" . $_POST["btnDetalles"] . "'";
                $resultado = mysqli_query($conexion, $consulta);
            } catch (Exception $e) {
                mysqli_close($conexion);
                die("<p>Error no se ha podido hacer la consulta: " . $e->getMessage() . "</p>
                </body>
                </html>");
            }

            require "vistas/vista_detalles.php";
        }

        # Formulario de nuevo usuario
        if(isset($_POST["btnNuevo"]) || (isset($_POST["btnContNuevo"]) && $error_form))
        {
    ?>
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
    <?php
        }
    ?>

    <h2>Listado Usuarios</h2>

    <?php

        # Select de las asignaturas

        try {
            $consulta = "SELECT * FROM usuarios";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die("<p>Error no se ha podido hacer la consulta: " . $e->getMessage() . "</p>
            </body>
            </html>");
        }


        echo "<table border='1'>";
        
        echo "<tr>
        <th>#</th>
        <th>imagen</th>
        <th>nombre</th>
        <th><form action='index.php' method='post'><button class='enlace' name='btnNuevo'>Usuario+</button></form></th>
        </tr>";

        while ($tupla = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>" . $tupla['id_usuario'] . "</td>";
            echo "<td><img src='img/" . $tupla['foto'] . "' alt='Foto perfil' title='Foto perfil' width='100'></td>";
            echo "<td><form action='index.php' method='post'><button title='Ver detalles' class='enlace' name='btnDetalles' value='" . $tupla['id_usuario'] . "'>" . $tupla['nombre'] . "</button></form></td>";
            echo "<td>Borrar - Editar</td>";
            echo "</tr>";
        }

        mysqli_free_result($resultado);
        echo "</table>";

        mysqli_close($conexion);

    ?>

</body>
</html>