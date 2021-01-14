<?php
error_reporting(E_ERROR | E_PARSE);
echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';
echo '<div align="center">';
echo'<table width="166" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="156" align="center"><img src="images/ajax-loader.gif" width="160" height="24" /></td>
  </tr>
  <tr>
    <td align="center">Deshabilitar esta sesi&oacute;n </td>
  </tr>
</table>';
echo '</div>';

$id_distrito=$_GET['id_distrito'];
$id_sesion=$_GET['id_sesion'];
$id_orden=$_GET['id_orden'];
$fecha_alta= date('d-m-Y');

include ("config_open_db.php");

$sql_select="select * from sisesecd_ordenes_noaplica where estado <>0 and id_orden=".$id_orden."";

$result= sqlsrv_query ($conn,$sql_select);
$row = sqlsrv_fetch_array($result);
$id_noaplica=$row[id_noaplica];

if ($idnoaplica!= '')
{
$sql_count="select count(*)as cuantos from sisesecd_ordenes_noaplica where id_noaplica=".$id_noaplica."";
//echo $sql_count;
$result_count= sqlsrv_query ($conn, $sql_count);
$row_c = sqlsrv_fetch_array ($result_count);
		
		if($row_c[cuantos] == 1)
		{
			echo'	<SCRIPT LANGUAGE="javascript">';
			echo'alert("Se encuentra ya deshabilitado")';
			echo'	</SCRIPT>';
		
			echo'<SCRIPT LANGUAGE="javascript">';
			echo'history.go(-2)';
			echo'</SCRIPT>';
		}
}
else
{

$sql_insert="insert into sisesecd_ordenes_noaplica values (".$id_sesion.", ".$id_orden.",".$id_distrito.",'".$fecha_alta."','',0)";
//echo $sql_insert;
	
	if (sqlsrv_query($conn, $sql_insert)==true)
	{
	$sql_delete="update sisesecd_ordendia  set estatus_noaplica=0 where id_sesion=$id_sesion and id_orden=$id_orden";
			if(sqlsrv_query($conn, $sql_delete)==true)
			{
			echo'	<SCRIPT LANGUAGE="javascript">';
			
			echo' 	alert("El punto ha sido deshabilitado")';
			echo'	</SCRIPT>';
			echo'<SCRIPT LANGUAGE="javascript">';
		
			echo'history.go(-2)';
			echo'</SCRIPT>';
			}
			else
			{
			sqlsrv_errors();
			}
			sqlsrv_close($conn);
	
	}
}
?>