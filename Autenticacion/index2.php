<?php
require_once 'Librerias/GestionaPlantilla.php';
session_start();
GestionaPlantilla::Inicio_Plantilla("Plantilla/__PlantillaSESION.php");
?>
<h1>Esto es un ejemplo de AUTENTICACIÓN CON SESIONES</h1>
<?php
GestionaPlantilla::Fin_Plantilla();
?>

