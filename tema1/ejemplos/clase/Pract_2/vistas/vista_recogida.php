 <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pract_1 - Recogida</title>
  </head>
  <body>
    <h1>Recogida de datos</h1>
    <p><strong>Nombre: </strong><?php echo $_POST["nombre"];?></p>
    <p><strong>Apellidos: </strong><?php echo $_POST["apellidos"];?></p>
    <p><strong>Contraseña: </strong>************</p>
    <p><strong>DNI: </strong><?php echo $_POST["dni"];?></p>
    <p><strong>Sexo: </strong><?php echo $_POST["sexo"];?></p>
    <p><strong>Nacido en: </strong><?php echo $_POST["nacido"];?></p>
    <p><strong>Comentarios: </strong><?php echo $_POST["comentarios"];?></p>
    <p><strong>Subscripción: </strong><?php if(isset($_POST["subscripcion"])) echo "Sí";else echo "No";?></p>

    <?php

    if($_FILES["foto"]["name"]!="")
    {
      $nombre_imagen=uniqid("img_").".".tiene_extension($_FILES["foto"]["name"]);
      @$var=move_uploaded_file($_FILES["foto"]["tmp_name"],"images/".$nombre_imagen);
      if(!$var)
      {
          echo "<p>No se ha podido mover la imagen subida a la carpeta destino</p>";
      }
      else
      {
          echo "<p><strong>Nombre Original: </strong>".$_FILES["foto"]["name"]."</p>";
          echo "<p><strong>Tipo: </strong>".$_FILES["foto"]["type"]."</p>";
          echo "<p><strong>Tamaño: </strong>".$_FILES["foto"]["size"]."</p>";
          echo "<p><strong>Archivo subido temporalmente en: </strong>".$_FILES["foto"]["tmp_name"]."</p>";
          echo "<p><img src='images/".$nombre_imagen."' alt='Imagen Subida' title='Imagen Subida'></p>";
      }
    }
    else
    {
      echo "<p>No has seleccionado ninguna imagen</p>";
    }
    ?>
  </body>
  </html>