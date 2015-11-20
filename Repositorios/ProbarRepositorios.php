<?php
require_once 'Librerias/AccesoBD.php';
require_once 'Librerias/Repositorio.php';
require_once 'Modelo/producto.php';

$bd=new AccesoBaseDatos();
$con=$bd->CrearConexion('mysql:host=localhost;dbname=northwind',"root","aiv1010via");
$repositorio=new Repositorio($bd,"products");
//var_dump($repositorio->getTodos());

//Creo un nuevo producto
$nuevoproducto=new products();
$nuevoproducto->ProductID=90;
$nuevoproducto->Discontinued=0;
$nuevoproducto->UnitPrice=10.5;
$nuevoproducto->ProductName="Calabazas";
$nuevoproducto->UnitsInStock=20;
$nuevoproducto->CategoryID=2;
$nuevoproducto->SupplierID=1;
$nuevoproducto->UnitsOnOrder=2;
$nuevoproducto->ReorderLevel=10;
$nuevoproducto->QuantityPerUnit=5;
$repositorio->Nuevo($nuevoproducto);

//Busco producto de código 1 y lo modifico
$producto=$repositorio->getUno(1);
$producto->ProductName="Nombre cambiado";
$repositorio->Modificar($producto);
$repositorio->GrabarCambios();
var_dump($repositorio->getTodos());
