<?php
function generar_token_seguro($longitud)
{
    if ($longitud < 4) {
        $longitud = 4;
    }
 
    return bin2hex(openssl_random_pseudo_bytes(($longitud - ($longitud % 2)) / 2));
}

require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);
    if ($conexion->connect_error) die ("Fatal error");

    if(isset($_POST['email']) )
    {
        
        
        $email = mysql_entities_fix_string($conexion, $_POST['email']);
        $token= generar_token_seguro(8);
        
        
        $query = "INSERT INTO restablecer (correo,fecha,token)VALUES('$email', ADDDATE(now(), INTERVAL '3' hour), '$token')";
        $result = $conexion->query($query); 
        $link = "http://localhost/proyecto-de-progra/recuperar2.php?token=".$token."&codigo=".$email;
              
		
		$asunto='Solicitud de Restablecimiento de contraseña';
	
		$header = "From: noreply@example.com" . "\r\n";
		$header.= "Reply-to: noreply@example.com" . "\r\n";
		$header.= "X-Mailer: PHP/" . phpversion();
		$mail = @mail($email,$asunto,$link,$header);
		if ($mail) {
			echo "<h4>¡Mail enviado exitosamente!</h4>";
		}
	


        
        if (!$result) die ($conexion->error);

  
    }else{
        echo "llene los campos";
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