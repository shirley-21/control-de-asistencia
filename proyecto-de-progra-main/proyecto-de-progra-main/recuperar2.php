<?php
require_once 'login.php';
$conexion = new mysqli($hn, $un, $pw, $db, $port);

if($conexion->connect_error) die("Error fatal");
$token=$_GET['token'];
$email=$_GET['codigo'];
$query = "SELECT * FROM restablecer where token='$token' and fecha >= '2021-01-24'";
$result = $conexion->query($query);
if (!$result) die ("Falló el acceso a la base de datos");
$rows = $result->num_rows;
$row = $result->fetch_array(MYSQLI_NUM);
if($rows>=1){
header('location: recuperar3.php?codigo='.$email);
}else{
  echo "Su solicitud de cambio de contraseña ya ha caducado";
}


?>

