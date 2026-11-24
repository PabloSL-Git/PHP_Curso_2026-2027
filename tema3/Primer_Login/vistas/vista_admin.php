<?php
$error_bd="";
try
{
    // BORRAR (un admin no puede borrarse a sí mismo)
    if(isset($_POST["btnBorrar"]) && $_POST["btnBorrar"]!=$datos_usu_log["id_usuario"])
        mysqli_query($conexion,"delete from usuarios where id_usuario=".$_POST["btnBorrar"]);

    // INSERTAR
    if(isset($_POST["btnInsertar"]) && $_POST["nombre"]!="" && $_POST["usuario"]!="" && $_POST["clave"]!="")
        mysqli_query($conexion,"insert into usuarios (nombre,usuario,clave,email,tipo) values ('".$_POST["nombre"]."','".$_POST["usuario"]."','".md5($_POST["clave"])."','".$_POST["email"]."','".$_POST["tipo"]."')");

    // ACTUALIZAR
    if(isset($_POST["btnActualizar"]) && $_POST["nombre"]!="" && $_POST["usuario"]!="")
    {
        $consulta="update usuarios set nombre='".$_POST["nombre"]."', usuario='".$_POST["usuario"]."', email='".$_POST["email"]."', tipo='".$_POST["tipo"]."'";
        if($_POST["clave"]!="")
            $consulta.=", clave='".md5($_POST["clave"])."'";
        $consulta.=" where id_usuario=".$_POST["id_usuario"];
        mysqli_query($conexion,$consulta);

        // Si el admin se edita a sí mismo, actualizo su sesión
        if($_POST["id_usuario"]==$datos_usu_log["id_usuario"])
        {
            $_SESSION["usuario"]=$_POST["usuario"];
            if($_POST["clave"]!="")
                $_SESSION["clave"]=md5($_POST["clave"]);
            header("Location:index.php");
            exit;
        }
    }

    // LEER: lista de usuarios y, si se pulsa Editar, los datos de ese usuario
    $resultado_usuarios=mysqli_query($conexion,"select * from usuarios");
    if(isset($_POST["btnEditar"]))
    {
        $res=mysqli_query($conexion,"select * from usuarios where id_usuario=".$_POST["btnEditar"]);
        $datos_editar=mysqli_fetch_assoc($res);
        mysqli_free_result($res);
    }
}
catch(Exception $e)
{
    $error_bd="Error en la BD (¿usuario o email repetido?): ".$e->getMessage();
    $resultado_usuarios=mysqli_query($conexion,"select * from usuarios");
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
        table,th,td{border:1px solid black;border-collapse:collapse;padding:.3rem}
    </style>
</head>
<body>
    <h1>Primer Login</h1>
    <form action="index.php" method="post">
        <p>Bienvenido <strong><?php echo $datos_usu_log["nombre"];?></strong> - <button type="submit" class='enlace' name="btnCerrarSesion">Salir</button></p>
    </form>

    <?php if($error_bd!="") echo "<p class='error'>".$error_bd."</p>";?>

    <h2>Listado de usuarios</h2>
    <table>
        <tr><th>Nombre</th><th>Usuario</th><th>Email</th><th>Tipo</th><th>Acciones</th></tr>
        <?php
        while($fila=mysqli_fetch_assoc($resultado_usuarios))
        {
            echo "<tr>";
            echo "<td>".$fila["nombre"]."</td><td>".$fila["usuario"]."</td><td>".$fila["email"]."</td><td>".$fila["tipo"]."</td>";
            echo "<td><form action='index.php' method='post'>";
            echo "<button class='enlace' type='submit' name='btnEditar' value='".$fila["id_usuario"]."'>Editar</button> - ";
            echo "<button class='enlace' type='submit' name='btnBorrar' value='".$fila["id_usuario"]."'>Borrar</button>";
            echo "</form></td>";
            echo "</tr>";
        }
        mysqli_free_result($resultado_usuarios);
        ?>
    </table>

    <?php if(isset($datos_editar) && $datos_editar){ ?>
    <h2>Editar usuario</h2>
    <form action="index.php" method="post">
        <input type="hidden" name="id_usuario" value="<?php echo $datos_editar["id_usuario"];?>">
        <p>Nombre: <input type="text" name="nombre" value="<?php echo $datos_editar["nombre"];?>"></p>
        <p>Usuario: <input type="text" name="usuario" value="<?php echo $datos_editar["usuario"];?>"></p>
        <p>Contraseña (vacía = no cambiarla): <input type="password" name="clave"></p>
        <p>Email: <input type="text" name="email" value="<?php echo $datos_editar["email"];?>"></p>
        <p>Tipo:
            <select name="tipo">
                <option value="normal" <?php if($datos_editar["tipo"]=="normal") echo "selected";?>>normal</option>
                <option value="admin" <?php if($datos_editar["tipo"]=="admin") echo "selected";?>>admin</option>
            </select>
        </p>
        <p><button type="submit" name="btnActualizar">Guardar</button> <button type="submit">Cancelar</button></p>
    </form>
    <?php } else { ?>
    <h2>Nuevo usuario</h2>
    <form action="index.php" method="post">
        <p>Nombre: <input type="text" name="nombre"></p>
        <p>Usuario: <input type="text" name="usuario"></p>
        <p>Contraseña: <input type="password" name="clave"></p>
        <p>Email: <input type="text" name="email"></p>
        <p>Tipo:
            <select name="tipo">
                <option value="normal">normal</option>
                <option value="admin">admin</option>
            </select>
        </p>
        <p><button type="submit" name="btnInsertar">Insertar</button></p>
    </form>
    <?php } ?>
</body>
</html>
