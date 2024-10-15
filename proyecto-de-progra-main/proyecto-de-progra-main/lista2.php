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
    $codAnio =  $_POST['codigoanio'];
    $codCurso =  $_POST['codigocurso'];
    
    if(isset($_POST['codigoanio']) && isset($_POST['codigocurso']) && isset($_POST['codigoestudiante']))
    {
        $codanio =  $_POST['codigoanio'];
        $codCu =  $_POST['codigocurso'];
        $codEst =  $_POST['codigoestudiante'];
        
        $query4 = "SELECT max(ID_asistencia) from asistencia where DATE_FORMAT(fecha, '%M %d %Y') = DATE_FORMAT(now(), '%M %d %Y')"; 
        $result4 = $conexion->query($query4);
        $rows = $result4->num_rows;
        $row = $result4->fetch_array(MYSQLI_NUM);
        $max= htmlspecialchars($row[0]);
        if (!$max){
          $max=0;
        }

        $maxid = $max+1;

        $query3 = "INSERT into asistencia (fecha,ID_asistencia,codigo_asignatura,codigo_anio,codigo_estudiante)
        values (now(),'$maxid','$codCu','$codanio','$codEst')";
        $result3 = $conexion->query($query3);
        if (!$result3){
        die ("Falló el acceso a la base de datos");
        }else{
        //header('Location: lista2.php');
        }

        // declare maxid int;
        // set maxid= (select max(ID_asistencia) from asistencia where DATE_FORMAT(fecha, "%M %d %Y")=DATE_FORMAT(now(), "%M %d %Y"));
        // if (maxid is null) then
        //  set maxid=0;
        // end if;
        // insert into asistencia (fecha,ID_asistencia,codigo_asignatura,codigo_anio,codigo_estudiante)
        // values (now(),maxid+1,codas,codan,codes);
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
    <!-- <nav>
      
      <div class="nav-wrapper container">
        <a href="#" class="brand-logo ">Registro de Asistencia</a>
        <a href="#" class="sidenav-trigger" data-target="menu-side"><i class="material-icons">menu</i></a>
        <ul class="hide-on-med-and-down right ">
          
          <li><a href="opcion2.php"><i class="material-icons right">book</i>Asistencia</a></li>
          <li><a href="cerrar.php"><i class="material-icons right">library_add</i>cerrar sesion</a></li>
           Dropdown Trigger 
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
      
    </script> -->
    

    <section class="form-registro">
    

   
    
      <?php
      
      $query = "SELECT a.nombre,a.apellidos,a.codigo_estudiante FROM estudiante a 
        inner join matricula b on a.codigo_estudiante=b.codigo_estudiante 
        where  codigo_asignatura='$codCurso'";
        $result = $conexion->query($query);
        if (!$result) die ("Falló el acceso a la base de datos");
        $rows = $result->num_rows;
     
      ?>
      
          <table><tr>
    
            <td width="100">Nombre</td>
            <td width="150">Apellido</td>
            <td width="150">Asistencia</td>
          </tr>
    
          <br> 
          </table>
          
      <?php
        for ($j = 0; $j < $rows; $j++)
          {
            $row = $result->fetch_array(MYSQLI_NUM);
            $nombreE = htmlspecialchars($row[0]);
            $apellidoE = htmlspecialchars($row[1]);
            $codEs = htmlspecialchars($row[2]);

            echo <<<_END
            <form action="lista2.php" method="POST">
              <table>
                <tr>  
                  <td width="100">$nombreE</td>
                  <td width="150">$apellidoE</td>
                  <td width="150">
                  <input type='hidden' name='codigoanio' value='$codAnio'>
                  <input type='hidden' name='codigocurso' value='$codCurso'>
                  <input type='hidden' name='codigoestudiante' value='$codEs'>
                  <input class="buttons" type="submit" name="" value="Presente" >
                  </td>
                </tr>
              </table>
            </form> 
            _END;
          
          }
          
    
      ?>
 
    </section>
    
  </body>
</html>