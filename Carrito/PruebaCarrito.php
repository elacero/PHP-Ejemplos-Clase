<html>
<head>
<script type="text/javascript">
function AjaxCambiaProducto(id)
{
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("productos").innerHTML=xmlhttp.responseText;
		}
	};
	xmlhttp.open("GET","comprar.php?Id="+id,true);
	xmlhttp.send();
}
</script>
</head>
<body>
<?php
require_once 'Modelo/LineaPedido.php';
require_once 'Librerias/Carrito.php';

//Creo el carrito
$MiCarro=new Carrito();

//Añado una nueva linea al carrito
$linea=new LineaPedido();
$linea->Cantidad=10;
$linea->IdProducto=1;
$linea->Precio=100;
$MiCarro->NuevaLinea($linea);

//Al añadir una nueva linea con el mismo producto no se crea sino que se suma
//la cantidad a la ya existente
$linea=new LineaPedido();
$linea->Cantidad=10;
$linea->IdProducto=1;
$MiCarro->NuevaLinea($linea);

//Valor del carrito
echo "<h2>Valor del carrito</h2>";
var_dump($MiCarro->getCarrito());
echo "Total de artículos ".$MiCarro->TotalArticulos();
echo "<br>";
echo "Total euros ...".$MiCarro->TotalPedido();
echo "<br>";
echo "<a href='VerCarro.php?Id={$MiCarro->getIdCarrito()}'>Ver carro</a>";
?>
<br>
<h2>Cambiar el total de productos con AJAX</h2>
<form>
<input type='button' onclick="AjaxCambiaProducto('<?php echo $MiCarro->getIdCarrito()?>')" value='Comprar'>
</form>
<h2>Total de productos: </h2>
<span id='productos'>0</span>

</body>
</html>
