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
  </body>
  </html>