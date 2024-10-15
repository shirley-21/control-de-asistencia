<?php 
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db);
    if ($conexion->connect_error) die ("Fatal error");

    if(isset($_POST['user']) && isset($_POST['contra']))
    {
        $nombre = mysql_entities_fix_string($conexion, $_POST['nombre']);
        $apellido = mysql_entities_fix_string($conexion, $_POST['apellido']);
        $username = mysql_entities_fix_string($conexion, $_POST['user']);
        $pw_temp = mysql_entities_fix_string($conexion, $_POST['contra']);
        $correo = mysql_entities_fix_string($conexion, $_POST['correo']);
        $telefono = mysql_entities_fix_string($conexion, $_POST['telefono']);
        $codigo = mysql_entities_fix_string($conexion, $_POST['Codigo']);

        $password = password_hash($pw_temp, PASSWORD_DEFAULT);
        $rol = "Alumno";
        $query = "INSERT INTO usuario VALUES('$username', '$password', '$rol')";
        $query2 = "INSERT INTO estudiante VALUES('$codigo', '$nombre', '$apellido','$username','$correo','$telefono')";

        $result = $conexion->query($query);
        $result2 = $conexion->query($query2);
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