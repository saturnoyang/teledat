<?php
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>\n".
		"<html xmlns='http://www.w3.org/1999/xhtml'>\n".
		"<head>\n".
		"<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />".
		"<script language='javascript' src='calendar/calendar.js'></script>".
		"</head>\n<body link='#0000FF' vlink='#0000FF' alink='#0000FF'>\n";
		
// dashboard.php
// informacion relevante que da la bienvenida al usuario al ingresar al sistema
// (c) 2016 Ricardo Sanchez
// desarrollado para teledat, santiago de chile.

include('db_config.php');

 
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
echo "<h1>".$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y')."</h1>\n" ;

echo "<table width='90%' border='1' align='center' cellpadding='10' cellspacing='0'>
  <tr>
    <td rowspan='6' align='center' valign='middle'><table width='100%' border='1' cellspacing='0' cellpadding='10'>
        <tr>
          <td style='background: #FFF url(images/cumple_mes.jpg) no-repeat right top'><p>Cumpleaños del Mes</p></td>
        </tr>";
/*        <tr>
          <td>&nbsp;</td>
        </tr>

SELECT * 
FROM  persons 
WHERE  DATE_ADD(birthday, 
       INTERVAL YEAR(CURDATE())-YEAR(birthday)
       + IF(DAYOFYEAR(CURDATE()) >= DAYOFYEAR(birthday),1,0)
        YEAR)  
       BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY);

SELECT *, DATE_FORMAT(f_nac,'%d-%m-%Y') AS fnac
FROM  instaladores 
WHERE  DATE_ADD(f_nac, 
       INTERVAL YEAR(CURDATE())-YEAR(f_nac)
       + IF(DAYOFYEAR(CURDATE()) >= DAYOFYEAR(f_nac),1,0)
        YEAR)  
       BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 20 DAY);

*/


		$consulta="SELECT *, DATE_FORMAT(f_nac,'%d-%m-%Y') AS fnac FROM  instaladores ".
					"WHERE  DATE_ADD(f_nac, ".
					"INTERVAL YEAR(CURDATE())- YEAR(f_nac) ".
					"+ IF(DAYOFYEAR(CURDATE()) = DAYOFYEAR(f_nac),1,0) YEAR) ".
					"BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 1 DAY);";
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

				echo "<tr><td>No hay ningun cumpleaños hoy:</td></tr>\n";

			} else {



				while($row = $result->fetch_array()){
					$rows[] = $row;
				}
				echo "<table border='1' align='center' cellpadding='10' cellspacing='0'>";

				foreach($rows as $row){
					echo "<tr><td colspan='6'><h1>Feliz Cumpleaños!!!</h1></td></tr>\n";
					echo "<TR bgcolor=D0CFF9>\n";

					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['fnac']."</td>";
					echo "<Td>".$row['rut']."</td>";
					echo "<Td>".$row['correo']."</td>";
					echo "<Td>".$row['telf_casa']."</td>";
					echo "<Td>".$row['telf_movil']."</td>";


					
					echo "</tr>\n";
				}

				//echo "</table>";

				/* free result set */
				$result->close();
				$result = null;
				$row = null;
				$rows = null;

 			 }}

		$consulta="SELECT *, DATE_FORMAT(f_nac,'%d-%m-%Y') AS fnac FROM  instaladores ".
					"WHERE  DATE_ADD(f_nac, ".
					"INTERVAL YEAR(CURDATE())- YEAR(f_nac) ".
					"+ IF(DAYOFYEAR(CURDATE()) > DAYOFYEAR(f_nac),1,0) YEAR) ".
					"BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY);";

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

				echo "<tr><td colspan='6'>no hay otro cumpleaños acercandose!</td></tr>\n";

			} else {



				while($row = $result->fetch_array()){
					$rows[] = $row;
				}
				echo "<table border='1' align='center' cellpadding='10' cellspacing='0'>";

				foreach($rows as $row){
					echo "<TR bgcolor=D0CFF9>\n";

					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['fnac']."</td>";
					echo "<Td>".$row['rut']."</td>";
					echo "<Td>".$row['correo']."</td>";
					echo "<Td>".$row['telf_casa']."</td>";
					echo "<Td>".$row['telf_movil']."</td>";


					
					echo "</tr>\n";
				}

				//echo "</table>";

				/* free result set */
				$result->close();
				$mysqli = null;
				$row = null;
				$rows = null;

 			 }}















