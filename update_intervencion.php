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
    <td class="titulo_sistema">SIstema de Seguimiento a las Sesiones de los Consejos Distritales<BR> 
    (SISESECD 2012)</td>
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
	$page =  htmlspecialchars(trim($_POST['page'])); 
	//$tipointervencion =  htmlspecialchars(trim($_POST['tipointervencion'])); 
	include 'config_open_db.php';
	$idsesion = htmlspecialchars(trim($_REQUEST['idsesion']));

	$idorden = htmlspecialchars(trim($_REQUEST['idorden']));
	$nosesion = htmlspecialchars(trim($_POST['nosesion']));
	$tiposesion = htmlspecialchars(trim($_POST['tiposesion']));
	
	//echo "tiposesion".$tiposesion;
	
	$inter_cp = htmlspecialchars(trim($_POST['inter_cp']));
	$inter_cp = ($inter_cp != 1 ? 0 : 1);
	$inter_c1 = htmlspecialchars(trim($_POST['inter_c1']));
	$inter_c1 = ($inter_c1 != 1 ? 0 : 1);
	$inter_c2 = htmlspecialchars(trim($_POST['inter_c2']));
	$inter_c2 = ($inter_c2 != 1 ? 0 : 1);
	$inter_c3 = htmlspecialchars(trim($_POST['inter_c3']));
	$inter_c3 = ($inter_c3 != 1 ? 0 : 1);
	$inter_c4 = htmlspecialchars(trim($_POST['inter_c4']));
	$inter_c4 = ($inter_c4 != 1 ? 0 : 1);
	$inter_c5 = htmlspecialchars(trim($_POST['inter_c5']));
	$inter_c5 = ($inter_c5 != 1 ? 0 : 1);
	$inter_c6 = htmlspecialchars(trim($_POST['inter_c6']));
	$inter_c6 = ($inter_c6 != 1 ? 0 : 1);
	$inter_se = htmlspecialchars(trim($_POST['inter_se']));
	$inter_se = ($inter_se != 1 ? 0 : 1);
	$inter_panp = htmlspecialchars(trim($_POST['pan']));
	$inter_panp = ($inter_panp != 1 ? 0 : 1);
	$inter_pans = htmlspecialchars(trim($_POST['pan']));
	$inter_pans = ($inter_pans != 2 ? 0 : 1);
	$inter_prip = htmlspecialchars(trim($_POST['pri']));
	$inter_prip = ($inter_prip != 1 ? 0 : 1);
	$inter_pris = htmlspecialchars(trim($_POST['pri']));
	$inter_pris = ($inter_pris != 2 ? 0 : 1);
	$inter_prdp = htmlspecialchars(trim($_POST['prd']));
	$inter_prdp = ($inter_prdp != 1 ? 0 : 1);
	$inter_prds = htmlspecialchars(trim($_POST['prd']));
	$inter_prds = ($inter_prds != 2 ? 0 : 1);
	$inter_ptp = htmlspecialchars(trim($_POST['pt']));
	$inter_ptp = ($inter_ptp != 1 ? 0 : 1);
	$inter_pts = htmlspecialchars(trim($_POST['pt']));
	$inter_pts = ($inter_pts != 2 ? 0 : 1);
	$inter_pvemp = htmlspecialchars(trim($_POST['pvem']));
	$inter_pvemp = ($inter_pvemp != 1 ? 0 : 1);
	$inter_pvems = htmlspecialchars(trim($_POST['pvem']));
	$inter_pvems = ($inter_pvems != 2 ? 0 : 1);
	$inter_convp = htmlspecialchars(trim($_POST['conv']));
	$inter_convp = ($inter_convp != 1 ? 0 : 1);
	$inter_convs = htmlspecialchars(trim($_POST['conv']));
	$inter_convs = ($inter_convs != 2 ? 0 : 1);
	$inter_pnap = htmlspecialchars(trim($_POST['pna']));
	$inter_pnap = ($inter_pnap != 1 ? 0 : 1);
	$inter_pnas = htmlspecialchars(trim($_POST['pna']));
	$inter_pnas = ($inter_pnas != 2 ? 0 : 1);
	$inter_psp = htmlspecialchars(trim($_POST['ps']));
	$inter_psp = ($inter_psp != 1 ? 0 : 1);
	$inter_pss = htmlspecialchars(trim($_POST['ps']));
	$inter_pss = ($inter_pss != 2 ? 0 : 1);

	
	$intervencion=htmlspecialchars(trim($_POST['intervencion']));
	$intervencion=str_replace("'",'"',$intervencion);
	$replica=htmlspecialchars(trim($_POST['replica']));
	$replica=str_replace("'",'"',$replica);
	
	$movimiento=htmlspecialchars(trim($_POST['movimiento'])); 
	//$tmpSQL="";
	
	
	$tmpSQL="UPDATE intervenciones set idsesion=".$idsesion.",idorden=".$idorden.",inter_cp=".$inter_cp.",inter_c1=".$inter_c1.",inter_c2=".$inter_c2.",inter_c3=".$inter_c3.",inter_c4=".$inter_c4.",inter_c5=".$inter_c5.",inter_c6=".$inter_c6.",inter_se=".$inter_se.",inter_panp = ".$inter_panp.", inter_pans = ".$inter_pans.", inter_prip = ".$inter_prip.", inter_pris = ".$inter_pris.", inter_prdp = ".$inter_prdp.", inter_prds = ".$inter_prds.", inter_ptp = ".$inter_ptp.", inter_pts = ".$inter_pts.", inter_pvemp = ".$inter_pvemp.", inter_pvems = ".$inter_pvems.", inter_convp = ".$inter_convp.", inter_convs = ".$inter_convs.", inter_pnap = ".$inter_pnap.", inter_pnas = ".$inter_pnas.", inter_psp = ".$inter_psp.", inter_pss = ".$inter_pss.
	",intervencion='".$intervencion."',replica='".$replica."'  WHERE idsesion = ".$idsesion;
//echo $tmpSQL;
$tmpSQL=str_replace("\n","",$tmpSQL);
 $tmpSQL=str_replace("\r","",$tmpSQL);	
	
	
if (ifx_query($tmpSQL,$conn)== true)
{
$sql_update="UPDATE sesiones SET con_intervencion =1 WHERE idsesion=$idsesion";
		//echo $sql_update;

		if(ifx_query($sql_update,$conn)== true)
		{

echo'<p></p>';
echo '<div align="center">';
echo'<table width="166" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="156" align="center"><img src="images/ajax-loader.gif" width="160" height="24" /></td>
  </tr>
  <tr>
    <td align="center">ACTUALIZANDO...</td>
  </tr>
</table>';

	echo'<SCRIPT LANGUAGE="javascript">';
	echo'alert("La Intervención se actualizo exitosamente");';
	echo'	location.href = "./grid_orden_dia.php?idsesion='.$idsesion.'&nosesion='.$nosesion.'&tiposesion='.$tiposesion.'";';
	echo'	</SCRIPT>';
		//http://localhost/sisesecd/grid_orden_dia.php?idsesion=10
		echo 'Datos guardados';	//echo 'Datos guardados';
		}
}
else
{
echo 'Datos NO guardados ';	
}

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