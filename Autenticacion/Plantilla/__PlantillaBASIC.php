<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Autenticación</title>
<link rel="stylesheet" href='CSS/estilos.css' type='text/css'>
</head>
<body>
<header>
<div id="cabecera">
<h1>Métodos de Autenticación</h1>
</div>
<div id ="menu">
<a href='httpbasic.php'>Página protegida HTTP BASIC</a>
<?php 
var_dump($_SERVER['PHP_AUTH_USER']);
if(!isset($_SERVER['PHP_AUTH_USER']))
{
	echo "<a class='login' href='iniciarbasic.php'>Iniciar sesión</a>";
}
else 
{
	echo "<a class='login' href='cerrarbasic.php'>
	Bienvenido {$_SERVER['PHP_AUTH_USER']}Cerrar sesión</a>";
}
?>
</div>
</header>
<div id='cuerpo'>
{{body}}
</div>
<br>
<footer>
<div id="pie">
<h2>Desarrollado por 2DAA</h2>
</div>
</footer>
</body>
</html>