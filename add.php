<?php
require_once "pdo.php";
session_start();
$_SESSION['status']=0;
 ?><!DOCTYPE html>
<html>
<head>
<title>Agregar Estudiante</title>
<link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
    crossorigin="anonymous">
</head>
<body>
<div class="container">
<h1>Editar Perfil</h1>
<?php    
       if (isset($_SESSION["error"])) {
        echo('<p style="color: red;">' . $_SESSION["error"]);
        unset($_SESSION["error"]);
    }?>
<form method="post">
<p>Nombre:
<input type="text" name="first_name" size="60"/></p>
<p>Apellido:
<input type="text" name="last_name" size="60"/></p>
<p>Correo:
<input type="text" name="email" size="30"/></p>
<p>Curso:<br/>
<input type="text" name="headline" size="80"/></p>
<p>Resumen:<br/>
<textarea name="summary" rows="8" cols="80"></textarea>
<p>
<input type="submit" name="add" value="Agregar">
<input type="submit" name="cancel" value="Cancelar">
</p>
</form>
</div>
</body>
</html>
<?php
if (!isset($_SESSION['user_id'])) {
  die("Acceso Denegado");
  return;
}
if(isset($_POST['cancel'])){
  header('Location: index.php');
  return;
}
if (isset($_POST["add"])) {
        $id=$_SESSION['user_id'];
        $name=$_POST['first_name'];
        $setna=$_POST['last_name'];
        $ema=$_POST['email'];
        $head=$_POST['headline'];
        $sum=$_POST['summary'];
        $stmt = ("INSERT INTO profile
        (user_id, first_name, last_name, email, headline, summary)
        VALUES ('$id','$name','$setna','$ema','$head','$sum')");
        $ejecutar=sqlsrv_query($pdo,$stmt);
    $_SESSION['status']=$_SESSION['status']+1;
    $_SESSION["success"] = "Profile added";
    header('Location: index.php');
    
}

 ?>
