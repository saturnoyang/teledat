<?php
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>\n".
		"<html xmlns='http://www.w3.org/1999/xhtml'>\n".
		"<head>\n".
		"<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />".
		"<script language='javascript' src='calendar/calendar.js'></script>".
		"</head>\n<body link='#0000FF' vlink='#0000FF' alink='#0000FF'>\n";
		
include('db_config.php');
require_once('calendar/classes/tc_calendar.php');

if (empty($_GET['op']))  { $op=0;	}  	else { $op=$_GET['op'];}
if (empty($_GET['usr'])) { $usr=0;	} 	else { $usr=$_GET['usr'];}
if (empty($_GET['id']))  { $id=0;	}	else { $id=$_GET['id'];}
if (empty($_GET['item'])){ $item=0;	} 	else { $item=$_GET['item'];}
if (empty($_GET['do']))	 { $do=0;	}	else { $do=$_GET['do'];}

$year3 = date("Y")+3;

switch($op){
	case 1:
		// realizar un pedido
		$consulta="SELECT pedidos.id_pedido, pedidos.f_pedido, DATE_FORMAT(pedidos.f_pedido,'%d-%m-%Y') AS fpedido, pedidos.id_usr, ".
					"pedidos.id_instalador, pedidos.n_doc, pedidos.procesada, pedidos.comentario, ".
					"instaladores.id_inst, instaladores.nombre, instaladores.f_nac, DATE_FORMAT(instaladores.f_nac,'%d-%m-%Y') AS fnac, ".
					"instaladores.rut AS rut_inst, instaladores.correo, instaladores.direccion, usuarios.id_usr, usuarios.usr_nombre, ".
					"usuarios.full_name, usuarios.email, usuarios.rut AS rut_usr, usuarios.telf ".
					"FROM pedidos, instaladores, usuarios ".
					"WHERE pedidos.id_usr = usuarios.id_usr AND pedidos.id_instalador = instaladores.id_inst AND pedidos.procesada='0'";

		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);

		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}		
		if ($result = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			///////->echo $numero_resultados;
			if($numero_resultados==0){
				echo "<form id='form' name='form' method='post'  autocomplete='off' action='pedidos.php?op=11&usr=$usr'>\n".
						"<table width='80%' border='1' align='center' cellpadding='5' cellspacing='0'>\n".
						"<tr>\n".
						"<td>Fecha pedido</td>\n".
						"<td>Instalador, Que solicita los materiales</td>\n".
						"<td>Numero Documento</td>\n</tr>".
						"<tr>\n<td>\n";

				//instantiate class and set properties
				$myCalendar = new tc_calendar("fecha_pedido", true);
				$myCalendar->setPath("calendar/");
				$myCalendar->setTimezone("America/Santiago");
				$myCalendar->setYearInterval(1940, date("Y") );
				$myCalendar->setDate(date("d"), date("m"),date("Y"));
				$myCalendar->setIcon("calendar/images/iconCalendar.gif");
				//output the calendar
				$myCalendar->writeScript(); 
				echo "</td>\n<td>\n";
				$consulta="SELECT id_inst, nombre, f_nac, DATE_FORMAT(f_nac,'%d-%m-%Y') AS fnac, rut, correo, direccion FROM instaladores ORDER BY nombre";
				if ($result2 = $mysqli->query($consulta)) {
					$numero_resultados = $mysqli->affected_rows; 
					if($numero_resultados==0){
						echo "no se encontro informacion";
					} else {
						echo "<select name='instalador' id='instalador'>\n<option value='0'>Seleccione...</option>";

						while($row = $result2->fetch_array()){
							$rows[] = $row;
						}

						foreach($rows as $row){
							echo "<option value='".$row['id_inst']."'>".$row['nombre'].", ".$row['rut'].", ".$row['fnac'].
								", ".$row['correo'].", ".$row['direccion']."</option>\n";
						}

						echo "</select>";

						/* free result set */
						$result2->close();
						$result2 = null;

	 			 }
		 
		}	
		echo "&nbsp;</td>\n".
				"<td><input type='text' name='n_doc' value='0' style='text-align:right;'></td>\n".
				"</tr>\n<tr>\n".
				"<td>Usuario: <input name='id_usuario' type='hidden' value='".$usr."' />";
	
		$consulta="SELECT id_usr, usr_nombre, full_name, email, rut, passwd, telf, is_admin, usr_status FROM usuarios WHERE id_usr='$usr'";

		$row = null;
		$rows = null;
	
		if ($result2 = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==0){

				echo "no se encontro informacion";

			} else {

				while($row = $result2->fetch_array()){
					$rows[] = $row;
				}

				foreach($rows as $row){

					echo $row['usr_nombre'].", ".$row['full_name'].", ";
					echo $row['email'].", ".$row['rut'].", ".$row['telf']."\n";

				}

				/* free result set */
				$result2->close();
				$result2 = null;

 			 }		 
		}
	
		echo "</td>\n<td>Comentario:<br><textarea name='comentario' id='comentario' cols='80' rows='3'></textarea></td>\n".
			"<td><select name='status' id='status'>\n".
			"<option value='0'>Seleccione...</option>\n".
			"<option value='1' selected >Iniciar Pedido</option>\n".
			"<option value='2'>Cerrar Pedido</option>\n".
			"</select>&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' name='button' id='button' value='Enviar' /></td>\n".
			"</tr>\n</table></form>\n".
			"<center><iframe id='pr_frame' name='pr_frame' align='middle' src='pedidos.php?op=5&id=0' ".
			"frameborder='1' style='overflow: hidden; height: 500; width: 80%; position: relative;' height='500' width='80%'>".
			"</iframe><br>\n</center>";				
				
		}else{
			echo "Buscar registo de pedidos pendientes";

				echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=2 heigth=50 ALIGN='center' bgcolor=97BDED>\n";

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}
				foreach($rows as $row){

					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td colspan='3'>Ficha de Pedido: ".$row['id_pedido']."</td></tr><tr>"; 
					echo "<td>Fecha del Pedido</td><td>Instalador</td><td>Num Documento</td></tr><tr>";
					echo "<Td>".$row['fpedido']."</td>";

					echo "<Td>".$row['nombre'].", ".$row['fnac'].", ".$row['rut_inst'].", ".$row['correo']."</td>";
					echo "<Td>".$row['n_doc']."</td>";
					echo "</tr><tr> <td colspan='2'>Usuario</td><td>&nbsp</td>";					
					echo "</tr><tr>";					
					echo "<Td>";
					echo $row['usr_nombre'].", ".$row['full_name'].", ";
					echo $row['email'].", ".$row['rut_usr'].", ".$row['telf']."\n</td><td>".nl2br($row['comentario'])."</td>";

					echo "<td><button onclick=\"window.location.href='pedidos.php?op=11&usr=".$row['id_usr'].
									"&id=".$row['id_pedido']."'\">Continuar</button></td>";


					echo "</tr>\n";

				}

				echo "</table>";

		}
	}	
	
	break;
	case 11:

		//cerrar pedido
		//

		
		if((empty($_POST['status'])? 0 :$_POST['status']) == 2 ){
			/*
			pasos: 	
					1) buscar en el stock la existencia actual, restar el pedido
					2) marcar la compra como finalizada.
			*/
			
		$consulta=	"SELECT pedidos_det.id_item, pedidos_det.id_pedido, pedidos_det.id_deposito, pr_bodegas.id_prbodega, pr_bodegas.nombre, ".
						"pedidos_det.id_prod, productos.id_prod, productos.nombre AS prod_nombre, productos.codigob1, productos.codigob2, ".
						"pedidos_det.cantidad ".
					"FROM pedidos_det,pr_bodegas,productos ".
					"WHERE pedidos_det.id_deposito=pr_bodegas.id_prbodega AND pedidos_det.id_prod=productos.id_prod AND pedidos_det.id_pedido='$id'";
		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);

		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}		
		if ($result = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==0){

				echo "no se encontro informacion";

			} else {

				echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=2 heigth=50 ALIGN='center' bgcolor=97BDED>\n";

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}
						
		echo "</td></tr>";
				foreach($rows as $row){
					// actualizar la existencia

					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td>".$row['id_item']."</td>";
					echo "<Td>".$row['id_pedido']."</td>";
					echo "<Td>".$row['id_deposito']."</td>";
					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['id_prod']."</td>";
					echo "<Td>".$row['prod_nombre']."</td>";
					echo "<Td>".$row['codigob1']."</td>";
					echo "<Td>".$row['codigob2']."</td>";
					echo "<Td>".$row['cantidad']."</td>";

					echo "</tr>\n";
					
					
					$consulta = null;
					$consulta2 = "SELECT id_stock, id_prod, id_depo, stock FROM prod_stock ".
									"WHERE id_prod = '".$row['id_prod']."' AND id_depo = '".$row['id_deposito']."'";
					echo "<tr><td colspan='10'>comparar y actualizar existencias";
					if ($result2 = $mysqli->query($consulta2)) {
						$numero_resultados = $mysqli->affected_rows; 
						if($numero_resultados==0){
							echo "no se encontro informacion";

							$consulta="INSERT INTO prod_stock ( id_stock, id_prod, id_depo, stock) ".
										"VALUES ( null, '".$row['id_prod']."' ,'".$row['id_deposito']."','".$row['cantidad']."')";						

						} else {

						while($row2 = $result2->fetch_array()){
							$rows2[] = $row2;
						}

						foreach($rows2 as $row2){
							//echo $row2['id_stock'].", ".$row2['id_prod'].", ".$row2['stock']."<br>";
							//echo "\n";
							$consulta="UPDATE prod_stock SET stock = '".($row2['stock'] - $row['cantidad'])."' ".
										"WHERE id_depo = '".$row['id_deposito']."' AND id_prod = '".$row2['id_prod']."'";						
						}

				/* free result set */
				$result2->close();
				$result2 = null;
				$row2 = null;
				$rows2 = null;
 			 }
				if ($consulta != null ) {
					
					if ($result2 = $mysqli->query($consulta)) {
						echo "<br>Se Actualizo exitencia en el sistema";
					}
				}

		}
		echo "</td></tr>\n";
					

				}
 			
				$consulta = "UPDATE pedidos SET procesada = '1' WHERE  id_pedido = '$id';";
				if ($consulta != null ) {
					
					if ($result2 = $mysqli->query($consulta)) {
						echo "<tr><td colspan = '10'>se ha cerrado la compra.<br>Ir a la <a href='dashboard.php'>página principal</a>".
								"<meta http-equiv='refresh' content=\"3; URL='dashboard.php'\" /></td></tr>";
					}
				}
				$result2 = null;
		
				
				/* free result set */
				$result->close();
				echo "</table>\n";

 			 }
		 
		}
			
			die(0);
		}

		// Agregar Pedido
		
		/*
		INSERT INTO pedidos (id_pedido, f_pedido, id_usr, id_instalador, n_doc, procesada) 
		VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6])
		
		
		$consulta="INSERT INTO compras ( id_compra, f_compra, id_usr, id_prov, n_doc, monto, procesada) ".
					"VALUES ( null, '".$_POST['fecha_compra']."', '".$_POST['id_usuario']."', '".
					$_POST['proveedor']."', '".$_POST['n_doc']."', '".$_POST['monto']."', '0')";		
		
		
		*/


		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);

		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}
		echo '<table width="80%" border="1" align="center" cellpadding="5" cellspacing="0">';
		echo "\n<tr><td colspan='3'>";

		if($id==0){
			echo "$id: no asignado agregar";

		$consulta="INSERT INTO pedidos (id_pedido, f_pedido, id_usr, id_instalador, n_doc, procesada, comentario)  ".
					"VALUES ( null, '".$_POST['fecha_pedido']."', '".$_POST['id_usuario']."', '".
					$_POST['instalador']."', '".$_POST['n_doc']."', '0', '".$_POST['comentario']."' )";		

		if ($result = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==1){
				echo "Se agrego un nuevo <b>Pedido</b>\n";
			} else {
				echo "<br><b>ERROR</b> al agrergar";
			}
		}
		echo "</td></tr>";
		$result = null;

		$consulta="SELECT id_pedido, f_pedido, id_usr, id_instalador, n_doc, procesada,comentario FROM pedidos WHERE f_pedido = '".$_POST['fecha_pedido']."' ".
					"AND n_doc='".$_POST['n_doc']."' AND id_instalador='".$_POST['instalador']."' LIMIT 1";
					
		}else{
			echo "$id: asignado para continuar un pedido, buscar pedido y continuar";

			$consulta="SELECT id_pedido, f_pedido, id_usr, id_instalador, n_doc, procesada, comentario FROM pedidos WHERE id_pedido='$id'";
			

		}


			if ($result = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==0){

				echo "no se encontro informacion";

			} else {

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}

				foreach($rows as $row){
			
					echo "<form id='form' name='form' method='post'  autocomplete='off' action='pedidos.php?op=11&id=".$row['id_pedido']."&usr=$usr'>".							
							'<tr>'.
							'<td>Fecha pedido</td>'.
							'<td>Instalador</td>'.
							'<td>Numero Documento</td></tr><tr><td>';
							
					$fecha = date_create($row['f_pedido']);	
					
					$myCalendar = new tc_calendar("fecha_pedido", true);
					$myCalendar->setPath("calendar/");
					$myCalendar->setTimezone("America/Santiago");
					$myCalendar->setYearInterval(1940, $year3 );
					$myCalendar->setDate(date_format($fecha, 'd'), date_format($fecha, 'm'),date_format($fecha, 'Y') );
					$myCalendar->setIcon("calendar/images/iconCalendar.gif");
					//output the calendar
					$myCalendar->writeScript();
					echo "</td>\n<td>\n";

		$consulta = "SELECT id_inst, nombre, f_nac, DATE_FORMAT(f_nac,'%d-%m-%Y') AS fnac, rut, correo, direccion FROM instaladores ".
					"WHERE id_inst = '".$row['id_instalador']."' ORDER BY nombre";
		
		if ($result2 = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==0){
				echo "no se encontro informacion";

			} else {

				while($row2 = $result2->fetch_array()){
					$rows2[] = $row2;
				}

				foreach($rows2 as $row2){
					echo $row2['nombre'].", ".$row2['rut'].", ".$row2['fnac'].
							", ".$row2['correo'].", ".$row2['direccion'];
					echo "\n";

				}

				/* free result set */
				$result2->close();
				$result2 = null;

 			 }
		 
		}
	
		echo "&nbsp;</td>\n".
				"<td>".$row['n_doc']."</td>\n".
				"</tr>\n<tr>".
				"<td>Usuario: <input name='id_usuario' type='hidden' value='".$usr."' />";

		$consulta="SELECT id_usr, usr_nombre, full_name, email, rut, passwd, telf, is_admin, usr_status FROM usuarios WHERE id_usr='$usr'";
		$row2 = null;
		$rows2 = null;
		if ($result2 = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==0){
				echo "no se encontro informacion";
			} else {

				while($row2 = $result2->fetch_array()){
					$rows2[] = $row2;
				}

				foreach($rows2 as $row2){

					echo $row2['usr_nombre'].", ".$row2['full_name'].", ";
					echo $row2['email'].", ".$row2['rut'].", ".$row2['telf']."\n";

				}

				/* free result set */
				$result2->close();
				$result2 = null;

 			 }		 
		}

					
	echo "</td>\n".
			"<td>".nl2br($row['comentario'])."</td>\n".
			"<td><select name='status' id='status'>\n".
			"<option value='0'>Seleccione...</option>\n".
			"<option value='1'>Iniciar Pedido</option>\n".
			"<option value='2' selected >Cerrar Pedido</option>".
			"</select>&nbsp;&nbsp;&nbsp;&nbsp; <input type='submit' name='button' id='button' value='Enviar' /></td>".
			"</tr>\n</table>\n</form>\n";					
					
					
					
						
					echo "<center><iframe id='pr_frame' name='pr_frame' align='middle' src='pedidos.php?op=5&id=".$row['id_pedido']."' ".
							"frameborder='1' style='overflow: hidden; height: 500; width: 80%; position: relative;' height='500' width='80%'>".
							"</iframe><br>\n".
						 "</center>";

				}

				/* free result set */
				$result->close();
				$result = null;

 			 }		 
		}
		
		$mysqli->close();		
	break;	
	
	
	
	
	case 2:
	// consultar pedidos

		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);

		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}		

		$consulta="SELECT pedidos.id_pedido, pedidos.f_pedido, DATE_FORMAT(pedidos.f_pedido,'%d-%m-%Y') AS fpedido, pedidos.id_usr, ".
					"pedidos.id_instalador, pedidos.n_doc, pedidos.procesada, pedidos.comentario, ".
					"instaladores.id_inst, instaladores.nombre, instaladores.f_nac, DATE_FORMAT(instaladores.f_nac,'%d-%m-%Y') AS fnac, ".
					"instaladores.rut AS rut_inst, instaladores.correo, instaladores.direccion, usuarios.id_usr, usuarios.usr_nombre, ".
					"usuarios.full_name, usuarios.email, usuarios.rut AS rut_usr, usuarios.telf ".
					"FROM pedidos, instaladores, usuarios ".
					"WHERE pedidos.id_usr = usuarios.id_usr AND pedidos.id_instalador = instaladores.id_inst AND pedidos.procesada='1' ".
					"ORDER BY pedidos.id_pedido DESC ";

		if ($result = $mysqli->query($consulta)){
			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==0){
				echo "No se encontro informacion";				
			}else{
				echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=2 heigth=50 ALIGN='center' bgcolor=97BDED>\n";

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}
				foreach($rows as $row){

					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td colspan='3'>Ficha de Pedido: ".$row['id_pedido']."</td></tr><tr>"; 
					echo "<td>Fecha del Pedido</td><td>Instalador</td><td>Num Documento</td></tr><tr>";
					echo "<Td>".$row['fpedido']."</td>";

					echo "<Td>".$row['nombre'].", ".$row['fnac'].", ".$row['rut_inst'].", ".$row['correo']."</td>";
					echo "<Td>".$row['n_doc']."</td>";
					echo "</tr><tr> <td colspan='2'>Usuario</td><td>&nbsp</td>";					
					echo "</tr><tr>";					
					echo "<Td>";
					echo $row['usr_nombre'].", ".$row['full_name'].", ";
					echo $row['email'].", ".$row['rut_usr'].", ".$row['telf']."\n</td><td>".nl2br($row['comentario'])."</td>";

					echo "<td><button onclick=\"window.location.href='pedidos.php?op=21&usr=".$row['id_usr'].
									"&id=".$row['id_pedido']."'\">Consultar</button></td>";


					echo "</tr>\n".
							"<tr bgcolor='FFFFF'><td colspan='3'>&nbsp;</td></tr>";

				}

				echo "</table>";
	
				
			}
		}
	
	
	
	break;
	case 21:

		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);

		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}		

		$consulta="SELECT pedidos.id_pedido, pedidos.f_pedido, DATE_FORMAT(pedidos.f_pedido,'%d-%m-%Y') AS fpedido, pedidos.id_usr, ".
					"pedidos.id_instalador, pedidos.n_doc, pedidos.procesada, pedidos.comentario, ".
					"instaladores.id_inst, instaladores.nombre, instaladores.f_nac, DATE_FORMAT(instaladores.f_nac,'%d-%m-%Y') AS fnac, ".
					"instaladores.rut AS rut_inst, instaladores.correo, instaladores.direccion, usuarios.id_usr, usuarios.usr_nombre, ".
					"usuarios.full_name, usuarios.email, usuarios.rut AS rut_usr, usuarios.telf ".
					"FROM pedidos, instaladores, usuarios ".
					"WHERE pedidos.id_usr = usuarios.id_usr AND pedidos.id_instalador = instaladores.id_inst AND pedidos.id_pedido='$id'";

		if ($result = $mysqli->query($consulta)){
			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==0){
				echo "No se encontro informacion";				
			}else{
				echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=0 heigth=50 ALIGN='center' bgcolor=97BDED>\n";

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}
				foreach($rows as $row){

					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td colspan='3'>Ficha de Pedido: ".$row['id_pedido']."</td></tr><tr>"; 
					echo "<td>Fecha del Pedido</td><td>Instalador</td><td>Num Documento</td></tr><tr>";
					echo "<Td>".$row['fpedido']."</td>";

					echo "<Td>".$row['nombre'].", ".$row['fnac'].", ".$row['rut_inst'].", ".$row['correo']."</td>";
					echo "<Td>".$row['n_doc']."</td>";
					echo "</tr><tr> <td colspan='2'>Usuario</td><td>&nbsp</td>";					
					echo "</tr><tr>";					
					echo "<Td>";
					echo $row['usr_nombre'].", ".$row['full_name'].", ";
					echo $row['email'].", ".$row['rut_usr'].", ".$row['telf']."\n</td><td colspan='2'>".nl2br($row['comentario'])."</td>";



					echo "</tr>\n".
							"<tr bgcolor='FFFFF'><td colspan='3'>&nbsp;</td></tr>";

				}

				echo "</table>";
	
				
			}
		}
		$result=null;
		$row=null;
		$rows=null;
		$consulta=	"SELECT pedidos_det.id_item, pedidos_det.id_pedido, pedidos_det.id_deposito, pr_bodegas.id_prbodega, pr_bodegas.nombre, ".
						"pedidos_det.id_prod, productos.id_prod, productos.nombre AS prod_nombre, productos.codigob1, productos.codigob2, ".
						"pedidos_det.cantidad ".
					"FROM pedidos_det,pr_bodegas,productos ".
					"WHERE pedidos_det.id_deposito=pr_bodegas.id_prbodega AND pedidos_det.id_prod=productos.id_prod AND pedidos_det.id_pedido='$id' ".
					"ORDER BY pedidos_det.id_item";
		
		if ($result = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			echo "<center><br>Productos en esta Orden<br>\n<TABLE BORDER=1 cellpadding=5 cellspacing=0 heigth=50 ALIGN='center'>\n";
			if($numero_resultados==0){
				echo "<tr><td colspan='9'>no se encontro informacion</td></tr>\n";
			} else {

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}
				foreach($rows as $row){
					echo "<TR >\n";
					echo "<Td>".$row['id_item']."</td>";
					//echo "<Td>".$row['id_pedido']."</td>";
					echo "<Td>".$row['id_deposito']."</td>";
					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['id_prod']."</td>";
					echo "<Td>".$row['prod_nombre']."</td>";
					echo "<Td>".$row['codigob1']."</td>";
					echo "<Td>".$row['codigob2']."</td>";
					echo "<Td>".$row['cantidad']."</td>";
					echo "</tr>\n";

				}

				/* free result set */
				$result->close();

 			 }
		 
		}

		echo "</table>";		
			
				
		
	
	
	
	
	
	
	
	
	break;
	case 3:
	break;
	case 5:
		// Seccion que controla el ingreso de productos en el pedido
		if($id==0){
			echo"<br><br><br><br><br><h1><center>En Espera...<center></h1>";
		}else{
			echo"a procesar!";

		
		$consulta=	"SELECT pedidos_det.id_item, pedidos_det.id_pedido, pedidos_det.id_deposito, pr_bodegas.id_prbodega, pr_bodegas.nombre, ".
						"pedidos_det.id_prod, productos.id_prod, productos.nombre AS prod_nombre, productos.codigob1, productos.codigob2, ".
						"pedidos_det.cantidad ".
					"FROM pedidos_det,pr_bodegas,productos ".
					"WHERE pedidos_det.id_deposito=pr_bodegas.id_prbodega AND pedidos_det.id_prod=productos.id_prod AND pedidos_det.id_pedido='$id' ".
					"ORDER BY pedidos_det.id_item";
		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);

		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}		
		if ($result = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=2 heigth=50 ALIGN='center' bgcolor=97BDED>\n";
			if($numero_resultados==0){
				echo "<tr bgcolor=D0CFF9><td colspan='9'>no se encontro informacion</td></tr>\n";
			} else {

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}
				foreach($rows as $row){
					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td>".$row['id_item']."</td>";
					//echo "<Td>".$row['id_pedido']."</td>";
					echo "<Td>".$row['id_deposito']."</td>";
					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['id_prod']."</td>";
					echo "<Td>".$row['prod_nombre']."</td>";
					echo "<Td>".$row['codigob1']."</td>";
					echo "<Td>".$row['codigob2']."</td>";
					echo "<Td>".$row['cantidad']."</td>";
					echo "<td><a href=''>".
							"<a href='pedidos.php?op=54&id=$id&item=".$row['id_item']."'><img src='images/editar.png' width='30' height='30'></a>&nbsp;".
							"<a href='pedidos.php?op=53&id=$id&item=".$row['id_item']."'><img src='images/papelera.png' width='30' height='30'></a></td>";



					echo "</tr>\n";

				}

				/* free result set */
				$result->close();

 			 }
		 
		}
		echo "<tr><td colspan='5'>Ingrese el nombre del producto, o alguno de sus codigos</td>\n".
				"<td colspan='3'><form name='form' method='post'  autocomplete='off' action='pedidos.php?op=51&id=$id'>\n".
				"<input type='text' name='busca' size='40'></td>\n".
				"<td><input type='submit' name='button' id='button' value='Enviar' /></td></tr></form>\n";
		echo "</table>";		
			
				
		}

	break;
	case 51:
	
		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);

		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}
		
		if( substr($_POST['busca'],0,3) == "[-]" ){
			$consulta="SELECT id_prod, nombre, codigob1, codigob2, marca, precio, grupo FROM productos WHERE id_prod='".substr($_POST['busca'],3)."'";
		}else{
			$consulta="SELECT id_prod, nombre, codigob1, codigob2, marca, precio, grupo FROM productos WHERE codigob1='".$_POST['busca']."'".
						"OR codigob2='".$_POST['busca']."'".
						"OR nombre LIKE '%".$_POST['busca']."%'";
		}
			
		if ($result = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==0){

				echo "Error: El código no existe, <A HREF='javascript:history.back()'>[ Regresar ]</A>";

			} else {								
				echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=2 heigth=50 ALIGN='center' bgcolor=97BDED>\n";

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}

				foreach($rows as $row){
					echo "<TR bgcolor=D0CFF9>\n";

					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['codigob1']."</td>";
					echo "<Td>".$row['codigob2']."</td>";
					echo "<Td>".$row['marca']."</td>";
					echo "<Td>".$row['precio']."</td>";
					echo "<Td>".$row['grupo']."</td>";
					echo ($numero_resultados > 1 ? 
							"<td><form name='form' method='post' action='pedidos.php?op=51&id=$id'>\n".
							"<input name='busca' type='hidden' value='[-]".$row['id_prod']."' />".
							"<input type='submit' name='button' id='button' value='Seleccionar' />".
							"</form></td>":"").
							"</tr>\n";
					$pr_compra = $row['precio'];
				}
				if($numero_resultados==1){
					echo "<form name='form' method='post'  autocomplete='off' action='pedidos.php?op=52&id=$id'>".
							"<tr><td colspan='2'>Deposito</td><td>Cantidad</td><td colspan='2'>Precio Compra</td></tr>\n";
					echo "<tr><td colspan='2'>";
					
		$consulta="SELECT id_prbodega, id_usr, nombre, ubicacion, comentario FROM pr_bodegas";
		if ($result2 = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==0){

				echo "no se encontro informacion";

			} else {

				echo "<select name='bodega' id='bodega'>\n<option value='0'>Seleccione...</option>";

				while($row2 = $result2->fetch_array()){
					$rows2[] = $row2;
				}

				foreach($rows2 as $row2){
					echo "<option value='".$row2['id_prbodega']."'>".$row2['nombre'].", ".$row2['ubicacion']."</option>";
					echo "\n";

				}

				echo "</select>";

				/* free result set */
				$result2->close();
				$result2 = null;
				$row2 =null;
				$rows2 = null;

 			 }
		 
		}
					
					echo 	"<input name='producto' type='hidden' value='".$row['id_prod']."' />".
							"</td><td><input name='cantidad' type='text' style='text-align:right;'></td>".
							"<td>&nbsp;</td>".
							"<td><input type='submit' name='button' id='button' value='Enviar'></td></tr></form>\n";
				}
				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 die(0);
		}
		
	break;
	case 52:
		// agregar producto
		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);
		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}
		$consulta="SELECT id_item, id_pedido, id_deposito, id_prod, cantidad FROM pedidos_det ".
					"WHERE id_pedido='$id' AND id_deposito='".$_POST['bodega']."' AND  id_prod='".$_POST['producto']."'";

		if ($result = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados > 1){
				echo "<b>Error:</b> este producto ya se encuentra agregado en esta orden de compra, ".
						"modifique la cantidad que intenta agregar al pedido<br>".
						"<a href='pedidos.php?op=5&id=".$id."'>[ Regresar ]</a>".
						"<meta http-equiv='refresh' content=\"4; URL='pedidos.php?op=5&id=".$id."'\" />";;
				die(0);
			}
		}
		$result = null;

		$consulta="INSERT INTO pedidos_det ( id_item, id_pedido, id_deposito, id_prod, cantidad ) ".
					"VALUES ( null,'".$id."','".$_POST['bodega']."','".$_POST['producto']."','".$_POST['cantidad']."' )";
		if ($result = $mysqli->query($consulta)) {

			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==1){
				echo "<br>Se agrego un nuevo <b>Producto</b><br>\n".
						"<meta http-equiv='refresh' content=\"2; URL='pedidos.php?op=5&id=".$id."'\" />";
			} else {
				echo "<br><b>ERROR</b> al agrergar";
			}

		    $mysqli->close();
		}
	break;
	case 53:
	//eliminar producto
		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);
		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}
		$consulta="DELETE FROM pedidos_det WHERE id_item='$item' AND id_pedido='$id' LIMIT 1";
		if ($result = $mysqli->query($consulta)) {
			echo "Se ha Eliminado un registro".
					"<a href='pedidos.php?op=5&id=".$id."'>[ Continuar ]</a>".			
					"<meta http-equiv='refresh' content=\"4; URL='pedidos.php?op=5&id=".$id."'\" />";
			

		}
	
	break;
	case 54:
	//editar producto
		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);
		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}	
		$consulta=	"SELECT pedidos_det.id_item, pedidos_det.id_pedido, pedidos_det.id_deposito, pr_bodegas.id_prbodega, pr_bodegas.nombre, ".
						"pedidos_det.id_prod, productos.id_prod, productos.nombre AS prod_nombre, productos.codigob1, productos.codigob2, ".
						"pedidos_det.cantidad ".
					"FROM pedidos_det,pr_bodegas,productos ".
					"WHERE pedidos_det.id_deposito=pr_bodegas.id_prbodega AND pedidos_det.id_prod=productos.id_prod AND pedidos_det.id_pedido='$id' ".
					"AND pedidos_det.id_item='$item'";	
		if ($result = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			echo "<center>\n".
					"<TABLE BORDER=1 cellpadding=5 cellspacing=0 heigth=50 ALIGN='center' bgcolor=97BDED>\n";
			if($numero_resultados==0){
				echo "<tr bgcolor=D0CFF9><td colspan='9'>no se encontro informacion</td></tr>\n";
			} else {
				echo "<tr><td>id</td><td>Deposito</td><td>Código</td><td>Producto</td>".
						"<td>Codigo B1</td><td>Codigo B2</td><td>Cantidad</td></tr>\n";
				while($row = $result->fetch_array()){
					$rows[] = $row;
				}
				foreach($rows as $row){
					echo "<form name='form' method='post' autocomplete='off' action='pedidos.php?op=55&id=$id&item=".$row['id_item'].
						"'>\n<TR bgcolor=D0CFF9>\n";
					echo "<Td>".$row['id_item']."</td>";
					//echo "<Td>".$row['id_pedido']."</td>";
					//echo "<Td>".$row['id_deposito'];
					echo "<Td>";					
					$consulta="SELECT id_prbodega, id_usr, nombre, ubicacion, comentario FROM pr_bodegas";
					if ($result2 = $mysqli->query($consulta)) {
						$numero_resultados = $mysqli->affected_rows; 
						if($numero_resultados==0){
							echo "no se encontro informacion";
						} else {

							echo "<select name='bodega' id='bodega'>\n<option value='0'>Seleccione...</option>";

							while($row2 = $result2->fetch_array()){
								$rows2[] = $row2;
							}

							foreach($rows2 as $row2){
								echo "<option value='".$row2['id_prbodega']."'".
									($row['id_deposito']==$row2['id_prbodega']?' selected ':'').">".$row2['nombre'].", ".$row2['ubicacion']."</option>".
									 "\n";

							}

							echo "</select>";

							/* free result set */
							$result2->close();
							$result2 = null;
							$row2 =null;
							$rows2 = null;

 			 		}
		 
				}
				echo "</td>";
				//echo "<Td>".$row['nombre']."</td>";
				echo "<Td>".$row['id_prod']."</td>";
				echo "<Td>".$row['prod_nombre']."</td>";
				echo "<Td>".$row['codigob1']."</td>";
				echo "<Td>".$row['codigob2']."</td>";
				echo "<Td><input type='text' name='cantidad' value='".$row['cantidad']."' style='text-align:right;' size='3'></td>";

				echo "</tr>\n";
			}
			/* free result set */
			$result->close();

 		 }
		 
		}
		echo "<tr><td align='center' colspan='8'><input type='submit' name='button' id='button' value='Enviar'></td></tr>".
				"</table>\n</form>";

	
	
	break;
	case 55:
	//guardar producto editado
		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);
		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}	
		$consulta="UPDATE pedidos_det SET id_deposito =  '".$_POST['bodega']."', cantidad =  '".$_POST['cantidad']."' WHERE  id_item = '$item'";

		echo $consulta."<br>";
		if ($result = $mysqli->query($consulta)) {
			echo "Se ha Editado un registro".
					"<a href='pedidos.php?op=5&id=".$id."'>[ Continuar ]</a>".			
					"<meta http-equiv='refresh' content=\"4; URL='pedidos.php?op=5&id=".$id."'\" />";
			

		}
			
	break;


}

echo "</body>\n</html>";
?>