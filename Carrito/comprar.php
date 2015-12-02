<?php
require_once 'Modelo/LineaPedido.php';
require_once 'Librerias/Carrito.php';

$MiCarro=$_SESSION[$_GET['Id']];
$linea=new LineaPedido();
$linea->Cantidad=30;
$linea->IdProducto=4;
$linea->Precio=10;
$MiCarro->NuevaLinea($linea);
echo $MiCarro->TotalArticulos();
?>
