<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Documento sin título</title>
</head>

<body>
<form id='form' name='form' method='post' action='autos.php?op=31'>

<br>
 
  <table width='90%' border='1' align='center' cellpadding='10' cellspacing='0'>
    <tr>
      <td>auto</td>      <td><select name='id_auto' id='id_auto'>
        <option value='0'>Seleccione...</option>
        <option value='1'>FIAT, FIORINO, xd303m5, 2004, VERDE</option>
      </select></td>      <td>kilometraje: 
        <input type='text' name='km_auto' id='km_auto' /></td>      <td>fecha</td>      
      <td>&nbsp;</td>      
    </tr>
    <tr>
      <td colspan='2'>Revisión de Niveles</td>
      <td align='center'>&nbsp;</td>
      <td align='center'>&nbsp;</td>
      <td colspan='3' rowspan='5'>&nbsp;</td>
    </tr>
    <tr>
      <td rowspan='4'>&nbsp;</td>
      <td>aceite</td>
      <td align='center'><input type='radio' name='aceite' value='1' id='aceite_0' /></td>
      <td align='center'><input type='radio' name='aceite' value='0' id='aceite_1' /></td>
    </tr>
    <tr>
      <td>agua</td>
      <td align='center'><input type='radio' name='agua' value='1' id='agua_0' /></td>
      <td align='center'><input type='radio' name='agua' value='0' id='agua_1' /></td>
    </tr>
    <tr>
      <td>neumaticos</td>
      <td align='center'><input type='radio' name='neumaticos' value='1' id='neumaticos_0' /></td>
      <td align='center'><input type='radio' name='neumaticos' value='0' id='neumaticos_1' /></td>
    </tr>
    <tr>
      <td>otros</td>
      <td align='center'><input type='radio' name='otros' value='1' id='otros_0' /></td>
      <td align='center'><input type='radio' name='otros' value='0' id='otros_1' /></td>
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
      <td width='20%'>observaciones</td>
    </tr>
    <tr>
      <td>freno</td>
      <td align='center'><input type='radio' name='freno' value='1' id='freno_0' /></td>
      <td align='center'><input type='radio' name='freno' value='2' id='freno_1' /></td>
      <td align='center'><input type='radio' name='freno' value='3' id='freno_2' /></td>
      <td align='center'><input type='radio' name='freno' value='4' id='freno_3' /></td>
      <td align='center'><input type='radio' name='freno' value='5' id='freno_4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>luces altas</td>
      <td align='center'><input type='radio' name='l_altas' value='1' id='l_altas0' /></td>
      <td align='center'><input type='radio' name='l_altas' value='2' id='l_altas1' /></td>
      <td align='center'><input type='radio' name='l_altas' value='3' id='l_altas2' /></td>
      <td align='center'><input type='radio' name='l_altas' value='4' id='l_altas3' /></td>
      <td align='center'><input type='radio' name='l_altas' value='5' id='l_altas4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>luces bajas</td>
      <td align='center'><input type='radio' name='l_bajas' value='1' id='l_bajas0' /></td>
      <td align='center'><input type='radio' name='l_bajas' value='2' id='l_bajas1' /></td>
      <td align='center'><input type='radio' name='l_bajas' value='3' id='l_bajas2' /></td>
      <td align='center'><input type='radio' name='l_bajas' value='4' id='l_bajas3' /></td>
      <td align='center'><input type='radio' name='l_bajas' value='5' id='l_bajas4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>luces de estacionamiento</td>
      <td align='center'><input type='radio' name='l_park' value='1' id='l_park0' /></td>
      <td align='center'><input type='radio' name='l_park' value='2' id='l_park1' /></td>
      <td align='center'><input type='radio' name='l_park' value='3' id='l_park2' /></td>
      <td align='center'><input type='radio' name='l_park' value='4' id='l_park3' /></td>
      <td align='center'><input type='radio' name='l_park' value='5' id='l_park4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>luces de freno</td>
      <td align='center'><input type='radio' name='l_freno' value='1' id='l_freno0' /></td>
      <td align='center'><input type='radio' name='l_freno' value='2' id='l_freno1' /></td>
      <td align='center'><input type='radio' name='l_freno' value='3' id='l_freno2' /></td>
      <td align='center'><input type='radio' name='l_freno' value='4' id='l_freno3' /></td>
      <td align='center'><input type='radio' name='l_freno' value='5' id='l_freno4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>bocina</td>
      <td align='center'><input type='radio' name='bocina' value='1' id='bocina_0' /></td>
      <td align='center'><input type='radio' name='bocina' value='2' id='bocina_1' /></td>
      <td align='center'><input type='radio' name='bocina' value='3' id='bocina_2' /></td>
      <td align='center'><input type='radio' name='bocina' value='4' id='bocina_3' /></td>
      <td align='center'><input type='radio' name='bocina' value='5' id='bocina_4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>parabrisas</td>
      <td align='center'><input type='radio' name='parabr' value='1' id='parabr_0' /></td>
      <td align='center'><input type='radio' name='parabr' value='2' id='parabr_1' /></td>
      <td align='center'><input type='radio' name='parabr' value='3' id='parabr_2' /></td>
      <td align='center'><input type='radio' name='parabr' value='4' id='parabr_3' /></td>
      <td align='center'><input type='radio' name='parabr' value='5' id='parabr_4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>luneta</td>
      <td align='center'><input type='radio' name='luneta' value='1' id='luneta_0' /></td>
      <td align='center'><input type='radio' name='luneta' value='2' id='luneta_1' /></td>
      <td align='center'><input type='radio' name='luneta' value='3' id='luneta_2' /></td>
      <td align='center'><input type='radio' name='luneta' value='4' id='luneta_3' /></td>
      <td align='center'><input type='radio' name='luneta' value='5' id='luneta_4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>baterias</td>
      <td align='center'><input type='radio' name='bat' value='1' id='bat_0' /></td>
      <td align='center'><input type='radio' name='bat' value='2' id='bat_1' /></td>
      <td align='center'><input type='radio' name='bat' value='3' id='bat_2' /></td>
      <td align='center'><input type='radio' name='bat' value='4' id='bat_3' /></td>
      <td align='center'><input type='radio' name='bat' value='5' id='bat_4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan='7'>condicion exterior</td>
    </tr>
    <tr>
      <td colspan='7'>&nbsp;</td>
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
      <td align='center'><input type='radio' name='repuesto' value='1' id='repuesto_0' /></td>
      <td align='center'><input type='radio' name='repuesto' value='2' id='repuesto_1' /></td>
      <td align='center'><input type='radio' name='repuesto' value='3' id='repuesto_2' /></td>
      <td align='center'><input type='radio' name='repuesto' value='4' id='repuesto_3' /></td>
      <td align='center'><input type='radio' name='repuesto' value='5' id='repuesto_4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>delanteros</td>
      <td align='center'><input type='radio' name='delanteros' value='1' id='delanteros_0' /></td>
      <td align='center'><input type='radio' name='delanteros' value='2' id='delanteros_1' /></td>
      <td align='center'><input type='radio' name='delanteros' value='3' id='delanteros_2' /></td>
      <td align='center'><input type='radio' name='delanteros' value='4' id='delanteros_3' /></td>
      <td align='center'><input type='radio' name='delanteros' value='5' id='delanteros_4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>traseros</td>
      <td align='center'><input type='radio' name='traseros' value='1' id='traseros_0' /></td>
      <td align='center'><input type='radio' name='traseros' value='2' id='traseros_1' /></td>
      <td align='center'><input type='radio' name='traseros' value='3' id='traseros_2' /></td>
      <td align='center'><input type='radio' name='traseros' value='4' id='traseros_3' /></td>
      <td align='center'><input type='radio' name='traseros' value='5' id='traseros_4' /></td>
      <td>&nbsp;</td>
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
      <td align='center'><input type='radio' name='ll_ruedas' value='1' id='ll_ruedas0' /></td>
      <td align='center'><input type='radio' name='ll_ruedas' value='2' id='ll_ruedas1' /></td>
      <td align='center'><input type='radio' name='ll_ruedas' value='3' id='ll_ruedas2' /></td>
      <td align='center'><input type='radio' name='ll_ruedas' value='4' id='ll_ruedas3' /></td>
      <td align='center'><input type='radio' name='ll_ruedas' value='5' id='ll_ruedas4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>gata</td>
      <td align='center'><input type='radio' name='gata' value='1' id='gata_0' /></td>
      <td align='center'><input type='radio' name='gata' value='2' id='gata_1' /></td>
      <td align='center'><input type='radio' name='gata' value='3' id='gata_2' /></td>
      <td align='center'><input type='radio' name='gata' value='4' id='gata_3' /></td>
      <td align='center'><input type='radio' name='gata' value='5' id='gata_4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>extintor</td>
      <td align='center'><input type='radio' name='extintor' value='1' id='extintor_0' /></td>
      <td align='center'><input type='radio' name='extintor' value='2' id='extintor_1' /></td>
      <td align='center'><input type='radio' name='extintor' value='3' id='extintor_2' /></td>
      <td align='center'><input type='radio' name='extintor' value='4' id='extintor_3' /></td>
      <td align='center'><input type='radio' name='extintor' value='5' id='extintor_4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>cinturon de seguridad</td>
      <td align='center'><input type='radio' name='cinturon' value='1' id='cinturon_0' /></td>
      <td align='center'><input type='radio' name='cinturon' value='2' id='cinturon_1' /></td>
      <td align='center'><input type='radio' name='cinturon' value='3' id='cinturon_2' /></td>
      <td align='center'><input type='radio' name='cinturon' value='4' id='cinturon_3' /></td>
      <td align='center'><input type='radio' name='cinturon' value='5' id='cinturon_4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>triangulos</td>
      <td align='center'><input type='radio' name='triangulo' value='1' id='triangulo_0' /></td>
      <td align='center'><input type='radio' name='triangulo' value='1' id='triangulo_0' /></td>
      <td align='center'><input type='radio' name='triangulo' value='1' id='triangulo_0' /></td>
      <td align='center'><input type='radio' name='triangulo' value='1' id='triangulo_0' /></td>
      <td align='center'><input type='radio' name='triangulo' value='1' id='triangulo_0' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>botiquin</td>
      <td align='center'><input type='radio' name='botinquin' value='1' id='botinquin_0' /></td>
      <td align='center'><input type='radio' name='botinquin' value='2' id='botinquin_1' /></td>
      <td align='center'><input type='radio' name='botinquin' value='3' id='botinquin_2' /></td>
      <td align='center'><input type='radio' name='botinquin' value='4' id='botinquin_3' /></td>
      <td align='center'><input type='radio' name='botinquin' value='5' id='botinquin_4' /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>realizado por</td>
      <td colspan='6'>&nbsp;</td>
    </tr>
    <tr>
      <td>recibido por</td>
      <td colspan='6'>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>