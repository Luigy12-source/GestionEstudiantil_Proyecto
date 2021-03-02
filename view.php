<?php
require_once "pdo.php";
$id=$_GET['profile_id'];
$consul ="SELECT * FROM profile WHERE profile_id = '" .$id."' ";
$resul = sqlsrv_query($pdo,$consul);
$extraido= sqlsrv_fetch_array($resul, SQLSRV_FETCH_ASSOC);
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Informacion
    </title>
  </head>
  <body>
    <div id=”tabla1″>
    
      <h1>Imformacion del Estudiante</h1>
      <?php 
        $ver1= htmlentities($extraido['first_name']);
        $ver2= htmlentities($extraido['last_name']);
        $ver3 = htmlentities($extraido['email']);
        $ver4= htmlentities($extraido['headline']);
        $ver5 = htmlentities($extraido['summary']);
        ?>
      <p>Nombre: <?php echo $ver1 ?></p>
      <p>Apellido: <?php echo $ver2 ?></p>
      <p>Correo:  <?php echo $ver3 ?></p>
      <p>
      Curso: 
      <br>
      <?php echo $ver4?>
      </p>
      <p>
      Resumen: 
      <br>
      <?php echo $ver5?>
      </p>
      <h1>-------------------------------------</h1>
      </div>
      <a href="index.php">Aceptar</a>

  </body>
</html>
