<?PHP
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>\n".
		"<html xmlns='http://www.w3.org/1999/xhtml'>\n".
		"<head>\n".
		"<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />".
		"<script language='javascript' src='calendar/calendar.js'></script>".
		"</head>\n<body link='#0000FF' vlink='#0000FF' alink='#0000FF'>\n";
		
include('db_config.php');

$year3 = date("Y")+3;

if (empty($_GET['op'])) { $op=0;} else { $op=$_GET['op'];}
if (empty($_GET['id'])) { $id=0;} else { $id=$_GET['id'];}

switch($op){
	case 1:
		require_once('calendar/classes/tc_calendar.php');
		echo "<form id='form1' name='form1' method='post' action='instaladores.php?op=11' autocomplete='off'>
  <table width='80%' border='1' align='center' cellpadding='5' cellspacing='0'>
    <tr>
      <td colspan='7' align='center' valign='middle'>Ficha del Instalador</td>
    </tr>
    <tr>
      <td width='29%'>Nombre Completo</td>
      <td width='20%'>Rut</td>
      <td colspan='3'>Fecha Nacimiento</td>
      <td colspan='2'>Correo</td>
    </tr>
    <tr>
      <td>
      <input name='nombre' type='text' id='nombre' size='40' /></td>
      <td align='center'><input type='text' name='rut' id='rut' /></td>
      <td colspan='3'>";

		//instantiate class and set properties
		$myCalendar = new tc_calendar("f_nac", true);
		$myCalendar->setPath("calendar/");
		$myCalendar->setTimezone("America/Santiago");
		$myCalendar->setYearInterval(1940, $year3 );
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		//output the calendar
		$myCalendar->writeScript();	  

	  
	  
	  
	  echo "</td>
      <td colspan='2'><input type='text' name='correo' id='correo' /></td>
    </tr>
    <tr>
      <td>Nacionalidad</td>
      <td>Estado Civil</td>
      <td colspan='2'>Talla Polera</td>
      <td colspan='2'>Talla Pantalon</td>
      <td width='13%'>Talla Zapatos</td>
    </tr>
    <tr>
      <td><input name='nacionalidad' type='text' id='nacionalidad' size='20' /></td>
      <td><select name='edo_civil' id='edo_civil'>
        <option value='0'>Seleccione</option>
        <option value='Soltero'>Soltero</option>
        <option value='Casado'>Casado</option>
        <option value='Divorciado'>Divorciado</option>
        <option value='Viudo'>Viudo</option>
      </select></td>
      <td colspan='2'><input name='polera' type='text' id='polera' size='10' /></td>
      <td colspan='2'><input name='pantalon' type='text' id='pantalon' size='10' /></td>
      <td><input name='zapatos' type='text' id='zapatos' size='10' /></td>
    </tr>
    <tr>
      <td>Teléfono Casa</td>
      <td>Teléfono Movil</td>
      <td colspan='3'>Region</td>
      <td colspan='2'>Comuna</td>
    </tr>
    <tr>
      <td><input type='text' name='tel_casa2' id='tel_casa2' /></td>
      <td><input type='text' name='tel_fijo2' id='tel_fijo2' /></td>
      <td colspan='3'><input type='text' name='region2' id='region2' /></td>
      <td colspan='2'><input type='text' name='comuna2' id='comuna2' /></td>
    </tr>

    <tr>
      <td colspan='7'>Direccion</td>
    </tr>
    <tr>
      <td colspan='7' align='center' valign='middle'><textarea name='direccion' id='direccion' cols='80' rows='5'></textarea></td>
    </tr>
        <tr>
      <td>Fecha de Ingreso</td>
      <td>Tipo de Previsión (AFP)</td>
      <td colspan='3'>Tipo de Prevision (Salud)</td>
      <td colspan='2'>¿Toma algún medicamento?</td>
    </tr>

    <tr>
      <td>";
	  
		//instantiate class and set properties
		$myCalendar = new tc_calendar("f_ingreso", true);
		$myCalendar->setPath("calendar/");
		$myCalendar->setTimezone("America/Santiago");
		$myCalendar->setYearInterval(1940, $year3 );
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		//output the calendar
		$myCalendar->writeScript();	  	  
	  
	  
	  echo "</td>      
      <td><input type='text' name='afp' id='afp' /></td>      <td colspan='3'><input type='text' name='salud' id='salud' /></td>      <td width='10%'>
        <label>
          <input name='medicamento' type='radio' id='medicamento_0' value='0' checked='checked' />
          No</label>
        <br />
      </td>
      <td><label>
        <input type='radio' name='medicamento' value='1' id='medicamento_1' />
      Si</label></td>
    </tr>    
    <tr>
      <td colspan='2' rowspan='2'>&nbsp;</td>
      <td width='10%'>¿Tiene alguna Discapacidad?</td>
      <td width='8%'><label>
        <input name='disca' type='radio' id='disca_0' value='0' checked='checked' />
      No</label></td>
      <td width='10%'><input type='radio' name='disca' value='1' id='disca_1' />
Si</td>
      <td colspan='2'>Medicamento</td>
    </tr>
    <tr>
          <td colspan='3'><input name='discapacidad' type='text' id='discapacidad' /></td>
          <td colspan='2'><input name='n_medicamento' type='text' id='n_medicamento' /></td>
    </tr>
    <tr>
      <td colspan='7' align='center' valign='middle'><input type='submit' name='button' id='button' value='Guardar y Continuar' /></td>
    </tr>
  </table>
</form>
";
		break;	
	case 11:
		
		echo "<form id='form2' name='form2' method='post' action='instaladores.php?op=12&amp;id=1' autocomplete='off'>\n".
				"<input type='hidden' name='nombre' value='".$_POST['nombre']."'>\n".
				"<input type='hidden' name='rut' value='".$_POST['rut']."'>\n".
				"<input type='hidden' name='f_nac' value='".$_POST['f_nac']."'>\n".
				"<input type='hidden' name='correo' value='".$_POST['correo']."'>\n".
				"<input type='hidden' name='nacionalidad' value='".$_POST['nacionalidad']."'>\n".
				"<input type='hidden' name='edo_civil' value='".$_POST['edo_civil']."'>\n".
				"<input type='hidden' name='polera' value='".$_POST['polera']."'>\n".
				"<input type='hidden' name='pantalon' value='".$_POST['pantalon']."'>\n".
				"<input type='hidden' name='zapatos' value='".$_POST['zapatos']."'>\n".
				"<input type='hidden' name='tel_casa2' value='".$_POST['tel_casa2']."'>\n".
				"<input type='hidden' name='tel_fijo2' value='".$_POST['tel_fijo2']."'>\n".
				"<input type='hidden' name='region2' value='".$_POST['region2']."'>\n".
				"<input type='hidden' name='comuna2' value='".$_POST['comuna2']."'>\n".
				"<input type='hidden' name='direccion' value='".$_POST['direccion']."'>\n".
				"<input type='hidden' name='f_ingreso' value='".$_POST['f_ingreso']."'>\n".
				"<input type='hidden' name='afp' value='".$_POST['afp']."'>\n".
				"<input type='hidden' name='salud' value='".$_POST['salud']."'>\n".
				"<input type='hidden' name='medicamento' value='".$_POST['medicamento']."'>\n".
				"<input type='hidden' name='disca' value='".$_POST['disca']."'>\n".
				"<input type='hidden' name='discapacidad' value='".$_POST['discapacidad']."'>\n".
				"<input type='hidden' name='n_medicamento' value='".$_POST['n_medicamento']."'>\n

  <table width='80%' border='1' align='center' cellpadding='5' cellspacing='0'>
    <tr>
      <td colspan='4' align='center' valign='top'>Contactos de Emergencia</td>
    </tr>
    <tr>
      <td>Contacto 1</td>
      <td>Nombre Completo</td>
      <td>Telefono Fijo</td>
      <td>Telefono Movil</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type='text' name='con_emer1' id='con_emer1' /></td>
      <td><input type='text' name='con_emer1_ph1' id='con_emer1_ph1' /></td>
      <td><input type='text' name='con_emer1_ph2' id='con_emer1_ph2' /></td>
    </tr>
    <tr>
      <td>Contacto 2</td>
      <td>Nombre Completo</td>
      <td>Telefono Fijo</td>
      <td>Telefono Movil</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type='text' name='con_emer2' id='con_emer2' /></td>
      <td><input type='text' name='con_emer2_ph1' id='con_emer2_ph1' /></td>
      <td><input type='text' name='con_emer2_ph2' id='con_emer2_ph2' /></td>
    </tr>
    <tr>
      <td>Contacto 3</td>
      <td>Nombre Completo</td>
      <td>Telefono Fijo</td>
      <td>Telefono Movil</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type='text' name='con_emer3' id='con_emer3' /></td>
      <td><input type='text' name='con_emer3_ph1' id='con_emer3_ph1' /></td>
      <td><input type='text' name='con_emer3_ph2' id='con_emer3_ph2' /></td>
    </tr>
    <tr>
      <td colspan='4' align='center' valign='middle'><input type='submit' name='button2' id='button2' value='Guardar y Cerrar' /></td>
    </tr>
  </table>
</form>
";	
		
		
			
	break;
	case 12:

		/*
		$_POST['nombre']
		$_POST['rut']
		$_POST['f_nac']
		$_POST['correo']
		$_POST['nacionalidad']
		$_POST['edo_civil']
		$_POST['polera']
		$_POST['pantalon']
		$_POST['zapatos']
		$_POST['tel_casa2']
		$_POST['tel_fijo2']
		$_POST['region2']
		$_POST['comuna2']
		$_POST['direccion']
		$_POST['f_ingreso']
		$_POST['afp']
		$_POST['salud']
		$_POST['medicamento']
		$_POST['disca']
		$_POST['discapacidad']
		$_POST['n_medicamento']
		$_POST['con_emer1']
		$_POST['con_emer1_ph1']
		$_POST['con_emer1_ph2']
		$_POST['con_emer2']
		$_POST['con_emer2_ph1']
		$_POST['con_emer2_ph2']
		$_POST['con_emer3']
		$_POST['con_emer3_ph1']
		$_POST['con_emer3_ph2']
		*/

		$consulta = "INSERT INTO instaladores ".
						"(id_inst, nombre, f_nac, rut, correo, nacionalidad, ".
						"edo_civil, polera, pantalon, zapatos, telf_casa, telf_movil, ".
						"comuna, region, direccion, f_ingreso, afp, salud, medicamento, ".
						"disca, discapacidad, n_medicamento, cont_eme1, cont_eme1_ph1, ".
						"cont_eme1_ph2, cont_eme2, cont_eme2_ph1, cont_eme2_ph2, cont_eme3, ".
						"cont_eme3_ph1, cont_eme3_ph2, servicio) ".
					"VALUES ".
						"( null,'".$_POST['nombre']."', '".$_POST['f_nac']."', ".
						"'".$_POST['rut']."','".$_POST['correo']."','".$_POST['nacionalidad']."', ".
						"'".$_POST['edo_civil']."', '".$_POST['polera']."','".$_POST['pantalon']."', ".
						"'".$_POST['zapatos']."', '".$_POST['tel_casa2']."', '".$_POST['tel_fijo2']."', ".
						"'".$_POST['comuna2']."', '".$_POST['region2']."','".$_POST['direccion']."', ".
						"'".$_POST['f_ingreso']."', '".$_POST['afp']."', ".
						"'".$_POST['salud']."','".$_POST['medicamento']."','".$_POST['disca']."', ".
						"'".$_POST['discapacidad']."', '".$_POST['n_medicamento']."', '".$_POST['con_emer1']."', ".
						"'".$_POST['con_emer1_ph1']."',	'".$_POST['con_emer1_ph2']."', '".$_POST['con_emer2']."', ".
						"'".$_POST['con_emer2_ph1']."', '".$_POST['con_emer2_ph2']."', '".$_POST['con_emer3']."', ".
						"'".$_POST['con_emer3_ph1']."', '".$_POST['con_emer3_ph2']."', '1' )";
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

			$numero_resultados = $mysqli->affected_rows; 
			if($numero_resultados==1){
				echo "<br><br><br><br><br>".
					"<table width='80%' border='0' align='center' cellpadding='0' cellspacing='10'>\n".
					"<tr> <td bgcolor='#66CCFF'>\n<h1>".
					"<img src='images/like-1174811_640.png' width='80' height='74'> Se guardo su información</h1></td>\n".
					"</tr><tr><td align='center'>Se agrego un nuevo <b>instalador</b></td></tr>\n".
					"<tr><td colspan = '10'>Ir a la <a href='dashboard.php'>página principal</a>".
					"<meta http-equiv='refresh' content=\"3; URL='dashboard.php'\" /></td></tr>".					
					"</table>";				
							
			} else {
				echo "<br><b>ERROR</b> al agrergar";
			}

		    $mysqli->close();
		}
	break;
	case 2:
		//Consultar Editar usuarios
		echo "<br><h1>\n<center>Consultar / Editar Instaladores</center></h1>\n<br>\n";
		$consulta="SELECT id_inst, nombre, DATE_FORMAT(f_nac,'%d-%m-%Y') AS fnac, rut, correo, nacionalidad, ".
						"edo_civil FROM instaladores ORDER BY servicio";
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
					echo "<Td>".$row['id_inst']."</td>";
					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['fnac']."</td>";
					echo "<Td>".$row['rut']."</td>";
					echo "<Td>".$row['correo']."</td>";
					echo "<Td>".$row['nacionalidad']."</td>";
					echo "<Td>".$row['edo_civil']."</td>";
					echo "<td><button onclick=\"window.location.href='instaladores.php?op=21&id=".$row['id_inst']."'\">Imprimir</button></td>";
					echo "<td><button onclick=\"window.location.href='instaladores.php?op=22&id=".$row['id_inst']."'\">Editar</button></td>";
					echo "<td><button onclick=\"window.location.href='instaladores.php?op=23&id=".$row['id_inst']."'\">Habilitar</button></td>";					
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
		//Imprimir Hoja de Vida Completa
		echo "<br><h1>\n<center>Hoja de Vida del Instalador</center></h1>\n<br>\n";
		
		$consulta="SELECT id_inst, nombre, DATE_FORMAT(f_nac,'%d-%m-%Y') AS fnac, rut, correo, nacionalidad, ".
						"edo_civil, polera, pantalon, zapatos, telf_casa, telf_movil, ".
						"comuna, region, direccion, DATE_FORMAT(f_ingreso,'%d-%m-%Y') AS fingreso, afp, salud, medicamento, ".
						"disca, discapacidad, n_medicamento, cont_eme1, cont_eme1_ph1, ".
						"cont_eme1_ph2, cont_eme2, cont_eme2_ph1, cont_eme2_ph2, cont_eme3, ".
						"cont_eme3_ph1, cont_eme3_ph2, servicio FROM instaladores WHERE id_inst ='$id' ORDER BY servicio";
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

					echo $row['servicio']."\n";

