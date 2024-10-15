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
        
        $codigoasignatura = mysql_entities_fix_string($conexion, $_POST['codigoasignatura']);
        $codigodocente = mysql_entities_fix_string($conexion, $_POST['codigodocente']);
        $cicloac = mysql_entities_fix_string($conexion, $_POST['ciclo']);
        

        $query3 = "INSERT INTO docente_asignatura VALUES('$codigoasignatura', '$codigodocente', '$cicloac')";       
        $result3 = $conexion->query($query3);
        if (!$result3) {
          echo ($conexion->error);
        }
        else{
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
        popup('Desinacion Completada','opcion3.php'.$qr);
        }
        function mysql_entities_fix_string($conexion, $string)
    {
        return htmlentities(mysql_fix_string($conexion, $string));
      }
    function mysql_fix_string($conexion, $string)
    {
        if (get_magic_quotes_gpc()) $string = stripslashes($string);
        return $conexion->real_escape_string($string);
      }   
?>
