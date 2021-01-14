<?php
error_reporting(E_ERROR | E_PARSE);
include ('config_open_db.php');

$id_sesion=$_POST[id_sesion];

$sql_2="select * from sisesecd_sesiones where id_sesion=$id_sesion";
//echo $sql_2;
$result2=sqlsrv_query($conn,$sql_2);	
$rows2 = sqlsrv_fetch_array($result2);

	
 $nosesion=$rows2['nosesion'];
 $tipo_sesion=$rows2['tipo_sesion'];
 $desc_sesion=$rows2['desc_sesion'];

echo'	<SCRIPT LANGUAGE="javascript">';
echo'	location.href = "grid_sesiones.php?nosesion='.$nosesion.'&tipo_sesion='.$tipo_sesion.'&desc_sesion='.$desc_sesion.'";';
echo'	</SCRIPT>';

?>
		