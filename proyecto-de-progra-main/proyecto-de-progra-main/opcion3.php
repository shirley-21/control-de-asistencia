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
    <?php

         //echo "
         echo <<<_END
         <br>
         <form name="asis" action="asignatura.php" method="POST">
         <input class="buttons" type="submit" name="" value="Agregar Cursos" >
         </form>
         <form name="asis" action="docente_asignatura.php" method="POST">
         <input class="buttons" type="submit" name="" value="Designar Curso" >
         </form>
         <br>
         _END;
         //";
        
    ?>
    </section>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  </body>
</html>