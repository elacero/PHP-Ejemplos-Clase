<?php
require_once 'Librerias/PreparaSesion.php';
?>
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
		<div id="menu">
			<a href='sesion.php'>Página protegida con SESION</a>
<?php
// session_start();
if (! isset ( $_SESSION ['autenticacion'] )) {
	echo "<a class='login' href='iniciarsesion.php'>Iniciar sesión</a>";
} else {
	echo "<a class='login' href='cerrarsesion.php'>
	Bienvenido {$_SESSION['autenticacion']}Cerrar sesión</a>";
}
?>
</div>
	</header>
	<div id='cuerpo'>{{body}}
	<?php
	require_once 'Librerias/clase.php';
	$objeto=new prueba();
	$objeto->setNombre("Juan");
	echo "<br>";
	echo "<h2>Probando el uso de código PHP en la plantilla</h2>";
	echo "Aquí esta el amigo ".$objeto->getNombre();
	?>
	</div>
	<br>
	<footer>
		<div id="pie">
			<h2>Desarrollado por 2DAA</h2>
		</div>
	</footer>
</body>
</html>