<?php
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>\n".
		"<html xmlns='http://www.w3.org/1999/xhtml'>\n".
		"<head>\n".
		"<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />".
		"<script language='javascript' src='calendar/calendar.js'></script>".
		"</head>\n<body link='#0000FF' vlink='#0000FF' alink='#0000FF'>\n";
		
include('db_config.php');
require_once('calendar/classes/tc_calendar.php');

if (empty($_GET['op']))  { $op=0;}  else { $op=$_GET['op'];}
if (empty($_GET['usr'])) { $usr=0;} else { $usr=$_GET['usr'];}
if (empty($_GET['inst'])) { $inst=0;} else { $inst=$_GET['inst'];}
if (empty($_GET['id']))  { $id=0;}  else { $id=$_GET['id'];}
$year3 = date("Y")+3;


switch($op){

	case 1:
		//nueva compra

		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);
		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}		


		$consulta="SELECT h_entrega.id_prestamo, h_entrega.id_instalador, h_entrega.id_usuario, h_entrega.fecha, ".
					"DATE_FORMAT(h_entrega.fecha,'%d-%m-%Y') as pr_fecha, h_entrega.comentario, h_entrega.status, ".
					"usuarios.id_usr, usuarios.usr_nombre, usuarios.full_name, usuarios.email, usuarios.rut AS rut_usr, ".
					"usuarios.telf, instaladores.id_inst, instaladores.nombre, instaladores.f_nac, ".
					"DATE_FORMAT(instaladores.f_nac,'%d-%m-%Y') AS fnac, instaladores.rut AS rut_inst, instaladores.correo, ".
					"instaladores.direccion ".
				"FROM h_entrega, usuarios, instaladores ".
				"WHERE h_entrega.id_usuario = usuarios.id_usr ".
					"AND h_entrega.id_instalador = instaladores.id_inst AND h_entrega.status = '0'";
