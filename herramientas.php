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
if (empty($_GET['id']))  { $id=0;	} 	else { $id=$_GET['id'];}
$year3 = date("Y")+3;

switch($op){
	case 1:
		echo "<script>\n".
				"function setURL(url){\n".
				"   document.getElementById('pr_frame').src = url;\n".
				"}\n".
			"</script>";
		echo "<h1>Archivo de Herramientas</h1>\n";
		echo "<center><iframe id='pr_frame' name='pr_frame' align='middle' src='herramientas.php?op=11' ".
		"frameborder='1' style='overflow: hidden; height: 500; width: 80%; position: relative;' height='500' width='80%'>".
		"</iframe><br>\n";
		echo "<input type='button' value='Nuevo' onclick=\"setURL('herramientas.php?op=2')\" />";
		echo "<input type='button' value='Ver Todos' onclick=\"setURL('herramientas.php?op=11&id=%')\" />";
		echo "<input type='button' value='A' onclick=\"setURL('herramientas.php?op=11&id=a')\" />";
		echo "<input type='button' value='B' onclick=\"setURL('herramientas.php?op=11&id=b')\" />";
		echo "<input type='button' value='C' onclick=\"setURL('herramientas.php?op=11&id=c')\" />";
		echo "<input type='button' value='D' onclick=\"setURL('herramientas.php?op=11&id=d')\" />";
		echo "<input type='button' value='E' onclick=\"setURL('herramientas.php?op=11&id=e')\" />";
		echo "<input type='button' value='F' onclick=\"setURL('herramientas.php?op=11&id=f')\" />";
		echo "<input type='button' value='G' onclick=\"setURL('herramientas.php?op=11&id=g')\" />";
		echo "<input type='button' value='H' onclick=\"setURL('herramientas.php?op=11&id=h')\" />";
		echo "<input type='button' value='I' onclick=\"setURL('herramientas.php?op=11&id=i')\" />";
		echo "<input type='button' value='J' onclick=\"setURL('herramientas.php?op=11&id=j')\" />";
		echo "<input type='button' value='K' onclick=\"setURL('herramientas.php?op=11&id=k')\" />";
		echo "<input type='button' value='L' onclick=\"setURL('herramientas.php?op=11&id=l')\" />";
		echo "<input type='button' value='M' onclick=\"setURL('herramientas.php?op=11&id=m')\" />";
		echo "<input type='button' value='N' onclick=\"setURL('herramientas.php?op=11&id=n')\" />";
		echo "<input type='button' value='Ñ' onclick=\"setURL('herramientas.php?op=11&id=ñ')\" />";
		echo "<input type='button' value='O' onclick=\"setURL('herramientas.php?op=11&id=o')\" />";
		echo "<input type='button' value='P' onclick=\"setURL('herramientas.php?op=11&id=p')\" />";
		echo "<input type='button' value='Q' onclick=\"setURL('herramientas.php?op=11&id=q')\" />";
		echo "<input type='button' value='R' onclick=\"setURL('herramientas.php?op=11&id=r')\" />";
		echo "<input type='button' value='S' onclick=\"setURL('herramientas.php?op=11&id=s')\" />";
		echo "<input type='button' value='T' onclick=\"setURL('herramientas.php?op=11&id=t')\" />";
		echo "<input type='button' value='U' onclick=\"setURL('herramientas.php?op=11&id=u')\" />";
		echo "<input type='button' value='V' onclick=\"setURL('herramientas.php?op=11&id=v')\" />";
		echo "<input type='button' value='W' onclick=\"setURL('herramientas.php?op=11&id=w')\" />";
		echo "<input type='button' value='X' onclick=\"setURL('herramientas.php?op=11&id=x')\" />";
		echo "<input type='button' value='Y' onclick=\"setURL('herramientas.php?op=11&id=y')\" />";
		echo "<input type='button' value='Z' onclick=\"setURL('herramientas.php?op=11&id=z')\" />";

		echo "</center>";

	break;
	case 11:

		//Consultar
		echo "<br><h1>\n<center>Consultar la Ficha de Herramientas</center></h1>";
		$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);

		if ($mysqli->connect_errno) {
		    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
		    exit();
		}
		if (!$mysqli->set_charset("utf8")) {
		    printf("Error loading character set utf8: %s\n", $mysqli->error);
		}	
		
		if($id=="0"){
			echo "\n<p>\n(solo las primeras 50 herramientas)</p>\n";
			$consulta="SELECT id_tool, id_instalador, id_prestamo, nombre, codigo1, codigo2, comentario, status FROM herramientas LIMIT 50";
		}else{
			$consulta="SELECT id_tool, id_instalador, id_prestamo, nombre, codigo1, codigo2, comentario, status FROM herramientas WHERE nombre LIKE '%$id'";	
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
					echo "<Td>".$row['id_tool']."</td>";
					echo "<Td>".$row['id_instalador']."</td>";
					echo "<Td>".$row['id_prestamo']."</td>";
					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['codigo1']."</td>";
					echo "<Td>".$row['codigo2']."</td>";
					echo "<Td>".nl2br($row['comentario'])."</td>";
					echo "<Td>".$row['status']."</td>";
/*
					echo "<td><button onclick=\"window.location.href='herramientas.php?op=23&id=".$row['id_tool']."'\">Existencias</button></td>";
					echo "<td><button onclick=\"window.location.href='herramientas.php?op=24&id=".$row['id_tool']."'\">Imprimir</button></td>";
*/

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
		echo "<form id='form' name='form' method='post' action='herramientas.php?op=22'>
  <table width='100%' border='1' cellspacing='0' cellpadding='10'>
    <tr>
      <td colspan='2'>Agregar nueva Herramienta</td>
    </tr>
    <tr>
      <td>Nombre</td>
      <td>Código 1</td>
    </tr>
    <tr>
      <td align='center' valign='middle'><input name='nombre' type='text' id='nombre' size='50' /></td>
      <td align='center' valign='middle'><input type='text' name='codigo' id='codigo' size='30' /></td>
    </tr>
    <tr>
      <td>Comentario</td>
      <td>Código 2</td>
    </tr>
    <tr>
      <td align='center' valign='middle'><textarea name='comentario' id='comentario' cols='80' rows='3'></textarea></td>
      <td align='center' valign='middle'><input type='text' name='serial' id='serial' size='30' /></td>
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
		$_POST['codigo'];
		$_POST['comentario'];
		$_POST['serial'];


*/		
		$consulta=	"INSERT INTO herramientas (id_tool, id_instalador, id_prestamo, nombre, codigo1, codigo2, comentario, status)  ".
						"VALUES ( null,'0' ,'0' ,'".$_POST['nombre']."' ,'".$_POST['serial']."' ,'".$_POST['codigo'].
						"' ,'".$_POST['comentario']."' ,'1')";
//		echo $consulta;

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
					"</tr><tr><td align='center'>Se agrego una nueva <b>Herramienta</b><br>\n</td></tr>\n".
					"<tr><td colspan = '10'>Ir a la <a href='dashboard.php' target='iframe'>página principal</a>".
					" Agregar <a href='herramientas.php?op=2' >una nueva herramienta</a></td></tr>".					
					"</table>";

			} else {
				echo "<br><b>ERROR</b> al agrergar";
			}

		    $mysqli->close();
		}
	
	break;
	case 23:
		// Existencias
		echo "<br><h1>\n<center>Consultar Existencias</center></h1>\n";
		$consulta="SELECT productos.id_prod, productos.nombre, productos.codigob1, productos.codigob2, productos.marca, ".
					"productos.precio, productos.grupo,grupo_productos.id_grupo, grupo_productos.gr_productos ".
					"FROM productos, grupo_productos WHERE productos.grupo = grupo_productos.id_grupo AND productos.id_prod = '$id'";
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
					echo "<Td>".$row['id_prod']."</td>";
					echo "<Td>".$row['nombre']."</td>";
					echo "<Td>".$row['codigob1']."</td>";
					echo "<Td>".$row['codigob2']."</td>";
					echo "<Td>".$row['marca']."</td>";
					echo "<Td>".$row['precio']."</td>";
					echo "<Td>".$row['gr_productos']."</td>";
					echo "</tr>\n";
				}

				echo "</table>\n<br>";

				/* free result set */
				$result->close();

 			 }
		 
		}
		$row = null;
		$rows = null;
		$result = null;
		$consulta="SELECT id_prbodega, id_usr, nombre, ubicacion, comentario FROM pr_bodegas";
		if ($result = $mysqli->query($consulta)) {
			$numero_resultados = $mysqli->affected_rows; 
				echo "<center>\n<TABLE BORDER=0 cellpadding=5 cellspacing=2 heigth=50 ALIGN='center' bgcolor=97BDED>\n";
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
					echo "</tr>\n";
					$row1 =null;
					$rows1=null;
					$existencias = "SELECT id_stock, id_prod, id_depo, stock FROM prod_stock WHERE id_prod='$id' AND id_depo='".$row['id_prbodega']."'";
					if ($result1 = $mysqli->query($existencias)) {
						$numero_resultados = $mysqli->affected_rows; 
						if($numero_resultados==0){

				echo "<tr bgcolor=D0CFF9><td colspan='9'>no se encontro informacion</td></tr>";

			} else {

				while($row1 = $result1->fetch_array()){
					$rows1[] = $row1;
				}

				foreach($rows1 as $row1){
					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td>&nbsp;</td>";
					echo "<Td>&nbsp;</td>";
					echo "<Td>Existencia:</td>";
					echo "<Td>".$row1['stock']."</td>";
					echo "</tr>\n";
				}}}
				}

				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 die(0);
		}





	break;
}
?>