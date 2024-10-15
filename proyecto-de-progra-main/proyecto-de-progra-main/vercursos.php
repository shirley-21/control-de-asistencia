<?php
session_start();
//error_reporting(0);
if(isset( $_SESSION['correo'])){
    $nombre=$_SESSION['correo'];
    $rol=$_SESSION['rol'];
    $c="Administrador";
}else{
echo 'usted no tiene autorizacion';
die();
}
if ($rol==$c){
    
}else{
    
    function popup($vMsg,$vDestination) {
        echo("<html>\n");
        echo("<head>\n");
        echo("<title>System Message</title>\n");
        echo("<meta http-equiv=\"Content-Type\" content=\"text/html;
        charset=iso-8859-1\">\n");
         
        echo("<script language=\"javascript\" type=\"text/javascript\">\n");
        echo("alert('$vMsg');\n");
        echo("window.location = ('$vDestination');\n");
        echo("</script>\n");
        echo("</head>\n");
        echo("<body>\n");
        echo("</body>\n");
        echo("</html>\n");
        exit;
        }      
    popup('El usuario no tiene permiso para entrar a esta página','opcion.php'.$qr);    
}

require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);

    if($conexion->connect_error) die("Error fatal");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>registro de asistencia</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <section class="form-registro">
    
    <?php
  $query = "SELECT * FROM asignatura";
  $result = $conexion->query($query);
  if (!$result) die ("Falló el acceso a la base de datos");
  $rows = $result->num_rows;
  ?>
  
      <table><tr>
      <td  width="150">Codigo</td>
        <td width="250">Curso</td>       
      </tr>

      <br>  
      
      <?php
      for ($j = 0; $j < $rows; $j++)
      {
      $row = $result->fetch_array(MYSQLI_NUM);
      $codigo = htmlspecialchars($row[0]);
      $curso = htmlspecialchars($row[1]);
      echo <<<_END
      <table>
      <tr>
        <td HEIGHT="30" width="150">$codigo</td>
        <td HEIGHT="30" width="250">$curso</td>
      </tr>  
      _END;
      
      }

    ?>
    </section>
    
  </body>
</html>