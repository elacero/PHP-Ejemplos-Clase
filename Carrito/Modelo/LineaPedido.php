<?php
/**
 * Clase que identifica la entidad Linea de Pedido
 * @author antonio
 *
 */
class LineaPedido
{
	//*********************** ACLARACIONES **********************
	//La entidad LineaPedido cuando la persistamos en una base de datos relacional
	//tendrá como clave primaria los campos $NumeroLinea e $IdFactura
	//pero en mi carrito todavia no hemos facturado y cada linea queda identificada
	//por su número de linea
	public $NumeroLinea;
	public $IdFactura;
	public $IdProducto;
	public $NombreProducto;
	public $Precio;
	public $Cantidad;
	public $DescuentoProducto;
}

/**
 * La clase factura se utilizará si facturamos a clientes
 * En principio en clase esto no lo haremos solo crearemos el carrito
 * @author antonio
 *
 */
class Factura
{
	public $IdFactura;
	public $IVA;
	public $DescuentoFactura;
	public $IdCliente;
	public $FechaFactura;
	public $TotalFactura;
}