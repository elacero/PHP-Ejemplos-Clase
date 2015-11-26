<?php
require_once 'Librerias/GestionaPlantilla.php';
if(!isset($_SERVER['PHP_AUTH_USER']))
{
	header("location:index.php");
}
GestionaPlantilla::Inicio_Plantilla("Plantilla/__PlantillaBASIC.php");
?>
<h1>Bienvenido a la página de autenticación HTTP BASIC</h1>
<?php
GestionaPlantilla::Fin_Plantilla();
?>