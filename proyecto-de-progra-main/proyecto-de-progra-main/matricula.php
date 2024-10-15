<?php
session_start();
//error_reporting(0);
if(isset( $_SESSION['correo'])){
    $nombre=$_SESSION['correo'];
    $rol=$_SESSION['rol'];
    $a =  "Alumno";
}else{
echo 'usted no tiene autorizacion';
die();}
require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);

    if($conexion->connect_error) die("Error fatal");
    
$query = "SELECT * FROM estudiante where correo='$nombre'";
$result = $conexion->query($query);
if (!$result) die ("Falló el acceso a la base de datos");
$rows = $result->num_rows;
$row = $result->fetch_array(MYSQLI_NUM);

$idestu = htmlspecialchars($row[0]);
$nombr = htmlspecialchars($row[1]);
$apel = htmlspecialchars($row[2]);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>registro de usuario</title>
    <link rel="stylesheet" href="style.css">
    <!--Import Google Icon Font-->
    <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->

    <!-- Compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->

  </head>
  <body>
     
    

    <section class="form-vista">
      
    <h3>Cursos</h3>
     
    ciclo academico: 
    <form action ="" method="post">
      <select name="opcion" >
        <?php
        $query3 = "SELECT codigo_anio FROM ciclo_Academico";
        $result3 = $conexion->query($query3);
        if (!$result3) die ("Falló el acceso a la base de datos");
        $rows = $result3->num_rows;
        for ($j = 0; $j < $rows; $j++)
        {
        $row = $result3->fetch_array(MYSQLI_NUM);
        $anio = htmlspecialchars($row[0]);
        echo "<option value='$anio'>$anio</option>";       
        }

        ?>
       <input name="enviar" type="submit"></input>
      </select>
    </form>  
    <?php
      if (isset($_POST['enviar'])){
      $anio = $_POST['opcion'];
      $query2 = "SELECT * FROM asignatura";
      $result = $conexion->query($query2);
      if (!$result) die ("Falló el acceso a la base de datos");
      $rows = $result->num_rows;
  
      for ($j = 0; $j < $rows; $j++)
      {
      $row = $result->fetch_array(MYSQLI_NUM);
      $cod = htmlspecialchars($row[0]);
      $nom = htmlspecialchars($row[1]);
      echo "$cod";
      echo "$nom";
      //echo "
      echo <<<_END
      <br>
      <form name="asis" action="matricular.php" method="POST">
      <input type='hidden' name='codigocurso' value='$cod'>
      <input type='hidden' name='codigoestudiante' value='$idestu'>
      <input type='hidden' name='codigoacademico' value='$anio'>
      <input class="buttons" type="submit" name="" value="matricularse" >
      </form>
      <br>
      _END;
      //";
      }
    }    
    ?>
    </section>
    
  </body>
</html>