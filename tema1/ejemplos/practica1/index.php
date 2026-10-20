<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 1</title>
</head>
<body>
    <h1>Rellena tu CV</h1>
    <form action="index.php" method="get" class="formulario" enctype="multipath/form-data">
    <div class="nombre">    
        <label>Nombre</label><br>   
        <input type="text">
    </div>
    <div class="apellidos">
        <label>Apellidos</label><br>
        <input type="text">
    </div>
    <div class="contraseña">
        <label>Contraseña</label><br>
        <input type="password">
    </div>
    <div class="dni">
        <label>DNI</label><br>
        <input type="text">
    </div>
    <div class="sexo">
        <label>Sexo</label><br>
        <label><input type="radio" name="sexo" value="Hombre" /> Hombre</label><br>
        <label><input type="radio" name="sexo" value="Mujer" /> Mujer</label>
    </div>
    <br>
    <div class="foto">
        <label>Incluir mi foto:</label>
        <input type="file" lang="es">
    </div>
    <br>
    <div class="lugarNacimiento">
        <label>Nacido en:</label>
        <select name="lugarNacimiento">
            <option value="">Selecciona tu lugar de nacimiento</option>
            <option value="Málaga">Málaga</option>
            <option value="Málaga">Cádiz</option>
            <option value="Málaga">Sevilla</option>
            <option value="Málaga">Granada</option>
            <option value="Málaga">Cordoba</option>
            <option value="Málaga">Almeria</option>
            <option value="Málaga">Jaén</option>
            <option value="Málaga">Huelva</option>
        </select>
    </div>
    <br>
    <div class="comentarios">
        <label>Comentarios:</label>
        <textarea name="comentarios" rows="5" cols="50"></textarea>
    </div>
    <br>
    <div class="suscribirse">
        <input type="checkbox" checked>
        <label> Suscribirse al boletin de Novedades</label>
    </div>
    <br>
    <input type="submit" value="Guardar los cambios">
    <input type="reset" value="Borrar los datos introducidos">
    </form>
</body>
</html>