echo "

  <table width='80%' border='1' align='center' cellpadding='5' cellspacing='0'>
    <tr>
      <td colspan='7' align='center' valign='middle'>Ficha del Instalador</td>
    </tr>
    <tr>
      <td width='29%'>Nombre Completo</td>
      <td width='20%'>Rut</td>
      <td colspan='3'>Fecha Nacimiento</td>
      <td colspan='2'>Correo</td>
    </tr>
    <tr>
      <td>
      ".$row['nombre']."</td>
      <td align='center'>".$row['rut']."</td>
      <td colspan='3'>".$row['fnac']."</td>
      <td colspan='2'>".$row['correo']."</td>
    </tr>
    <tr>
      <td>Nacionalidad</td>
      <td>Estado Civil</td>
      <td colspan='2'>Talla Polera</td>
      <td colspan='2'>Talla Pantalon</td>
      <td width='13%'>Talla Zapatos</td>
    </tr>
    <tr>
      <td>".$row['nacionalidad']."</td>
      <td>".$row['edo_civil']."</td>
      <td colspan='2'>".$row['polera']."</td>
      <td colspan='2'>".$row['pantalon']."</td>
      <td>".$row['zapatos']."</td>
    </tr>
    <tr>
      <td>Teléfono Casa</td>
      <td>Teléfono Movil</td>
      <td colspan='3'>Región</td>
      <td colspan='2'>Comuna</td>
    </tr>
    <tr>
      <td>".$row['telf_casa']."</td>
      <td>".$row['telf_movil']."</td>
      <td colspan='3'>".$row['region']."</td>
      <td colspan='2'>".$row['comuna']."</td>
    </tr>

    <tr>
      <td colspan='7'>Direccion</td>
    </tr>
    <tr>
      <td colspan='7' align='center' valign='middle'><p>".$row['direccion']."</p></td>
    </tr>
        <tr>
      <td>Fecha de Ingreso</td>
      <td>Tipo de Previsión (AFP)</td>
      <td colspan='3'>Tipo de Prevision (Salud)</td>
      <td colspan='2'>¿Toma algún medicamento?</td>
    </tr>

    <tr>
      <td>".$row['fingreso']."</td>      
      <td>".$row['afp']."</td>
	  <td colspan='3'>".$row['salud']."</td>      
	  <td colspan='2'>".$row['medicamento']."
