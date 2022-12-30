<?php
// Proyecto (Sistema de intranet TELEDAT) MVC
// Ricardo Sanchez.
// 2022

require_once "controllers/ingreso.php";

if (empty($_POST['usr']) || empty($_POST['pswd']))
	{ 
		include "views/inicio.php";
		die();		
	} 

$ingresoController = new IngresoController();
$ingresoController->iniciar($_POST['usr'], $_POST['pswd']);


?>