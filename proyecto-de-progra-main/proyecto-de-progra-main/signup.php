<?php 
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);
    if ($conexion->connect_error) die ("Fatal error");

    if(isset($_POST['correo']) && isset($_POST['contra']))
    {
        $nombre = mysql_entities_fix_string($conexion, $_POST['nombre']);
        $apellido = mysql_entities_fix_string($conexion, $_POST['apellido']);
        $pw_temp = mysql_entities_fix_string($conexion, $_POST['contra']);
        $correo = mysql_entities_fix_string($conexion, $_POST['correo']);
        $telefono = mysql_entities_fix_string($conexion, $_POST['telefono']);
        $codigo = mysql_entities_fix_string($conexion, $_POST['Codigo']);
        $rol = mysql_entities_fix_string($conexion, $_POST['rol']);
        $a =  "Alumno";
        $b = "Docente";
        $password = password_hash($pw_temp, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuario VALUES('$correo', '$password', '$rol')";       
        $result = $conexion->query($query);
          if($rol == $a){          
            $query2 = "INSERT INTO estudiante VALUES('$codigo', '$nombre', '$apellido','$correo','$telefono')";
            $result2 = $conexion->query($query2);
          }elseif($rol == $b){
            $query3 = "INSERT INTO docente VALUES('$correo','$codigo', '$nombre', '$apellido','$telefono')";
            $result3 = $conexion->query($query3);
          }

        if (!$result) die ("Falló registro");

        echo "Registro exitoso <a href='index.html'>Ingresar</a>";  
    }
    else
    {
       echo "Falta usuario o contraseña";
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