<?php
class Carrito
{
	/**
	 * 
	 * @array colecci�n de entidades LineaPedido pero indexada por clave primaria
	 * para facilitar los accesos
	 */
	private $carrito;
	private $total_Articulos;
	private $total_Pedido;
	
	public function Carrito()
	{
		//Inicializo propiedades
		$this->carrito=array();
		$this->total_Articulos=0;
		$this->total_Pedido=0;
		
		//Creo la variable de sesi�n
		$_SESSION[]
	}
}