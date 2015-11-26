<?php
/**
 * Clase que identifica la entidad Linea de Pedido
 * La clave primaria es múltiple $NumeroLinea+$IdFactura
 * @author antonio
 *
 */
class LineaPedido
{
	/**
	 * [key]
	 */
	public $NumeroLinea;
	/**
	 * [key]
	 */
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