<?php 
session_start();
error_reporting(E_ERROR | E_PARSE);
$name= $_SESSION['transaccion'];
$grup=$_SESSION['grupo'];

$id_distrito=$_SESSION[id_distrito];
$id_admin=$_SESSION[id_admin];

$nosesion=$_GET['nosesion'];
$id_sesion=$_GET['id_sesion'];

//echo 'Bienvenido, ';
if (isset($_SESSION['user'])) {

	
}
else
{
echo' 	alert("Debe iniciar una sesion")';	
	echo'<SCRIPT LANGUAGE="javascript">';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">
	
	<title>.: SISESECD:.</title>
</head>
  <script>
function validar_texto(a) { 
    tecl = (document.all) ? a.keyCode : a.which; 
    if (tecl==8) return true; 
//    patro =/[a-zA-Záéíóúäëïöü0ñÑ.-9\s]/; 
	patro =/[a-z A-Z áéíóúÁÉÍÓÚäëïöü0ñÑ 0-9\-\.\?\,\"\@\:\()\;\*\+&%\$#_]/;
    t = String.fromCharCode(tecl); 
    return patro.test(t); 
} 

</script> 
<?php include('header.php');	?>
<!--tabla para todos las pantallas -->
    <body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">

                    <div class="container-fluid">
	            <h1 class="mt-4"><img src="images/logo-header.png"></h1>
	<p>&nbsp;</p>
							
			<div class="top-menu">		
				
<table border="0" style="width: 90%;">
  <tr>
    <td width="159" height="25" align="left" class="well">Usuario: <?php echo $name; ?></td>
    <td width="555" align="left" class="well">Consejo Distritital: <?php echo $id_distrito; ?></td>
    <td width="542" align="center"><?php echo"<a class='btn btn-primary' href='javascript:history.back(-2)'> Regresar </a>";?></td>
     
   <td width="169" align="right"><a class="btn btn-default"  href="logout.php">Cerrar Sesion</a></td>
  </tr>
</table>
	
						</div>			

<?php
$variable= $_REQUEST["page"];
//echo "GET PAGE: ".$variable."...";
//echo "GET ID ".$_REQUEST['idsesion']."...";


$movimiento = htmlspecialchars(trim($_POST['movimiento']));

// Consigo datos a desplegar solo de muestra
$encabezado = "-ERROR DE LECTURA-";

require('functions.php');
include 'config_open_db.php';
include 'arreglos.php';

if(isset($_REQUEST['id_sesion']))
{

	$tmpSesion= "SELECT tipo_sesion,desc_sesion,nosesion,CAST(desc_punto as CHAR(2084)) as desc_punto,punto FROM sisesecd_sesiones,sisesecd_ordendia WHERE sisesecd_sesiones.id_sesion=sisesecd_ordendia.id_sesion and sisesecd_sesiones.id_sesion =".$_REQUEST['id_sesion']." and id_orden=".$_REQUEST['id_orden'].";";

	$consultaSesion = sqlsrv_query($conn, $tmpSesion);
	

	if (sqlsrv_has_rows($consultaSesion)){
		
		$registro = sqlsrv_fetch_array($consultaSesion);
		$typesess=$registro['tipo_sesion'];
		$desc=$registro['desc_sesion'];
		$nosesion=$registro['nosesion'];
		$decspunto=$registro['desc_punto'];
		$srt=$decspunto;
		eval("\$srt = \"$srt\";");

//$encabezado = "<b>".$nom_sesion[$nosesion]." Sesión ".$tipo_ses[$typesess]." de los Consejos Distritales 0".$desc."<b><br/> Punto:".$registro['punto']."".utf8_encode($srt).".";
		
$encabezado = "".$tipo_ses[$typesess]." de los Consejos Distritales 0".$desc."<br/> Punto:".$registro['punto']."".utf8_encode($srt).".";		
		
	}
	else{
		echo 'Se produjo un error. No se encontraron datos de la Sesion Distrital:  '.sqlsrv_error();
		return;
	} 
}

if(isset($_POST['submit'])){

	$id_orden=$_REQUEST[id_orden];
	$id_sesion=$_REQUEST[id_sesion];
	$id_incidente=$_POST[id_incidente];
	
	$page =  htmlspecialchars(trim($_POST['page'])); 
	$inter_cp = htmlspecialchars(trim($_POST['ck_cp']));
	$inter_cp = ($inter_cp != 1 ? 0 : 1);
	$inter_c1 = htmlspecialchars(trim($_POST['ck_c1']));
	$inter_c1 = ($inter_c1 != 1 ? 0 : 1);
	$inter_c2 = htmlspecialchars(trim($_POST['ck_c2']));
	$inter_c2 = ($inter_c2 != 1 ? 0 : 1);
	$inter_c3 = htmlspecialchars(trim($_POST['ck_c3']));
	$inter_c3 = ($inter_c3 != 1 ? 0 : 1);
	$inter_c4 = htmlspecialchars(trim($_POST['ck_c4']));
	$inter_c4 = ($inter_c4 != 1 ? 0 : 1);
	$inter_c5 = htmlspecialchars(trim($_POST['ck_c5']));
	$inter_c5 = ($inter_c5 != 1 ? 0 : 1);
	$inter_c6 = htmlspecialchars(trim($_POST['ck_c6']));
	$inter_c6 = ($inter_c6 != 1 ? 0 : 1);
	$inter_se = htmlspecialchars(trim($_POST['ck_sc']));
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
	
	$inter_pmcp = htmlspecialchars(trim($_POST['pmc']));
	$inter_pmcp = ($inter_pmcp != 1 ? 0 : 1);
	$inter_pmcs = htmlspecialchars(trim($_POST['pmc']));
	$inter_pmcs = ($inter_pmcs != 2 ? 0 : 1);
	
	$inter_pelgp = htmlspecialchars(trim($_POST['elg']));
	$inter_pelgp = ($inter_pelgp != 1 ? 0 : 1);
	$inter_pelgs = htmlspecialchars(trim($_POST['elg']));
	$inter_pelgs = ($inter_pelgs != 2 ? 0 : 1);
	
	$inter_pesp = htmlspecialchars(trim($_POST['pes']));
	$inter_pesp = ($inter_pesp != 1 ? 0 : 1);
	$inter_pess = htmlspecialchars(trim($_POST['pes']));
	$inter_pess = ($inter_pess != 2 ? 0 : 1);
	
	$inter_prspp = htmlspecialchars(trim($_POST['prsp']));
	$inter_prspp = ($inter_prspp != 1 ? 0 : 1);
	$inter_prsps = htmlspecialchars(trim($_POST['prsp']));
	$inter_prsps = ($inter_prsps != 2 ? 0 : 1);

	$inter_morenap = htmlspecialchars(trim($_POST['morena']));
	$inter_morenap = ($inter_morenap != 1 ? 0 : 1);
	
	$inter_morenas = htmlspecialchars(trim($_POST['morena']));
	$inter_morenas = ($inter_morenas != 2 ? 0 : 1);
	
	$inter_pfsmp = htmlspecialchars(trim($_POST['pfsm']));
	$inter_pfsmp = ($inter_pfsmp != 1 ? 0 : 1);
	
	$inter_pfsms = htmlspecialchars(trim($_POST['pfsm']));
	$inter_pfsms = ($inter_pfsms != 2 ? 0 : 1);
	
/////// candidatos independientes /////////	
	$inter_ci1p = htmlspecialchars(trim($_POST['ci1']));
	$inter_ci1p = ($inter_ci1p == 1 ? 1 : 0);
		
	$inter_ci1s = htmlspecialchars(trim($_POST['ci1']));
	$inter_ci1s = ($inter_ci1s == 2 ? 1 : 0);
	
	$inter_ci2p = htmlspecialchars(trim($_POST['ci2']));
	$inter_ci2p = ($inter_ci2p == 1 ? 1 : 0);
	
	$inter_ci2s = htmlspecialchars(trim($_POST['ci2']));
	$inter_ci2s = ($inter_ci2s == 2 ? 1 : 0);
	
	$inter_ci3p = htmlspecialchars(trim($_POST['ci3']));
	$inter_ci3p = ($inter_ci3p == 1 ? 1 : 0);
	
	$inter_ci3s = htmlspecialchars(trim($_POST['ci3']));
	$inter_ci3s = ($inter_ci3s == 2 ? 1 : 0);
	
	$inter_ci4p = htmlspecialchars(trim($_POST['ci4']));
	$inter_ci4p = ($inter_ci4p == 1 ? 1 : 0);
	
	$inter_ci4s = htmlspecialchars(trim($_POST['ci4']));
	$inter_ci4s = ($inter_ci4s == 2 ? 1 : 0);
	
	
	$intervencion=htmlspecialchars(trim($_POST['intervencion']));
	$intervencion=str_replace("'",'"',$intervencion);

	$replica=htmlspecialchars(trim($_POST['replica']));
	$replica=str_replace("'",'"',$replica);
	
	$movimiento=htmlspecialchars(trim($_POST['movimiento'])); 
//	echo $movimiento;
	$tmpSQL="";

	if($movimiento=="EDITAR")
	{
	$id_orden=$_POST[id_orden];
	$id_sesion=$_POST[id_sesion];
	
		$tmpSQL="UPDATE sisesecd_incidentes set id_sesion=".$id_sesion.",id_distrito=".$id_distrito.",id_orden=".$id_orden.",tipo_incidente=0,inter_cp=".$inter_cp.",inter_c1=".$inter_c1.",inter_c2=".$inter_c2.",inter_c3=".$inter_c3.",inter_c4=".$inter_c4.",inter_c5=".$inter_c5.",inter_c6=".$inter_c6.",inter_se=".$inter_se.",inter_panp = ".$inter_panp.", inter_pans = ".$inter_pans.", inter_prip = ".$inter_prip.", inter_pris = ".$inter_pris.", inter_prdp = ".$inter_prdp.", inter_prds = ".$inter_prds.", inter_ptp = ".$inter_ptp.", inter_pts = ".$inter_pts.", inter_pvemp = ".$inter_pvemp.", inter_pvems = ".$inter_pvems.", inter_pmcp = ".$inter_pmcp.", inter_pmcs= ".$inter_pmcs.", inter_pelgp = ".$inter_pelgp.", inter_pelgs = ".$inter_pelgs.", inter_pesp = ".$inter_pesp.", inter_pess= ".$inter_pess.", inter_prspp=".$inter_prspp.", inter_prsps=".$inter_prsps.", inter_morenap=".$inter_morenap.", inter_morenas=".$inter_morenas.", inter_pfsmp=".$inter_pfsmp.",inter_pfsms=".$inter_pfsms.", inter_ci1p=".$inter_ci1p.", inter_ci1s=".$inter_ci1s.", inter_ci2p=".$inter_ci2p.", inter_ci2s=".$inter_ci2s.", inter_ci3p=".$inter_ci3p.", inter_ci3s=".$inter_ci3s.", inter_ci4p=".$inter_ci4p.", inter_ci4s=".$inter_ci4s." ,incidente='".$intervencion."',replica='".$replica."'  WHERE id_sesion = ".$id_sesion." and id_orden=".$id_orden." and id_incidentes=".$id_incidente."";
	
		
	}
	
$tmpSQL=str_replace("\n","",$tmpSQL);
$tmpSQL=str_replace("\r","",$tmpSQL);	
	

	//echo $tmpSQL;
//	echo exit;
	if (sqlsrv_query($conn, $tmpSQL)== true){
		echo 'Datos guardados';
		
		include("bitacora.php");
		$accion="Actualizo Incidente ".$id_orden;
		bitacora($accion);
	//	$sql_update="UPDATE sisesecd_sesiones SET con_incidente = 1 WHERE id_sesion=$id_sesion;";

		//if (ifx_query($sql_update,$conn)== true){
					echo'<SCRIPT LANGUAGE="javascript">';
					echo'alert("El Incidente se actualizó Exitosamente")';
					echo'</SCRIPT>';
					echo'<SCRIPT LANGUAGE="javascript">';
					echo'history.go(-2)
					history.back ()';
					echo'	</SCRIPT>';
		//}
		//else{
		//echo 'Se produjo un error al guardar historico. Intente nuevamente '.ifx_error();
		//} 
	}
	else{
		echo 'Se produjo un error. Intente nuevamente '.sqlrsv_error();
	} 
}


		$id_orden=$_REQUEST[id_orden];
		$id_sesion=$_REQUEST[id_sesion];
		
		$sql_incidentes="SELECT * FROM sisesecd_incidentes WHERE id_orden =$id_orden and id_incidentes=$_GET[id_incidente];";
		
		$exc_sql = sqlsrv_query($conn, $sql_incidentes);
		$cliente = sqlsrv_fetch_array($exc_sql);
//	echo "cuantos 1: ";
//		echo $sql_incidentes;
?>
<p>&nbsp;</p>
<center>
	<div class="card mb-4">
	<div class="card-header">
     <center>Edici&oacute;n de Reporte de Incidentes de la  <?php echo $encabezado ?></center>
	
    </div>
    <br />
		
	
	<form id="frmClienteActualizar" name="frmClienteActualizar" method="post" onsubmit="ActualizarIncidente(); return false">
	<input type="hidden" name="movimiento" id="movimiento" value="EDITAR" />
  <input type="hidden" name="id_sesion" id="id_sesion" value="<?php echo $_REQUEST['id_sesion']; ?>" />
  <input type="hidden" name="id_orden" id="id_orden" value="<?php echo $_REQUEST['id_orden']; ?>" />
  <input type="hidden" name="id_incidente" id="id_incidente" value="<?php echo $cliente['id_incidentes']; ?>" />
 <input class="text" type="hidden" name="id_distrito" id="id_distrito" value="<?php echo $_SESSION['id_distrito']; ?>"/>
  </label>
  
 
    
<?php 
//// me traigo los nombres de los integrantes////

$sql_integra = "select * from sisesecd_cat_funcionarios where id_sesion=$id_sesion and id_integrante in (1,2,3,4,5,6,7,8) and id_distrito=$id_distrito";
echo $sql_select;

echo'<table  style="width: 90%;" border="0">';
echo'<tr >';
echo'<td colspan=10 align="center" ><strong>Asistencia a inicio de sesi&oacute;n de Consejo</strong></td>';
echo'</tr>';

	$exec_int = sqlsrv_query($conn, $sql_integra);

	$salta=0;
	while($row_int = sqlsrv_fetch_array ($exec_int))
	{
		
	
	echo'<tr>';	
			
		if($row_int[id_integrante]==1)
		{
			
		echo'<td colspan="8"><strong>Nombre CP :</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
			echo'<td colspan="2">';
			if($cliente['inter_cp']=="1")
			{
			echo'<input type="checkbox" name="ck_cp" value="1" checked="checked">'; 
			}
			else
			{
			echo'<input type="checkbox" name="ck_cp" value="1" >';
			}
			echo' CP';
			echo'</td>';
		}
		
		if($row_int[id_integrante]==2)
		{
		echo '<td colspan="8"><strong>Nombre SC :</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		
				echo'<td colspan="2">';
				if($cliente['inter_se']=="1")
				{
				echo'<input type="checkbox" name="ck_sc" value="1" checked="checked">'; 
				}
				else
				{
				echo'<input type="checkbox" name="ck_sc" value="1" >';
				}
				echo' SC';
				echo'</td>';
		}

		if($row_int[id_integrante]==3)
		{
		echo'<td colspan="8"><strong> NombreC1 :</strong>'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['inter_c1']=="1")
				{
				echo'<input type="checkbox" name="ck_c1" value="1" checked="checked">'; 
				}
				else
				{
				echo'<input type="checkbox" name="ck_c1" value="1" >';
				}
				echo' C1';
				echo'</td>';
		}
		
		if($row_int[id_integrante]==4)
		{
		echo '<td colspan="8"><strong>NombreC2 :</strong>'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['inter_c2']=="1")
				{
				echo'<input type="checkbox" name="ck_c2" value="1" checked="checked">'; 
				}
				else
				{
				echo'<input type="checkbox" name="ck_c2" value="1" >';
				}
				echo' C2';
				echo'</td>';
		}
		
		if($row_int[id_integrante]==5)
		{
		echo '<td colspan="8"><strong> NombreC3:</strong>'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['inter_c3']=="1")
				{
				echo'<input type="checkbox" name="ck_c3" value="1" checked="checked">'; 
				}
				else
				{
				echo'<input type="checkbox" name="ck_c3" value="1" >';
				}
				echo' C3';
				echo'</td>';
		}

		if($row_int[id_integrante]==6)
		{
		echo'<td colspan="8"><strong>NombreC4:</strong> '.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['inter_c4']=="1")
				{
				echo'<input type="checkbox" name="ck_c4" value="1" checked="checked">'; 
				}
				else
				{
				echo'<input type="checkbox" name="ck_c4" value="1" >';
				}
				echo' C4';
				echo'</td>';
		}
		if($row_int[id_integrante]==7)
		{
		echo '<td colspan="8"><strong>NombreC5:</strong>'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['inter_c5']=="1")
				{
				echo'<input type="checkbox" name="ck_c5" value="1" checked="checked">'; 
				}
				else
				{
				echo'<input type="checkbox" name="ck_c5" value="1" >';
				}
				echo' C5';
				echo'</td>';
		}
		if($row_int[id_integrante]==8)
		{
		echo '<td colspan="8"><strong> NombreC6:</strong>'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['inter_c6']=="1")
				{
				echo'<input type="checkbox" name="ck_c6" value="1" checked="checked">'; 
				}
				else
				{
				echo'<input type="checkbox" name="ck_c6" value="1" >';
				}
				echo' C6';
				echo'</td>';
		}
	//echo'</tr>';
	
	}// cierro while
