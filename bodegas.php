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
		echo "<br><h1>\n<center>Administrar Bodegas</center></h1>\n<br>\n";
		$consulta="SELECT id_prbodega, id_usr, nombre, ubicacion, comentario FROM pr_bodegas";
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
				echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=2 heigth=50 ALIGN='center' bgcolor=97BDED>\n".
						"<tr><td colspan='9'><input type='button' value='Nuevo' onclick=\"window.location='bodegas.php?op=11'\" /></td></tr>";
			if($numero_resultados==0){

				echo "<tr bgcolor=D0CFF9><td colspan='9'>no se encontro informacion</td></tr>";

			} else {

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}

				foreach($rows as $row){

					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td>".$row['id_prbodega']."</td>";
					echo "<Td>".$row['id_usr']."</td>";
					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['ubicacion']."</td>";
					echo "<Td>".$row['comentario']."</td>";
					echo "<td><button onclick=\"window.location.href='bodegas.php?op=21&id=".$row['id_prbodega']."'\">Imprimir</button></td>";
					echo "<td><button onclick=\"window.location.href='bodegas.php?op=22&id=".$row['id_prbodega']."'\">Editar</button></td>";
					echo "</tr>\n";

				}

				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 die(0);
		}
		
	
	
	break;
	case 11:
	
		echo "<form action='bodegas.php?op=12' method='post' name='form' id='form' autocomplete='off'>
  <table width='80%' border='1' align='center' cellpadding='10' cellspacing='0'>
    <tr>
      <td colspan='2' bgcolor='#FFFFCC'>Crear una nueva bodega</td>
    </tr>
    <tr>
      <td>Responsable</td>
      <td>";
	
	  echo "<select name='id_usr' id='id_usr'>
        <option value='0'>Seleccione...</option>\n";
	  
		$consulta="SELECT id_inst, nombre, DATE_FORMAT(f_nac,'%d-%m-%Y') AS fnac, rut, correo, nacionalidad, ".
						"edo_civil FROM instaladores ORDER BY servicio";
		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);
		$row = null;
		$rows = null;

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
				while($row = $result->fetch_array()){
					$rows[] = $row;
				}
				foreach($rows as $row){
					echo "<option value='".$row['id_inst']."'>".$row['nombre'].", ".$row['fnac'].", ";
					echo $row['rut'].", ". $row['correo'].", ". $row['nacionalidad'].", ". $row['edo_civil']."</option>";
				}

				/* free result set */
				$result->close();

 			 }
		}
	  
	  echo "</select>";
	  echo "</td>
    </tr>
    <tr>
      <td>nombre de la bodega</td>
      <td><input name='b_nombre' type='text' id='b_nombre' size='60'></td>
    </tr>
    <tr>
      <td>ubicacion</td>
      <td><input name='ubicacion' type='text' id='ubicacion' size='60'></td>
    </tr>
    <tr>
      <td colspan='2'>comentarios</td>
    </tr>
    <tr>
      <td colspan='2' align='center'><textarea name='comentario' cols='80' rows='3' id='comentario'></textarea></td>
    </tr>
    <tr>
      <td colspan='2' align='center'><input type='submit' name='button' id='button' value='Enviar'></td>
    </tr>
  </table>
</form>
";
	
	break;
	case 12:

		$consulta=	"INSERT INTO pr_bodegas(id_prbodega, id_usr, nombre, ubicacion, comentario) 
		VALUES (null,'".$_POST['id_usr']."','".$_POST['b_nombre']."','".$_POST['ubicacion']."','".$_POST['comentario']."')";
		echo $consulta;
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
				echo "<br>Se agrego una nueva <b>bodega</b><br>\n";
			} else {
				echo "<br><b>ERROR</b> al agrergar";
			}
		    $mysqli->close();
		}
	

	break;
}
		
echo "</body>\n</html>";		
?>		