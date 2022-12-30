<?php

echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>\n".
		"<html xmlns='http://www.w3.org/1999/xhtml'>\n".
		"<head>\n".
		"<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />\n".
		"<meta http-equiv='Cache-Control' content='no-store' />\n".
		"<META HTTP-EQUIV='Expires' CONTENT='-1'>\n".
		"<title>Teledat.cl INTRANET</title>\n".
		"<link rel='shortcut icon' href='favicon.ico' />\n".
		"<link rel='stylesheet' href='images/style.css' type='text/css' />\n".
		"<style type='text/css'>\n".
		"	._css3m{display:none}\n".
		"	.alerta {\n".
		"		font-family: Verdana, Geneva, sans-serif;\n".
		"		font-size: 16px;\n".
		"	}\n".
		"</style>\n".
		"</head>\n".
		"<body style='background-color:#EBEBEB'>\n";

if (empty($_POST['usr']) || empty($_POST['pswd']))  { die("<br><br><br><h1><p><center>No se recibio, información</center></p><h1>");}

include('db_config.php');

$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);

if ($mysqli->connect_errno) {
    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
    exit();
}
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
}
$consulta = "SELECT id_usr, usr_nombre, full_name, email, rut, passwd, telf, is_admin, usr_status FROM usuarios WHERE ".
				"usr_nombre='".$_POST["usr"]."' AND passwd='".sha1($_POST["pswd"])."'";

