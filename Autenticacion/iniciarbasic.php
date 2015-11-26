<?php
if(!isset($_SERVER['PHP_AUTH_USER']))
{
	header('WWW-Authenticate: Basic realm="Mi dominio"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Debes autentificarte para entrar en esta página';
    echo "<a href='index.php'>Volver</a>";
    exit;
	
}
else 
{
	echo "Hola {$_SERVER['PHP_AUTH_USER']}";
	echo "Has introducido {$_SERVER['PHP_AUTH_PW']} como contraseña";
}

echo "<a href='index.php'>Volver</a>";