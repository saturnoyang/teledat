<?php
// Proyecto (Sistema de intranet TELEDAT) MVC
// Ricardo Sanchez.
// 2022


class DB {
	private $conex;

	function __construct() {
		try {
			$this->conex = new PDO('mysql:host=localhost;dbname=intra-teledat', 'root', '');
		}
		catch (PDOException $e){
			$this->conex = null;
		}
	}

	function getConexion() {
		return $this->conex;
	}

}

?>