</td>
    </tr>    
    <tr>
      <td colspan='2' rowspan='2'>&nbsp;</td>
      <td width='10%'>¿Tiene alguna Discapacidad?</td>
      <td colspan='2'>".$row['disca']."</td>
      <td colspan='2'>Medicamento</td>
    </tr>
    <tr>
          <td colspan='3'>".$row['discapacidad']."</td>
          <td colspan='2'>".$row['n_medicamento']."</td>
    </tr>

  </table>

<p>&nbsp;</p>

  <table width='80%' border='1' align='center' cellpadding='5' cellspacing='0'>
    <tr>
      <td colspan='4' align='center' valign='top'>Contactos de Emergencia</td>
    </tr>
    <tr>
      <td>Contacto 1</td>
      <td>Nombre Completo</td>
      <td>Telefono Fijo</td>
      <td>Telefono Movil</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>".$row['cont_eme1']."</td>
      <td>".$row['cont_eme1_ph1']."</td>
      <td>".$row['cont_eme1_ph2']."</td>
    </tr>
    <tr>
      <td>Contacto 2</td>
      <td>Nombre Completo</td>
      <td>Telefono Fijo</td>
      <td>Telefono Movil</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>".$row['cont_eme2']."</td>
      <td>".$row['cont_eme2_ph1']."</td>
      <td>".$row['cont_eme2_ph2']."</td>
    </tr>
    <tr>
      <td>Contacto 3</td>
      <td>Nombre Completo</td>
      <td>Telefono Fijo</td>
      <td>Telefono Movil</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>".$row['cont_eme3']."</td>
      <td>".$row['cont_eme3_ph1']."</td>
      <td>".$row['cont_eme3_ph2']."</td>
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
	case 22:
		//Editar Instaladores
		require_once('calendar/classes/tc_calendar.php');
		echo "<br><h1>\n<center>Editar Instaladores</center></h1>\n<br>\n";
		$consulta="SELECT id_inst, nombre, f_nac, rut, correo, nacionalidad, ".
						"edo_civil, polera, pantalon, zapatos, telf_casa, telf_movil, ".
						"comuna, region, direccion, f_ingreso, afp, salud, medicamento, ".
						"disca, discapacidad, n_medicamento, cont_eme1, cont_eme1_ph1, ".
						"cont_eme1_ph2, cont_eme2, cont_eme2_ph1, cont_eme2_ph2, cont_eme3, ".
						"cont_eme3_ph1, cont_eme3_ph2, servicio FROM instaladores WHERE id_inst ='$id' ORDER BY servicio";


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
					
					echo "
					<form id='form1' name='form1' method='post' action='instaladores.php?op=23&id=".$row['id_inst']."' autocomplete='off'>
  <table width='80%' border='1' align='center' cellpadding='5' cellspacing='0'>
    <tr>
      <td colspan='7' align='center' valign='middle'>Ficha del Instalador</td>
    </tr>
    <tr>
      <td width='29%'>Nombre Completo</td>
      <td width='20%'>Rut</td>
      <td colspan='3'>Fecha Nacimiento</td>
      <td colspan='2'>Correo</td>
    </tr>
    <tr>
      <td>
      <input name='nombre' type='text' id='nombre' size='40' value='".$row['nombre']."' /></td>
      <td align='center'><input type='text' name='rut' id='rut' value='".$row['rut']."' /></td>
      <td colspan='3'>";
	  
		//codigo calendario
		$fnac = date_create($row['f_nac']);;
		//instantiate class and set properties
		$myCalendar = new tc_calendar("f_nac", true);
		$myCalendar->setPath("calendar/");
		$myCalendar->setTimezone("America/Santiago");
		$myCalendar->setYearInterval(1940, $year3 );
		$myCalendar->setDate(date_format($fnac, 'd'), date_format($fnac, 'm'),date_format($fnac, 'Y') );
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		//output the calendar
		$myCalendar->writeScript();	   
	  
	  
	 	  
	  echo "</td>
      <td colspan='2'><input type='text' name='correo' id='correo' value='".$row['correo']."'/></td>
    </tr>
    <tr>
      <td>Nacionalidad</td>
      <td>Estado Civil</td>
      <td colspan='2'>Talla Polera</td>
      <td colspan='2'>Talla Pantalon</td>
      <td width='13%'>Talla Zapatos</td>
    </tr>
    <tr>
      <td><input name='nacionalidad' type='text' id='nacionalidad' size='20' value='".$row['nacionalidad']."' /></td>
      <td><select name='edo_civil' id='edo_civil'>
        <option value='0' ".($row['edo_civil']=="0" ? "SELECTED" : "").">Seleccione</option>
        <option value='Soltero' ".($row['edo_civil']=="Soltero" ? "SELECTED" : "" ).">Soltero</option>
        <option value='Casado' ".($row['edo_civil']=="Casado" ? "SELECTED": "" ).">Casado</option>
        <option value='Divorciado' ".($row['edo_civil']=="Divorciado" ? "SELECTED": "").">Divorciado</option>
        <option value='Viudo' ".($row['edo_civil']=="Viudo" ? "SELECTED": "").">Viudo</option>
      </select></td>
      <td colspan='2'><input name='polera' type='text' id='polera' size='10' value='".$row['polera']."' /></td>
      <td colspan='2'><input name='pantalon' type='text' id='pantalon' size='10' value='".$row['pantalon']."' /></td>
      <td><input name='zapatos' type='text' id='zapatos' size='10' value='".$row['zapatos']."' /></td>
    </tr>
    <tr>
      <td>Teléfono Casa</td>
      <td>Teléfono Movil</td>
      <td colspan='3'>Region</td>
      <td colspan='2'>Comuna</td>
    </tr>
    <tr>
      <td><input type='text' name='telf_casa' id='telf_casa' value='".$row['telf_casa']."' /></td>
      <td><input type='text' name='telf_movil' id='telf_movil' value='".$row['telf_movil']."' /></td>
      <td colspan='3'><input type='text' name='region' id='region' value='".$row['region']."' /></td>
      <td colspan='2'><input type='text' name='comuna' id='comuna' value='".$row['comuna']."' /></td>
    </tr>

    <tr>
      <td colspan='7'>Direccion</td>
    </tr>
    <tr>
      <td colspan='7' align='center' valign='middle'><textarea name='direccion' id='direccion' cols='80' rows='5'>".$row['direccion']."</textarea></td>
    </tr>
        <tr>
      <td>Fecha de Ingreso</td>
      <td>Tipo de Previsión (AFP)</td>
      <td colspan='3'>Tipo de Prevision (Salud)</td>
      <td colspan='2'>¿Toma algún medicamento?</td>
    </tr>

    <tr>
      <td>";

	  	//codigo calendario
		$f_ingreso = date_create($row['f_ingreso']);;
		//instantiate class and set properties
		$myCalendar = new tc_calendar("f_ingreso", true);
		$myCalendar->setPath("calendar/");
		$myCalendar->setTimezone("America/Santiago");
		$myCalendar->setYearInterval(1940, $year3 );
		$myCalendar->setDate(date_format($f_ingreso, 'd'), date_format($f_ingreso, 'm'),date_format($f_ingreso, 'Y') );
		$myCalendar->setIcon("calendar/images/iconCalendar.gif");
		//output the calendar
		$myCalendar->writeScript();	 
  
	  echo "</td>      
      <td><input type='text' name='afp' id='afp' value='".$row['afp']."' />
	  </td>      <td colspan='3'><input type='text' name='salud' id='salud' value='".$row['salud']."' /></td>      <td width='10%'>
        <label>
          <input name='medicamento' type='radio' id='medicamento_0' value='0' ".
		  ($row['medicamento']=="0" ? "checked='checked'" : "") ." />
          No</label>
        <br />
      </td>
      <td><label>
        <input type='radio' name='medicamento' value='1' id='medicamento_1' ".($row['medicamento']=="1" ? "checked='checked'" : "")."/>
      Si</label></td>
    </tr>    
    <tr>
      <td colspan='2' rowspan='2'>&nbsp;</td>
      <td width='10%'>¿Tiene alguna Discapacidad?</td>
      <td width='8%'><label>
        <input name='disca' type='radio' id='medicamento_2' value='0' ".($row['disca']=="0" ? "checked='checked'" : "")." />
      No</label></td>
      <td width='10%'><input type='radio' name='disca' value='1' id='medicamento_3' ".($row['disca']=="1" ? "checked='checked'" : "")."/>
