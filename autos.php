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

		echo "<form id='form' name='form' method='post' action='autos.php?op=11' autocomplete='off'>
<table width='80%' border='1' align='center' cellpadding='5' cellspacing='0'>
  <tr>
    <td colspan='4' align='center'>Ficha del Auto</td>
  </tr>
  <tr>
    <td>Marca</td>
    <td>Modelo</td>
    <td>Patente</td>
    <td>Año</td>
  </tr>
  <tr>
    <td><input type='text' name='marca' id='marca' /></td>
    <td><input type='text' name='modelo' id='modelo' /></td>
    <td><input type='text' name='patente' id='patente' /></td>
    <td><input type='text' name='year' id='year' /></td>
  </tr>
  <tr>
    <td>Color</td>
    <td>Revisión</td>
    <td>Seguro</td>
    <td>Permiso</td>
  </tr>
  <tr>
    <td><input type='text' name='color' id='color' /></td>
    <td>";
		//instantiate class and set properties
		$myCalendar = new tc_calendar("f_rev", true);
		$myCalendar->setPath("calendar/");
		$myCalendar->setTimezone("America/Santiago");
		$myCalendar->setYearInterval(1940, $year3 );
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		//output the calendar
		$myCalendar->writeScript();	  	

		echo "</td>\n<td>";
		//instantiate class and set properties
		$myCalendar = new tc_calendar("f_seg", true);
		$myCalendar->setPath("calendar/");
		$myCalendar->setTimezone("America/Santiago");
		$myCalendar->setYearInterval(1940, $year3 );
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		//output the calendar
		$myCalendar->writeScript();	  	
	
		echo "</td>\n<td>";
		//instantiate class and set properties
		$myCalendar = new tc_calendar("f_perm", true);
		$myCalendar->setPath("calendar/");
		$myCalendar->setTimezone("America/Santiago");
		$myCalendar->setYearInterval(1940, $year3 );
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		//output the calendar
		$myCalendar->writeScript();	  	
	
	
	echo "</td>\n</tr>\n<tr>
    <td>Comentarios</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4' align='center'><textarea name='comentario' id='comentario' cols='80' rows='5'></textarea></td>
  </tr>
  <tr>
    <td colspan='4' align='right'><input type='submit' name='button' id='button' value='Enviar' /></td>
  </tr>
