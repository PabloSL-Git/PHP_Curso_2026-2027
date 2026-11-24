<?php
if(isset($_POST["btnLogin"]))
{
    $error_usuario=$_POST["usuario"]=="";
    $error_clave=$_POST["clave"]=="";
    $error_form=$error_usuario || $error_clave;
    if(!$error_form)
    {
        ///
        try
        {
            @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
            mysqli_set_charset($conexion,"utf8");
        }
        catch(Exception $e)
        {
            session_destroy();
            die(error_page("Primer Login","<h1>Primer Login</h1><p>Error al conectarse a la BD: ".$e->getMessage()."</p>"));
        }

        try
        {
            $consulta="select usuario from usuarios where usuario='".$_POST["usuario"]."' and clave='".md5($_POST["clave"])."'";
            $resultado_usuario=mysqli_query($conexion,$consulta);
        }
        catch(Exception $e)
        {
            mysqli_close($conexion);
            session_destroy();
            die(error_page("Primer Login","<h1>Primer Login</h1><p>Error al hacer la consulta: ".$e->getMessage()."</p>"));
        }

        mysqli_close($conexion);
        $n_tuplas=mysqli_num_rows($resultado_usuario);
        mysqli_free_result($resultado_usuario);
        if($n_tuplas>0)
        {
            $_SESSION["usuario"]=$_POST["usuario"];
            $_SESSION["clave"]=md5($_POST["clave"]);
            $_SESSION["ultima_accion"]=time();
            header("Location:index.php");
            exit;
        }
        else
        {
            $error_usuario=true;
        }


    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login</title>
    <style>
        .error{color:red}
        .mensaje{color:blue;font-size:1.25rem}
    </style>
</head>
<body>
    <h1>Primer Login</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario" value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"];?>">
            <?php
            if(isset($_POST["btnLogin"]) && $error_usuario)
            {
                if($_POST["usuario"]=="")
                    echo "<span class='error'> * Campo vacío</span>";
                else
                    echo "<span class='error'> * Usuario y/o contraseña incorrectos. </span>";
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña:</label>
            <input type="password" name="clave" id="clave">
            <?php
            if(isset($_POST["btnLogin"]) && $error_clave)
            {
                echo "<span class='error'> * Campo vacío</span>";
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnLogin">Entrar</button>
        </p>
    </form>
    <?php
    if(isset($_SESSION["seguridad"]))
    {
        echo "<p class='mensaje'>".$_SESSION["seguridad"]."</p>";
        session_destroy();
        
    }
    ?>
</body>
</html>