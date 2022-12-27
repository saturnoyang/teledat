<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Documento sin título</title>
</head>

<body>

<form id='form' name='form' method='post' action='autos.php?op=11'>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Comentarios</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan='4' align='center'><textarea name='textarea' id='textarea' cols='80' rows='5'></textarea></td>
  </tr>
  <tr>
    <td colspan='4' align='right'><input type='submit' name='button' id='button' value='Enviar' /></td>
  </tr>
</table>
</form>
</body>
</html>