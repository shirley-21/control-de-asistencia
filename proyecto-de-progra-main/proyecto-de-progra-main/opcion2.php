<?php
session_start();
//error_reporting(0);
if(isset( $_SESSION['correo'])){
    $nombre=$_SESSION['correo'];
    $rol=$_SESSION['rol'];
}else{
echo 'usted no tiene autorizacion';
die();
}
require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);

    if($conexion->connect_error) die("Error fatal");

  $query = "SELECT * FROM docente where correo='$nombre'";
  $result = $conexion->query($query);
  if (!$result) die ("Falló el acceso a la base de datos");
  $rows = $result->num_rows;
  $row = $result->fetch_array(MYSQLI_NUM);
  
  $iddoc = htmlspecialchars($row[1]);
  $nombr = htmlspecialchars($row[2]);
  $apel = htmlspecialchars($row[3]);

  


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>registro de usuario</title>
    <link rel="stylesheet" href="style.css">
    

  </head>
  <body>
    
    

    <section class="form-registro">
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
        $query2 = "SELECT c.codigo_asignatura,c.nombre,a.codigo_docente,a.nombre_docente FROM docente a 
        inner join docente_asignatura b on a.codigo_docente=b.codigo_docente 
        inner join asignatura c on b.codigo_asignatura=c.codigo_asignatura 
        where b.codigo_docente='$iddoc'";
        $result = $conexion->query($query2);
        if (!$result) die ("Falló el acceso a la base de datos");
        $rows = $result->num_rows;
        for ($j = 0; $j < $rows; $j++)
        {
        $row = $result->fetch_array(MYSQLI_NUM);
        $cod = htmlspecialchars($row[0]);
        $nom = htmlspecialchars($row[1]);
        $coddoc = htmlspecialchars($row[2]);
        $nomdoc = htmlspecialchars($row[3]);
        echo "$cod";
        echo "$nom";
        //echo "
        echo <<<_END
        <br>
        <form name="asis" action="lista2.php" method="POST">
          <input type='hidden' name='codigocurso' value='$cod'>
          <input type='hidden' name='codigoanio' value='$anio'>
          <input class="buttons" type="submit" name="" value="llenar asistencia" >
        </form>
        <br>
        _END;
        //";
        }
     
      
    }    
    ?>
    </section>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  </body>
</html>