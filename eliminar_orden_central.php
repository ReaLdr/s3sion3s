<?php
error_reporting(0);
echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';
echo '<div align="center">';
echo'<table width="166" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="156" align="center"><img src="images/ajax-loader.gif" width="160" height="24" /></td>
  </tr>
  <tr>
    <td align="center">BORRANDO</td>
  </tr>
</table>';
echo '</div>';
$id_sesion=$_GET[id_sesion];
$id_orden=$_GET[id_orden];
include ("config_open_db.php");


function confirma(){
		echo'	<SCRIPT LANGUAGE="javascript">';
		echo' 	alert("Está seguro de eliminar el punto.")';
		echo'	</SCRIPT>';
		echo'	<SCRIPT LANGUAGE="javascript">';
		echo'	location.href = "./grid_orden_dia_central.php";';
		echo'	</SCRIPT>';
		return true;
		}
		
		
		
if(confirma){

$sql_delete="update sisesecd_ordendia  set estatus=0 where punto in (select punto from sisesecd_ordendia where id_orden=$id_orden)";
if(sqlsrv_query($conn, $sql_delete)==true)
	{
	echo'	<SCRIPT LANGUAGE="javascript">';
	
	echo' 	alert("El punto ha sido cancelado exitosamente")';
	echo'	</SCRIPT>';
	echo'<SCRIPT LANGUAGE="javascript">';
				//echo'history.go(-1)
	echo'history.go(-1)';
	echo'</SCRIPT>';
	}
	else
	{
	sqlsrv_errormsg();
	}
	sqlsrv_close($id_con);
	}
?>