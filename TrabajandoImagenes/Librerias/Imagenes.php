<?php
class Imagenes
{
	/**
	 * 
	 * @param string $dir directorio que contiene las imagenes sin la / final
	 * @param integer $w ancho de la imagen que queremos crear
	 * @param integer $h alto de la imagen que queremos crear
	 * @param integer $nColumnas número de columnas que queremos tenga
	 * @return string devuelve una cadena que contiene los bytes de la imagen
	 */
	public static function CreaImagendeImagenesDir($dir,$w,$h,$nColumnas)
	{
		$totalimagenes = count(glob($dir."/{*.jpg,*.JPG,*.gif,*.GIF,*.PNG,*.png}",GLOB_BRACE));
		
		//Cálculos
		$anchoImagenes=round($w/$nColumnas,0,PHP_ROUND_HALF_DOWN);
		$numerofilas=round($totalimagenes/$nColumnas);
		$altoImagenes=round($h/$numerofilas,0,PHP_ROUND_HALF_DOWN);
		
		//Creo imagen grande o lienzo
		$imagen=imagecreatetruecolor($w, $h);
		
		//Abrimos y recorremos el directorio
		$d=opendir($dir);
		$dst_x=0;
		$dst_y=0;
		$cuentafilas=1;
		$cuentacolumnas=1;
		while ($file=readdir($d))
		{
			//Si no es el punto o los dos puntos
			if($file!="." && $file!="..")
			{
				//Cogemos información de la imagen
				$info=getimagesize($dir."/".$file);
				
				//Variable que recoge el nombre de la función
				$funcion="imagecreatefrom".explode("/",$info['mime'])[1];
				//Uso de función de variable
				$img=$funcion($dir."/".$file);
				imagecopyresampled($imagen, $img, $dst_x, $dst_y, 0, 0,
						$anchoImagenes, $altoImagenes,$info[0], $info[1]);
				$img=NULL;
				if($cuentacolumnas<$nColumnas)
				{
					$dst_x+=$anchoImagenes;
					$cuentacolumnas++;
				}
				else
				{
					$dst_y+=$altoImagenes;
					$cuentacolumnas=1;
					$dst_x=0;
				}
				
				//break;
			}
			
		}
		
		//Recojo los datos en una variable para devolverla
		ob_start();
		imagejpeg($imagen);
		$foto=ob_get_contents();
		ob_end_clean();
		return $foto;
	}
}