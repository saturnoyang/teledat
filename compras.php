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
if (empty($_GET['id']))  { $id=0;}  else { $id=$_GET['id'];}
$year3 = date("Y")+3;

switch($op){
	case 1:
	
		echo "<center><input type='button' value='Nueva Compra' onclick=\"window.location='compras.php?op=2&usr=$usr'\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";	
		echo "<input type='button' value='Reporte Compras' onclick=\"window.location='compras.php?op=3'\" /></center>";		
	
	break;
	case 2:
		//nueva compra

		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);
		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}		

		$consulta="SELECT compras.id_compra, compras.f_compra, DATE_FORMAT(compras.f_compra,'%d-%m-%Y') AS fcompra, compras.id_usr, ".
					"compras.id_prov, compras.n_doc, compras.monto, compras.procesada, ".
					"proveedores.id_prov, proveedores.nombre, proveedores.rut, proveedores.contacto, proveedores.fono, proveedores.web, ".
					"proveedores.email, proveedores.comentario, proveedores.activo,  ".
					"usuarios.id_usr, usuarios.usr_nombre, ".
					"usuarios.full_name, usuarios.email, usuarios.rut AS rut_usr, usuarios.telf ".
					"FROM compras, usuarios, proveedores WHERE proveedores.id_prov = compras.id_prov AND compras.id_usr = usuarios.id_usr AND procesada='0'";
		if ($result = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			///////->echo $numero_resultados;
			if($numero_resultados==0){
				echo "<form id='form' name='form' method='post'  autocomplete='off' action='compras.php?op=22&usr=$usr'>\n".
						"<table width='80%' border='1' align='center' cellpadding='5' cellspacing='0'>\n".
						"<tr>\n".
						"<td>Fecha compra</td>\n".
						"<td>Proveedor</td>\n".
						"<td>Numero Documento</td>\n</tr>".
						"<tr>\n<td>\n";

				//instantiate class and set properties
				$myCalendar = new tc_calendar("fecha_compra", true);
				$myCalendar->setPath("calendar/");
				$myCalendar->setTimezone("America/Santiago");
				$myCalendar->setYearInterval(1940, date("Y") );
				$myCalendar->setDate(date("d"), date("m"),date("Y"));
				$myCalendar->setIcon("calendar/images/iconCalendar.gif");
				//output the calendar
				$myCalendar->writeScript(); 
				echo "</td>\n<td>\n";
				$consulta="SELECT id_prov, nombre, rut, contacto, fono, web, email, comentario, activo FROM proveedores ORDER BY nombre";
				if ($result2 = $mysqli->query($consulta)) {
					$numero_resultados = $mysqli->affected_rows; 
					if($numero_resultados==0){
						echo "no se encontro informacion";
					} else {
						echo "<select name='proveedor' id='proveedor'>\n<option value='0'>Seleccione...</option>";

						while($row = $result2->fetch_array()){
							$rows[] = $row;
						}

						foreach($rows as $row){
							echo "<option value='".$row['id_prov']."'>".$row['nombre'].", ".$row['rut'].", ".$row['contacto'].
								", ".$row['fono'].", ".$row['web'].", ".$row['email'].", ".$row['comentario'].", ".
								$row['activo']."</option>\n";
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

	
			echo "</td>\n<td>Monto: <input type='text' name='monto' value='0' style='text-align:right;'></td>\n".
			"<td><select name='status' id='status'>\n".
			"<option value='0'>Seleccione...</option>\n".
			"<option value='1'>Iniciar Compra</option>\n".
			"<option value='2'>Cerrar Compra</option>\n".
			"</select>&nbsp;&nbsp;&nbsp;&nbsp;<input type='submit' name='button' id='button' value='Enviar' /></td>\n".
			"</tr>\n</table></form>\n".
			"<center><iframe id='pr_frame' name='pr_frame' align='middle' src='compras.php?op=5&id=0' ".
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
					echo "<Td colspan='3'>Ficha de Compra: ".$row['id_compra']."</td></tr><tr>"; 
					echo "<td>Fecha de Compra</td><td>Proveedor</td><td>Num Documento</td></tr><tr>";
					echo "<Td>".$row['fcompra']."</td>";

					echo "<Td>".$row['nombre'].", ".$row['rut'].", ".$row['contacto'].", ".$row['email']."</td>";
					echo "<Td>".$row['n_doc']."</td>";
					echo "</tr><tr> <td colspan='2'>Usuario</td><td>&nbsp</td>";					
					echo "</tr><tr>";					
					echo "<Td colspan='2'>";
					echo $row['usr_nombre'].", ".$row['full_name'].", ";
					echo $row['email'].", ".$row['rut_usr'].", ".$row['telf']."\n</td>";

					echo "<td><button onclick=\"window.location.href='compras.php?op=22&usr=".$row['id_usr'].
									"&id=".$row['id_compra']."'\">Continuar</button></td>";


					echo "</tr>\n";

				}

				echo "</table>";

				}}
	
	break;
	case 22:

		//cerrar compra
		if((empty($_POST['status'])? 0 :$_POST['status']) == 2 ){
			/*
			pasos: 	1) comparar precio producto, precio compra, actualizar si es necesario
					2) buscar en el stock la existencia actual, sumar la comprada
					3) marcar la compra como finalizada.
			*/
			
		$consulta=	"SELECT compras_det.id_item, compras_det.id_compra, compras_det.id_deposito, pr_bodegas.id_prbodega, pr_bodegas.nombre, ".
						"compras_det.id_prod, productos.id_prod, productos.nombre AS prod_nombre, productos.codigob1, productos.codigob2, ".
						"compras_det.cantidad, compras_det.pr_compra ".
					"FROM compras_det,pr_bodegas,productos ".
					"WHERE compras_det.id_deposito=pr_bodegas.id_prbodega AND compras_det.id_prod=productos.id_prod AND compras_det.id_compra='$id'";
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
					// comparar precio de compra

					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td>".$row['id_item']."</td>";
					echo "<Td>".$row['id_compra']."</td>";
					echo "<Td>".$row['id_deposito']."</td>";
					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['id_prod']."</td>";
					echo "<Td>".$row['prod_nombre']."</td>";
					echo "<Td>".$row['codigob1']."</td>";
					echo "<Td>".$row['codigob2']."</td>";
					echo "<Td>".$row['cantidad']."</td>";
					echo "<Td>".$row['pr_compra']."</td>";


					echo "</tr>\n";

					$consulta2 = "SELECT id_prod, nombre, codigob1, codigob2, marca, precio, grupo FROM productos WHERE id_prod = '".$row['id_prod']."'";
					echo "<tr><td colspan='10'>Comparar Precio compra = Precio en sistema";
					if ($result2 = $mysqli->query($consulta2)) {
						$numero_resultados = $mysqli->affected_rows; 
						if($numero_resultados==0){
							echo "no se encontro informacion";
						} else {

						while($row2 = $result2->fetch_array()){
							$rows2[] = $row2;
						}

					foreach($rows2 as $row2){
						//echo $row2['id_prod'].", ".$row2['nombre'].", ".$row2['precio']."<br>";
						//echo "\n";
						$consulta = null;
						if($row2['precio'] != $row['pr_compra']){
							$consulta="UPDATE productos SET precio =  '".$row['pr_compra']."' WHERE id_prod = '".$row2['id_prod']."'";						
						}else{
							$consulta = null;
						}
					}

				/* free result set */
				$result2->close();
				$result2 = null;
				$row2 = null;
				$rows2 = null;
				if ($consulta != null ) {
					if ($result2 = $mysqli->query($consulta)) {
						echo "<br>Se Actualizo el precio en el sistema";
					}
				}
 			 }
		}
		echo "</td></tr>";
		}
				foreach($rows as $row){
					// actualizar la existencia

					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td>".$row['id_item']."</td>";
					echo "<Td>".$row['id_compra']."</td>";
					echo "<Td>".$row['id_deposito']."</td>";
					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['id_prod']."</td>";
					echo "<Td>".$row['prod_nombre']."</td>";
					echo "<Td>".$row['codigob1']."</td>";
					echo "<Td>".$row['codigob2']."</td>";
					echo "<Td>".$row['cantidad']."</td>";
					echo "<Td>".$row['pr_compra']."</td>";
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
							$consulta="UPDATE prod_stock SET stock = '".($row2['stock'] + $row['cantidad'])."' ".
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
 			
				$consulta = "UPDATE compras SET  procesada = '1' WHERE  id_compra = '$id';";
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
			echo "$id: no asignado agregar";
			$consulta="INSERT INTO compras ( id_compra, f_compra, id_usr, id_prov, n_doc, monto, procesada) ".
					"VALUES ( null, '".$_POST['fecha_compra']."', '".$_POST['id_usuario']."', '".
					$_POST['proveedor']."', '".$_POST['n_doc']."', '".$_POST['monto']."', '0')";

			if ($result = $mysqli->query($consulta)) {
				$numero_resultados = $mysqli->affected_rows; 
				if($numero_resultados==1){
					echo "Se agrego una nueva <b>Compra</b>\n";
				} else {
					echo "<br><b>ERROR</b> al agrergar";
				}
			}
			echo "</td></tr>";
			$result = null;
			$consulta="SELECT id_compra, f_compra, id_usr, id_prov, n_doc, monto, procesada FROM compras WHERE f_compra = '".$_POST['fecha_compra']."' ".
						"AND n_doc='".$_POST['n_doc']."' AND id_prov='".$_POST['proveedor']."' LIMIT 1";
		}else{
			echo "$id: asignado para continuar un pedido, buscar pedido y continuar";
			$consulta="SELECT id_compra, f_compra, id_usr, id_prov, n_doc, monto, procesada FROM compras WHERE id_compra='$id' LIMIT 1";			
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
			
					echo "<form id='form' name='form' method='post'  autocomplete='off' action='compras.php?op=22&id=".$row['id_compra']."&usr=$usr'>".							
							'<tr>'.
							'<td>Fecha compra</td>'.
							'<td>Proveedor</td>'.
							'<td>Numero Documento</td></tr><tr><td>';
							
					$fecha = date_create($row['f_compra']);	
					
					$myCalendar = new tc_calendar("fecha_compra", true);
					$myCalendar->setPath("calendar/");
					$myCalendar->setTimezone("America/Santiago");
					$myCalendar->setYearInterval(1940, $year3 );
					$myCalendar->setDate(date_format($fecha, 'd'), date_format($fecha, 'm'),date_format($fecha, 'Y') );
					$myCalendar->setIcon("calendar/images/iconCalendar.gif");
					//output the calendar
					$myCalendar->writeScript();
					echo "</td>\n<td>\n";

		$consulta=	"SELECT id_prov, nombre, rut, contacto, fono, web, email, comentario, activo FROM proveedores ".
					"WHERE id_prov = '".$row['id_prov']."' ORDER BY nombre";
		if ($result2 = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==0){
				echo "no se encontro informacion";

			} else {

				while($row2 = $result2->fetch_array()){
					$rows2[] = $row2;
				}

				foreach($rows2 as $row2){
					echo $row2['nombre'].", ".$row2['rut'].", ".$row2['contacto'].
							", ".$row2['fono'].", ".$row2['web'].", ".$row2['email'].", ".$row2['comentario'].", ";										
					echo $row2['activo'];
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
			"<td>Monto: ".$row['monto']."</td>\n".
			"<td><select name='status' id='status'>\n".
			"<option value='0'>Seleccione...</option>\n".
			"<option value='1'>Iniciar Compra</option>\n".
			"<option value='2' selected >Cerrar Compra</option>".
			"</select>&nbsp;&nbsp;&nbsp;&nbsp; <input type='submit' name='button' id='button' value='Enviar' /></td>".
			"</tr>\n</table>\n</form>\n";					
					
					
					
						
					echo "<center><iframe id='pr_frame' name='pr_frame' align='middle' src='compras.php?op=5&id=".$row['id_compra']."' ".
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

		
		$consulta=	"SELECT compras_det.id_item, compras_det.id_compra, compras_det.id_deposito, pr_bodegas.id_prbodega, pr_bodegas.nombre, ".
						"compras_det.id_prod, productos.id_prod, productos.nombre AS prod_nombre, productos.codigob1, productos.codigob2, ".
						"compras_det.cantidad, compras_det.pr_compra ".
					"FROM compras_det,pr_bodegas,productos ".
					"WHERE compras_det.id_deposito=pr_bodegas.id_prbodega AND compras_det.id_prod=productos.id_prod AND compras_det.id_compra='$id'";
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
					echo "<Td>".$row['id_compra']."</td>";
					echo "<Td>".$row['id_deposito']."</td>";
					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['id_prod']."</td>";
					echo "<Td>".$row['prod_nombre']."</td>";
					echo "<Td>".$row['codigob1']."</td>";
					echo "<Td>".$row['codigob2']."</td>";
					echo "<Td>".$row['cantidad']."</td>";
					echo "<Td>".$row['pr_compra']."</td>";


					echo "</tr>\n";

				}

				/* free result set */
				$result->close();

 			 }
		 
		}
		echo "<tr><td colspan='5'>Ingrese el nombre del producto, o alguno de sus codigos</td>\n".
				"<td colspan='3'><form name='form' method='post'  autocomplete='off' action='compras.php?op=51&id=$id'>\n".
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
							"<td><form name='form' method='post' action='compras.php?op=51&id=$id'>\n".
							"<input name='busca' type='hidden' value='[-]".$row['id_prod']."' />".
							"<input type='submit' name='button' id='button' value='Seleccionar' />".
							"</form></td>":"").
							"</tr>\n";
					$pr_compra = $row['precio'];
				}
				if($numero_resultados==1){
					echo "<form name='form' method='post'  autocomplete='off' action='compras.php?op=52&id=$id'>".
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
							"<td><input name='pr_compra' type='text' value='".$pr_compra."' style='text-align:right;'></td>".
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
	

		$consulta="INSERT INTO compras_det( id_item, id_compra, id_deposito, id_prod, cantidad, pr_compra) ".
					"VALUES ( null,'".$id."','".$_POST['bodega']."','".$_POST['producto']."','".$_POST['cantidad']."','".$_POST['pr_compra']."')";		

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
			if($numero_resultados==1){
				echo "<br>Se agrego un nuevo <b>Producto</b><br>\n".
						"<meta http-equiv='refresh' content=\"2; URL='compras.php?op=5&id=".$id."'\" />";
			} else {
				echo "<br><b>ERROR</b> al agrergar";
			}

		    $mysqli->close();
		}
	break;
}
echo "</body>\n</html>";
?>