if ($result = $mysqli->query($consulta)) {
		if( $result->num_rows == 0){
			echo "<p class='alerta'>";
			echo "usuario: ".$_POST["usr"]."<br>\n";
			echo "contraseña: ".sha1($_POST["pswd"])."<br>\n";
			echo "Usuario / Clave Incorrecta <A HREF='javascript:history.back()'>Regresar</A>";
			echo "</p>";
			die(0);
	}else{

		while($row = $result->fetch_array()){
			$rows[] = $row;
		}

		$is_admin=0;
		foreach($rows as $row){

// 		depuracion --> determinando el tipo de usuario
//		echo $row['id_usr'].", ".$row['usr_nombre'].", ".$row['full_name'].", ".$row['email'].", ".$row['rut'].", ".$row['passwd'].
//			", ".$row['telf'].", ".$row['is_admin'].", ".$row['usr_status']."<br>\n" ;

		if ($row['usr_status']=="0"){
			echo "<h1>Error: Su usuario no se encuentra activo, consulte con el Administrador</h1>";
			die(0);
		}
		$is_admin = $row['is_admin'];
		$id_usr = $row['id_usr'];
		}
		echo "<ul id='css3menu1' class='topmenu'>\n".
				"<input type='checkbox' id='css3menu-switcher' class='switchbox'>\n".
				"	<label onclick='' class='switch' for='css3menu-switcher'></label>\n".
				"<li class='topfirst'><a href='dashboard.php' target='iframe' style='height:50px;line-height:50px;'>".
				"<img src='images/teledat_icon.jpg' alt=''/>&nbsp</a></li>";

		if ($is_admin=="1"){

			//menu ordinario
			echo "	<li class='topmenu'><a href='#' style='height:50px;line-height:50px;'><span>Usuarios</span></a>\n".
					"<ul>\n".
					"<li><a href='usuarios.php?op=1' target='iframe' >Agregar</a></li>\n".
					"<li><a href='usuarios.php?op=2' target='iframe' >Seguridad</a></li>\n".
					"<li><a href='usuarios.php?op=3' target='iframe' >Consultar</a></li>\n".
					"<li><a href='usuarios.php?op=4' target='iframe' >Eliminar</a></li>\n".
					"</ul></li>\n".
					"<li class='topmenu'><a href='#' style='height:50px;line-height:50px;'><span>Instaladores</span></a>\n".
					"<ul>\n".
					"<li><a href='instaladores.php?op=1' target='iframe' >Agregar</a></li>\n".
					"<li><a href='instaladores.php?op=2' target='iframe' >Consultar / Editar</a></li>\n".
					"</ul></li>\n".
					"<li class='topmenu'><a href='#' style='height:50px;line-height:50px;'><span>Bodega</span></a>\n".
					"<ul>\n".
					"<li><a href='proveedores.php?op=1' target='iframe' >Proveedores</a></li>\n".
					"<li><a href='bodegas.php?op=1' target='iframe' >Bodegas</a></li>\n".
					"<li><a href='productos.php?op=1' target='iframe' >Productos</a></li>\n".
					"<li><a href='compras.php?op=1&usr=$id_usr' target='iframe' >Compras</a></li>\n".
					"<li><a href='entregas.php?op=1' target='iframe' >Procesar una Entrega</a></li>\n".
					"<li><a href='entregas.php?op=2' target='iframe' >Consultar Entregas</a></li>\n".
					"<li><a href='#' >Herramientas</a>\n".
					"<ul><li><a href='herramientas.php?op=1' target='iframe'>Inventario</a></li>\n".
					"<li><a href='h_prestamo.php?op=1&usr=$id_usr' target='iframe'>Prestamo</a></li>\n".
					"<li><a href='h_retorno.php?op=1&usr=$id_usr' target='iframe'>Devolución</a></li></ul>\n".
					"</li>\n".
					"</ul></li>\n".
					"<li class='topmenu'><a href='#' style='height:50px;line-height:50px;'><span>Autos</span></a>\n".
					"<ul>\n".
					"<li><a href='autos.php?op=1' target='iframe' >Ingresar</a></li>\n".
					"<li><a href='autos.php?op=2' target='iframe' >Consultar</a></li>\n".
					"<li><a href='autos.php?op=3&usr=$id_usr' target='iframe' >Entregar un Auto</a></li>\n".
					"<li><a href='autos.php?op=4' target='iframe' >Reportes</a></li>\n".
					"</ul></li>\n".
					"<li class='topmenu'><a href='#' style='height:50px;line-height:50px;'><span>Pedidos</span></a>\n".
					"<ul>\n".
					"<li><a href='pedidos.php?op=1&usr=$id_usr' target='iframe' >Realizar un pedido</a></li>\n".
					"<li><a href='pedidos.php?op=2' target='iframe' >Consultar</a></li>\n".
					"<li><a href='pedidos.php?op=3&usr=$id_usr' target='iframe' >Regresar material</a></li>\n".
					"<li><a href='' target='iframe' >Reportes</a></li>\n".
					"</ul></li>\n";

		}else{
			//listar niveles de acceso para segun usuario


			$consulta2= "SELECT acceso.id_acceso, acceso.id_modulo, modulos.mod_nombre, acceso.id_usr, acceso.acceso, modulos.mod_status ".
						"FROM acceso, modulos ".
						"WHERE acceso.id_modulo = modulos.id_modulo AND acceso.id_usr = $id_usr";

			if ($result2 = $mysqli->query($consulta2)) {
				if( $result2->num_rows == 0){
					echo "no hay datos";
				}else{
					$row=null;
					$rows=null;
					while($row = $result2->fetch_array()){
						$rows[] = $row;
					}
					foreach($rows as $row){

//					echo $row['id_acceso'].", ".$row['id_modulo'].", ".$row['mod_nombre'].", ".$row['id_usr'].", ".$row['acceso'].", ".
//							$row['mod_status'].", "."<br>\n" ;


					switch($row['id_modulo']){
						case 1:
							// usuarios
							echo "<li class='topmenu'><a href='#' style='height:50px;line-height:50px;'><span>".$row['mod_nombre']."</span></a>";
							if($row['acceso']=="1"){
								echo "<ul>\n<li><a href='usuarios.php?op=1' target='iframe' >Agregar</a></li>\n".
										"<li><a href='usuarios.php?op=2' target='iframe' >Seguridad</a></li>\n".
										"<li><a href='usuarios.php?op=3' target='iframe' >Consultar</a></li>\n".
										"<li><a href='usuarios.php?op=4' target='iframe' >Eliminar</a></li>\n".
										"</ul>";
							}
							echo "</li>";
							break;
						case 2:
							// instaladores
							echo "<li class='topmenu'><a href='#' style='height:50px;line-height:50px;'><span>".$row['mod_nombre']."</span></a>\n";
							if($row['acceso']=="1"){
								echo "<ul>".
										"<li><a href='instaladores.php?op=1' target='iframe' >Agregar</a></li>".
										"<li><a href='instaladores.php?op=2' target='iframe' >Consultar / Editar</a></li>".
										"</ul>";
							}
							echo "</li>";
							break;
						case 3;
							// bodega
							echo "<li class='topmenu'><a href='#' style='height:50px;line-height:50px;'><span>".$row['mod_nombre']."</span></a>\n";
							if($row['acceso']=="1"){
								echo "<ul>\n<li><a href='proveedores.php?op=1' target='iframe' >Proveedores</a></li>\n".
										"<li><a href='bodegas.php?op=1' target='iframe' >Bodegas</a></li>\n".
										"<li><a href='productos.php?op=1' target='iframe' >Productos</a></li>\n".
										"<li><a href='compras.php?op=1&usr=$id_usr' target='iframe' >Compras</a></li>\n".
										"<li><a href='entregas.php?op=1' target='iframe' >Procesar una Entrega</a></li>\n".
										"<li><a href='entregas.php?op=2' target='iframe' >Consultar Entregas</a></li>\n".
										"<li><a href='#' >Herramientas</a>\n".
										"<ul><li><a href='herramientas.php?op=1' target='iframe'>Inventario</a></li>\n".
										"<li><a href='h_prestamo.php?op=1&usr=$id_usr' target='iframe'>Prestamo</a></li>\n".
										"<li><a href='h_retorno.php?op=1&usr=$id_usr' target='iframe'>Devolución</a></li></ul>\n".
										"</li>\n".
										"</ul>\n";
							}
							echo "</li>";
							break;
						case 4;
							// autos
							echo "<li class='topmenu'><a href='#' style='height:50px;line-height:50px;'><span>".$row['mod_nombre']."</span></a>\n";
							if($row['acceso']=="1"){
								echo "<ul>\n".
										"<li><a href='autos.php?op=1' target='iframe' >Ingresar</a></li>\n".
										"<li><a href='autos.php?op=2' target='iframe' >Consultar</a></li>\n".
										"<li><a href='autos.php?op=3&usr=$id_usr' target='iframe' >Entregar un Auto</a></li>\n".
										"<li><a href='autos.php?op=4' target='iframe' >Reportes</a></li>\n".
										"</ul>";
							}
							echo "</li>";
							break;
						case 5;
							// pedidos
							echo "<li class='topmenu'><a href='#' style='height:50px;line-height:50px;'><span>".$row['mod_nombre']."</span></a>\n";
							if($row['acceso']=="1"){
								echo "<ul>\n".
										"<li><a href='pedidos.php?op=1&usr=$id_usr' target='iframe' >Realizar un pedido</a></li>\n".
										"<li><a href='pedidos.php?op=2' target='iframe' >Consultar</a></li>\n".
										"<li><a href='pedidos.php?op=3&usr=$id_usr' target='iframe' >Regresar material</a></li>\n".
										"<li><a href='' target='iframe' >Reportes</a></li>\n".
										"</ul>\n";
							}
							echo "</li>";
							break;
						}
					}
				}
			}
		}
		echo "<li class='toplast'><a href='index.php' style='height:50px;line-height:50px;'>Salir</a></li>\n</ul>\n";
	}
    $result->close();
}
$mysqli->close();

echo "<iframe id='iframe' name='iframe' src='dashboard.php' ".
		"frameborder='0' style='overflow: hidden; height: 91%; width: 99%; position: absolute;' height='91%' width='99%'>".
		"</iframe>\n";
?>
</body>
</html>
