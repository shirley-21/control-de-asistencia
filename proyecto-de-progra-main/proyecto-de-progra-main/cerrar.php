<?php
session_start();
setcookie(session_name(), '', time()-2592000, '/');
session_destroy();
header('Location: index.html');
?>