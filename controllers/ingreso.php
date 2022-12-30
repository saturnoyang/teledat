<?php
// Proyecto (Sistema de intranet TELEDAT) MVC
// Ricardo Sanchez.
// 2022
include "models/db.php";

class IngresoController {

	public $inicio;

	public function __construct() {
	}

	public function iniciar($usr,$pswd){
		$consulta = "SELECT id_usr, usr_nombre, full_name, email, rut, passwd, telf, is_admin, usr_status ".
								"FROM usuarios WHERE ".
								"usr_nombre='".$_POST["usr"]."' AND passwd='".sha1($_POST["pswd"])."'";
		$db = new DB();
		$sentencia = $db->getConexion()->prepare($consulta);

		if($sentencia->execute()){
			if($sentencia->rowCount() == 0){
				echo "<p class='alerta'>";
				echo "usuario: ".$usr."<br>\n";
				echo "contraseña: ".sha1($pswd)."<br>\n";
				echo "Usuario / Clave Incorrecta <A HREF='javascript:history.back()'>Regresar</A>";
				echo "</p>";
				die(0);

			}else{
				$rs = $sentencia->fetchAll();
				$is_admin = $rs[0]['is_admin'];
				$id_usr = $rs[0]['id_usr'];

				if($is_admin=="1"){
					$nombre_completo = $rs[0]['usr_nombre'];
					$acceso[0] =  array('id_modulo'=>'1', 'acceso'=>'1');
					$acceso[1] =  array('id_modulo'=>'2', 'acceso'=>'1');
					$acceso[2] =  array('id_modulo'=>'3', 'acceso'=>'1');
					$acceso[3] =  array('id_modulo'=>'4', 'acceso'=>'1');
					$acceso[4] =  array('id_modulo'=>'5', 'acceso'=>'1');
					$acceso[5] =  array('id_modulo'=>'6', 'acceso'=>'1');
				}else{
					if ($rs[0]['usr_status']=="0"){
						echo "<h1>Error: Su usuario no se encuentra activo, consulte con el Administrador</h1>";
						echo "<A HREF='javascript:history.back()'>Regresar</A>";
						die(0);
					}
					$nombre_completo = $rs[0]['full_name'];
					$consulta2= "SELECT acceso.id_acceso, acceso.id_modulo, modulos.mod_nombre, ".
															"acceso.id_usr, acceso.acceso, modulos.mod_status ".
											"FROM acceso, modulos ".
											"WHERE acceso.id_modulo = modulos.id_modulo AND acceso.id_usr = $id_usr";

					$sentencia2 = $db->getConexion()->prepare($consulta2);
					if($sentencia2->execute()){
						if($sentencia2->rowCount() == 0){
							echo "<h1>Error: Su usuario no posee privilegios de acceso, consulte con el Administrador</h1>";
							echo "<A HREF='javascript:history.back()'>Regresar</A>";
							die(0);
						}else{
							$acceso = $sentencia2->fetchAll();
						}
					}
				}






	}
}
		include "views/ingreso.php";
	}
}

?>
