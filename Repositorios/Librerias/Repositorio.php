<?php
require_once 'Librerias/AccesoBD.php';
class Repositorio
{
	/**
	 * @var colección de datos del repositorio
	 * ejemplo: $ColeccionObjetos=array([clave]=>array([objeto],[estado]),...)
	 */
	private $ColeccionObjetos;
	private $Entidad;
	private $BD;
	
	public function Repositorio($accesoBD,$entidad)
	{
		$this->Entidad=$entidad;
		$this->BD=$accesoBD;
		$this->CargarDatos();
	}
	
	private function CargarDatos()
	{
		$this->ColeccionObjetos=$this->PasarAsociativo($this->BD->getTodos($this->Entidad));
	}
	
	public function Nuevo($objeto)
	{
		$this->ColeccionObjetos[$objeto->getClave()][0]=$objeto;
		$this->ColeccionObjetos[$objeto->getClave()][1]=3;
	}
	
	public function Borrar($objeto)
	{
		//unset($this->ColeccionObjetos[$objeto->getClave()]);
		$this->ColeccionObjetos[$objeto->getClave()][1]=2; //Estado borrado
	}
	
	public function Modificar($objeto)
	{
		$this->ColeccionObjetos[$objeto->getClave()][0]=$objeto;
		$this->ColeccionObjetos[$objeto->getClave()][1]=1; //Estado modificado
	}
	
	public function getTodos()
	{
		//return $this->ColeccionObjetos; hay que quitar los borrados
		$retornar=array();
		foreach ($this->ColeccionObjetos as $objeto)
		{
			if($objeto[1]!=2)
			{
				$retornar[$objeto[0]->getClave()]=$objeto[0];
			}
		}
		return $retornar; //Devuelve la colección de objetos sin el estado.
	}
	
	public function getUno($clave)
	{
		return $this->ColeccionObjetos[$clave][0];
	}
	
	public function GrabarCambios()
	{
		$this->BD->ActualizarConColeccion($this->ColeccionObjetos,$this->Entidad);
		//Cargo de nuevo los datos para quwe el estado pase a 0 en todos
		$this->CargarDatos();
	}
	
	/**
	 * Pasa la colección de objetos  recibida desde BD
	 * a colección de objetos asociativa por clave y ademas crea 
	 * para cada objeto un elemento donde pondré el estado (0-sin cambios, 1-Modificado, 2-Borrado, 3-Nuevo)
	 * @param $ColeccionObjetos recibida desde la BD
	 * @return $datos, array asociativo en formato $datos=array([clave]=>array([objeto],[estado]),...)
	 */
	private function PasarAsociativo($ColeccionObjetos)
	{
		$datos=array();
		foreach ($ColeccionObjetos as $objeto)
		{
			$datos[$objeto->getClave()][0]=$objeto;
			$datos[$objeto->getClave()][1]=0;
		}
		return $datos;
	}
}
