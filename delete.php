<?php 
session_start();
include_once 'pdo.php'; 
$id=$_GET['profile_id'];
$consulta = "SELECT * FROM profile WHERE profile_id ='" .$id."' ";
$resulta = sqlsrv_query($pdo,$consulta);
$ex= sqlsrv_fetch_array($resulta, SQLSRV_FETCH_ASSOC);
$nombre = $ex['first_name'];
$second = $ex['last_name'];
if (isset($_POST['delete']) && isset($_POST['profile_id'])) {
    #Sentencia para eliminar
    $eliminar = "DELETE FROM profile WHERE profile_id ='" .$id."' ";
    sqlsrv_query($pdo, $eliminar) or die; 
    ?>
    <script>alert("El perfil ha sido eliminado!");</script>
    <?php 
    header('Location: index.php');

}
if(isset($_POST['cancel'])){
    header('Location: index.php');
    return;
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Perfil</title>
</head>
<body style="font-family: Helvetica">
    <h1>Eliminar Perfil</h1>
    <p>Nombre: <?php echo $nombre ?></p>
    <p>Apellido: <?php echo $second ?></p>
    <form method="post">
        <input
            type="hidden"
            name="profile_id"
            value="<?php echo $_GET['profile_id'] ?>"
        >
        <input type="submit" name="delete" value="Eliminar">
        <input type="submit" name="cancel" value="Cancelar">
    </form>
</body>
</html>