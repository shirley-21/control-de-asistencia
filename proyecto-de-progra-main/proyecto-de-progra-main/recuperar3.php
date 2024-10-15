<?php
$email=$_GET['codigo'];
if(isset( $_POST['save'])){ 
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);
    if ($conexion->connect_error) die ("Fatal error");
    $contra1 = mysqli_real_escape_string($conexion,$_POST['contra']);
    $contra2 = mysqli_real_escape_string( $conexion,$_POST['contra2']);
    $pw_temp = mysqli_real_escape_string($conexion, $_POST['contra']);
    $password = password_hash($pw_temp, PASSWORD_DEFAULT);
    if($contra1 == $contra2){
      $query = " UPDATE usuario set contraseña='$password' where correo='$email'";       
        $result = $conexion->query($query);
        echo"contraseña cambiada con exito";
    }else{
        echo "Las contraseñas son distintas";
    }

}

  
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="stylerecuperar.css">
  </head>
  <body>
    <section class="form-recuperar">
      <h5>Restablecer contraseña</h5>
      <h1></h1>
      <br>
      <form name="sigup" action="" method="POST">
      <input class="controls" type="password" name="contra" value="" placeholder="contraseña nueva">
      
      <input class="controls" type="password" name="contra2" value="" placeholder="repita contraseña">
      <input class="buttons" onclick="" type="submit" name="save" value="Cambiar contraseña" >
      <br>

      </form>
     
    </section>

  
  </body>
</html>