<?php
session_start();
class Carrito
{
	/**
	 * 
	 * @array colección de entidades LineaPedido pero indexada por clave primaria
	 * para facilitar los accesos
	 */
	private $carrito;
	private $total_Articulos;
	private $total_Pedido;
	private $NumeroLinea;
	/**
	 * 
	 * @String generado por uniqid que identifica un objeto carrito
	 */
	private $idObjeto;
	private $sesion;
	
	public function Carrito($datos=NULL)
	{
		//Inicializo propiedades
		if(!isset($datos))
		{
			$this->carrito=array();
		}
		else 
		{
			$this->carrito=$datos;
		}
		$this->total_Articulos=0;
		$this->total_Pedido=0;
		$this->idObjeto=uniqid();
		$this->NumeroLinea=1;
		//Creo la variable de sesión
		$_SESSION[$this->idObjeto]=$this;
		$this->sesion=$_SESSION[$this->idObjeto];
		
	}
	
	public function NuevaLinea($lineapedido)
	{
		$NumeroLinea=$this->ExisteProducto($lineapedido);
		if($NumeroLinea==-1)//No existe el producto
		{
			$lineapedido->NumeroLinea=$this->NumeroLinea;
			$this->carrito[$this->NumeroLinea]=$lineapedido;
			$this->NumeroLinea++;
		}
		else 
		{
			$this->ModificaLinea($NumeroLinea,$lineapedido);
		}
		//Actualizar campos
		$this->total_Articulos=$this->TotalArticulos();
		$this->total_Pedido=$this->TotalPedido();
	}
	
	public function BorraLinea($NumeroLinea)
	{
		unset($this->carrito[$NumeroLinea]);
		//Actualizar campos
		$this->total_Articulos=$this->TotalArticulos();
		$this->total_Pedido=$this->TotalPedido();
	}
	
	public function getCarrito()
	{
		return $this->carrito;
	}
	private function ExisteProducto($lineapedido)
	{
		$r=-1;
		foreach ($this->carrito as $linea)
		{
			if($linea->IdProducto==$lineapedido->IdProducto)
			{
				$r=$linea->NumeroLinea;
				break;
			}
		}
		return $r;
	}
	
	private function ModificaLinea($NumeroLinea,$lineapedido)
	{
		$this->carrito[$NumeroLinea]->Cantidad+=$lineapedido->Cantidad;
		//Actualizar campos
		$this->total_Articulos=$this->TotalArticulos();
		$this->total_Pedido=$this->TotalPedido();
	}
	
	public function TotalArticulos()
	{
		$total=0;
		foreach ($this->carrito as $lineapedido)
		{
			$total+=$lineapedido->Cantidad;
		}
		return $total;
	}
	
	public function TotalPedido()
	{
		$total=0;
		foreach ($this->carrito as $lineapedido)
		{
			$total+=$lineapedido->Precio*$lineapedido->Cantidad;
		}
		return $total;
	}
	
	public function getIdCarrito()
	{
		return $this->idObjeto;
	}
	
}