</table>
</form>";
	break;
	case 11:


		$consulta=	"INSERT INTO autos ".
						"(id_auto, en_servicio, marca, modelo, patente, year, color, revision, seguro, permiso, comentarios) ".
					"VALUES ".
						"(null,'1','".$_POST['marca']."','".$_POST['modelo']."','".$_POST['patente']."','".$_POST['year']."', ".
						"'".$_POST['color']."','".$_POST['f_rev']."','".$_POST['f_seg']."','".$_POST['f_perm']."','".$_POST['comentario']."')";
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
				echo "<br>Se agrego un nuevo <b>Auto</b><br>\n";
			} else {
				echo "<br><b>ERROR</b> al agrergar";
			}

		    $mysqli->close();
		}





			
	break;
	case 2:
	
		//Consultar
		echo "<br><h1>\n<center>Consultar la Ficha del Auto</center></h1>\n<br>\n";
		$consulta="SELECT id_auto, en_servicio, marca, modelo, patente, year, color, revision, seguro, permiso, comentarios FROM autos ";
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
					echo "<Td>".$row['id_auto']."</td>";
					echo "<Td>".$row['marca']."</td>";
					echo "<Td>".$row['modelo']."</td>";
					echo "<Td>".$row['patente']."</td>";
					echo "<Td>".$row['year']."</td>";
					echo "<Td>".$row['color']."</td>";
					echo "<td><button onclick=\"window.location.href='autos.php?op=21&id=".$row['id_auto']."'\">Imprimir</button></td>";
					echo "<td><button onclick=\"window.location.href='autos.php?op=22&id=".$row['id_auto']."'\">Editar</button></td>";
					echo "<td><button onclick=\"window.location.href='autos.php?op=24&id=".$row['id_auto']."&usr=".
										($row['en_servicio']==1 ? "0" : "1" )."'\">".
										($row['en_servicio']==1 ? "Activo" : "Desactivado" )."</button></td>";

					echo "</tr>\n";

				}

				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 die(0);
		}
	
	break;
	case 21:
		//imprimir
		echo "<br><h1>\n<center>Consultar la Ficha del Auto</center></h1>\n<br>\n";
		$consulta="SELECT id_auto, en_servicio, marca, modelo, patente, year, color, revision, seguro, permiso, comentarios FROM autos WHERE id_auto='$id' ";
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

				echo "<center>\n <table width='80%' border='1' align='center' cellpadding='5' cellspacing='0'>\n";

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}

				foreach($rows as $row){

					echo "  <tr>
    <td colspan='4' align='center'>Ficha del Auto</td>
  </tr>
  <tr>
    <td>Marca</td>
    <td>Modelo</td>
    <td>Patente</td>
    <td>Año</td>
  </tr>
  <tr>
    <td>".$row['marca']."</td>
    <td>".$row['modelo']."</td>
    <td>".$row['patente']."</td>
    <td>".$row['year']."</td>
  </tr>
  <tr>
    <td>Color</td>
    <td>Revisión</td>
    <td>Seguro</td>
    <td>Permiso</td>
  </tr>
  <tr>
    <td>".$row['color']."</td>
    <td>".$row['revision']."</td>
	<td>".$row['seguro']."</td>
	<td>".$row['permiso']."</td>\n</tr>\n<tr>
    <td colspan='4' align='center'>Comentarios</td>

  </tr>
  <tr>
    <td colspan='4' align='center'>".$row['comentarios']."</td>
  </tr>

";


				}

				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 die(0);
		}
	
	break;	
	

	case 22:
		//editar auto
		echo "<br><h1>\n<center>Editar la Ficha del Auto</center></h1>\n<br>\n";
		$consulta="SELECT id_auto, en_servicio, marca, modelo, patente, year, color, revision, seguro, permiso, comentarios FROM autos WHERE id_auto='$id' ";
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

				echo "<center>\n <table width='80%' border='1' align='center' cellpadding='5' cellspacing='0'>\n";

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}

				foreach($rows as $row){



echo "<form id='form' name='form' method='post' autocomplete='off' action='autos.php?op=23&id=".$row['id_auto']."'>

  <tr>
    <td colspan='4' align='center'>Ficha del Auto</td>
  </tr>
  <tr>
    <td>Marca</td>
    <td>Modelo</td>
    <td>Patente</td>
    <td>Año</td>
  </tr>
  <tr>
    <td><input type='text' name='marca' id='marca' value='".$row['marca']."' /></td>
    <td><input type='text' name='modelo' id='modelo' value='".$row['modelo']."'/></td>
    <td><input type='text' name='patente' id='patente' value='".$row['patente']."' /></td>
    <td><input type='text' name='year' id='year' value='".$row['year']."'/></td>
  </tr>
  <tr>
    <td>Color</td>
    <td>Revisión</td>
    <td>Seguro</td>
    <td>Permiso</td>
  </tr>
  <tr>
    <td><input type='text' name='color' id='color' value='".$row['color']."' /></td>
    <td>";
		//fecha
		$fecha = date_create($row['revision']);
		//instantiate class and set properties
		$myCalendar = new tc_calendar("f_rev", true);
		$myCalendar->setPath("calendar/");
		$myCalendar->setTimezone("America/Santiago");
		$myCalendar->setYearInterval(1940, $year3 );
		$myCalendar->setDate(date_format($fecha, 'd'), date_format($fecha, 'm'),date_format($fecha, 'Y') );
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		//output the calendar
		$myCalendar->writeScript();
		$fecha=null;	  	

		echo "</td>\n<td>";
		//fecha
		$fecha = date_create($row['seguro']);		
		//instantiate class and set properties
		$myCalendar = new tc_calendar("f_seg", true);
		$myCalendar->setPath("calendar/");
		$myCalendar->setTimezone("America/Santiago");
		$myCalendar->setYearInterval(1940, $year3 );
		$myCalendar->setDate(date_format($fecha, 'd'), date_format($fecha, 'm'),date_format($fecha, 'Y') );		
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		//output the calendar
		$myCalendar->writeScript();	  	
		$fecha=null;	  	
			
		echo "</td>\n<td>";
		//fecha
		$fecha = date_create($row['permiso']);		
		//instantiate class and set properties
		$myCalendar = new tc_calendar("f_perm", true);
		$myCalendar->setPath("calendar/");
		$myCalendar->setTimezone("America/Santiago");
		$myCalendar->setYearInterval(1940, $year3 );
		$myCalendar->setDate(date_format($fecha, 'd'), date_format($fecha, 'm'),date_format($fecha, 'Y') );				
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		//output the calendar
		$myCalendar->writeScript();	  	
	
	
	echo "</td>\n</tr>\n<tr>
    <td>Comentarios</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4' align='center'><textarea name='comentario' id='comentario' cols='80' rows='5'>".$row['comentarios']."</textarea></td>
  </tr>
  <tr>
    <td colspan='4' align='right'><input type='submit' name='button' id='button' value='Enviar' /></td>
  </tr>

</form>";


				}

				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 die(0);
		}
	
	break;
	case 23:
		$consulta=	"UPDATE autos SET marca='".$_POST['marca']."', modelo='".$_POST['modelo']."', patente='".$_POST['patente']."', ".
				"year='".$_POST['year']."', color='".$_POST['color']."', revision='".$_POST['f_rev']."', seguro='".$_POST['f_seg']."', ".
				"permiso='".$_POST['f_perm']."', comentarios='".$_POST['comentario']."' WHERE id_auto='$id'";
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
			echo "se modifico la ficha de un auto";
		}else{
			echo "error al modificar la ficha";
		    
		}
		$mysqli->close();


	break;
	case 24;
		$consulta=	"UPDATE autos SET en_servicio='$usr' WHERE id_auto='$id'";
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
			echo "se modifico el estatus de un auto";
		}else{
			echo "error al modificar la ficha";
		    
		}
		$mysqli->close();
	
	break;
	case 3:
		// Entrega de un Auto
		echo '<script language="JavaScript">
function validar(f) {


var todoCorrecto = true;
var formulario = document.form;
for (var i=0; i<formulario.length; i++) {
 if(formulario[i].type != "hidden" && formulario[i].type != "radio" ) {
  if (formulario[i].value == null || formulario[i].value == 0 || formulario[i].value.length == 0 || /^\s*$/.test(formulario[i].value)){
   alert (formulario[i].type + ", " +formulario[i].id + " no puede estar vacío o contener sólo espacios en blanco");
   return false;
  }
 }
}

  alert("Todo esta correcto");
  return true; 

}		
</script>';
		
		
		
		
		echo "<form id='form' name='form' method='post' onSubmit='return validar(this)' autocomplete='off' action='autos.php?op=31'>

