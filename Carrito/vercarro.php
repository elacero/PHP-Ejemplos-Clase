<?php
require_once 'Modelo/LineaPedido.php';
require_once 'Librerias/Carrito.php';

$MiCarro=$_SESSION[$_GET['Id']];

//Dibujemos el carrito
echo "<table>";
echo "<tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Total</th><tr>";
foreach ($MiCarro->getCarrito() as $lineapedido)
{
	echo "<tr>";
	echo "<td>$lineapedido->NombreProducto</td>";
	echo "<td>$lineapedido->Cantidad</td>";
	echo "<td>$lineapedido->Precio</td>";
	$aux=$lineapedido->Cantidad*$lineapedido->Precio;
	echo "<td>$aux</td>";
	echo "</tr>";
}
echo "<tr><td></td><td></td><td>Total...</td><td>{$MiCarro->TotalPedido()}</td>";
echo "</table>";