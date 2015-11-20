<?php
class xmlMantenimiento
{
	private $_xmlArchivo;
	private $_domDocumento;
	
	public  function __construct($xmlArchivo)
	{
		$this->_xmlArchivo=$xmlArchivo;
		$this->_domDocumento=new DOMDocument('1.0','iso-8859-1');
		$this->_domDocumento->load($xmlArchivo);
	}
	
	public function NuevoAlumno($nombre,$localidad,$unidad)
	{
		$Nuevo=$this->CreaNodo("Alumno");
		$Nuevo->setAttribute("Alumno", $nombre);
		$Nuevo->setAttribute("Localidad", $localidad);
		$Nuevo->setAttribute("Unidad", $unidad);

		return $Nuevo;
		
	}
	
	public function InsertaAlumnoDespuesde($Nombre,$Nuevo)
	{
		$this->InsertaNodoDespuesde($this->AlumnoPorNombre($Nombre), $Nuevo);
	}
	
	public function BorrarAlumno($NodoAlumno)
	{
		$this->NodoRaiz()->removeChild($NodoAlumno);
	}
	
	public function ModificaAlumno($Actual, $Nuevo)
	{
		$Actual->setAttribute("Alumno",$Nuevo->getAttribute("Alumno"));
		$Actual->setAttribute("Localidad",$Nuevo->getAttribute("Localidad"));
		$Actual->setAttribute("Unidad",$Nuevo->getAttribute("Unidad"));
	}
	
	public function TodosAlumnos()
	{
		return $this->TodosNodos("Alumno");
	}
		
	public function AlumnoPorNombre($nombre)
	{
		$alum=NULL;
		foreach ($this->TodosAlumnos() as $Alumno)
		{
			if($Alumno->getAttribute("Alumno")==$nombre)
			{
				$alum=$Alumno;
				break;
			}
		}
		return $alum;
	}
	
	public function Grabar()
	{
		$this->_domDocumento->save($this->_xmlArchivo);
	}
	
	private function TodosNodos($NodoNombre)
	{
		return $this->_domDocumento->getElementsByTagName($NodoNombre);
	}
	
	private function  NodoRaiz()
	{
		return $this->_domDocumento->documentElement;
	}
	
	private function CreaNodo($NodoNombre)
	{
		return $this->_domDocumento->createElement($NodoNombre);
	}
	
	private function InsertaNodoAntesde($NodoOrigen,$NodoNuevo)
	{
		$NodoOrigen->insertBefore($NodoNuevo);
	}
	
	private function InsertaNodoDespuesde($NodoOrigen,$NodoNuevo)
	{
		$NodoOrigen->appendChild($NodoNuevo);
	}
}