<br>
 
  <table width='90%' border='1' align='center' cellpadding='10' cellspacing='0'>
    <tr>
      <td>auto: <select name='id_auto' id='Auto'>
        <option value='0'>Seleccione...</option>";
		
		$consulta="SELECT id_auto, en_servicio, marca, modelo, patente, year, color, revision, seguro, permiso, comentarios FROM autos ".
					"WHERE en_servicio='1'";
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

					echo "<option value='".$row['id_auto']."'>".$row['marca'].", ".$row['modelo'].", ";
					echo $row['patente'].", ".$row['year'].", " .$row['color'].", ". $row['revision'].", ";
					echo $row['seguro'].", ". $row['permiso']."</option>\n";

				}



				/* free result set */
				$result->close();

 			 }

		}
	  
	  
	  echo "</select></td>      <td>kilometraje: 
        <input type='text' name='km_auto' id='Kilometraje Auto' /></td>      <td>fecha: ";
		//instantiate class and set properties
		$myCalendar = new tc_calendar("fecha_entrega", true);
		$myCalendar->setPath("calendar/");
		$myCalendar->setTimezone("America/Santiago");
		$myCalendar->setYearInterval(1940, date("Y") );
		$myCalendar->setDate(date("d"), date("m"),date("Y"));
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		//output the calendar
		$myCalendar->writeScript();	  	
		echo "</td>      
    </tr>
	</table>
	<table width='90%' border='1' align='center' cellpadding='10' cellspacing='0'>
    <tr>
      <td colspan='2'>Revisión de Niveles</td>
      <td align='center'><img src='images/bat_hi.jpg' width='80' height='40' alt='Alto' /></td>
      <td align='center'><img src='images/bat_low.jpg' width='81' height='40' alt='Bajo' /></td>
      <td colspan='3' rowspan='5'>&nbsp;</td>
    </tr>
    <tr>
      <td rowspan='4'>&nbsp;</td>
      <td>aceite</td>
      <td align='center'><input type='radio' name='aceite' value='1' id='aceite_0' /></td>
      <td align='center'><input type='radio' name='aceite' value='0' id='aceite_1' checked /></td>
    </tr>
    <tr>
      <td>agua</td>
      <td align='center'><input type='radio' name='agua' value='1' id='agua_0' /></td>
      <td align='center'><input type='radio' name='agua' value='0' id='agua_1' checked /></td>
    </tr>
    <tr>
      <td>neumaticos</td>
      <td align='center'><input type='radio' name='neumaticos' value='1' id='neumaticos_0' /></td>
      <td align='center'><input type='radio' name='neumaticos' value='0' id='neumaticos_1' checked /></td>
    </tr>
    <tr>
      <td>otros</td>
      <td align='center'><input type='radio' name='otros' value='1' id='otros_0' /></td>
      <td align='center'><input type='radio' name='otros' value='0' id='otros_1' checked /></td>
    </tr>
    </table>
    <p></p>
      <table width='90%' border='1' align='center' cellpadding='10' cellspacing='0'>
    <tr>
      <td colspan='7'>condiciones generales</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>n/a</td>
      <td>no existe</td>
      <td>bueno</td>
      <td>regular</td>
      <td>malo</td>
      <td width='15%'>observaciones</td>
    </tr>
    <tr>
      <td>freno</td>
      <td align='center'><input type='radio' name='freno' value='1' id='freno_0' checked /></td>
      <td align='center'><input type='radio' name='freno' value='2' id='freno_1' /></td>
      <td align='center'><input type='radio' name='freno' value='3' id='freno_2' /></td>
      <td align='center'><input type='radio' name='freno' value='4' id='freno_3' /></td>
      <td align='center'><input type='radio' name='freno' value='5' id='freno_4' /></td>
      <td><input type='text' name='fr_obs' value='-'></td>
    </tr>
    <tr>
      <td>luces altas</td>
      <td align='center'><input type='radio' name='l_altas' value='1' id='l_altas0' checked /></td>
      <td align='center'><input type='radio' name='l_altas' value='2' id='l_altas1' /></td>
      <td align='center'><input type='radio' name='l_altas' value='3' id='l_altas2' /></td>
      <td align='center'><input type='radio' name='l_altas' value='4' id='l_altas3' /></td>
      <td align='center'><input type='radio' name='l_altas' value='5' id='l_altas4' /></td>
      <td><input type='text' name='la_obs' value='-'></td>
    </tr>
    <tr>
      <td>luces bajas</td>
      <td align='center'><input type='radio' name='l_bajas' value='1' id='l_bajas0' checked /></td>
      <td align='center'><input type='radio' name='l_bajas' value='2' id='l_bajas1' /></td>
      <td align='center'><input type='radio' name='l_bajas' value='3' id='l_bajas2' /></td>
      <td align='center'><input type='radio' name='l_bajas' value='4' id='l_bajas3' /></td>
      <td align='center'><input type='radio' name='l_bajas' value='5' id='l_bajas4' /></td>
      <td><input type='text' name='lb_obs' value='-'></td>
    </tr>
    <tr>
      <td>luces de estacionamiento</td>
      <td align='center'><input type='radio' name='l_park' value='1' id='l_park0' checked /></td>
      <td align='center'><input type='radio' name='l_park' value='2' id='l_park1' /></td>
      <td align='center'><input type='radio' name='l_park' value='3' id='l_park2' /></td>
      <td align='center'><input type='radio' name='l_park' value='4' id='l_park3' /></td>
      <td align='center'><input type='radio' name='l_park' value='5' id='l_park4' /></td>
      <td><input type='text' name='le_obs' value='-'></td>
    </tr>
    <tr>
      <td>luces de freno</td>
      <td align='center'><input type='radio' name='l_freno' value='1' id='l_freno0' checked /></td>
      <td align='center'><input type='radio' name='l_freno' value='2' id='l_freno1' /></td>
      <td align='center'><input type='radio' name='l_freno' value='3' id='l_freno2' /></td>
      <td align='center'><input type='radio' name='l_freno' value='4' id='l_freno3' /></td>
      <td align='center'><input type='radio' name='l_freno' value='5' id='l_freno4' /></td>
      <td><input type='text' name='lf_obs' value='-'></td>
    </tr>
    <tr>
      <td>bocina</td>
      <td align='center'><input type='radio' name='bocina' value='1' id='bocina_0' checked /></td>
      <td align='center'><input type='radio' name='bocina' value='2' id='bocina_1' /></td>
      <td align='center'><input type='radio' name='bocina' value='3' id='bocina_2' /></td>
      <td align='center'><input type='radio' name='bocina' value='4' id='bocina_3' /></td>
      <td align='center'><input type='radio' name='bocina' value='5' id='bocina_4' /></td>
      <td><input type='text' name='bc_obs' value='-'></td>
    </tr>
    <tr>
      <td>parabrisas</td>
      <td align='center'><input type='radio' name='parabr' value='1' id='parabr_0' checked /></td>
      <td align='center'><input type='radio' name='parabr' value='2' id='parabr_1' /></td>
      <td align='center'><input type='radio' name='parabr' value='3' id='parabr_2' /></td>
      <td align='center'><input type='radio' name='parabr' value='4' id='parabr_3' /></td>
      <td align='center'><input type='radio' name='parabr' value='5' id='parabr_4' /></td>
      <td><input type='text' name='pr_obs' value='-'></td>
    </tr>
    <tr>
      <td>luneta</td>
      <td align='center'><input type='radio' name='luneta' value='1' id='luneta_0' checked /></td>
      <td align='center'><input type='radio' name='luneta' value='2' id='luneta_1' /></td>
      <td align='center'><input type='radio' name='luneta' value='3' id='luneta_2' /></td>
      <td align='center'><input type='radio' name='luneta' value='4' id='luneta_3' /></td>
      <td align='center'><input type='radio' name='luneta' value='5' id='luneta_4' /></td>
      <td><input type='text' name='lun_obs' value='-'></td>
    </tr>
    <tr>
      <td>bateria</td>
      <td align='center'><input type='radio' name='bat' value='1' id='bat_0' checked /></td>
      <td align='center'><input type='radio' name='bat' value='2' id='bat_1' /></td>
      <td align='center'><input type='radio' name='bat' value='3' id='bat_2' /></td>
      <td align='center'><input type='radio' name='bat' value='4' id='bat_3' /></td>
      <td align='center'><input type='radio' name='bat' value='5' id='bat_4' /></td>
      <td><input type='text' name='bat_obs' value='-'></td>
    </tr>
    <tr>
      <td colspan='7'>condicion exterior</td>
    </tr>
    <tr>
      <td align='center' colspan='7'><textarea name='cond_ext' cols='80' rows='5'>.</textarea></td>
    </tr>
    <tr>
      <td colspan='7'>estado neumaticos</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>n/a</td>
      <td>no existe</td>
      <td>bueno</td>
      <td>regular</td>
      <td>malo</td>
      <td>observaciones</td>
    </tr>
    <tr>
      <td>repuesto</td>
      <td align='center'><input type='radio' name='repuesto' value='1' id='repuesto_0' checked /></td>
      <td align='center'><input type='radio' name='repuesto' value='2' id='repuesto_1' /></td>
      <td align='center'><input type='radio' name='repuesto' value='3' id='repuesto_2' /></td>
      <td align='center'><input type='radio' name='repuesto' value='4' id='repuesto_3' /></td>
      <td align='center'><input type='radio' name='repuesto' value='5' id='repuesto_4' /></td>
      <td><input type='text' name='rep_obs' value='-'></td>
    </tr>
    <tr>
      <td>delanteros</td>
      <td align='center'><input type='radio' name='delanteros' value='1' id='delanteros_0' checked /></td>
      <td align='center'><input type='radio' name='delanteros' value='2' id='delanteros_1' /></td>
      <td align='center'><input type='radio' name='delanteros' value='3' id='delanteros_2' /></td>
      <td align='center'><input type='radio' name='delanteros' value='4' id='delanteros_3' /></td>
      <td align='center'><input type='radio' name='delanteros' value='5' id='delanteros_4' /></td>
      <td><input type='text' name='del_obs' value='-'></td>
    </tr>
    <tr>
      <td>traseros</td>
      <td align='center'><input type='radio' name='traseros' value='1' id='traseros_0' checked /></td>
      <td align='center'><input type='radio' name='traseros' value='2' id='traseros_1' /></td>
      <td align='center'><input type='radio' name='traseros' value='3' id='traseros_2' /></td>
      <td align='center'><input type='radio' name='traseros' value='4' id='traseros_3' /></td>
      <td align='center'><input type='radio' name='traseros' value='5' id='traseros_4' /></td>
      <td><input type='text' name='tras_obs' value='-'></td>
    </tr>
    <tr>
      <td colspan='7'>accesorios</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>n/a</td>
      <td>no existe</td>
      <td>bueno</td>
      <td>regular</td>
      <td>malo</td>
      <td>observaciones</td>
    </tr>
    <tr>
      <td>llave de ruedas</td>
      <td align='center'><input type='radio' name='ll_ruedas' value='1' id='ll_ruedas0' checked /></td>
      <td align='center'><input type='radio' name='ll_ruedas' value='2' id='ll_ruedas1' /></td>
      <td align='center'><input type='radio' name='ll_ruedas' value='3' id='ll_ruedas2' /></td>
      <td align='center'><input type='radio' name='ll_ruedas' value='4' id='ll_ruedas3' /></td>
      <td align='center'><input type='radio' name='ll_ruedas' value='5' id='ll_ruedas4' /></td>
      <td><input type='text' name='llruedas_obs' value='-'></td>
    </tr>
    <tr>
      <td>gata</td>
      <td align='center'><input type='radio' name='gata' value='1' id='gata_0' checked /></td>
      <td align='center'><input type='radio' name='gata' value='2' id='gata_1' /></td>
      <td align='center'><input type='radio' name='gata' value='3' id='gata_2' /></td>
      <td align='center'><input type='radio' name='gata' value='4' id='gata_3' /></td>
      <td align='center'><input type='radio' name='gata' value='5' id='gata_4' /></td>
      <td><input type='text' name='gata_obs' value='-'></td>
    </tr>
    <tr>
      <td>extintor</td>
      <td align='center'><input type='radio' name='extintor' value='1' id='extintor_0' checked /></td>
      <td align='center'><input type='radio' name='extintor' value='2' id='extintor_1' /></td>
      <td align='center'><input type='radio' name='extintor' value='3' id='extintor_2' /></td>
      <td align='center'><input type='radio' name='extintor' value='4' id='extintor_3' /></td>
      <td align='center'><input type='radio' name='extintor' value='5' id='extintor_4' /></td>
      <td><input type='text' name='ext_obs' value='-'></td>
    </tr>
    <tr>
      <td>cinturon de seguridad</td>
      <td align='center'><input type='radio' name='cinturon' value='1' id='cinturon_0' checked /></td>
      <td align='center'><input type='radio' name='cinturon' value='2' id='cinturon_1' /></td>
      <td align='center'><input type='radio' name='cinturon' value='3' id='cinturon_2' /></td>
      <td align='center'><input type='radio' name='cinturon' value='4' id='cinturon_3' /></td>
      <td align='center'><input type='radio' name='cinturon' value='5' id='cinturon_4' /></td>
      <td><input type='text' name='cint_obs' value='-'></td>
    </tr>
    <tr>
      <td>triangulo</td>
      <td align='center'><input type='radio' name='triangulo' value='1' id='triangulo_0' checked /></td>
      <td align='center'><input type='radio' name='triangulo' value='2' id='triangulo_0' /></td>
      <td align='center'><input type='radio' name='triangulo' value='3' id='triangulo_0' /></td>
      <td align='center'><input type='radio' name='triangulo' value='4' id='triangulo_0' /></td>
      <td align='center'><input type='radio' name='triangulo' value='5' id='triangulo_0' /></td>
      <td><input type='text' name='trian_obs' value='-'></td>
    </tr>
    <tr>
      <td>botiquin</td>
      <td align='center'><input type='radio' name='botinquin' value='1' id='botinquin_0' checked /></td>
      <td align='center'><input type='radio' name='botinquin' value='2' id='botinquin_1' /></td>
      <td align='center'><input type='radio' name='botinquin' value='3' id='botinquin_2' /></td>
      <td align='center'><input type='radio' name='botinquin' value='4' id='botinquin_3' /></td>
      <td align='center'><input type='radio' name='botinquin' value='5' id='botinquin_4' /></td>
      <td><input type='text' name='bot_obs' value='-'></td>
    </tr>
    <tr>
      <td>realizado por</td>
      <td colspan='6'><input name='id_usuario' type='hidden' value='".$usr."' />";
	  
		$consulta="SELECT id_usr, usr_nombre, full_name, email, rut, passwd, telf, is_admin, usr_status FROM usuarios WHERE id_usr='$usr'";
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

				echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=2 heigth=50 ALIGN='center' bgcolor=97BDED>\n";

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}

				foreach($rows as $row){
					
					
					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td>".$row['usr_nombre']."</td>\n<Td>".$row['full_name']."</td>";
					echo "<Td>".$row['email']."</td>\n<Td>".$row['rut']."</td>\n<Td>".$row['telf']."</td>";
					echo "</tr>\n";

				}

				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 
		}





	  
	  
	  echo "</td>
    </tr>
    <tr>
      <td>recibido por</td>
      <td colspan='6'>";
	  
	  echo "<select name='id_instalador' id='Instalador'>
        <option value='0'>Seleccione...</option>       
      ";
	  
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



	  
	  echo "</select></td>
    </tr>
    <tr>
      <td colspan='7' align='center'><input type='submit' name='button' id='button' value='Procesar entrega del Auto' /></td>

    </tr>
  </table>
