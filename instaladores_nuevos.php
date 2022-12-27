<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Documento sin título</title>
</head>

<body>
<form id='form1' name='form1' method='post' action='instaladores.php?op=11'>
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
      <td colspan='3'><input name='d' type='text' id='d' size='3' />
      <input name='m' type='text' id='m' size='10' />
      <input name='y' type='text' id='y' size='5' /></td>
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
      <td>Teléfono Fijo</td>
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
      <td><input name='d2' type='text' id='d2' size='3' />
        <input name='m2' type='text' id='m2' size='10' />
      <input name='y2' type='text' id='y2' size='5' /></td>      
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
        <input name='disca' type='radio' id='medicamento_2' value='0' checked='checked' />
      No</label></td>
      <td width='10%'><input type='radio' name='disca' value='1' id='medicamento_3' />
Si</td>
      <td colspan='2'>Medicamento</td>
    </tr>
    <tr>
          <td colspan='3'><input name='discapacidad' type='text' id='discapacidad' /></td>
          <td colspan='2'><input name='medicamento' type='text' id='medicamento' /></td>
    </tr>
    <tr>
      <td colspan='7' align='center' valign='middle'><input type='submit' name='button' id='button' value='Guardar y Continuar' /></td>
    </tr>
  </table>
</form>
<p>Contactos Emergencia</p>
<p>&nbsp;</p>
<form id='form2' name='form2' method='post' action='instaladores.php?op=12&amp;id=1'>
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
</body>
</html>