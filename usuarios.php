<?PHP
echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>\n".
		"<html xmlns='http://www.w3.org/1999/xhtml'>\n".
		"<head>\n".
		"<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />".
		"</head>\n<body link='#0000FF' vlink='#0000FF' alink='#0000FF'>\n";
		
include('db_config.php');
if (empty($_GET['op'])) { $op=0;} else { $op=$_GET['op'];}

switch($op){
	case 1:
		//Agregar
		
		
		
		echo '
		
<script language="JavaScript">
function validarPasswd(f) {


var todoCorrecto = true;
var formulario = document.form1;
for (var i=0; i<formulario.length; i++) {
 if(formulario[i].type =="text") {
 if (formulario[i].value == null || formulario[i].value.length == 0 || /^\s*$/.test(formulario[i].value)){
 alert (formulario[i].name+ " no puede estar vacío o contener sólo espacios en blanco");
 return false;
 }
 }
 }


var p1 = document.getElementById("passwd1").value;
var p2 = document.getElementById("passwd2").value;

var espacios = false;
var cont = 0;
 
while (!espacios && (cont < p1.length)) {
  if (p1.charAt(cont) == " ")
    espacios = true;
  cont++;
}
 
if (espacios) {
  alert ("La contraseña no puede contener espacios en blanco");
  return false;
}

if (p1.length == 0 || p2.length == 0) {
  alert("Los campos de la password no pueden quedar vacios");
  return false;
}
if (p1 != p2) {
  alert("Las passwords deben de coincidir");
  return false;
} else {
  alert("Todo esta correcto");
  return true; 
}


}		
</script>		
		
		
		

<form name="form1" method="post" onSubmit="return validarPasswd(this)" action="usuarios.php?op=11" autocomplete="off" >
  <table width="80%" border="1" align="center" cellpadding="3" cellspacing="0">
    <tr>
      <td colspan="2" align="center">Ingreso de nuevo usuario</td>
    </tr>
    <tr>
      <td>Nombre Completo</td>
      <td><label for="textfield"></label>
      <input type="text" name="full_name" id="full_name"></td>
    </tr>
    <tr>
      <td>RUT</td>
      <td><input type="text" name="rut" id="rut"></td>
    </tr>
    <tr>
      <td>email</td>
      <td><input type="text" name="email" id="email"></td>
    </tr>
    <tr>
      <td>login</td>
      <td><input type="text" name="login" id="login"></td>
    </tr>
    <tr>
      <td>clave</td>
      <td><input type="password" name="passwd1" id="passwd1"></td>
    </tr>
    <tr>
      <td>repita la clave</td>
      <td><input type="password" name="passwd2" id="passwd2"></td>
    </tr>
    <tr>
      <td>telefono</td>
      <td><input type="text" name="telefono" id="telefono"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Enviar"></td>
    </tr>
  </table>
</form>

';
			
		
		
		break;
	case 11:
		//Recibir datos nuevo usuario
		/*
		echo $_POST['full_name']."<br>\n";
		echo $_POST['rut']."<br>\n";
		echo $_POST['email']."<br>\n";
		echo $_POST['login']."<br>\n";
		echo $_POST['passwd1']."<br>\n";
		echo $_POST['telefono']."<br>\n";
		*/
		$consulta="INSERT INTO usuarios (id_usr, usr_nombre, full_name, email, rut, passwd, telf, is_admin, usr_status) ".
					"VALUES ( null,'".$_POST['login']."','".$_POST['full_name']."','".$_POST['email']."','".$_POST['rut'].
					"','".sha1($_POST['passwd1'])."','".$_POST['telefono']."','0','0')";
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
					"</tr><tr><td align='center'><br>Se agrego un nuevo usuario<br>\n".
					"Recuerde que debe ir al Modulo Seguridad activar el usuario y asignarle el acceso al sistema.</td></tr>\n".
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
		//Seguridad
		echo "<br><h1>\n<center>Niveles de Acceso y Seguridad</center></h1>\n<br>\n";
		$consulta="SELECT id_usr, usr_nombre, full_name, email, rut, passwd, telf, is_admin, usr_status FROM usuarios ORDER BY usr_status";
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
					
					$url1 = ($row['is_admin']==1 ? "" : "<a href='usuarios.php?op=21&id=".$row['id_usr']."'>");
					$url2 = ($row['is_admin']==1 ? "" : "</a>");
					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td>$url1".$row['id_usr']."$url2</td>";
					echo "<Td>$url1".$row['usr_nombre']."$url2</td>";
					echo "<Td>$url1".$row['full_name']."$url2</td>";
					echo "<Td>".$row['email']."</td>";
					echo "<Td>".$row['rut']."</td>";
					echo "<Td>".$row['telf']."</td>";
					echo "<Td>".($row['is_admin']==1 ? "Administrador" : "Usuario")."</td>";
					echo "<Td>".($row['usr_status']==1 ? "Activo" : "Desactivado" )."</td>";
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
		echo "<br><h1>\n<center>Niveles de Acceso y Seguridad</center></h1>\n<br>\n";
		if (empty($_GET['id'])) { $id=0;} else { $id=$_GET['id'];}
		$consulta="SELECT id_usr, usr_nombre, full_name, email, rut, passwd, telf, is_admin, usr_status FROM usuarios WHERE id_usr='$id' ORDER BY usr_status";
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
					
					$url1 = ($row['is_admin']==1 ? "" : "<a href='usuarios.php?op=21&id=".$row['id_usr']."'>");
					$url2 = ($row['is_admin']==1 ? "" : "</a>");
					echo "<TR bgcolor=D0CFF9>\n";
					echo "<Td>$url1".$row['id_usr']."$url2</td>";
					echo "<Td>$url1".$row['usr_nombre']."$url2</td>";
					echo "<Td>$url1".$row['full_name']."$url2</td>";
					echo "<Td>".$row['email']."</td>";
					echo "<Td>".$row['rut']."</td>";
					echo "<Td>".$row['telf']."</td>";
					echo "<Td>".($row['is_admin']==1 ? "Administrador" : "Usuario")."</td>";
					echo "<Td>\n";
					echo "<form method='post' action='usuarios.php?op=22&id=".$row['id_usr']."'>".
							"<select name='usr_status' id='usr_status'>\n".
							"<option>Seleccione....</option>\n".
							"<option ".($row['usr_status']==1 ? "selected='selected'" : " " )."value='1'>Activado</option>\n".
							"<option ".($row['usr_status']==0 ? "selected='selected'" : " " )."value='0'>Desactivado</option>".
							"</select><input type='submit' name='button' id='button' value='Actualizar'>".
							"</form>";
					echo "</tr>\n";

				}
				echo "</table>\n<br><br><br>\n";
				$result=null;
				$row = null;
				$rows = null;
				$consulta="SELECT id_modulo, mod_nombre, mod_status FROM modulos";

				if ($result = $mysqli->query($consulta)) {
					$numero_resultados = $mysqli->affected_rows; 
					if($numero_resultados==0){

				echo "no se encontro informacion";

			} else {

				echo "<center>\n<TABLE BORDER=1 cellpadding=5 cellspacing=2 heigth=50 ALIGN='center' bgcolor=97BDED>\n";
				echo "<form name='form1' method='post' action='usuarios.php?op=23&id=".$id."'>\n";

				while($row = $result->fetch_array()){
					$rows[] = $row;
				}

				foreach($rows as $row){

					echo "<tr><Td>".$row['mod_nombre']."</td>\n";

					$consulta2="SELECT id_acceso, id_modulo, id_usr, acceso FROM acceso WHERE id_modulo='".$row['id_modulo']."' AND id_usr='".$id."'";
					$row2 = null;
					$rows2 = null;
					if ($result2 = $mysqli->query($consulta2)) {
						$numero_resultados = $mysqli->affected_rows; 
						if($numero_resultados==0){
						
							echo "<td><input type='hidden' name='status' value='1'><label>\n".
								"<input type='radio' name='access[".$row['id_modulo']."]' value='1' id='RadioGroup1_0' />\n".
								"Si</label>\n".
								"</td><td><label>\n".
								"<input type='radio' name='access[".$row['id_modulo']."]' value='0' id='RadioGroup1_1' checked='checked' />".
								"No</label></td>\n";		

			} else {

				while($row2 = $result2->fetch_array()){
					$rows2[] = $row2;
				}

				foreach($rows2 as $row2){


				echo "<td><input type='hidden' name='status' value='0'><label>\n".
						"<input type='radio' name='access[".$row['id_modulo']."]' value='1' id='RadioGroup1_0' ".
						($row2['acceso']==1? "checked='CHECKED'": " ")." />\n".
						"Si</label>\n".
						"</td><td><label>\n".
						"<input type='radio' name='access[".$row['id_modulo']."]' value='0' id='RadioGroup1_1' ".
						($row2['acceso']==0? "checked='CHECKED'": " ")." />".
						"No</label></td>\n";		

					}}
					}
				}}
					
				echo "<td colspan='2' align='center'><input type='submit' name='button' id='button' value='Actualizar'></td>";	
				echo "</form></table>\n";	
				}

				/* free result set */
				$result->close();
				echo "</center>";

 			 }
		 die(0);
		}

	
		break;
	case 22:
		if (empty($_GET['id'])) { $id=0;} else { $id=$_GET['id'];}
		if (empty($_POST['usr_status'])) { $usr_status=0;} else { $usr_status=$_POST['usr_status'];}
		echo "Usuario: $id<br>\nEstatus: $usr_status<br>\n";
		$consulta="UPDATE usuarios SET usr_status ='".$usr_status."' WHERE id_usr ='".$id."'";
		echo $consulta."\n<br>";
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
				echo "<br>Se han cambiado las credenciales de Acceso al Sistema.";
			} else {
				echo "<br><b>ERROR</b> al Actualizar";
			}

		    $mysqli->close();
		}
	
		break;
	case 23:
		if (empty($_GET['id'])) { $id=0;} else { $id=$_GET['id'];}
		if ( !empty($_POST["access"]) && is_array($_POST["access"]) ) { 
			$mysqli = new mysqli($db_host, $db_usuario, $db_passwd, $db_nombre);
			if ($mysqli->connect_errno) {
			    printf("<br>Error de Conexi&oacute;n: %s\n", $mysqli->connect_error);
			    exit();
			}
			if (!$mysqli->set_charset("utf8")) {
			    printf("Error loading character set utf8: %s\n", $mysqli->error);
			}		
	       	foreach ( $_POST["access"] as $modulo => $access ) { 			
    	        echo "<li>";				
				if($_POST["status"]=="1"){
					$consulta = "INSERT INTO acceso (id_acceso, id_modulo, id_usr, acceso) VALUES (null,'$modulo','$id','$access')";
				}else{
					$consulta = "UPDATE acceso SET  acceso='$access' WHERE  id_modulo='$modulo' AND id_usr='$id'";
				}
				if ($result = $mysqli->query($consulta)) {
					echo "Ok!";
				} else {
					echo "<br><b>ERROR</b>";
				}
	            echo "</li>\n";
     	}
		$result=null;
		}
		break;	
	case 3:
		//Consultar
		echo "<br><h1>\n<center>Consultar Usuarios</center></h1>\n<br>\n";
		$consulta="SELECT id_usr, usr_nombre, full_name, email, rut, passwd, telf, is_admin, usr_status FROM usuarios ORDER BY usr_status";
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
					echo "<Td>".$row['id_usr']."</td>";
					echo "<Td>".$row['usr_nombre']."</td>";
					echo "<Td>".$row['full_name']."</td>";
					echo "<Td>".$row['email']."</td>";
					echo "<Td>".$row['rut']."</td>";
					echo "<Td>".$row['telf']."</td>";
					echo "<Td>".($row['is_admin']==1 ? "Administrador" : "Usuario")."</td>";
					echo "<Td>".($row['usr_status']==1 ? "Activo" : "Desactivado" )."</td>";
					echo "</tr>\n";

				}

				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 die(0);
		}
					
		break;
	case 4:
		//Eliminar
		echo "<br><h1>\n<center>Desactivar / Eliminar Usuario</center></h1>\n<br>\n";
		$consulta="SELECT id_usr, usr_nombre, full_name, email, rut, passwd, telf, is_admin, usr_status FROM usuarios ORDER BY usr_status";
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
					echo "<Td>".$row['id_usr']."</td>";
					echo "<Td>".$row['usr_nombre']."</td>";
					echo "<Td>".$row['full_name']."</td>";
					echo "<Td>".$row['email']."</td>";
					echo "<Td>".$row['rut']."</td>";
					echo "<Td>".$row['telf']."</td>";
					echo "<Td>".($row['is_admin']==1 ? "Administrador" : "Usuario")."</td>";					
					echo "<Td>".($row['usr_status']==1 ? "Activo" : "Desactivado" )."</td>";
					echo "</tr>\n";

				}

				echo "</table>";

				/* free result set */
				$result->close();

 			 }
		 die(0);
		}





		break;
	default:
		echo $op;
		break;	
}


echo "</body>\n</html>";
?>