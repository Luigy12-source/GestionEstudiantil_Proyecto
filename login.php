<?php
require_once "pdo.php";
session_start();
$consul ="SELECT * FROM users";
$resul = sqlsrv_query($pdo,$consul);
$extraido = sqlsrv_fetch_array($resul, SQLSRV_FETCH_ASSOC);
    $id = $extraido['user_id'];
    $emailver = $extraido['email'];
    $clavever = $extraido['password'];
//$extraido= mysqli_fetch_array($resul);
//$id = $extraido['user_id'];
//$emailver = $extraido['email'];
//$clavever = $extraido['password'];

$salt='XyZzy12';
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="login.css">
<link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
    crossorigin="anonymous">
</head>
<body>
<?php
///Obtener datos

//$check = hash('md5',$salt,$_POST['pass']);
//$stmt = $pdo->prepare('SELECT user_id, name FROM users WHERE email = :em AND password = :pw');
//$stnt = execute(array(':em'=> $_POST['email'],':pw' => $check));
//$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (isset($_POST['submi'])) {
  if ($_POST['email'] == $emailver && $_POST['pass'] == $clavever) {
           $_SESSION['user_id']=$id;
           header('Location: index.php');
           return;
      }else {
          $msg = 'El usuario o Contraseña no son validos';
          echo $msg;
      }
}
if (isset($_POST['cancel'])) {
  header('Location: index.php');
  return;
}
 ?>
<script>
function doValidate() {
    try {
        addr = document.getElementById('email').value;
        pw = document.getElementById('id_1723').value;
        console.log("Validating addr="+addr+" pw="+pw);
        if (addr == null || addr == "" || pw == null || pw == "") {
            alert("Both fields must be filled out");
            return false;
        }
        if ( addr.indexOf('@') == -1 ) {
            alert("Invalid email address");
            return false;
        }
        return true;
    } catch(e) {
        return false;
    }
    return false;
}
</script>
</div>


<div class="container">
     <div class="login-container">
       <div class="register">
         <h2>Ingresar</h2>
         
<form method="POST" action="login.php">
    <label for="email">Correo</label>
    <input type="text" name="email" id="email" class="correo"><br/>
<label for="id_1723">Contraseña</label>
<input type="password" name="pass" id="id_1723" class="clave"><br/>
<input type="submit" name="submi" onclick="return doValidate();" value="Ingresar">
<input type="submit" name="cancel" value="Cancelar">
</form>
       </div>
       <div class="login">
         <h2>Luigy & Asociados</h2>
         <div class="login-items">
            <img src="Recursos/icon2.png" alt="" width="250" height="250" >
         </div>
       </div>
     </div>
   </div>
</body>