Si</td>
      <td colspan='2'>Medicamento</td>
    </tr>
    <tr>
          <td colspan='3'><input name='discapacidad' type='text' id='discapacidad' value='".$row['discapacidad']."' /></td>
          <td colspan='2'><input name='n_medicamento' type='text' id='n_medicamento' value='".$row['n_medicamento']."' /></td>
    </tr>
    <tr>
      <td colspan='7' align='center' valign='middle'>

 <input name='cont_eme1' type='hidden' value='".$row['cont_eme1']."' />
 <input name='cont_eme1_ph1' type='hidden' value='".$row['cont_eme1_ph1']."' />
 <input name='cont_eme1_ph2' type='hidden' value='".$row['cont_eme1_ph2']."' />
 <input name='cont_eme2' type='hidden' value='".$row['cont_eme2']."' />
 <input name='cont_eme2_ph1' type='hidden' value='".$row['cont_eme2_ph1']."' />
 <input name='cont_eme2_ph2' type='hidden' value='".$row['cont_eme2_ph2']."' />
 <input name='cont_eme3' type='hidden' value='".$row['cont_eme3']."' />
 <input name='cont_eme3_ph1' type='hidden' value='".$row['cont_eme3_ph1']."' />
 <input name='cont_eme3_ph2' type='hidden' value='".$row['cont_eme3_ph2']."' />
	  
	  
	  
	  
	  
	  
	  <input type='submit' name='button' id='button' value='Guardar y Continuar' /></td>
    </tr>
  </table>