echo'</table>';
  ?>
   <p>  
  <input type="hidden" value="<?php  echo $_REQUEST["page"] ?>" id="page" name="page" />
  </p>
  <table width="89%" border="1">
    <tr>
      <td  colspan="12" align="center" bgcolor="#CCCCFF"><strong>Partidos Politicos Involucrados</strong></td>
    </tr>
    <tr></tr>
    <tr>
      <td  colspan="2" align="center">PAN</td>
      <td  colspan="2" align="center">PRI</td>
      <td  colspan="2" align="center">PRD</td>
      <td  colspan="2" align="center">PVEM</td>
      <td  colspan="2" align="center">PT</td>
	  <td colspan="2" align="center">PMC</td>
		
    </tr>
    <tr>
      <td width="0%"><input type="radio" name="pan" value="1" <?php if($cliente['inter_panp']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="pan" value="2" <?php if($cliente['inter_pans']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
      <td width="0%"><input type="radio" name="pri" value="1" <?php if($cliente['inter_prip']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="pri" value="2" <?php if($cliente['inter_pris']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
      <td width="0%"><input type="radio" name="prd" value="1" <?php if($cliente['inter_prdp']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="prd" value="2" <?php if($cliente['inter_prds']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
        
      <td width="0%"><input type="radio" name="pvem" value="1" <?php if($cliente['inter_pvemp']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="pvem" value="2" <?php if($cliente['inter_pvems']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
      <td width="0%"><input type="radio" name="pt" value="1" <?php if($cliente['inter_ptp']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="pt" value="2" <?php if($cliente['inter_pts']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
		<td width="0%"><input type="radio" name="pmc" value="1" <?php if($cliente['inter_pmcp']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="pmc" value="2" <?php if($cliente['inter_pmcs']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
    </tr>
    <tr>
<td colspan="2" align="center">MORENA</td>
<td colspan="2" align="center">PES</td>
<td colspan="2" align="center">RSP</td>
<td colspan="2" align="center">FM</td>
<!-- 12/01/2021: SE CAMBIA PRELACIÓN-->
<td colspan="2" align="center">ELIGE</td>

    </tr>
    <tr>
       <td width="0%"><input type="radio" name="morena" value="1" <?php if($cliente['inter_morenap']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="morena" value="2" <?php if($cliente['inter_morenas']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
				
      <td width="0%"><input type="radio" name="pes" value="1" <?php if($cliente['inter_pesp']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="pes" value="2" <?php if($cliente['inter_pess']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
		
      <td width="0%"><input type="radio" name="prsp" value="1" <?php if($cliente['inter_prspp']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="prsp" value="2" <?php if($cliente['inter_prsps']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
		
		<td width="0%"><input type="radio" name="pfsm" value="1" <?php if($cliente['inter_pfsmp']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="pfsm" value="2" <?php if($cliente['inter_pfsms']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
 
		<!-- 12/01/2021: SE CAMBIA PRELACIÓN   -->
		<td width="0%"><input type="radio" name="elg" value="1" <?php if($cliente['inter_pelgp']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="elg" value="2" <?php if($cliente['inter_pelgs']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
		
    </tr>
    <tr >
      <td  colspan="12" align="center" bgcolor="#CCCCFF"><strong> Candidaturas Sin Partido</strong></td>
    </tr>
    <tr align="center">
     <td colspan="2">CI - 1</td>
      <td colspan="2">CI - 2</td>
      <td colspan="2">CI - 3</td>
      <td colspan="2">CI - 4</td>
      
    </tr>
    <tr align="center">
  <td width="0%"><input type="radio" name="ci1" value="1" <?php if($cliente['inter_ci1p']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="ci1" value="2" <?php if($cliente['inter_ci1s']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
      <td width="0%"><input type="radio" name="ci2" value="1" <?php if($cliente['inter_ci2p']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="ci2" value="2" <?php if($cliente['inter_ci2s']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
      <td width="0%"><input type="radio" name="ci3" value="1" <?php if($cliente['inter_ci3p']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="ci3" value="2" <?php if($cliente['inter_ci3s']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
         <td width="0%"><input type="radio" name="ci4" value="1" <?php if($cliente['inter_ci4p']=="1") echo "checked=\"checked\""?> />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="ci4" value="2" <?php if($cliente['inter_ci4s']=="1") echo "checked=\"checked\""?> />
        <br />
        S </td>
    </tr>
  </table>
  <p>
</p>

		<table  style="width: 90%;" border="0">
	   <tr >
      <td  colspan="10" align="center" bgcolor="#CCCCFF"><strong> Detalle de las Incidencias</strong></td>
    </tr>
		 </br>

	<tr>
		 <td>N&uacute;mero de Incidente<br />	</td> 
		<?php
	$tipo_punto= $cliente['punto'];  
		 
		
	  
$array_selects[1] = "<option value='1'>Primera</option>";
$array_selects[2] = "<option value='2'>Segunda</option>";
$array_selects[3] = "<option value='3'>Tercera</option>";

		   
		   
		   echo"<td><select class='form-control'  name='numincidente' size='1' id='numincidente' disable>";
		   
        echo "  $array_selects[$tipo_punto] </td>";
			   
        	echo"</select>";
	
	  
		?>
		
	
		</tr>
 <p>
	 
	 
	 <tr>
    <td><label>Descripci&oacute;n del evento<br />
    <textarea name="intervencion" cols="45" rows="5" id="intervencion" onkeypress="return validar_texto(event)"><?php echo stripslashes($cliente['incidente']);?></textarea>
</td>
    </label>
		 </tr>
  </p>
  <p>
	  
    <td><label>Replica<br />
    <textarea name="replica" cols="45" rows="5" id="replica" onkeypress="return validar_texto(event)"><?php echo stripslashes($cliente['replica']);?></textarea>
</td>
		</table>



		<input class="btn btn-primary" type="submit" name="submit" id="button" value="Enviar" />
<p>&nbsp;</p>
		<input class="btn btn-default"  type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="javascript:history.back()" />
	  

</form>
</center>

</div>
</div>
</div>

<footer class="py-4 bg-light mt-auto">
	<?php include('footer.php'); ?>
</footer>
		
</body>
</html>