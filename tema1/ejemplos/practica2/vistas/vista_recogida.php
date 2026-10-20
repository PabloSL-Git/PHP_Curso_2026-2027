<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 2</title>
</head>
<body>
    <h1>Estos son los datos enviados</h1>
    <p>Ha nacido en: <?php echo $_POST["nombre"];?></p>
    <p>El nombre enviado ha sido: <?php echo $_POST["nacido"];?></p>
    <p>El sexo es: <?php echo $_POST["sexo"];?></p>
    <?php

    // Aficiones
    if(isset($_POST["aficiones"])){

        echo "<p><strong>Las seleccionadas han sido: </strong></p>";
        echo "<ol>";

        for($i=0; $i< count($_POST["aficiones"]); $i++){

            echo"<li>".$_POST["aficiones"][$i]."</li>";

        }


        echo "</ol>";
    } else
        echo "<p><strong>No has seleccionado ninguna afición</strong></p>";

    // Comentario
    if ($_POST["comentario"]==""){
        echo "<p><strong>No has hecho ningún comentario</strong></p>";
    } else 
        echo "<p><strong>El comentario ha sido: </strong>".$_POST["comentario"]."</p>";
    ?>

    
</body>
</html>