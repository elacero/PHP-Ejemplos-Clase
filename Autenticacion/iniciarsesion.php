<?php
require_once 'Librerias/GestionaPlantilla.php';
GestionaPlantilla::Inicio_Plantilla("Plantilla/__PlantillaSESION.php");
if(isset($_POST['usuario']))
{
	if($_POST['usuario']=="antonio" && $_POST['pswd']=="1234")
	{
		//session_start();
		$_SESSION["autenticacion"]=$_POST['usuario'];
		header("location:index2.php");
	}
}
else 
{
	echo "<form action='' method='post'>";
	echo "<input type='text' name='usuario'/>";
	echo "<input type='password' name ='pswd'/>";
	echo "<input type='submit' value='Enviar'/>";
	echo "</form>";
}

GestionaPlantilla::Fin_Plantilla();
?>


