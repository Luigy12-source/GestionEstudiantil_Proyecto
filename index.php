<?PHP
session_start(); 
$_SESSION['status']=true;
require_once "pdo.php";
/////Se une las tablas para combinar los datos de los perfiles y calificaciones dependiendo de el id del perfil
$sqln=sqlsrv_query($pdo, "SELECT * FROM profile t1 INNER JOIN calificaciones t2 ON t1.profile_id=t2.profile_id");
$extraido = sqlsrv_fetch_array($sqln, SQLSRV_FETCH_ASSOC);
$first_na = $extraido['first_name'];
$last_na = $extraido['last_name'];
$head_la = $extraido['headline'];
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <link rel="stylesheet" href="estilitos.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript">
		function tiempoReal()
		{
			var tabla = $.ajax({
				url:'obtenerdatos.php',
				dataType:'text',
				async:false
			}).responseText;

			document.getElementById("miTabla").innerHTML = tabla;
		}
		setInterval(tiempoReal, 1000);
		</script>
    <meta charset="utf-8">
    <title>Inicio</title>
  </head>
  <body>
  <h3 class="badge bg-secondary" id="text">Sistema de Gestión de Estudiantes</h3>
<?php
if (isset($_SESSION['user_id'])){
?>
<div id="Contenedor" class="d-flex flex-column-reverse">
<nav class="navbar navbar-lightclass" style="width: 250px;">
  <form id ="bot" class="form-inline d-flex justify-content-center" action="" method="POST">
    <input class="form-control mr-sm-2" type="search" placeholder="Buscar Alumno" aria-label="Search"  name="nam">
    <input type="submit"  class="btn btn-primary" name="opp" value="Buscar">
  </form>
</nav>
<div id="info" class="d-flex justify-content-center">
<?php 
if(isset($_POST['opp'])){
      ////Procedimiento para mostrar datos
      $busqueda=$_POST['nam'];
      $preliminar='exec buscar_nombre @nomb = '.$busqueda;
      $xds=sqlsrv_query($pdo,$preliminar); 
      $pop = sqlsrv_fetch_array($xds, SQLSRV_FETCH_ASSOC);
      echo "Información del alumno: <br />";
      echo "Nombre: ",$pop['first_name']."<br />";
      echo "Apellido: ",$pop['last_name']."<br />";
      echo "Correo: ",$pop['email']."<br />";
    }
?>
</div>
</div>
<?php
}
              if (isset($_SESSION['success']) ) {
                echo '<p class="alert alert-success" role="alert"">'.$_SESSION['success']."</p>\n";
                unset($_SESSION['success']);
            }
              if (!isset($_SESSION['user_id'])) {
                ?>
                <html>    
                <div id="conte" class="d-flex justify-content-around">

                <div class="card text-dark bg-warning mb-3" style="max-width: 18rem;">
  <div class="card-header"><b>Visión</b></div>
  <div class="card-body">
    <h5 class="card-title"></h5>
    <p class="card-text" id="jus1">Una base de datos es en esencia una colección estructurada de datos relacionados entre si, de la cual los usuarios pueden extraer información.

Se basa en el concepto de encapsular los datos en un objeto y el codigo que opera sobre ellos.

Seguridad en la información ya que usuarios o personas no autorizadas no pueden acceder a la información..</p>
  </div>
  
</div>
<div id="login" class="looogin">
                <div id="olo" class="card" style="width: 18rem;">
  <img src="Recursos/icon1.png" class="card-img-top" alt="">
  <div class="card-body">
    <h5 class="card-title">Bienvenido!</h5>
    <p class="card-text">Nos Alegra que estes aquí. Inicia sesion para continuar!</p>
    <a href="login.php" class="btn btn-primary">Iniciar Sesion</a>
  </div>
</div>

</div>
<div class="card text-dark bg-info mb-3" style="max-width: 18rem;">
  <div class="card-header"><b>Propósitos</b></div>
  <div class="card-body">
    <h5 class="card-title"></h5>
    <p class="card-text ">Almacenar la información en una sola parte para que no haya datos ambiguos, es decir a veces la información pueda estar repetida en diferentes partes.
Guardar la información importante de las organizaciones, empresas y personas de una manera organizada, y que sea de fácil recuperación.</p>
  </div>           
  </div>
  </div>
              <?php
              }else{
                ?>
                  <a id="cerrar_sesion" class="btn btn-outline-danger mr-2" href="logout.php">Cerrar Sesion</a>
  
                <?php
                              }
    if (isset($_SESSION['user_id'])){
      ?>
      <div class="tablita">
      <section id="miTabla" >
		</section>
    <footer>
		</footer>
    </div>
    <?php 
  }
 
 ?>
 </div>


          

  </body>

</html>
