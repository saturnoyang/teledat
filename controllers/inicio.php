<?php
// Proyecto (Sistema de intranet TELEDAT) MVC
// Ricardo Sanchez.
// 2022


class InicioController {

	public $inicio;

	public function __construct() {
	}

	public function iniciar(){
		include "views/inicio.php";
	}
}

?>
