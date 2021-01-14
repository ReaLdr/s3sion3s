<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=concentrado_dto.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html;charset=utf-8"); 

session_start();

$iddistrito= $_SESSION['k_idDistrito'];

$grup=$_SESSION['k_grupo'];

require("arreglos.php");


echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo "<tr>";
echo "<th colspan=3>";
echo "";
echo "</th>";
echo "<th colspan=6>";
echo "<font style='font-size:14px;font-weight:bold;'>Secretaria Ejecutiva<font><br>";
echo "</th>";
echo "<tr>";
echo "<th padding: 10px; >";
echo "<img src='http://localhost/SISECAOD/images/iedf.PNG' style='vertical-align:middle' alt='' />";
echo "</th>";
echo "<tr>";
echo "<th colspan=3>";
echo "";
echo "</th>";
echo "<th colspan=6>";
echo "<font style='font-size:14px;font-weight:bold;'>Unidad T&eacute;cnica de Archivo, Log&iacute;stica y Apoyo a los &Oacute;rganos Desconcentrados<font><br>";
echo "</th>";


echo "<tr>";
echo "<th colspan=3>";
echo "";
echo "</th>";
echo "<th colspan=6>";
echo "<font style='font-size:14px;font-weight:bold;'> REPORTE MENSUAL DE ACTIVIDADES DESARROLLADAS POR LOS &Oacute;RGANOS DESCONCENTRADOS						
<font><br>";
echo "</th>";

echo "<tr>";
echo "<th colspan=2>";
echo "";
echo "<th colspan=2>";
echo "<font style='font-size:14px;font-weight:bold;'> DISTRITO $d_romano[$iddistrito]				
<font><br>";
echo "</th>";

echo "<tr>";
echo "</tr>";
echo "<tr>";
echo "</tr>";
echo '<tr border="1" bgcolor="#cccccc" >';
echo "<th>CLAVE</th>";
echo "<th>ACTIVIDAD</th>";
echo "<th>CUMPLIO</th>";
echo "<th>ESPECIFICAR N&Uacute;MERO DE OFICIO, TARJETA, CORREO ELECTR&Oacute;NICO Y OTRO DOCUMENTO CON EL QUE DIO CUMPLIMIENTO O CON EL QUE JUSTIFICA EL NO CUMPLIMIENTO</th>";
echo "<th>RESUMEN CONCRETO</th>";
echo "<th>SE&Ntilde;ALAR LA CAUSA POR LA QUE NO DIO CUMPLIMIENTO</th>";
echo "</tr>";
echo "</table>";


echo "<table border=1 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";


require("conector.php");

//$sql="select * from sisecao_actividades_trabajo  INNER JOIN sisecao_catactividad ON
//sisecao_actividades_trabajo.'clave' = sisecao_catactividad.'clave' where sisecao_actividades.status =1 order by sisecao_actividades_trabajo.'clave' ";

$sql="SELECT t.iddistrito as distrito, t.clave as clave, c.actividad as actividad,t.realizo as realizo, t.tipo as tipo, t.num_oficio as oficio, t.descripcion as detalle 
FROM sisecao_actividades_trabajo AS t, sisecao_catactividad as c
WHERE t.clave=c.clave AND  t.iddistrito=$iddistrito
ORDER BY clave, iddistrito;";



$query_exe=ifx_query($sql,$id_con);
while ($rows=ifx_fetch_row($query_exe))
		{
				
			echo '<tr>';
			$clave="";
			$clave=$rows[clave];
			$clave=(string)$clave;
			echo '<td>'.$rows[clave].'</td>';
			echo '<td>'.$rows[actividad].'</td>';
			echo '<td>'.$rows[realizo].'</td>';
			echo '<td>'.$rows[tipo].'&nbsp;'.$rows[oficio].'</td>';// CONVERTIT
//			echo '<td>'.$rows[num_oficio].'</td>'; // CONVERTIR
			//echo '<td>'.$rows[realizo].'</td>';
			
			if($rows[realizo]=='SI')
			{
			echo '<td align="left">'.$rows[detalle].'</td>';
			echo '<td>&nbsp;-&nbsp;</td>';
			}
			else
			{
			echo '<td>&nbsp;-&nbsp;</td>';
			echo '<td align="left">'.$rows[detalle].'</td>';		
			}

	
		echo '</tr>';
		}
echo '</table>';
?>