<?php
require("conector.php");
require("arreglos.php");

$cuantos_cat=40;
$iddistrito= $_SESSION['k_idDistrito'];
$grup=$_SESSION['k_grupo'];
?>
<div align="center">
<table width="503" border="0">
  <tr>
    <td width="150"><img src='http://localhost/SISECAOD/images/iedf.PNG' style='vertical-align:middle' alt='' /></td>
    <td width="343" align="center"><font style='font-size:14px;font-weight:bold;'>Unidad T&eacute;cnica de Archivo, Log&iacute;stica y Apoyo<br> a los &Oacute;rganos Desconcentrado</font></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center">N&Uacute;MERO DE ACTIVIDADES DESARROLLADAS <br />
POR LOS &Oacute;RGANOS DESCONCENTRADOS </td>
  </tr>
</table>

<div align="center">
<table width="500" border="1" >
  <tr align="center" bgcolor="#cccccc">
    <td width="100">CLAVE DE ACTIVIDAD</td>
    <td width="155">CUANTOS SI</td>
    <td width="223">CUANTOS NO</td>
  </tr>



<?PHP
//$sql="SELECT clave, count(iddistrito)as cuantos_si FROM sisecao_actividades_trabajo 
//WHERE realizo='SI' GROUP BY clave ORDER BY clave";

//echo $sql; 


$query_exe=ifx_query($sql,$id_con);
while ($rows=ifx_fetch_row($query_exe))
		{
			$cuantos_si=0;
			$cuantos_no=0;
			echo '<tr>';
			$clave="";
			$clave=$rows[clave];
			$clave=(string)$clave;
			//echo '<td>'.$clave.'</td>';
			echo '<td>'.$rows[clave].'</td>';
			$cuantos_si=$rows[cuantos_si];
			$cuantos_si=(int)$cuantos_si;
//			$miEnteronuevo = (int) $miReal;  


			echo '<td align="center">'.$cuantos_si.'</td>';

			$cuantos_no=$cuantos_cat-$cuantos_si;
			echo '<td align="center">'.$cuantos_no.'</td>'; // CONVERTIR
			//echo '<td>'.$rows[realizo].'</td>';
		echo '</tr>';
		}
echo '</table>
</div>
</div>';
?>
</table>