echo "</table></td>
    <td>autos, revisión</td>
  </tr><tr><td>";

		$consulta="SELECT id_auto, en_servicio, marca, modelo, patente, year, color, revision, seguro, permiso, comentarios, ".
					"DATE_FORMAT(revision,'%d-%m-%Y') AS f_revision FROM autos WHERE MONTH( revision ) = MONTH( DATE_ADD( CURDATE( ) , INTERVAL 20 DAY ) ) ".
					"OR CURDATE() > revision" ;
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

				echo "<center>No hay revisiones Próximas a vencerse</center>";

			} else {

				echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=0 heigth=50 ALIGN='center' bgcolor=97BDED>\n";

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}

				foreach($rows as $row){

					echo "<TR bgcolor=D0CFF9>\n";

					echo "<Td>".$row['marca']."</td>";
					echo "<Td>".$row['modelo']."</td>";
					echo "<Td>".$row['patente']."</td>";
					echo "<Td>".$row['year']."</td>";
					echo "<Td>".$row['color']."</td>";
					echo "<Td>".$row['f_revision']."</td>";

					echo "</tr>\n";

				}

				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 
		}
				$mysqli = null;
				$row = null;
				$rows = null;
  
echo "</td></tr><tr>
    <td>autos, seguro</td>
  </tr><tr><td>";
		$consulta="SELECT id_auto, en_servicio, marca, modelo, patente, year, color, revision, seguro, permiso, comentarios, ".
					"DATE_FORMAT(seguro,'%d-%m-%Y') AS f_seguro FROM autos WHERE MONTH( seguro ) = MONTH( DATE_ADD( CURDATE( ) , INTERVAL 20 DAY ) ) ".
					"OR CURDATE() > seguro";
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

				echo "<center>No hay seguros proximos a vencerse</center>";

			} else {

				echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=0 heigth=50 ALIGN='center' bgcolor=97BDED>\n";

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}

				foreach($rows as $row){

					echo "<TR bgcolor=D0CFF9>\n";

					echo "<Td>".$row['marca']."</td>";
					echo "<Td>".$row['modelo']."</td>";
					echo "<Td>".$row['patente']."</td>";
					echo "<Td>".$row['year']."</td>";
					echo "<Td>".$row['color']."</td>";
					echo "<Td>".$row['f_seguro']."</td>";

					echo "</tr>\n";

				}

				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 
		}
				$mysqli = null;
				$row = null;
				$rows = null;  
echo "</td></tr><tr>
    <td>autos, permiso</td>
  </tr><tr><td>";
		$consulta="SELECT id_auto, en_servicio, marca, modelo, patente, year, color, revision, seguro, permiso, comentarios, ".
					"DATE_FORMAT(permiso,'%d-%m-%Y') AS f_permiso FROM autos WHERE MONTH( permiso ) = MONTH( DATE_ADD( CURDATE( ) , INTERVAL 20 DAY ) ) ".
					"OR CURDATE() > permiso";
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

				echo "<center>No hay permisos próximos a vencerse</center>";

			} else {

				echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=0 heigth=50 ALIGN='center' bgcolor=97BDED>\n";

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}

				foreach($rows as $row){

					echo "<TR bgcolor=D0CFF9>\n";

					echo "<Td>".$row['marca']."</td>";
					echo "<Td>".$row['modelo']."</td>";
					echo "<Td>".$row['patente']."</td>";
					echo "<Td>".$row['year']."</td>";
					echo "<Td>".$row['color']."</td>";
					echo "<Td>".$row['f_permiso']."</td>";

					echo "</tr>\n";

				}

				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 
		}
				$mysqli = null;
				$row = null;
				$rows = null;  
echo "</td></tr></table>";



?>