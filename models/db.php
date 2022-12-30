<?php
// Proyecto (Sistema de intranet TELEDAT) MVC
// Ricardo Sanchez.
// 2022


class DB {
	private $conex;

	function __construct() {
		try {
			$this->conex = new PDO(
												'mysql:host=localhost;dbname=intra-teledat',
												'root',
												'',
												array(
    											PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    											PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
												  )
												);
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