</form>
					";
					
					
				}

				/* free result set */
				$result->close();

 			 }
		 die(0);
		}
		
	
	break;
	case 23:
		
		/*
		
$_POST['nombre'];
$_POST['rut'];
$_POST['f_nac'];
$_POST['correo'];
$_POST['nacionalidad'];
$_POST['edo_civil'];
$_POST['polera'];
$_POST['pantalon'];
$_POST['zapatos'];
$_POST['telf_casa'];
$_POST['telf_movil'];
$_POST['region'];
$_POST['comuna'];
$_POST['direccion'];
$_POST['f_ingreso'];
$_POST['afp'];
$_POST['salud'];
$_POST['medicamento'];
$_POST['disca'];
$_POST['discapacidad'];
$_POST['n_medicamento'];

$_POST['cont_eme1'];
$_POST['cont_eme1_ph1'];
$_POST['cont_eme1_ph2'];
$_POST['cont_eme2'];
$_POST['cont_eme2_ph1'];
$_POST['cont_eme2_ph2'];
$_POST['cont_eme3'];
$_POST['cont_eme3_ph1'];
$_POST['cont_eme3_ph2'];


		foreach ($_POST as $param_name => $param_val) {
		    echo '$'."_POST['$param_name'];\n";
		}
		
		*/
		echo "<form id='form2' name='form2' method='post' action='instaladores.php?op=24&amp;id=$id' autocomplete='off'>
		
 <input name='nombre' type='hidden' value='".$_POST['nombre']."' />		
 <input name='rut' type='hidden' value='".$_POST['rut']."' />		
 <input name='f_nac' type='hidden' value='".$_POST['f_nac']."' />		
 <input name='correo' type='hidden' value='".$_POST['correo']."' />		
 <input name='nacionalidad' type='hidden' value='".$_POST['nacionalidad']."' />		
 <input name='edo_civil' type='hidden' value='".$_POST['edo_civil']."' />		
 <input name='polera' type='hidden' value='".$_POST['polera']."' />		
 <input name='pantalon' type='hidden' value='".$_POST['pantalon']."' />		
 <input name='zapatos' type='hidden' value='".$_POST['zapatos']."' />		
 <input name='telf_casa' type='hidden' value='".$_POST['telf_casa']."' />		
 <input name='telf_movil' type='hidden' value='".$_POST['telf_movil']."' />		
 <input name='region' type='hidden' value='".$_POST['region']."' />		
 <input name='comuna' type='hidden' value='".$_POST['comuna']."' />		
 <input name='direccion' type='hidden' value='".$_POST['direccion']."' />		
 <input name='f_ingreso' type='hidden' value='".$_POST['f_ingreso']."' />		
 <input name='afp' type='hidden' value='".$_POST['afp']."' />		
 <input name='salud' type='hidden' value='".$_POST['salud']."' />		
 <input name='medicamento' type='hidden' value='".$_POST['medicamento']."' />		
 <input name='disca' type='hidden' value='".$_POST['disca']."' />		
 <input name='discapacidad' type='hidden' value='".$_POST['discapacidad']."' />		
 <input name='n_medicamento' type='hidden' value='".$_POST['n_medicamento']."' />		

		
		
  <table width='80%' border='1' align='center' cellpadding='5' cellspacing='0'>
    <tr>
      <td colspan='4' align='center' valign='top'>Contactos de Emergencia, <b>".$_POST['nombre']."</b></td>
    </tr>
    <tr>
      <td>Contacto 1</td>
      <td>Nombre Completo</td>
      <td>Telefono Fijo</td>
      <td>Telefono Movil</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type='text' name='cont_eme1' id='cont_eme1' value='".$_POST['cont_eme1']."'/></td>
      <td><input type='text' name='cont_eme1_ph1' id='cont_eme1_ph1' value='".$_POST['cont_eme1_ph1']."' /></td>
      <td><input type='text' name='cont_eme1_ph2' id='cont_eme1_ph2' value='".$_POST['cont_eme1_ph2']."'/></td>
    </tr>
    <tr>
      <td>Contacto 2</td>
      <td>Nombre Completo</td>
      <td>Telefono Fijo</td>
      <td>Telefono Movil</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type='text' name='cont_eme2' id='cont_eme2' value='".$_POST['cont_eme2']."'/></td>
      <td><input type='text' name='cont_eme2_ph1' id='cont_eme2_ph1' value='".$_POST['cont_eme2_ph1']."'/></td>
      <td><input type='text' name='cont_eme2_ph2' id='cont_eme2_ph2' value='".$_POST['cont_eme2_ph2']."'/></td>
    </tr>
    <tr>
      <td>Contacto 3</td>
      <td>Nombre Completo</td>
      <td>Telefono Fijo</td>
      <td>Telefono Movil</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type='text' name='cont_eme3' id='cont_eme3'  value='".$_POST['cont_eme3']."'/></td>
      <td><input type='text' name='cont_eme3_ph1' id='cont_eme3_ph1'  value='".$_POST['cont_eme3_ph1']."'/></td>
      <td><input type='text' name='cont_eme3_ph2' id='cont_eme3_ph2'  value='".$_POST['cont_eme3_ph2']."'/></td>
    </tr>
    <tr>
      <td colspan='4' align='center' valign='middle'><input type='submit' name='button2' id='button2' value='Guardar y Cerrar' /></td>
    </tr>
  </table>
