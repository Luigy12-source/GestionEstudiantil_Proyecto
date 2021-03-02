<script>
 var total = 0;	
function operaciones (valor) {
    valor = parseInt(valor);
    total = document.getElementById('spTotal').innerHTML;
    total = (total == null || total == undefined || total == "") ? 0 : total;
    total = (parseInt(total) + parseInt(valor));
    document.getElementById('spTotal').innerHTML = total;
}

</script><?php
require_once "pdo.php";
session_start();
$_SESSION['status']=0;

 ?><!DOCTYPE html>
<html>
<head>
<title>Agregar Notas del Estudiante</title>
<link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
    crossorigin="anonymous">
</head>
<body>
<div class="container">
<h1>Agregar Notas del Estudiante</h1>
<?php    
       if (isset($_SESSION["error"])) {
        echo('<p style="color: red;">' . $_SESSION["error"]);
        unset($_SESSION["error"]);
    }?>
<form method="post">
<p>Primer Parcial:
<input type="text" id="txt_campo_1" name="prim" onchange="operaciones(this.value);" size="60"/></p>
<p>Segundo Parcial:
<input type="text"  id="txt_campo_2" name="segun" onchange="operaciones(this.value);" size="60"/></p>
<p>Examen:
<input type="text" id="txt_campo_3" name="exa" onchange="operaciones(this.value);" size="30"/></p>
<p>Nota Final: <span id='spTotal'></span>
</p>
<br/>
<input type="submit" name="add" value="Agregar Notas">
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
         $id = $_GET['profile_id'];
         $pp=$_POST['prim'];
         $ppp=$_POST['segun'];
         $pppp=$_POST['exa'];
         $notafinal=($pp +$ppp+$pppp)/3;
        $stmt = ("INSERT INTO calificaciones
        (profile_id, primer, segundo, examen, total)
        VALUES ('$id','$pp','$ppp','$pppp','$notafinal')");
        $ejecutar=sqlsrv_query($pdo,$stmt);
    $_SESSION['status']=$_SESSION['status']+1;
    $_SESSION["success"] = "Se han Agregado las notas";
    header('Location: index.php');
}
 ?>
