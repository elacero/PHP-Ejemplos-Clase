<?php
/**
 * Esta versión de la librería si soporta sesiones en la creación de la plantilla
 * En la versión del proyecto <ComoCrearMiPlantilla> no es soportada.
 * @author antonio
 *
 */
class GestionaPlantilla
{
	static $_varsget;
	
	public static function Inicio_Plantilla($plantilla)
	{
		//*** Para tener disponible la sesión en el script
		//*** le paso las variables de sesión como parámetros
		self::CreaVariablesSesion();
		$aux=self::$_varsget;
		exec("php -f $plantilla $aux > ./datos.txt");
		ob_start("GestionaPlantilla::Render_Body");
	}
	public static function Render_Body($cadena)
	{
		$d=fopen("./datos.txt", "r");
		$datos=fread($d, filesize("./datos.txt"));
		return str_replace("{{body}}", $cadena, $datos);
	}
	
	public static function Fin_Plantilla()
	{
		ob_flush();
	}
	
	/**
	 * Pasa las variables de sesión a una cadena con el formato
	 * <nombrevariable> <valor> ...
	 */
	private static function  CreaVariablesSesion()
	{
		$vars=NULL;
		$i=1;
		foreach ($_SESSION as $clave=>$valor)
		{
			if($i<count($_SESSION))
			{
				$vars=$vars.$clave." ".$valor."&";
			}
			else 
			{
				$vars=$vars.$clave." ".$valor;
			}
			$i++;
		}
		self::$_varsget=$vars;
	}
	
	
}