</form>
";

	break;	
	case 24:
	
	

	
	$consulta = "UPDATE instaladores SET nombre='".$_POST['nombre']."', f_nac='".$_POST['f_nac']."', rut='".$_POST['rut']."', ".
					"correo='".$_POST['correo']."', nacionalidad='".$_POST['nacionalidad']."',edo_civil='".$_POST['edo_civil']."', ".
					"polera='".$_POST['polera']."', pantalon='".$_POST['pantalon']."', zapatos='".$_POST['zapatos']."', ".
					"telf_casa='".$_POST['telf_casa']."', telf_movil='".$_POST['telf_movil']."', comuna='".$_POST['comuna']."', ".
					"region='".$_POST['region']."',direccion='".$_POST['direccion']."',f_ingreso='".$_POST['f_ingreso']."', ".
					"afp='".$_POST['afp']."',salud='".$_POST['salud']."', medicamento='".$_POST['medicamento']."', ".
					"disca='".$_POST['disca']."',discapacidad='".$_POST['discapacidad']."',n_medicamento='".$_POST['n_medicamento']."', ".
					"cont_eme1='".$_POST['cont_eme1']."',cont_eme1_ph1='".$_POST['cont_eme1_ph1']."', cont_eme1_ph2='".$_POST['cont_eme1_ph2']."', ".
					"cont_eme2='".$_POST['cont_eme2']."',cont_eme2_ph1='".$_POST['cont_eme2_ph1']."', cont_eme2_ph2='".$_POST['cont_eme2_ph2']."', ".
					"cont_eme3='".$_POST['cont_eme3']."',cont_eme3_ph1='".$_POST['cont_eme3_ph1']."', cont_eme3_ph2='".$_POST['cont_eme3_ph2']."' ".
				"WHERE id_inst='$id'";
		//echo $consulta."\n<br>";
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
					"<img src='images/like-1174811_640.png' width='80' height='74'> Se actualizo su información</h1></td>\n".
					"</tr><tr><td align='center'>se han actualizado los datos de un instalador.</td></tr>\n".
					"<tr><td colspan = '10'>Ir a la <a href='dashboard.php'>página principal</a>".
					"<meta http-equiv='refresh' content=\"3; URL='dashboard.php'\" /></td></tr>".					
					"</table>";			

		}else{
			echo "<br><b>ERROR</b> al Actualizar";

		}
		    $mysqli->close();	
	
	break;
}

echo "</body>\n</html>";
?>