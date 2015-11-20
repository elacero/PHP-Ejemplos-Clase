<?php
class AccesoBaseDatos
{
	private $conexion;
	private $dsn, $username, $passwd, $options;
	private $mensaje_error;
	
	
	/**
	 * 
	 * @param string $d dsn de la conexión
	 * @param string $u opcional, nombre de usuario
	 * @param string $p opcional, contraseña
	 * @param string $op opcional, parámetros de la conexión
	 * @return NULL
	 */
	function CrearConexion($d,$u="",$p="",$op=null)
	{
		$this->dsn=$d;
		$this->passwd=$p;
		$this->username=$u;
		$this->options=$op;
		try {
			$this->conexion=new PDO($d, $u, $p, $op);
			$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $this->conexion;
		} catch (Exception $e) {
			$this->mensaje_error=$e->getMessage();
			return null;
		}
		
	}
	
	/**
	 * Método que añade un nuevo registro a la BD
	 * @param object $objeto que contiene los valores
	 * @param string $entidad opcional, Nombre de la tabla sino existe se tomará como
	 * nombre de la tabla el nombre de la clase que representa el objeto.
	 */
	function Nuevo($objeto,$entidad="")
	{
		$_entidad=$entidad==""?get_class($objeto):$entidad;
		$_campos=get_object_vars($objeto);
		$statement="insert into $_entidad (";
		foreach ($_campos as $key=>$valor)
		{
			$statement= $statement.$key.",";
		}
		$statement=substr($statement, 0,strlen($statement)-1).") values (";
		foreach ($_campos as $key=>$valor)
		{
			$aux=isset($valor)?$valor:'';
			if(gettype($valor)=="string")
			{
				$statement=$statement."'".$aux."',";
			}
			else 
			{
				$statement=$statement.$aux.",";
			}
		}
		$statement=substr($statement, 0,strlen($statement)-1).")";
		try 
		{
			$this->conexion->query($statement);
		} catch (Exception $e)
		{
			echo $e->getMessage();
		}
		
	}
	
	/**
	 * Método que borra un  registro de la BD
	 * @param object $objeto que contiene los valores
	 * @param string $entidad opcional, Nombre de la tabla sino existe se tomará como
	 * nombre de la tabla el nombre de la clase que representa el objeto.
	 */
	public function Borra($objeto,$entidad="")
	{
		$clave=$this->BuscaClave($objeto);
		
		$_entidad=$entidad==""?get_class($objeto):$entidad;
		$_campos=get_object_vars($objeto);
		$statement="delete from $_entidad where ";
		$filtro="";
		for($i=0;$i<count($clave);$i++)
		{
			$filtro=$filtro.$clave[$i][0]."=".$clave[$i][1];
			if($i!=count($clave)-1)
			{
				$filtro=$filtro." and ";
			}
		}
		$statement=$statement.$filtro;
		var_dump($statement);
		
		try
		{
			$this->conexion->query($statement);
		} catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function getTodos($entidad)
	{
		$datos=$this->conexion->query("select * from $entidad");
		$resul=$datos->fetchAll(PDO::FETCH_CLASS,$entidad);
		//var_dump($resul);
		return $resul;
	}
	
	/**
	 * 
	 * @param unknown $objeto
	 * @param string $entidad
	 */
	public function Modifica($objeto,$entidad="")
	{
		//***** Antes de nada aquí voy a utilizar prepare statement para que ustedes vean
		//***** los dos métodos de trabajo. Recuerda, la cadena que tenemos que formar es:
		//***** UPDATE TABLA SET COLUMNA1=?, COLUMNA2=?... WHERE KEY1=? AND ...
		
		$clave=$this->BuscaClave($objeto);
		
		$_entidad=$entidad==""?get_class($objeto):$entidad;
		$_campos=get_object_vars($objeto);
		$statement="update $_entidad set ";
		
		//Generamos la parte COLUMNA1=?,...
		foreach ($_campos as $key=>$valor)
		{
			if(NoesClave($key,$clave))//La clave no se puede modificar
			{
				$statement= $statement.$key."=?,";
			}
		}
		$statement=substr($statement, 0,strlen($statement)-1)." where ";
		
		//Generamos la parte KEY1=? and ...
		for($i=0;$i<count($clave);$i++)
		{
			$statement=$statement.$clave[$i][0]."=?";
			if($i!=count($clave)-1)
			{
				$filtro=$filtro." and ";
			}
		}
		//Generamos el prepare
		$sentencia=$this->conexion->prepare($statement);
		
		//Creamos los valores de los parametros
		$indiceparametro=1;
		foreach ($_campos as $key=>$valor)
		{
			switch (gettype($valor))
			{
				case "string":
					$param=PDO::PARAM_STR;
					break;
				case "integer":
					$param=PDO::PARAM_INT;
					break;
				default:
					$param=PDO::PARAM_INT;
			}
			$sentencia->bindParam($indiceparametro, $valor,$param);
			$indiceparametro++;
		}
		
		//Parámetros del where
		for($i=0;$i<count($clave);$i++)
		{
			$sentencia->bindParam($indiceparametro, $clave[$i][1]);
			$indiceparametro++;
		}
		
		try
		{
			$sentencia->execute();
		} catch (Exception $e)
		{
			echo $e->getMessage();
		}
		
	}
	
	private function NoesClave($key,$clave)
	{
		
	}
	/**
	 * 
	 * @param $coleccion es una array asociativo de array de dos elementos generada por la clase Repositorio
	 * Ejemplo $coleccion=array([clave]=>array([objeto],[estado]),...)
	 * la clave del array asociativo es la 'primary key' de la entidad y 
	 * el primer elemento guarda el propio objeto y el segundo el estado
	 *  (0-sin cambios, 1-Modificado, 2-Borrado, 3-Nuevo)
	 * @param $entidad es el nombre de la entidad
	 */
	public function ActualizarConColeccion($coleccion,$entidad)
	{
		foreach ($coleccion as $elemento)
		{
			switch ($elemento[1])
			{
				case 1:
					//Modificación UPDATE
					$this->Modifica($elemento[0]);
				;
				break;
				case 2:
					//Borrado DELETE
					$this->Borra($elemento[0]);
					break;
				case 3:
					//Nuevo INSERT
					$this->Nuevo($elemento[0],$entidad);
					break;
			}
		}
	}
	
	/**
	 * Recoge la documentación de las propiedades objeto y dentro de esta busca
	 * la cadena [key] que identifica la clave primaria de la entidad
	 * @param $objeto de la entidad
	 * @return $clave, devuelve un array con tantos elementos como campos formen parte de la 
	 * clave primaria, a su vez cada elemento es un array de dos elementos, el primero
	 * almacena el nombre de la propiedad y el segundo el valor.
	 * Ejemplo: $clave=array([0]=>array(['CategoryID'],[3]));
	 */
	private function BuscaClave($objeto)
	{
		$clave=array();
		$i=0;
		$ReflexionObjeto=new ReflectionObject($objeto);
		foreach ($ReflexionObjeto->getProperties() as $ReflexionPropiedad)
		{
			if(strpos($ReflexionPropiedad->getDocComment(),"[key]"))
			{
				$clave[$i][0]=$ReflexionPropiedad->getName();
				$clave[$i][1]=$ReflexionPropiedad->getValue($objeto);
				$i++;
			}
		}
		return $clave;
	}
}