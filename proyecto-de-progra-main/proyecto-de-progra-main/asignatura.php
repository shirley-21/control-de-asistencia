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
    <title></title>
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
          
        <li><a href="docente_asignatura.php"><i class="material-icons right">book</i>Agregar asignatura</a></li>
      <li><a href="docente_asignatura.php"><i class="material-icons right">library_add</i>Asignar docente</a></li>
          <!-- Dropdown Trigger -->
          <li><a class="dropdown-trigger" href="#" data-target="caja">Bienvenido : <?php echo $rol ?><i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>
        <ul id="caja" class="dropdown-content">
          <li class="divider"></li>
          
      </li>
     
      <li>
        <a href="cerrar.php">
          <i class="material-icons">backspace</i>
          Cerrar sesion
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
            <span class="email white-text"><?php echo $nombre ?></span>
          </a>
        </div>
      </li>

      <li><a href="docente_asignatura.php"><i class="material-icons right">book</i>agregar asignatura</a></li>
      <li><a href="docente_asignatura.php"><i class="material-icons right">library_add</i>asignar docente</a></li>
      
      <li> <div class="divider"></div> </li>
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
          Cerrar sesion
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
      <h5>INGENIERIA DE SISTEMAS UNAJMA</h5>
      <form name="Nueva asignatura" action="asignarcurso.php" method="POST">
  </select>
     <br>     
     Codigo_asignatura :<input class="Rcontrols" type="text" name="codigoa" value="" placeholder="IIAC53">
     <br>
     Nombre del curso : <input class="Rcontrols" type="text" name="nombrea" value="" placeholder="Programacion Web">
     
      <br>
      <center><input class="Rbuttons" type="submit" name="" value="Nueva asignatura" ></center>
      <br>
      <a href ="vercursos.php" target="_blank">Ver cursos</a><br><br>
      </form>

      <form action=""></form>


    </section>
    
  </body>
</html>