</form>
";
	break;
	case 31:
		/*
		
$_POST['id_auto'];
$_POST['id_usuario'];
$_POST['id_instalador'];
$_POST['km_auto'];
$_POST['fecha_entrega'];
$_POST['aceite'];
$_POST['agua'];
$_POST['neumaticos'];
$_POST['otros'];
$_POST['freno'];
$_POST['fr_obs'];
$_POST['l_altas'];
$_POST['la_obs'];
$_POST['l_bajas'];
$_POST['lb_obs'];
$_POST['l_park'];
$_POST['le_obs'];
$_POST['l_freno'];
$_POST['lf_obs'];
$_POST['bocina'];
$_POST['bc_obs'];
$_POST['parabr'];
$_POST['pr_obs'];
$_POST['luneta'];
$_POST['lun_obs'];
$_POST['bat'];
$_POST['bat_obs'];
$_POST['cond_ext'];
$_POST['repuesto'];
$_POST['rep_obs'];
$_POST['delanteros'];
$_POST['del_obs'];
$_POST['traseros'];
$_POST['tras_obs'];
$_POST['ll_ruedas'];
$_POST['llruedas_obs'];
$_POST['gata'];
$_POST['gata_obs'];
$_POST['extintor'];
$_POST['ext_obs'];
$_POST['cinturon'];
$_POST['cint_obs'];
$_POST['triangulo'];
$_POST['trian_obs'];
$_POST['botinquin'];
$_POST['bot_obs'];
	
INSERT INTO in_service (
		id_entrega, id_usuario, id_instalador, fecha, id_auto, km_auto, 
		aceite, agua, neumaticos, otros, freno, fr_obs, luces_altas, 
		la_obs, luces_bajas, lb_obs, luces_esta, le_obs, luces_freno, 
		lf_obs, bocina, bc_obs, parabrisas, pr_obs, luneta, lun_obs, 
		bateria, bat_obs, cond_ext, repuesto, rep_obs, delantero, del_obs, 
		traseros, tras_obs, llave_ruedas, llruedas_obs, gata, gata_obs, 
		extintor, ext_obs, cinturon_seg, cint_obs, triangulo, trian_obs, 
		botiquin, bot_obs) 
	VALUES (
		null,'$_POST['id_usuario']','$_POST['id_instalador']','$_POST['fecha_entrega']',
		'$_POST['id_auto']','$_POST['km_auto']','$_POST['aceite']','$_POST['agua']',
		'$_POST['neumaticos']','$_POST['otros']','$_POST['freno']','$_POST['fr_obs']',
		'$_POST['l_altas']','$_POST['la_obs']','$_POST['l_bajas']','$_POST['lb_obs']',
		'$_POST['l_park']','$_POST['le_obs']','$_POST['l_freno']','$_POST['lf_obs']',
		'$_POST['bocina']','$_POST['bc_obs']','$_POST['parabr']','$_POST['pr_obs']',
		'$_POST['luneta']','$_POST['lun_obs']','$_POST['bat']','$_POST['bat_obs']',
		'$_POST['cond_ext']','$_POST['repuesto']','$_POST['rep_obs']',
		'$_POST['delanteros']','$_POST['del_obs']','$_POST['traseros']','$_POST['tras_obs']',
		'$_POST['ll_ruedas']','$_POST['llruedas_obs']','$_POST['gata']','$_POST['gata_obs']',
		'$_POST['extintor']','$_POST['ext_obs']','$_POST['cinturon']','$_POST['cint_obs']',
		'$_POST['triangulo']','$_POST['trian_obs']','$_POST['botinquin']','$_POST['bot_obs']')	
	
		
		foreach ($_POST as $param_name => $param_val) {
		    echo '$'."_POST['$param_name'];<br>\n";			
		}
	
		foreach ($_POST as $param_name => $param_val) {
		    echo '$'."_POST['$param_name']; = ".$param_val."<br>\n";			
		}		
		
		
		*/
		
		
		
		
		
		$consulta="INSERT INTO in_service (".
					"id_entrega, id_usuario, id_instalador, fecha, id_auto, km_auto, ".
					"aceite, agua, neumaticos, otros, freno, fr_obs, luces_altas, ".
					"la_obs, luces_bajas, lb_obs, luces_esta, le_obs, luces_freno, ".
					"lf_obs, bocina, bc_obs, parabrisas, pr_obs, luneta, lun_obs, ".
					"bateria, bat_obs, cond_ext, repuesto, rep_obs, delantero, del_obs, ".
					"traseros, tras_obs, llave_ruedas, llruedas_obs, gata, gata_obs, ".
					"extintor, ext_obs, cinturon_seg, cint_obs, triangulo, trian_obs, ".
					"botiquin, bot_obs) ".
				"VALUES ( ".
					"null,'".$_POST['id_usuario']."','".$_POST['id_instalador']."','".$_POST['fecha_entrega']."', ".
					"'".$_POST['id_auto']."','".$_POST['km_auto']."','".$_POST['aceite']."','".$_POST['agua']."', ".
					"'".$_POST['neumaticos']."','".$_POST['otros']."','".$_POST['freno']."','".$_POST['fr_obs']."', ".
					"'".$_POST['l_altas']."','".$_POST['la_obs']."','".$_POST['l_bajas']."','".$_POST['lb_obs']."', ".
					"'".$_POST['l_park']."','".$_POST['le_obs']."','".$_POST['l_freno']."','".$_POST['lf_obs']."', ".
					"'".$_POST['bocina']."','".$_POST['bc_obs']."','".$_POST['parabr']."','".$_POST['pr_obs']."', ".
					"'".$_POST['luneta']."','".$_POST['lun_obs']."','".$_POST['bat']."','".$_POST['bat_obs']."', ".
					"'".$_POST['cond_ext']."','".$_POST['repuesto']."','".$_POST['rep_obs']."', ".
					"'".$_POST['delanteros']."','".$_POST['del_obs']."','".$_POST['traseros']."','".$_POST['tras_obs']."', ".
					"'".$_POST['ll_ruedas']."','".$_POST['llruedas_obs']."','".$_POST['gata']."','".$_POST['gata_obs']."', ".
					"'".$_POST['extintor']."','".$_POST['ext_obs']."','".$_POST['cinturon']."','".$_POST['cint_obs']."', ".
					"'".$_POST['triangulo']."','".$_POST['trian_obs']."','".$_POST['botinquin']."','".$_POST['bot_obs']."')";
		//echo $consulta;
		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);

		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}

		if ($result = $mysqli->query($consulta)) {			
			echo "<br><br><br><br><br>".
					"<table width='80%' border='0' align='center' cellpadding='0' cellspacing='10'>\n".
					"<tr> <td bgcolor='#66CCFF'>\n<h1>".
					"<img src='images/like-1174811_640.png' width='80' height='74'> Se guardo su información</h1></td>\n".
					"</tr><tr><td align='center'>se ha procesado la entrega de un auto.</td></tr>\n".
					"<tr><td colspan = '10'>Ir a la <a href='dashboard.php'>página principal</a>".
					"<meta http-equiv='refresh' content=\"3; URL='dashboard.php'\" /></td></tr>".					
					"</table>";
			
			
			
			
									
		}else{
			echo "<br><b>ERROR</b> al Actualizar";

		}
		    $mysqli->close();			
		
	break;
	case 4:
		$consulta = "SELECT in_service.*, usuarios.*, instaladores.*, autos.*  FROM  in_service, usuarios, instaladores, autos ".
						"WHERE usuarios.id_usr = in_service.id_usuario AND instaladores.id_inst = in_service.id_instalador AND ".
						"autos.id_auto = in_service.id_auto ORDER BY in_service.id_entrega DESC";
						
		echo "<br><h1>\n<center>Consultar la Entrega de un Auto</center></h1>\n<br>\n";
		
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
					echo "<Td>".$row['id_entrega']."</td>";
					echo "<Td>".$row['marca']."</td>";
					echo "<Td>".$row['modelo']."</td>";
					echo "<Td>".$row['patente']."</td>";
					echo "<Td>".$row['year']."</td>";
					echo "<Td>".$row['color']."</td>";
					echo "<Td>".$row['fecha']."</td>";					
					
					echo "<td><button onclick=\"window.location.href='autos.php?op=41&id=".$row['id_entrega']."'\">Imprimir</button></td>";

					echo "</tr>\n";

				}

				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 die(0);
		}
	
	
	
	
	break;
	case 41:
	
	
				$consulta = "SELECT in_service.*, usuarios.*,usuarios.rut AS usr_rut, instaladores.*,instaladores.rut AS inst_rut, autos.*  ".
						"FROM  in_service, usuarios, instaladores, autos ".
						"WHERE in_service.id_entrega='$id' AND usuarios.id_usr = in_service.id_usuario AND ".
						"instaladores.id_inst = in_service.id_instalador AND ".
						"autos.id_auto = in_service.id_auto ORDER BY in_service.id_entrega DESC";
						
		echo "<br><h1>\n<center>Consultar la Entrega de un Auto</center></h1>\n<br>\n";
		
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


				while($row = $result->fetch_array()){
					$rows[] = $row;
				}

				foreach($rows as $row){


					echo "<table width='90%' border='1' align='center' cellpadding='10' cellspacing='0'>
    <tr>
      <td>auto: " .$row['marca'].", ".$row['modelo'].", ". $row['patente'].", ".
	  $row['year'].", " .$row['color'].", ". $row['revision'].", ".  $row['seguro'].", ". $row['permiso'].
	  
	  
	  
	  
	  
"	  </td>      <td>kilometraje: ".$row['km_auto']."
        </td>      <td>fecha: ".$row['fecha']."</td>      
    </tr>
	</table>
	<table width='90%' border='1' align='center' cellpadding='10' cellspacing='0'>
    <tr>
      <td colspan='2'>Revisión de Niveles</td>
      <td align='center'><img src='images/bat_hi.jpg' width='80' height='40' alt='Alto' /></td>
      <td align='center'><img src='images/bat_low.jpg' width='81' height='40' alt='Bajo' /></td>
      <td colspan='3' rowspan='5'>&nbsp;</td>
    </tr>
    <tr>
      <td rowspan='4'>&nbsp;</td>
      <td>aceite</td>
      <td align='center'>".($row['aceite']==1?'x':'')."</td>
      <td align='center'>".($row['aceite']==0?'x':'')."</td>
    </tr>
    <tr>
      <td>agua</td>
      <td align='center'>".($row['agua']==1?'x':'')."</td>
      <td align='center'>".($row['agua']==0?'x':'')."</td>
    </tr>
    <tr>
      <td>neumaticos</td>
      <td align='center'>".($row['neumaticos']==1?'x':'')."</td>
      <td align='center'>".($row['neumaticos']==0?'x':'')."</td>
    </tr>
    <tr>
      <td>otros</td>
      <td align='center'>".($row['otros']==1?'x':'')."</td>
      <td align='center'>".($row['otros']==0?'x':'')."</td>
    </tr>
    </table>
    <p></p>
      <table width='90%' border='1' align='center' cellpadding='10' cellspacing='0'>
    <tr>
      <td colspan='7'>condiciones generales</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>n/a</td>
      <td>no existe</td>
      <td>bueno</td>
      <td>regular</td>
      <td>malo</td>
      <td width='15%'>observaciones</td>
    </tr>
    <tr>
      <td>freno</td>
      <td align='center'>".($row['freno']==1?'x':'')."</td>
      <td align='center'>".($row['freno']==2?'x':'')."</td>
      <td align='center'>".($row['freno']==3?'x':'')."</td>
      <td align='center'>".($row['freno']==4?'x':'')."</td>
      <td align='center'>".($row['freno']==5?'x':'')."</td>
      <td>".$row['fr_obs']."</td>
    </tr>
    <tr>
      <td>luces altas</td>
      <td align='center'>".($row['luces_altas']==1?'x':'')."</td>
      <td align='center'>".($row['luces_altas']==2?'x':'')."</td>
      <td align='center'>".($row['luces_altas']==3?'x':'')."</td>
      <td align='center'>".($row['luces_altas']==4?'x':'')."</td>
      <td align='center'>".($row['luces_altas']==5?'x':'')."</td>
      <td>".$row['la_obs']."</td>
    </tr>
    <tr>
      <td>luces bajas</td>
      <td align='center'>".($row['luces_bajas']==1?'x':'')."</td>
      <td align='center'>".($row['luces_bajas']==2?'x':'')."</td>
      <td align='center'>".($row['luces_bajas']==3?'x':'')."</td>
      <td align='center'>".($row['luces_bajas']==4?'x':'')."</td>
      <td align='center'>".($row['luces_bajas']==5?'x':'')."</td>
      <td>".$row['lb_obs']."</td>
    </tr>
    <tr>
      <td>luces de estacionamiento</td>
      <td align='center'>".($row['luces_esta']==1?'x':'')."</td>
      <td align='center'>".($row['luces_esta']==2?'x':'')."</td>
      <td align='center'>".($row['luces_esta']==3?'x':'')."</td>
      <td align='center'>".($row['luces_esta']==4?'x':'')."</td>
      <td align='center'>".($row['luces_esta']==5?'x':'')."</td>
      <td>".$row['le_obs']."</td>
    </tr>
    <tr>
      <td>luces de freno</td>
      <td align='center'>".($row['luces_freno']==1?'x':'')."</td>
      <td align='center'>".($row['luces_freno']==2?'x':'')."</td>
      <td align='center'>".($row['luces_freno']==3?'x':'')."</td>
      <td align='center'>".($row['luces_freno']==4?'x':'')."</td>
      <td align='center'>".($row['luces_freno']==5?'x':'')."</td>
      <td>".$row['lf_obs']."</td>
    </tr>
    <tr>
      <td>bocina</td>
      <td align='center'>".($row['bocina']==1?'x':'')."</td>
      <td align='center'>".($row['bocina']==2?'x':'')."</td>
      <td align='center'>".($row['bocina']==3?'x':'')."</td>
      <td align='center'>".($row['bocina']==4?'x':'')."</td>
      <td align='center'>".($row['bocina']==5?'x':'')."</td>
      <td>".$row['bc_obs']."</td>
    </tr>
    <tr>
      <td>parabrisas</td>
      <td align='center'>".($row['parabrisas']==1?'x':'')."</td>
      <td align='center'>".($row['parabrisas']==2?'x':'')."</td>
      <td align='center'>".($row['parabrisas']==3?'x':'')."</td>
      <td align='center'>".($row['parabrisas']==4?'x':'')."</td>
      <td align='center'>".($row['parabrisas']==5?'x':'')."</td>
      <td>".$row['pr_obs']."</td>
    </tr>
    <tr>
      <td>luneta</td>
      <td align='center'>".($row['luneta']==1?'x':'')."</td>
      <td align='center'>".($row['luneta']==2?'x':'')."</td>
      <td align='center'>".($row['luneta']==3?'x':'')."</td>
      <td align='center'>".($row['luneta']==4?'x':'')."</td>
      <td align='center'>".($row['luneta']==5?'x':'')."</td>
      <td>".$row['lun_obs']."</td>
    </tr>
    <tr>
      <td>bateria</td>
      <td align='center'>".($row['bateria']==1?'x':'')."</td>
      <td align='center'>".($row['bateria']==2?'x':'')."</td>
      <td align='center'>".($row['bateria']==3?'x':'')."</td>
      <td align='center'>".($row['bateria']==4?'x':'')."</td>
      <td align='center'>".($row['bateria']==5?'x':'')."</td>
      <td>".$row['bat_obs']."</td>
    </tr>
    <tr>
      <td colspan='7'>condicion exterior</td>
    </tr>
    <tr>
      <td align='center' colspan='7'>".nl2br($row['cond_ext'])."</td>
    </tr>
    <tr>
      <td colspan='7'>estado neumaticos</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>n/a</td>
      <td>no existe</td>
      <td>bueno</td>
      <td>regular</td>
      <td>malo</td>
      <td>observaciones</td>
    </tr>
    <tr>
      <td>repuesto</td>
      <td align='center'>".($row['repuesto']==1?'x':'')."</td>
      <td align='center'>".($row['repuesto']==2?'x':'')."</td>
      <td align='center'>".($row['repuesto']==3?'x':'')."</td>
      <td align='center'>".($row['repuesto']==4?'x':'')."</td>
      <td align='center'>".($row['repuesto']==5?'x':'')."</td>
      <td>".$row['rep_obs']."</td>
    </tr>
    <tr>
      <td>delanteros</td>
      <td align='center'>".($row['delantero']==1?'x':'')."</td>
      <td align='center'>".($row['delantero']==2?'x':'')."</td>
      <td align='center'>".($row['delantero']==3?'x':'')."</td>
      <td align='center'>".($row['delantero']==4?'x':'')."</td>
      <td align='center'>".($row['delantero']==5?'x':'')."</td>
      <td>".$row['del_obs']."</td>
    </tr>
    <tr>
      <td>traseros</td>
      <td align='center'>".($row['traseros']==1?'x':'')."</td>
      <td align='center'>".($row['traseros']==2?'x':'')."</td>
      <td align='center'>".($row['traseros']==3?'x':'')."</td>
      <td align='center'>".($row['traseros']==4?'x':'')."</td>
      <td align='center'>".($row['traseros']==5?'x':'')."</td>
      <td>".$row['tras_obs']."</td>
    </tr>
    <tr>
      <td colspan='7'>accesorios</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>n/a</td>
      <td>no existe</td>
      <td>bueno</td>
      <td>regular</td>
      <td>malo</td>
      <td>observaciones</td>
    </tr>
    <tr>
      <td>llave de ruedas</td>
      <td align='center'>".($row['llave_ruedas']==1?'x':'')."</td>
      <td align='center'>".($row['llave_ruedas']==2?'x':'')."</td>
      <td align='center'>".($row['llave_ruedas']==3?'x':'')."</td>
      <td align='center'>".($row['llave_ruedas']==4?'x':'')."</td>
      <td align='center'>".($row['llave_ruedas']==5?'x':'')."</td>
      <td>".$row['llruedas_obs']."</td>
    </tr>
    <tr>
      <td>gata</td>
      <td align='center'>".($row['gata']==1?'x':'')."</td>
      <td align='center'>".($row['gata']==2?'x':'')."</td>
      <td align='center'>".($row['gata']==3?'x':'')."</td>
      <td align='center'>".($row['gata']==4?'x':'')."</td>
      <td align='center'>".($row['gata']==5?'x':'')."</td>
      <td>".$row['gata_obs']."</td>
    </tr>
    <tr>
      <td>extintor</td>
      <td align='center'>".($row['extintor']==1?'x':'')."</td>
      <td align='center'>".($row['extintor']==2?'x':'')."</td>
      <td align='center'>".($row['extintor']==3?'x':'')."</td>
      <td align='center'>".($row['extintor']==4?'x':'')."</td>
      <td align='center'>".($row['extintor']==5?'x':'')."</td>
      <td>".$row['ext_obs']."</td>
    </tr>
    <tr>
      <td>cinturon de seguridad</td>
      <td align='center'>".($row['cinturon_seg']==1?'x':'')."</td>
      <td align='center'>".($row['cinturon_seg']==2?'x':'')."</td>
      <td align='center'>".($row['cinturon_seg']==3?'x':'')."</td>
      <td align='center'>".($row['cinturon_seg']==4?'x':'')."</td>
      <td align='center'>".($row['cinturon_seg']==5?'x':'')."</td>
      <td>".$row['cint_obs']."</td>
    </tr>
    <tr>
      <td>triangulo</td>
      <td align='center'>".($row['triangulo']==1?'x':'')."</td>
      <td align='center'>".($row['triangulo']==2?'x':'')."</td>
      <td align='center'>".($row['triangulo']==3?'x':'')."</td>
      <td align='center'>".($row['triangulo']==4?'x':'')."</td>
      <td align='center'>".($row['triangulo']==5?'x':'')."</td>
      <td>".$row['trian_obs']."</td>
    </tr>
    <tr>
      <td>botiquin</td>
      <td align='center'>".($row['botiquin']==1?'x':'')."</td>
      <td align='center'>".($row['botiquin']==2?'x':'')."</td>
      <td align='center'>".($row['botiquin']==3?'x':'')."</td>
      <td align='center'>".($row['botiquin']==4?'x':'')."</td>
      <td align='center'>".($row['botiquin']==5?'x':'')."</td>
      <td>".$row['bot_obs']."</td>
    </tr>
    <tr>
      <td>realizado por</td>
      <td colspan='6'>
<TABLE BORDER=1 cellpadding=5 cellspacing=0 heigth=50 ALIGN='center' bgcolor=97BDED>
<TR bgcolor=D0CFF9>

<Td>".$row['usr_nombre']."</td>
<Td>".$row['full_name']."</td><Td>".$row['email']."</td>
<Td>".$row['usr_rut']."</td>
<Td>".$row['telf']."</td></tr>
</table> 
</td>
    </tr>
    <tr>
      <td>recibido por</td>
      <td colspan='6'>
 <TABLE BORDER=1 cellpadding=5 cellspacing=0 heigth=50 ALIGN='center' bgcolor=97BDED>
<TR bgcolor=D0CFF9>

<Td>".$row['nombre']."</td>
<Td>".$row['f_nac']."</td><Td>".$row['ins_rut']."</td>
<Td>". $row['correo']."</td>

</table>
	  </td>
    </tr>

  </table>
";
					

				}
		
				
				/* free result set */
				$result->close();

 			 }
		 die(0);
		}
	
	
	
	
	
	
	
	
	break;
}

echo "</body>\n</html>";
?>