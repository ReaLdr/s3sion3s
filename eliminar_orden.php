<?php
echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';
echo '<div align="center">';
echo'<table width="166" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="156" align="center"><img src="images/ajax-loader.gif" width="160" height="24" /></td>
  </tr>
  <tr>
    <td align="center">Habilitar esta sesión </td>
  </tr>
</table>';
echo '</div>';

$id_distrito=$_GET[id_distrito];
$id_sesion=$_GET[id_sesion];
$id_orden=$_GET[id_orden];
$fecha_modifica= date('d-m-Y');


include ("config_open_db.php");

$sql_select="select * from sisesecd_ordenes_noaplica where estado <>1 and id_orden=".$id_orden."";
//echo $sql_select;
$result= sqlsrv_query ($conn, $sql_select);
$row = sqlsrv_fetch_array ($result);
$id_noaplica=$row[id_noaplica];

if ($id_noaplica != '')
{
	
	$sql_update="update sisesecd_ordenes_noaplica set estado=1, fecha_modifica='".$fecha_modifica."' WHERE id_sesion=".$id_sesion." and id_orden=".$id_orden."and id_distrito=".$id_distrito." and id_noaplica=".$id_noaplica."";
//	echo $sql_update;
	
	if(sqlsrv_query($conn, $sql_update)==true)
	{
	$sql_delete="update sisesecd_ordendia  set estatus_noaplica=1 where id_sesion=".$id_sesion." and id_orden=".$id_orden."";
				if(sqlsrv_query($conn, $sql_delete)==true)
				{
				echo'	<SCRIPT LANGUAGE="javascript">';
				echo' 	alert("El punto ha sido Habilitado")';
				echo'	</SCRIPT>';
				echo'<SCRIPT LANGUAGE="javascript">';
				echo'history.go(-2)';
				echo'</SCRIPT>';
				}
				else
				{
				sqlsrv_errors();
				}
				
		}
	
}
else
{
	
echo'<SCRIPT LANGUAGE="javascript">';
echo'history.go(-2)';
echo'</SCRIPT>';
}
?>