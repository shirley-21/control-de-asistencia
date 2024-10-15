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

    if(isset($_POST['codigoa']) && isset($_POST['nombrea']))
    {
        $codigoa = mysql_entities_fix_string($conexion, $_POST['codigoa']);
        $nombrec = mysql_entities_fix_string($conexion, $_POST['nombrea']);

        $query3 = "INSERT INTO asignatura VALUES('$codigoa','$nombrec')";       
        $result3 = $conexion->query($query3);
        if (!$result3) die ("Falló el acceso a la base de datos");
        echo "Curso Guardado";
        
        echo <<<_END
            <br>
            <form name="asis" action="opcion3.php" method="POST">
            <input class="buttons" type="submit" name="" value="Continuar" >
            </form>
            <br>
            _END;

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

