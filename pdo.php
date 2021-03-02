<?php
$serverName = "DESKTOP-SU16TSK\SQLEXPRESS"; 
$connectionInfo = array( "Database"=>"Proyecto");
$pdo = sqlsrv_connect( $serverName, $connectionInfo);
?>