<html>
<head>
<meta charset="utf-8"/>
</head>
<body>
<?php
require_once 'xmlManteni.php';
// $doc=new DOMDocument();
// $doc->load("alumnos.xml");
// //$aux=new DOMXPath($doc);
// $alumnos=$doc->getElementsByTagName("Alumno");
// foreach ($alumnos as $alumno)
// {
// 	echo $alumno->attributes->getNamedItem('Alumno')->value."</br>";
// }
$documento=new xmlMantenimiento("alumnos.xml");
$alums=$documento->TodosAlumnos();
$Nuevo=$documento->NuevoAlumno("pepe", "torre", "2DAA");
$documento->InsertaAlumnoDespuesde("Jurado Serrano, Alberto", $Nuevo);
$aux=$documento->AlumnoPorNombre("Calvo Camacho, Alejandro");
$documento->BorrarAlumno($aux);
$documento->ModificaAlumno($documento->AlumnoPorNombre("pepe"), $documento->NuevoAlumno("pepe", utf8_encode("Jaén"),"1ESO"));
foreach ($alums as $alum)
{
	echo "Nombre :".$alum->attributes->getNamedItem('Alumno')->value." ";
	echo "Localidad :".$alum->getAttribute("Localidad"). " ";
	echo "Unidad :".$alum->getAttribute("Unidad"). "</br>";
}
?>

</body>
</html>