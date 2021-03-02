<?php
require_once "pdo.php";
/////Se une las tablas para combinar los datos de los perfiles y calificaciones dependiendo de el id del perfil
$sqln=sqlsrv_query($pdo, "SELECT * FROM profile t1 INNER JOIN calificaciones t2 ON t1.profile_id=t2.profile_id");
$extraido = sqlsrv_fetch_array($sqln, SQLSRV_FETCH_ASSOC);
$first_na = $extraido['first_name'];
$last_na = $extraido['last_name'];
$head_la = $extraido['headline'];
      echo '<table border="1">'."\n";
      echo "<tr><td >";
      echo "Alumno";
      echo "</td><td>";
      echo "Curso";
      echo "</td><td>";
      echo "Nota final";
      echo "</td>";
      echo "<td>Opciones</td>";
      echo "<td> <a id='agreg' class='btn btn-warning align-text-bottom' href='add.php'>Agregar Nuevo Alumno</a></td>";
     
        while ($extraido = sqlsrv_fetch_array($sqln, SQLSRV_FETCH_ASSOC)) {
        
      echo "<tr><td>";
      echo "<a id='nombress' href='view.php?profile_id=" . $extraido['profile_id'] .
      "'>" . htmlentities($extraido['first_name'] . " " . $extraido['last_name']) .
      "</a>";
            echo("</td><td>");
            echo(htmlentities($extraido['headline']));
            echo ("<td>");

            echo $datos=$extraido['total'];

            echo(" </td>");
            echo'<td><a class="btn btn-outline-success" href="addnote.php?profile_id=' . $extraido['profile_id'] . '">Agregar Notas</a>';
            echo'  ';
            echo'<a class="btn btn-outline-warning" href="edit.php?profile_id=' . $extraido['profile_id'] .'">Editar</a>';
            echo'  ';
            echo'<a class="btn btn-outline-danger" href="delete.php?profile_id=' . $extraido['profile_id'] . '">Eliminar</a>';
            echo("</td>");
      
        }


?>