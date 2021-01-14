<?php 
session_start();
$name= $_SESSION['k_username'];
$grup=$_SESSION['k_grupo'];
$grup=$_SESSION[transaccion];
$id_distrito=$_SESSION[id_distrito];
$id_admin=$_SESSION[id_admin];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<title>.: SISECOD 2012 :.</title>
</head>
<style>
.titulo{

font - family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.blanco_tablas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	text-align : center;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: none;
	color: #FFFFFF;
}
</style>
<body>
<div id="container_blanco">
<div align="center">
<table width="597" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="115" rowspan="2"><img src="images/logo2012.gif" width="96" height="76" /></td>
    <td width="475" height="71" class="titulo_sistema">INSTITUTO ELECTORAL DEL DISTRITO FEDERAL</td>
  </tr>
  <tr>
    <td class="titulo_sistema">SIstema de Seguimiento a las Sesiones de los Consejos Distritales<BR> (SISECOD 2012)</td>
  </tr>
</table>
<!--tabla para todos las pantallas -->
<table width="580" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="222" height="25" align="left">Usuario: <?php echo $name; ?></td>
    <td width="223" align="left">Distrito: <?php echo $id_distrito; ?></td>
    <td width="446" align="left"><a href="grid_sesiones.php">Menú Principal</a></td>
    <td width="117" align="right"><a href="logout.php"><p class="titulo">Cerrar Sesion</p></a></td>
  </tr>
</table>

</div>
<?php

session_start();
$name= $_SESSION['k_username'];
$grup=$_SESSION['k_grupo'];
$grup=$_SESSION[transaccion];
$id_distrito=$_SESSION[id_distrito];
$id_admin=$_SESSION[id_admin];
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

$idsesion=$_GET[idsesion];
$idorden=$_GET[idorden];
$id_distrito=$_SESSION[id_distrito];
include ("config_open_db.php");




$sql_delete="update sesiones set estatus=0 where idsesion=$idsesion and iddistrito=$id_distrito";
$sql_delete_ordenes="update ordendia estatus=0 where idsesion=$idsesion;";
//echo $sql_delete;

if(ifx_query($sql_delete, $conn)==true)
	{
		$sql_delete_ordenes="update ordendia set estatus=0 WHERE idsesion=$idsesion;";
			if(ifx_query($sql_delete_ordenes, $conn)==true)
			{
			echo'	<SCRIPT LANGUAGE="javascript">';	
			echo' 	alert("El sesion ha sido cancelada exitosamente")';
			echo'	</SCRIPT>';
			echo'<SCRIPT LANGUAGE="javascript">';
						//echo'history.go(-1)
			echo'history.go(-1)';
			echo'</SCRIPT>';
			}
			else
			{
				ifx_errormsg();
			}
			
			
	echo' 	alert("El sesion ha sido cancelada exitosamente")';
			echo'	</SCRIPT>';
			echo'<SCRIPT LANGUAGE="javascript">';
						//echo'history.go(-1)
			echo'history.go(-1)';
	
	}
	else
	{
	ifx_errormsg();
	}


ifx_close($conn);
	
?>
</div>
<div align="center">
<table width="706" height="62" border="0" cellpadding="0" cellspacing="0">
  <tr bgcolor="#231A31">
    <td width="650" align="center"><img src="images/footer.png" /></td>
  </tr>
  </table>
  </div>
</body>
</html>