<?php
require_once 'Librerias/GestionaPlantilla.php';
GestionaPlantilla::Inicio_Plantilla("Plantilla/__PlantillaSESION.php");
//session_start();
if(!isset($_SESSION['autenticacion']))
{
	header("location:index2.php");
}
else 
{
	echo "<h1>Bienvenido a la página protegida";
}
GestionaPlantilla::Fin_Plantilla();
?>

