<?php
require_once 'Librerias/GestionaPlantilla.php';
if(!isset($_SERVER['PHP_AUTH_USER']))
{
	header("location:index.php");
}
GestionaPlantilla::Inicio_Plantilla("Plantilla/__PlantillaBASIC.php");
?>
<h1>Bienvenido a la p�gina de autenticaci�n HTTP BASIC</h1>
<?php
GestionaPlantilla::Fin_Plantilla();
?>