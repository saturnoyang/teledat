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
		echo "<script>\n".
				"function setURL(url){\n".
				"   document.getElementById('pr_frame').src = url;\n".
				"}\n".
			"</script>";
		echo "<h1>Archivo de Proveedores</h1>\n";
		echo "<center><iframe id='pr_frame' name='pr_frame' align='middle' src='proveedores.php?op=11' ".
		"frameborder='1' style='overflow: hidden; height: 500; width: 80%; position: relative;' height='500' width='80%'>".
		"</iframe><br>\n";
		echo "<input type='button' value='Nuevo' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='A' onclick=\"setURL('proveedores.php?op=11&id=a')\" />";
		echo "<input type='button' value='B' onclick=\"setURL('proveedores.php?op=11&id=b')\" />";
		echo "<input type='button' value='C' onclick=\"setURL('proveedores.php?op=11&id=c')\" />";
		echo "<input type='button' value='D' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='E' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='F' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='G' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='H' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='I' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='J' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='K' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='L' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='L' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='M' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='N' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='Ñ' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='O' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='P' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='Q' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='R' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='S' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='T' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='U' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='V' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='W' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='X' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='Y' onclick=\"setURL('proveedores.php?op=2')\" />";
		echo "<input type='button' value='Z' onclick=\"setURL('proveedores.php?op=2')\" />";

		echo "</center>";

	break;
	case 11:

		//Consultar
		echo "<br><h1>\n<center>Consultar la Ficha de Proveedores</center></h1>\n<p>\n(solo los primeros 50 proveedores)</p>\n";
		$consulta="SELECT id_prov, nombre, rut, contacto, fono, web, email, comentario, activo FROM proveedores ORDER BY nombre LIMIT 50";
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
					echo "<Td>".$row['id_prov']."</td>";
					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['rut']."</td>";
					echo "<Td>".$row['contacto']."</td>";
					echo "<Td>".$row['fono']."</td>";
					echo "<Td>".$row['web']."</td>";
					echo "<Td>".$row['email']."</td>";
					echo "<Td>".$row['comentario']."</td>";										
					echo "<Td>".$row['activo']."</td>";
					echo "<td><button onclick=\"window.location.href='proveedores.php?op=23&id=".$row['id_prov']."'\">Imprimir</button></td>";
					echo "<td><button onclick=\"window.location.href='proveedores.php?op=24&id=".$row['id_prov']."'\">Editar</button></td>";
					echo "<td><button onclick=\"window.location.href='proveedores.php?op=25&id=".$row['id_prov']."&usr=".
										($row['activo']==1 ? "0" : "1" )."'\">".
										($row['activo']==1 ? "Activo" : "Desactivado" )."</button></td>";

					echo "</tr>\n";

				}

				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 die(0);
		}






	break;
	case 2:
		echo '<script language="JavaScript">
function validar(f) {


var todoCorrecto = true;
var formulario = document.form;
for (var i=0; i<formulario.length; i++) {
 if(formulario[i].type =="text") {
 if (formulario[i].value == null || formulario[i].value.length == 0 || /^\s*$/.test(formulario[i].value)){
 alert (formulario[i].name+ " no puede estar vacío o contener sólo espacios en blanco");
 return false;
 }
 }
 }

  alert("Todo esta correcto");
  return true; 

}		
</script>';
		echo "<form id='form' name='form' method='post' action='proveedores.php?op=22'>
  <table width='100%' border='1' cellspacing='0' cellpadding='10'>
    <tr>
      <td colspan='2'>Agregar nuevo proveedor</td>
    </tr>
    <tr>
      <td>Nombre</td>
      <td>RUT</td>
    </tr>
    <tr>
      <td align='center' valign='middle'><input name='nombre' type='text' id='nombre' size='50' /></td>
      <td align='center' valign='middle'><input type='text' name='rut' id='rut' /></td>
    </tr>
    <tr>
      <td>Contacto</td>
      <td>Fono</td>
    </tr>
    <tr>
      <td align='center' valign='middle'><input name='contacto' type='text' id='contacto' size='50' /></td>
      <td align='center' valign='middle'><input type='text' name='fono' id='fono' /></td>
    </tr>
    <tr>
      <td>web</td>
      <td>email</td>
    </tr>
    <tr>
      <td align='center' valign='middle'><input name='web' type='text' id='web' size='50' /></td>
      <td align='center' valign='middle'><input type='text' name='email' id='email' /></td>
    </tr>
    <tr>
      <td colspan='2'>comentario</td>
    </tr>
    <tr>
      <td colspan='2' align='center' valign='middle'><textarea name='comentario' id='comentario' cols='80' rows='5'></textarea></td>
    </tr>
    <tr>
      <td colspan='2' align='center' valign='middle'><input type='submit' name='button' id='button' value='Enviar' /></td>
    </tr>
  </table>
</form>
";
	
	break;
	case 22:

/*
		$_POST['nombre'];
		$_POST['rut'];
		$_POST['contacto'];
		$_POST['fono'];
		$_POST['web'];
		$_POST['email'];
		$_POST['comentario'];
		
		
		INSERT INTO proveedores 
			(id_prov, nombre, rut, contacto, fono, web, email, comentario, activo) 
		VALUES 
			(null,'$_POST['nombre']','$_POST['rut']','$_POST['contacto']','$_POST['fono']',
			'$_POST['web']','$_POST['email']','$_POST['comentario']','1')
			
*/	
		
		$consulta=	"INSERT INTO proveedores ".
						"(id_prov, nombre, rut, contacto, fono, web, email, comentario, activo) ".
					"VALUES ".
					"(null,'".$_POST['nombre']."','".$_POST['rut']."','".$_POST['contacto']."','".$_POST['fono']."',".
					"'".$_POST['web']."','".$_POST['email']."','".$_POST['comentario']."','1')";
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
				echo "<br>Se agrego un nuevo <b>Proveedor</b><br>\n";
			} else {
				echo "<br><b>ERROR</b> al agrergar";
			}

		    $mysqli->close();
		}

	
	
	
	
	
	
	
	
	
	break;
}
?>