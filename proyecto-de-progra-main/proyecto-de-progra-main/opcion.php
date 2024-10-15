<?php
session_start();
//error_reporting(0);
if(isset( $_SESSION['correo'])){
    $nombre=$_SESSION['correo'];
    $rol=$_SESSION['rol'];
    $a =  "Alumno";
    $b =  "Docente";
    $c = "Administrador";
}else{
echo 'usted no tiene autorizacion';
die();
}
require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);

    if($conexion->connect_error) die("Error fatal");
if($rol==$a){
  $query = "SELECT * FROM estudiante where correo='$nombre'";
  $result = $conexion->query($query);
  if (!$result) die ("Falló el acceso a la base de datos");
  $rows = $result->num_rows;
  $row = $result->fetch_array(MYSQLI_NUM);
  
  $idestu = htmlspecialchars($row[0]);
  $nombr = htmlspecialchars($row[1]);
  $apel = htmlspecialchars($row[2]);
}else{ if($rol==$b){
  $query = "SELECT * FROM docente where correo='$nombre'";
  $result = $conexion->query($query);
  if (!$result) die ("Falló el acceso a la base de datos");
  $rows = $result->num_rows;
  $row = $result->fetch_array(MYSQLI_NUM);
  
  $iddoc = htmlspecialchars($row[1]);
  }
  
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>registro de usuario</title>
    <link rel="stylesheet" href="style.css">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

  </head>
  <body>
    <nav>
      
      <div class="nav-wrapper container">
        <a href="#" class="brand-logo ">Registro de Asistencia</a>
        <a href="#" class="sidenav-trigger" data-target="menu-side"><i class="material-icons">menu</i></a>
        <ul class="hide-on-med-and-down right ">
          
          <li><a href="opcion.php"><i class="material-icons right">book</i>Asistencia</a></li>
          <li><a href="matricula.php"><i class="material-icons right">library_add</i>Matricularse</a></li>
          <!-- Dropdown Trigger -->
          <li><a class="dropdown-trigger" href="#" data-target="caja"><?php echo $rol.': '.$nombr.' '.$apel ?><i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
        <ul id="caja" class="dropdown-content">
          <li><a href="#"><?php echo $nombr.' '.$apel ?></a></li>
          <li><a href="#"><?php echo $nombre ?></a></li>
          <li class="divider"></li>
          <li>
        <a href="recuperar3.php">
          <i class="material-icons">autorenew</i>
          Cambiar contraseña
        </a>
      </li>
      <li>
        <a href="">
          <i class="material-icons">cloud</i>
          Acerca de
        </a>
      </li>
      <li class="divider"></li>
      <li>
        <a href="cerrar.php">
          <i class="material-icons">backspace</i>
          Cerra sesion
        </a>
      </li>
        </ul>

      </div>
      

    </nav>

    <div class="container section">
    <ul class="sidenav" id="menu-side">
      <li>
        <div class="user-view">
          <div class="background">
            <img src="mora.jpg" alt="">
          </div>
          <a href="#" >
            <img src="user.jpg" alt="" class="circle">
          </a>
          <a>
            <span class="name white-text"><?php echo $nombr.' '.$apel ?></span>
          </a>
          <a>
            <span class="email white-text"><?php echo $nombre ?></span>
          </a>
        </div>
      </li>

      <li><a href="opcion.php"><i class="material-icons right">book</i>Asistencia</a></li>
      <li><a href="matricula.php"><i class="material-icons right">library_add</i>matricularse</a></li>
      <li><a class="dropdown-trigger" href="#" data-target="dropdown1">Dropdown<i class="material-icons right">arrow_drop_down</i></a></li>


      <li> <div class="divider"></div> </li>
      <li>
        <a href="recuperar3.php">
          <i class="material-icons">autorenew</i>
          Cambiar contraseña
        </a>
      </li>
      <li>
        <a href="">
          <i class="material-icons">cloud</i>
          Acerca de
        </a>
      </li>
      <li> <div class="divider"></div> </li>
      <li>
        <a href="cerrar.php">
          <i class="material-icons">backspace</i>
          Cerra sesion
        </a>
      </li>
    </ul>
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);

        // const elemsDropdown = document.querySelectorAll('.dropdown-trigger');
        // const instancesDropdown = Dropdown.init(elemsDropdown);
        M.AutoInit();
      });
      
    </script>
    

    <section class="form-registro">
    <?php
    
   



    $query2 = "SELECT c.codigo_asignatura,c.nombre,a.codigo_estudiante,a.nombre FROM estudiante a 
    inner join matricula b on a.codigo_estudiante=b.codigo_estudiante 
    inner join asignatura c on b.codigo_asignatura=c.codigo_asignatura 
    where b.codigo_estudiante='$idestu'";
    $result = $conexion->query($query2);
    if (!$result) die ("Falló el acceso a la base de datos");
    $rows = $result->num_rows;
    for ($j = 0; $j < $rows; $j++)
    {
    $row = $result->fetch_array(MYSQLI_NUM);
    $cod = htmlspecialchars($row[0]);
    $nom = htmlspecialchars($row[1]);
    $codest = htmlspecialchars($row[2]);
    $nomest = htmlspecialchars($row[3]);
    echo "$cod";
    echo "$nom";
    //echo "
    echo <<<_END
    <br>
    <form name="asis" action="lista.php" method="POST">
    <input type='hidden' name='codigocurso' value='$cod'>
    <input type='hidden' name='nombrecurso' value='$nom'>
    <input type='hidden' name='codigoestudiante' value='$codest'>
    <input type='hidden' name='nombreestudiante' value='$nomest'>
    <input class="buttons" type="submit" name="" value="ver asistencia" >
    </form>
    <br>
    _END;
    //";
    }

    ?>
    </section>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  </body>
</html>