/*


SELECT h_entrega.id_prestamo, h_entrega.id_instalador, h_entrega.id_usuario, h_entrega.fecha, DATE_FORMAT(h_entrega.fecha,'%d-%m-%Y') as pr_fecha, 
	h_entrega.comentario, h_entrega.status, usuarios.id_usr, usuarios.usr_nombre, 
	usuarios.full_name, usuarios.email, usuarios.rut AS rut_usr, usuarios.telf, instaladores.id_inst, instaladores.nombre, instaladores.f_nac, 	
	DATE_FORMAT(instaladores.f_nac,'%d-%m-%Y') AS fnac, instaladores.rut AS rut_inst, instaladores.correo, instaladores.direccion,
FROM h_entrega, usuarios, instaladores WHERE h_entrega.id_usuario = usuarios.id_usr AND h_entrega.id_instalador = instaladores.id_inst AND 
		h_entrega.status = '0'


*/

		if ($result = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			///////->echo $numero_resultados;
			if($numero_resultados==0){
				echo "<form id='form' name='form' method='post'  autocomplete='off' action='".basename(__FILE__)."?op=22&usr=$usr'>\n".
						"<table width='80%' border='1' align='center' cellpadding='5' cellspacing='0'>\n".
						"<tr>\n".
						"<td>Fecha Prestamo</td>\n".
						"<td>Instalador</td>\n".
						"<td align='center'><select name='status' id='status'>\n".
											"<option value='0'>Seleccione...</option>\n".
											"<option value='1'>Iniciar Prestamo</option>\n".
											"<option value='2'>Cerrar Prestamo</option>\n".
						"</select></td>\n</tr>".
						"<tr>\n<td>\n";

				//instantiate class and set properties
				$myCalendar = new tc_calendar("fecha", true);
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
			"<td align='center'><input type='submit' name='button' id='button' value='Enviar' /></td>\n".
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

	
			echo "</td>\n<td colspan='2' align='center'>Comentario:<br><textarea name='comentario' id='comentario' cols='80' rows='3'></textarea></td>\n".

			"</tr>\n</table></form>\n".
			"<center><iframe id='pr_frame' name='pr_frame' align='middle' src='".basename(__FILE__)."?op=5&id=0' ".
			"frameborder='1' style='overflow: hidden; height: 500; width: 80%; position: relative;' height='500' width='80%'>".
			"</iframe><br>\n</center>";				
				
				}else{

			echo "Buscar registo de compras pendientes";

				echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=2 heigth=50 ALIGN='center' bgcolor=97BDED>\n";

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}
				foreach($rows as $row){


					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td colspan='3'>Prestamo de Herramientas: ".$row['id_prestamo']."</td></tr><tr>"; 
					echo "<td>Fecha de Prestamo</td><td>Instalador</td><td>Usuario</td></tr><tr>";
					echo "<Td>".$row['pr_fecha']."</td>";

					echo "<Td>".$row['nombre'].", ".$row['fnac'].", ".$row['rut_inst'].", ".$row['correo']."</td>";
					echo "<Td>".$row['usr_nombre'].", ".$row['full_name'].", ".
					 $row['email'].", ".$row['rut_usr'].", ".$row['telf']."</td>";
					echo "</tr><tr> <td colspan='2'>Comentario</td><td> </td>";					
					echo "</tr><tr>";					
					echo "<Td colspan='2'>".nl2br($row['comentario']);
					echo "\n</td>";

					echo "<td><button onclick=\"window.location.href='".basename(__FILE__)."?op=22&usr=".$row['id_usr'].
									"&id=".$row['id_prestamo']."'\">Continuar</button></td>";


					echo "</tr>\n";

				}

				echo "</table>";

				}}
	
	break;
	case 22:

		//cerrar compra
		if((empty($_POST['status'])? 0 :$_POST['status']) == 2 ){
			/*
			pasos: 	1) buscar las herramientas del pedido y marcarla como ocupada

					2) marcar el pedido como finalizad0.
			*/
			
		$consulta=	"SELECT id_prestamo, id_herramienta FROM h_entr_dtalle WHERE id_prestamo='$id'";
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

				foreach($rows as $row){
					

					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td>".$row['id_prestamo']."</td>";
					echo "<Td>".$row['id_herramienta']."</td>";

					echo "</tr>\n";
					// actualizar herramientas

					$consulta2 = "UPDATE herramientas SET id_instalador='$inst', id_prestamo='$id' WHERE id_tool='".$row['id_herramienta']."'";
					echo "<tr><td colspan='10'>Actualizando ficha herramienta";
					if ($result2 = $mysqli->query($consulta2)) {
						$numero_resultados = $mysqli->affected_rows; 
						if($numero_resultados==0){
							echo "no se encontro informacion";
						} else {


				/* free result set */

				$result2 = null;
				$row2 = null;
				$rows2 = null;
 			 }
		}
					$consulta2 = "UPDATE h_entrega SET status='1' WHERE id_prestamo='".$id."'";
					echo "<tr><td colspan='10'>cerrando ficha prestamo";
					if ($result2 = $mysqli->query($consulta2)) {
						$numero_resultados = $mysqli->affected_rows; 
						if($numero_resultados==0){
							echo "no se encontro informacion";
						} else {


				/* free result set */

				$result2 = null;
				$row2 = null;
				$rows2 = null;
 			 }
		}
		echo "</td></tr>";
		}

 			
				
				$result2 = null;
		
				
				/* free result set */
				$result= null;
				echo "</table>\n";

 			 }
		 
		}
			
			die(0);
		}

		// Agregar Compra
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
			echo "Agregar: ";
			$consulta="INSERT INTO h_entrega (id_prestamo, id_instalador, id_usuario, fecha, comentario, status) ".
					"VALUES ( null, '".$_POST['instalador']."', '".$usr."', '".
					$_POST['fecha']."', '".$_POST['comentario']."', '0')";

			$inst=$_POST['instalador'];
			if ($result = $mysqli->query($consulta)) {
				$numero_resultados = $mysqli->affected_rows; 
				if($numero_resultados==1){
					echo "Nuevo <b>Prestamo de Herramientas</b>\n";
				} else {
					echo "<br><b>ERROR</b> al agrergar";
				}
			}
			echo "</td></tr>";
			$result = null;
			$consulta="SELECT id_prestamo, id_instalador, id_usuario, fecha, comentario, status FROM h_entrega ".
						"WHERE id_instalador='".$_POST['instalador']."' AND id_usuario = '$usr'  AND ".
							"fecha = '".$_POST['fecha']."' AND comentario='".$_POST['comentario']."' LIMIT 1";
			$inst=$_POST['instalador'];

		}else{
			echo "$id: buscar ficha prestamo y continuar";
			$consulta="SELECT id_prestamo, id_instalador, id_usuario, fecha, comentario, status FROM h_entrega WHERE id_prestamo='$id' LIMIT 1";			
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
			
					$inst=$row['id_instalador'];
					echo "<form id='form' name='form' method='post'  autocomplete='off' ".
							"action='".basename(__FILE__)."?op=22&inst=".$inst."&id=".$row['id_prestamo']."&usr=$usr'>".							
							'<tr>'.
							'<td>Fecha Prestamo</td>'.
							'<td>Instalador, que solicita las herramientas</td>'.
							'<td align="center">'. "<select name='status' id='status'>\n".
							"<option value='0'>Seleccione...</option>\n".
							"<option value='1'>Iniciar Prestamo</option>\n".
							"<option value='2' selected >Cerrar Prestamo</option>".
							"</select></td></tr><tr><td>";
							
					$fecha = date_create($row['fecha']);	
					
					$myCalendar = new tc_calendar("fecha", true);
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
		$inst=$row['id_instalador'];
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
				"<td align='center'><input type='submit' name='button' id='button' value='Enviar' /></td>\n".
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
			"<td colspan='2'>Comentario: ".nl2br($row['comentario'])."</td>\n".
			"".
			"</tr>\n</table>\n</form>\n";					
					
					
					
						
					echo "<center><iframe id='pr_frame' name='pr_frame' align='middle' src='".basename(__FILE__)."?op=5&inst=".$inst."&id=".$row['id_prestamo']."' ".
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
	case 3:
	// reporte de compras
		echo "<br><h1>\n<center>Consultar las compras</center></h1>\n<br>\n";
		/*
		
		SELECT proveedores.id_prov, proveedores.nombre, rut, contacto, fono, web, email, comentario, activo FROM proveedores
		
		*/

		$consulta="SELECT compras.id_compra, compras.f_compra,DATE_FORMAT(f_compra,'%d-%m-%Y') AS fcompra, compras.id_usr, usuarios.id_usr, ".
						"usuarios.usr_nombre, usuarios.full_name ,compras.id_prov, proveedores.id_prov, proveedores.nombre,".
						"compras.n_doc, compras.monto, compras.procesada ".
					"FROM compras, usuarios, proveedores WHERE compras.procesada='1' AND compras.id_usr = usuarios.id_usr ".
						"AND compras.id_prov = proveedores.id_prov ORDER BY compras.id_compra DESC";
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

				foreach($rows as $row){

					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td>".$row['id_compra']."</td>";
					echo "<Td>".$row['fcompra']."</td>";
					echo "<Td>".$row['id_usr']."</td>";
					echo "<Td>".$row['usr_nombre']."</td>";
					echo "<Td>".$row['id_prov']."</td>";
					echo "<Td>".$row['nombre']."</td>";					
					echo "<Td>".$row['n_doc']."</td>";
					echo "<Td>".$row['monto']."</td>";
					echo "<Td>".$row['procesada']."</td>";
					echo "<td><button onclick=\"window.location.href='compras.php?op=31&id=".$row['id_compra']."'\">Ver Compra</button></td>";



					echo "</tr>\n";

				}

				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 die(0);
		}

	
	
	
	break;
	case 31:
		echo "<br><h1>\n<center>Consultar las compras</center></h1>\n<br>\n";
		/*
		
		SELECT proveedores.id_prov, proveedores.nombre, rut, contacto, fono, web, email, comentario, activo FROM proveedores
		
		*/

		$consulta="SELECT compras.id_compra, compras.f_compra,DATE_FORMAT(f_compra,'%d-%m-%Y') AS fcompra, compras.id_usr, usuarios.id_usr, ".
						"usuarios.usr_nombre, usuarios.full_name ,compras.id_prov, proveedores.id_prov, proveedores.nombre,".
						"compras.n_doc, compras.monto, compras.procesada ".
					"FROM compras, usuarios, proveedores WHERE compras.procesada='1' AND compras.id_usr = usuarios.id_usr ".
						"AND compras.id_prov = proveedores.id_prov AND compras.id_compra = '$id'";
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

				foreach($rows as $row){

					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td>".$row['id_compra']."</td>";
					echo "<Td>".$row['fcompra']."</td>";
					echo "<Td>".$row['id_usr']."</td>";
					echo "<Td>".$row['usr_nombre']."</td>";
					echo "<Td>".$row['id_prov']."</td>";
					echo "<Td>".$row['nombre']."</td>";					
					echo "<Td>".$row['n_doc']."</td>";
					echo "<Td>".$row['monto']."</td>";
					echo "<Td>".$row['procesada']."</td>";

					echo "</tr></table><br>\n";
					
							
		$consulta=	"SELECT compras_det.id_item, compras_det.id_compra, compras_det.id_deposito, pr_bodegas.id_prbodega, pr_bodegas.nombre, ".
						"compras_det.id_prod, productos.id_prod, productos.nombre AS prod_nombre, productos.codigob1, productos.codigob2, ".
						"compras_det.cantidad, compras_det.pr_compra ".
					"FROM compras_det,pr_bodegas,productos ".
					"WHERE compras_det.id_deposito=pr_bodegas.id_prbodega AND compras_det.id_prod=productos.id_prod AND compras_det.id_compra='$id'";
		
		if ($result2 = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=2 heigth=50 ALIGN='center' bgcolor=97BDED>\n";
			if($numero_resultados==0){
				echo "<tr bgcolor=D0CFF9><td colspan='9'>no se encontro informacion</td></tr>\n";
			} else {

				while($row2 = $result2->fetch_array()){
					$rows2[] = $row2;
				}

				foreach($rows2 as $row2){

					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td>".$row2['id_item']."</td>";
					echo "<Td>".$row2['id_compra']."</td>";
					echo "<Td>".$row2['id_deposito']."</td>";
					echo "<Td>".$row2['nombre']."</td>";
					echo "<Td>".$row2['id_prod']."</td>";
					echo "<Td>".$row2['prod_nombre']."</td>";
					echo "<Td>".$row2['codigob1']."</td>";
					echo "<Td>".$row2['codigob2']."</td>";
					echo "<Td>".$row2['cantidad']."</td>";
					echo "<Td>".$row2['pr_compra']."</td>";


					echo "</tr>\n";

				}



 			 }
		 
		}

		echo "</table>";		
					

				}



				/* free result set */
				$result->close();

 			 }
		 die(0);
		}
	
	
	
	
	
	
	break;
	case 5:
		// Seccion que controla el ingreso de productos en la orden de compra
		if($id==0){
			echo"<br><br><br><br><br><h1><center>En Espera...<center></h1>";
		}else{
			echo"a procesar!";

		
		$consulta=	"SELECT h_entr_dtalle.id_prestamo, h_entr_dtalle.id_herramienta , ".
						"herramientas.id_tool, herramientas.id_instalador, herramientas.id_prestamo, ".
						"herramientas.nombre, herramientas.codigo1, herramientas.codigo2, ".
						"herramientas.comentario, herramientas.status ".
					"FROM herramientas, h_entr_dtalle ".
					"WHERE h_entr_dtalle.id_prestamo='$id' ".
						"AND h_entr_dtalle.id_herramienta = herramientas.id_tool";

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
					echo "<Td>".$row['id_tool']."</td>";
					echo "<Td>".$row['nombre']."</td>";
/*					echo "<Td>".$row['id_deposito']."</td>";
					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['id_prod']."</td>";
					echo "<Td>".$row['prod_nombre']."</td>";
					echo "<Td>".$row['codigob1']."</td>";
					echo "<Td>".$row['codigob2']."</td>";
					echo "<Td>".$row['cantidad']."</td>";
					echo "<Td>".$row['pr_compra']."</td>";
*/

					echo "</tr>\n";

				}

				/* free result set */
				$result->close();

 			 }
		 
		}
		echo "<tr><td colspan='5'>Ingrese el nombre del producto, o alguno de sus codigos</td>\n".
				"<td colspan='3'><form name='form' method='post'  autocomplete='off' action='".basename(__FILE__)."?op=51&inst=".$inst."&id=$id'>\n".
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
			$consulta="SELECT id_tool, id_instalador, id_prestamo, nombre, codigo1, codigo2, comentario, status  ".
						"FROM herramientas WHERE id_instalador='0' AND id_tool='".substr($_POST['busca'],3)."'";
		}else{
			
			
			$consulta="SELECT id_tool, id_instalador, id_prestamo, nombre, codigo1, codigo2, comentario, status ".
						"FROM herramientas ".
						"WHERE nombre LIKE '%".$_POST['busca']."%' OR codigo1='".$_POST['busca']."'"." OR codigo2='".$_POST['busca']."'";
		}

		if ($result = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==0){

				echo "Error: El código no existe,".
						" O la herramienta se encuentra en manos de otro instalador, <A HREF='javascript:history.back()'>[ Regresar ]</A>";

			} else {								
				echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=2 heigth=50 ALIGN='center' bgcolor=97BDED>\n";

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}

				foreach($rows as $row){
					echo "<TR bgcolor=D0CFF9>\n";

					echo "<Td>".$row['id_tool']."</td>";
					echo "<Td>".$row['id_instalador']."</td>";
					echo "<Td>".$row['id_prestamo']."</td>";
					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['codigo1']."</td>";
					echo "<Td>".$row['codigo2']."</td>";
					echo "</tr><tr><td colspan='4'>".$row['comentario']."</td>";
					echo ($numero_resultados > 1 ? 
							"<td><form name='form' method='post' action='".basename(__FILE__)."?op=51&inst=".$inst."&id=$id'>\n".
							"<input name='busca' type='hidden' value='[-]".$row['id_tool']."' />".
							"<input type='submit' name='button' id='button' value='Seleccionar' />".
							"</form></td>":"").
							"\n";
					
				}
				if($numero_resultados==1){
					echo "<form name='form' method='post'  autocomplete='off' action='".basename(__FILE__)."?op=52&inst=".$inst."&id=$id'>".
							"\n";
					echo "<td colspan='2' align='center'>";
					

					
					echo 	"<input name='herramienta' type='hidden' value='".$row['id_tool']."' />".
							"<input type='submit' name='button' id='button' value='Prestar'></td></tr></form>\n";
				}
				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 die(0);
		}
		
	break;
	case 52:


		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);
		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}


		$consulta="SELECT id_prestamo, id_herramienta FROM h_entr_dtalle WHERE id_prestamo='".$id."' AND id_herramienta ='".$_POST['herramienta']."' ";
		
		if ($result2 = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==0){ 
				$consulta="INSERT INTO h_entr_dtalle (id_prestamo, id_herramienta) VALUES ('".$id."', '".$_POST['herramienta']."')";		
	
				if ($result = $mysqli->query($consulta)) {

				$numero_resultados = $mysqli->affected_rows; 
				if($numero_resultados==1){
					echo "<br>Se agrego una nueva <b>Herramienta</b><br>\n".
							"<meta http-equiv='refresh' content=\"2; URL='".basename(__FILE__)."?op=5&inst=".$inst."&id=".$id."'\" />";
				} else {
					echo "<br><b>ERROR</b> al agrergar";
				}
				}}else{
					echo "<b>Error</b> esta herramienta ya se encuentra agregada".
					"<meta http-equiv='refresh' content=\"3; URL='".basename(__FILE__)."?op=5&inst=".$inst."&id=".$id."'\" />";;
					}

		    $mysqli->close();
		}
	break;
}
echo "</body>\n</html>";
?>