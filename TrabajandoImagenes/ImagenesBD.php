<html>
<head>
</head>
<body>
<?php
/******* Cargar imagen de forma dinámica desde una base de datos *****/
echo "<img src='cargaimagen.php' width='200px' height='200px' alt='imagen cargada'/>";
?>

/******* Leer imagen desde base de datos y guardar en un fichero *****/
<h1>Vamos a guardar la imagen en un fichero</h1>
<br>
<?php
require_once 'Librerias/AccesoBD.php';
require_once 'Librerias/Repositorio.php';
require_once 'Modelo/categoria.php';
$bd=new AccesoBaseDatos();
$con=$bd->CrearConexion('mysql:host=localhost;dbname=northwind',"root","aiv1010via");
$categorias=new Repositorio($bd, "categories");
$unacategoria=$categorias->getUno(1);
$foto=$unacategoria->Picture;
$d=fopen("Imagenes/imagen1.jpg", "w");
fwrite($d,$foto);
?>
</body>
</html>
