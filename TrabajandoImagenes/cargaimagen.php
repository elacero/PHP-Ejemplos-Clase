<?php
require_once 'Librerias/AccesoBD.php';
require_once 'Librerias/Repositorio.php';
require_once 'Modelo/categoria.php';
$bd=new AccesoBaseDatos();
$con=$bd->CrearConexion('mysql:host=localhost;dbname=northwind',"root","aiv1010via");
$categorias=new Repositorio($bd, "categories");
$unacategoria=$categorias->getUno(1);
$foto=$unacategoria->Picture;
header("Content-type:image/jpeg");
echo $foto;
?>