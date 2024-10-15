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
    $cod=$_POST['codigocurso'];
    $idestu=$_POST['codigoestudiante'];
    $codac=$_POST['codigoacademico'];

    
$query = "INSERT INTO matricula VALUES('$idestu', '$cod', '$codac')";
$result = $conexion->query($query);
if (!$result){
    echo ($conexion->error);
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
    popup('Matricula Completada','opcion.php');
}


?>