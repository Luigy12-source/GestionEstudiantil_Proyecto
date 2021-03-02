<?php
session_start();
include_once 'pdo.php';
$id = $_GET['profile_id'];
$consul = "SELECT * FROM profile WHERE profile_id = ' ".$id." ' ";
$resul = sqlsrv_query($pdo, $consul);
$ex = sqlsrv_fetch_array($resul, SQLSRV_FETCH_ASSOC);
$name=$ex['first_name'];
$setna=$ex['last_name'];
$ema=$ex['email'];
$head=$ex['headline'];
$sum=$ex['summary'];
if (isset($_POST["cancel"])) {
  header("Location: index.php");
  die();
}
if (isset($_POST["save"])) {
    if (strlen($_POST["first_name"]) < 1
        || strlen($_POST["last_name"]) < 1
        || strlen($_POST["email"]) < 1
        || strlen($_POST["headline"]) < 1
        || strlen($_POST["summary"]) < 1){
          $_SESSION["error"] = "All fields are required";
        }else{  
          $id=$_SESSION['user_id'];
          $name=$_POST['first_name'];
          $setna=$_POST['last_name'];
          $ema=$_POST['email'];
          $head=$_POST['headline'];
          $sum=$_POST['summary'];
          
          $stmt = "UPDATE profile set user_id = '" .$id. "', first_name = '" .$name."'
          , last_name = '" .$setna."', email = '".$setna."', headline = '".$head."'
          , summary = '".$sum."' WHERE profile_id ='".$_GET['profile_id']."' ";

          $ejecutar=sqlsrv_query($pdo,$stmt);
          ?> 
          <script>alert("El perfil ha sido actualizado!")</script>
          <?php
          $_SESSION["success"] = "Perfil Actualizado";
          header('Location: index.php');
        }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Editar Perfil</title>
<link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
    crossorigin="anonymous">
</head>
<body>
<div class="container">
<h1>Editar Perfil</h1>
<form method="post">
        <label>Nombre:</label>
        <input type="text" name="first_name" value="<?php echo $name ?>">
        <br>
        <label>Apellido:</label>
        <input type="text" name="last_name" value="<?php echo $setna ?>">
        <br>
        <label>Correo:</label>
        <input type="text" name="email" value="<?php echo $ema ?>">
        <br>
        <label>Titulo:</label>
        <br>
        <input type="text" name="headline" value="<?php echo $head ?>">
        <br>
        <label>Resumen:</label>
        <br>
        <textarea
            name="summary"
            cols="100"
            rows="20"
            style="resize: none;"
        >
        <?php echo $sum ?>
        </textarea>
        <br>
        <input type="hidden" name="profile_id" value="<?php echo $profile_id ?>">
        <input type="submit" name="save" value="Guardar Cambios">
        <input type="submit" name="cancel" value="Cancelar">
    </form>
</div>
</body>
</html>


