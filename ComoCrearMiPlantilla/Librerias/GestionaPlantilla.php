<?php
class GestionaPlantilla
{
	static $_plantilla;
	public static function Inicio_Plantilla($plantilla)
	{
		self::$_plantilla=$plantilla;
		exec("php -f $plantilla > ./datos.txt");
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
}
