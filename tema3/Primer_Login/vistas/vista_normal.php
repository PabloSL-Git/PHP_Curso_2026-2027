<?php
$error_bd="";
if(isset($_POST["btnGuardar"]))
{
    $error_form=$_POST["nombre"]=="" || $_POST["usuario"]=="";
    if(!$error_form)
    {
        // Si deja la clave vacía, se mantiene la actual
        $clave=$_POST["clave"]=="" ? $datos_usu_log["clave"] : md5($_POST["clave"]);
        try
        {
            $consulta="update usuarios set nombre='".$_POST["nombre"]."', usuario='".$_POST["usuario"]."', clave='".$clave."', email='".$_POST["email"]."' where id_usuario=".$datos_usu_log["id_usuario"];
            mysqli_query($conexion,$consulta);

            // Actualizo la sesión para que seguridad.php siga encontrando al usuario
            $_SESSION["usuario"]=$_POST["usuario"];
            $_SESSION["clave"]=$clave;
            header("Location:index.php");
            exit;
        }
        catch(Exception $e)
        {
            $error_bd="No se ha podido guardar (¿usuario o email repetido?)";
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
        .enlace{border:none;background:none;color:blue;text-decoration: underline;cursor: pointer;}
        .error{color:red}
    </style>
</head>
<body>
    <h1>Primer Login</h1>
    <form action="index.php" method="post">
        <p>Bienvenido <strong><?php echo $datos_usu_log["nombre"];?></strong> - <button type="submit" class='enlace' name="btnCerrarSesion">Salir</button></p>
    </form>

    <h2>Editar mis datos</h2>
    <form action="index.php" method="post">
        <p>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="<?php echo isset($_POST["nombre"]) ? $_POST["nombre"] : $datos_usu_log["nombre"];?>">
            <?php if(isset($_POST["btnGuardar"]) && $_POST["nombre"]=="") echo "<span class='error'> * Campo vacío</span>";?>
        </p>
        <p>
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario" value="<?php echo isset($_POST["usuario"]) ? $_POST["usuario"] : $datos_usu_log["usuario"];?>">
            <?php if(isset($_POST["btnGuardar"]) && $_POST["usuario"]=="") echo "<span class='error'> * Campo vacío</span>";?>
        </p>
        <p>
            <label for="clave">Contraseña (vacía = no cambiarla): </label>
            <input type="password" name="clave" id="clave">
        </p>
        <p>
            <label for="email">Email: </label>
            <input type="text" name="email" id="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : $datos_usu_log["email"];?>">
        </p>
        <p><button type="submit" name="btnGuardar">Guardar cambios</button></p>
        <?php if($error_bd!="") echo "<p class='error'>".$error_bd."</p>";?>
    </form>
</body>
</html>
