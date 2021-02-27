<?php 
session_start();
error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set("America/Mexico_City");


	if (isset($_SESSION['user'])) {
	$nombre_area=$_SESSION['transaccion'];
	$perfil=$_SESSION['grupo'];
	$id_distrito = $_SESSION['id_distrito'];	

	}
	else
	{

		echo'<SCRIPT LANGUAGE="javascript">';
		echo'	location.href = "index.php";';
		echo'	</SCRIPT>';
	}
$variable= $_REQUEST["page"];
$name= $_SESSION['transaccion'];
$grup=$_SESSION['grupo'];
//$grup=$_SESSION['transaccion'];
$id_distrito=$_SESSION['id_distrito'];


include('arreglos.php');
$nosesion=$_GET['nosesion'];
$id_sesion=$_GET['id_sesion'];
$tipo_sesion=$_GET['tipo_sesion'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />

<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<title>.: SISESECD 2018 :.</title>
</head>

  <?php include("header.php");?>
	
<body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid">
	            <h1 class="mt-4"><img src="images/logo-header.png"></h1>
	<p>&nbsp;</p>
<!--tabla para todos las pantallas -->
<div class="top-menu">
<table border="0" style="width: 90%;">
  <tr>
    <td width="222" height="25" align="left" class="well">Usuario: <?php echo $name; ?></td>
    <td width="223" align="left" class="well">Consejo Distrital: <?php echo $id_distrito; ?></td>
    <td width="446" align="center" ><?php echo'<a class="btn btn-primary" href="javascript:history.back(-1)"> Menu Principal </a>'; ?></td>
    <td width="117" align="right"><a href="logout.php"><p class="btn btn-default">Cerrar Sesion</p></a></td>
  </tr>
</table>
	  </div>
						
<?php

//echo "GET PAGE: ".$variable."...";
//echo "GET ID ".$_REQUEST['idsesion']."...";
$id_sesion = htmlspecialchars(trim($_REQUEST['id_sesion']));
$movimiento = htmlspecialchars(trim($_POST['movimiento']));

// Consigo datos a desplegar solo de muestra
$encabezado = "-ERROR DE LECTURA-";

require('functions.php');
include 'config_open_db.php';
include 'arreglos.php';

$distrito=$d_romano[$_SESSION['id_distrito']];
$nosesion=$_REQUEST['nosesion'];
$tipo_sesion=$_REQUEST['tipo_sesion'];
$id_sesion=$_REQUEST['id_sesion'];
$desc_sesion=$_REQUEST['desc_sesion'];
//echo $descsesion;
//echo $nosesion;

if(isset($_REQUEST['id_sesion']))
{
	//contar primero
	$sql_count="Select count(*) as cuantos from sisesecd_sesiones where id_sesion=$_REQUEST[id_sesion];";		
	$exec_count = sqlsrv_query($conn, $sql_count);
		//$cliente = mysql_fetch_array($consulta);
		$row_count1 = sqlsrv_fetch_array($exec_count);
		$cuantos1=0;
		$cuantos1=$row_count1[cuantos];
			
	$tmpSesion="Select * from sisesecd_sesiones where id_sesion=".$_REQUEST['id_sesion'].";";
//	$consultaSesion = mysql_query($tmpSesion);
	$consultaSesion = sqlsrv_query($conn, $tmpSesion);
	
	if ($cuantos1>0){
		// Aqui consigo datos a desplegar 
//		$registro = mysql_fetch_array($consultaSesion);
		$registro = sqlsrv_fetch_array($consultaSesion);
		$descripcion=$registro['desc_sesion'];
		$typesess=$registro['tipo_sesion'];
		
		//$encabezado = "<b>".$nom_sesion[$registro['nosesion']]." Sesión ".$tipo_ses[$typesess]." de los Consejos Distritales 0".$descripcion."</b>";
		$encabezado = "<b>".$tipo_ses[$typesess]." de los Consejos Distritales 0".$descripcion."</b>";
	

	}
	else{
		echo 'Se produjo un error. No se encontraron datos de la Sesión Distrital:  '.sqlsrv_error();
		return;
	} 
}

if(isset($_POST['submit'])){
	
	$fechafinreal = htmlspecialchars(trim($_POST['fechafinreal']));
	if($fechafinreal != ""){
		$explode_fecha_inicial = explode("/", $fechafinreal);
		$dia = $explode_fecha_inicial[0];
		$mes = $explode_fecha_inicial[1];
		$anio = $explode_fecha_inicial[2];
		$fecha_correcta = checkdate($mes, $dia, $anio);
	} else{
		$fecha_correcta = false;
	}
	if(!$fecha_correcta){
		echo'<SCRIPT LANGUAGE="javascript">';
				echo'alert("Ingrese una fecha válida")';
				echo'</SCRIPT>';
				echo'<SCRIPT LANGUAGE="javascript">';
				echo'location.href = "./actualizarinicio.php?id_sesion='.$id_sesion.'&nosesion='.$nosesion.'&tipo_sesion='.$tipo_sesion.'&desc_sesion='.$desc_sesion.'";';
		echo'</SCRIPT>';
		exit;
	}
	//echo $fechainicioreal;
	$horafinreal = htmlspecialchars(trim($_POST['horafinreal']));
	$page =  htmlspecialchars(trim($_POST['page'])); 
	$asistenciaini =0;
	
	$qf_cp = htmlspecialchars(trim($_POST['ck_cp']));
	$qf_cp = ($qf_cp != 1 ? 0 : 1);
	
	$qf_c1 = htmlspecialchars(trim($_POST['ck_c1']));
	$qf_c1 = ($qf_c1 != 1 ? 0 : 1);
	
	$qf_c2 = htmlspecialchars(trim($_POST['ck_c2']));
	$qf_c2 = ($qf_c2 != 1 ? 0 : 1);

	$qf_c3 = htmlspecialchars(trim($_POST['ck_c3']));
	$qf_c3 = ($qf_c3 != 1 ? 0 : 1);
	
	$qf_c4 = htmlspecialchars(trim($_POST['ck_c4']));
	$qf_c4 = ($qf_c4 != 1 ? 0 : 1);
	
	$qf_c5 = htmlspecialchars(trim($_POST['ck_c5']));
	$qf_c5 = ($qf_c5 != 1 ? 0 : 1);
	
	$qf_c6 = htmlspecialchars(trim($_POST['ck_c6']));
	$qf_c6 = ($qf_c6 != 1 ? 0 : 1);
	
	$qf_sc = htmlspecialchars(trim($_POST['ck_sc']));
	$qf_sc = ($qf_sc != 1 ? 0 : 1);

//////partidos politicos///	
	$qf_panp = htmlspecialchars(trim($_POST['pan']));
	$qf_panp = ($qf_panp == 1 ? 1 : 0);

	$qf_pans = htmlspecialchars(trim($_POST['pan']));
	$qf_pans = ($qf_pans == 2 ? 1 : 0);

	$qf_prip = htmlspecialchars(trim($_POST['pri']));
	$qf_prip = ($qf_prip == 1 ? 1 : 0);

	$qf_pris = htmlspecialchars(trim($_POST['pri']));
	$qf_pris = ($qf_pris == 2 ? 1 : 0);

	$qf_prdp = htmlspecialchars(trim($_POST['prd']));
	$qf_prdp = ($qf_prdp == 1 ? 1 : 0);

	$qf_prds = htmlspecialchars(trim($_POST['prd']));
	$qf_prds = ($qf_prds == 2 ? 1 : 0);

	$qf_ptp = htmlspecialchars(trim($_POST['pt']));
	$qf_ptp = ($qf_ptp == 1 ? 1 : 0);

	$qf_pts = htmlspecialchars(trim($_POST['pt']));
	$qf_pts = ($qf_pts == 2 ? 1 : 0);

	$qf_pvemp = htmlspecialchars(trim($_POST['pvem']));
	$qf_pvemp = ($qf_pvemp == 1 ? 1 : 0);

	$qf_pvems = htmlspecialchars(trim($_POST['pvem']));
	$qf_pvems = ($qf_pvems == 2 ? 1 : 0);

	$qf_pmcp = htmlspecialchars(trim($_POST['pmc']));
	$qf_pmcp = ($qf_pmcp == 1 ? 1 : 0);

	$qf_pmcs = htmlspecialchars(trim($_POST['pmc']));
	$qf_pmcs = ($qf_pmcs == 2 ? 1 : 0);

	$qf_elgp = htmlspecialchars(trim($_POST['elg']));
	$qf_elgp = ($qf_elgp == 1 ? 1 : 0);

	$qf_elgs = htmlspecialchars(trim($_POST['elg']));
	$qf_elgs = ($qf_elgs == 2 ? 1 : 0);

	$qf_pesp = htmlspecialchars(trim($_POST['pes']));
	$qf_pesp = ($qf_pesp == 1 ? 1 : 0);

	$qf_pess = htmlspecialchars(trim($_POST['pes']));
	$qf_pess = ($qf_pess == 2 ? 1 : 0);

	$qf_prsp = htmlspecialchars(trim($_POST['prsp']));
	$qf_prsp = ($qf_prsp == 1 ? 1 : 0);

	$qf_prss = htmlspecialchars(trim($_POST['prsp']));
	$qf_prss = ($qf_prss == 2 ? 1 : 0);

	$qf_morenap = htmlspecialchars(trim($_POST['morena']));
	$qf_morenap = ($qf_morenap == 1 ? 1 : 0);

	$qf_morenas = htmlspecialchars(trim($_POST['morena']));
	$qf_morenas = ($qf_morenas == 2 ? 1 : 0);
	
	$qf_pfsmp = htmlspecialchars(trim($_POST['pfsm']));
	$qf_pfsmp = ($qf_pfsmp == 1 ? 1 : 0);

	$qf_pfsms = htmlspecialchars(trim($_POST['pfsm']));
	$qf_pfsms = ($qf_pfsms == 2 ? 1 : 0);



//// candidatos independientes/////	
	$qf_ci1p = htmlspecialchars(trim($_POST['ci1']));
	$qf_ci1p = ($qf_ci1p == 1 ? 1 : 0);
	
	$qf_ci1s = htmlspecialchars(trim($_POST['ci1']));
	$qf_ci1s = ($qf_ci1s == 2 ? 1 : 0);
	
	$qf_ci2p = htmlspecialchars(trim($_POST['ci2']));
	$qf_ci2p = ($qf_ci2p == 1 ? 1 : 0);
	
	$qf_ci2s = htmlspecialchars(trim($_POST['ci2']));
	$qf_ci2s = ($qf_ci2s == 2 ? 1 : 0);
	
	$qf_ci3p = htmlspecialchars(trim($_POST['ci3']));
	$qf_ci3p = ($qf_ci3p == 1 ? 1 : 0);
	
	$qf_ci3s = htmlspecialchars(trim($_POST['ci3']));
	$qf_ci3s = ($qf_ci3s == 2 ? 1 : 0);
	
	$qf_ci4p = htmlspecialchars(trim($_POST['ci4']));
	$qf_ci4p = ($qf_ci4p == 1 ? 1 : 0);
	
	$qf_ci4s = htmlspecialchars(trim($_POST['ci4']));
	$qf_ci4s = ($qf_ci4s == 2 ? 1 : 0);
	
	$qf_prensa = htmlspecialchars(trim($_POST['qf_prensa']));
	$qf_prensa = ($qf_prensa != 1 ? 0 : 1);
	$qf_radio = htmlspecialchars(trim($_POST['qf_radio']));
	$qf_radio = ($qf_radio != 1 ? 0 : 1);
	$qf_tv = htmlspecialchars(trim($_POST['qf_tv']));
	$qf_tv = ($qf_tv != 1 ? 0 : 1);

	$observafin =htmlspecialchars(trim($_POST['observafin']));
	$observafin=str_replace("\n",' ',$observafin);

	$quorumfin =intval($qf_cp)+intval($qf_c1)+intval($qf_c2)+intval($qf_c3)+intval($qf_c4)+intval($qf_c5)+intval($qf_c6);
	$fecha_alta=date('d-m-Y');
	
	$movimiento=htmlspecialchars(trim($_POST['movimiento'])); 
	$tmpSQL="";

	if($movimiento=="EDITAR")
	{
		$tmpSQL="UPDATE sisesecd_fin set id_sesion=".$id_sesion.",fecha_inicio_final = '".$fechafinreal."', hora_fin_final= '".$horafinreal."',qf_cp=".$qf_cp.",qf_c1=".$qf_c1.",qf_c2=".$qf_c2.",qf_c3=".$qf_c3.",qf_c4=".$qf_c4.",qf_c5=".$qf_c5.",qf_c6=".$qf_c6.",qf_se=".$qf_sc.",qf_pan_p = ".$qf_panp.", qf_pan_s = ".$qf_pans.", qf_pri_p = ".$qf_prip.", qf_pri_s = ".$qf_pris.", qf_prd_p = ".$qf_prdp.", qf_prd_s = ".$qf_prds.", qf_pt_p = ".$qf_ptp.", qf_pt_s = ".$qf_pts.", qf_pvem_p = ".$qf_pvemp.", qf_pvem_s = ".$qf_pvems.", qf_pmc_p = ".$qf_pmcp.", qf_pmc_s = ".$qf_pmcs.", qf_elg_p = ".$qf_elgp.", qf_elg_s = ".$qf_elgs.", qf_pes_p=".$qf_pesp.", qf_pes_s=".$qf_pess.", qf_prsp_p=".$qf_prsp.",qf_prsp_s=".$qf_prss.", qf_morena_p=".$qf_morenap.", qf_morena_s=".$qf_morenas.",qf_pfsm_p=".$qf_pfsmp.", qf_pfsm_s=".$qf_pfsms.", qf_ci1_p=".$qf_ci1p.", qf_ci1_s=".$qf_ci1s.", qf_ci2_p=".$qf_ci2p.", qf_ci2_s=".$qf_ci2s.", qf_ci3_p=".$qf_ci3p.", qf_ci3_s=".$qf_ci3s.", qf_ci4_p=".$qf_ci4p.", pf_ci4_s=".$qf_ci4s.", qf_prensa = ".$qf_prensa.", qf_radio = ".$qf_radio.", qf_tv = ".$qf_tv.",quorumfin=".$quorumfin.",observafin='".$observafin."' WHERE id_sesion = ".$id_sesion;
	}
	else
	{
		$tmpSQL="INSERT INTO sisesecd_fin(id_sesion, fecha_inicio_final, hora_fin_final,qf_cp, qf_c1,qf_c2, qf_c3, qf_c4, qf_c5, qf_c6, qf_se, qf_pan_p, qf_pan_s, qf_pri_p, qf_pri_s, qf_prd_p, qf_prd_s, qf_pt_p, qf_pt_s, qf_pvem_p, qf_pvem_s, qf_pmc_p, qf_pmc_s, qf_elg_p, qf_elg_s, qf_pes_p, qf_pes_s, qf_prsp_p, qf_prsp_s, qf_morena_p, qf_morena_s, qf_pfsm_p, qf_pfsm_s, qf_ci1_p, qf_ci1_s, qf_ci2_p, qf_ci2_s, qf_ci3_p, qf_ci3_s, qf_ci4_p, pf_ci4_s, qf_prensa, qf_radio, qf_tv, quorumfin, observafin) values (".$id_sesion.", '".$fechafinreal."','".$horafinreal."',".$qf_cp.", ".$qf_c1.", ".$qf_c2.", ".$qf_c3.", ".$qf_c4.", ".$qf_c5.", ".$qf_c6.", ".$qf_sc.", ".$qf_panp.", ".$qf_pans.", ".$qf_prip.", ".$qf_pris.", ".$qf_prdp.", ".$qf_prds.", ".$qf_ptp.", ".$qf_pts.", ".$qf_pvemp.", ".$qf_pvems.", ".$qf_pmcp.", ".$qf_pmcs.", ".$qf_elgp.", ".$qf_elgs.", ".$qf_pesp.",".$qf_pess.",".$qf_prsp.",".$qf_prss.", ".$qf_morenap.",".$qf_morenas.",".$qf_pfsmp.",".$qf_pfsms.", ".$qf_ci1p.",".$qf_ci1s.",".$qf_ci2p.",".$qf_ci2s.",".$qf_ci3p.",".$qf_ci3s.",".$qf_ci4p.",".$qf_ci4s.",".$qf_prensa.", ".$qf_radio.", ".$qf_tv.", ".$quorumfin.",'".$observafin."');";
	
	$sql_insert="INSERT INTO sisesecd_estado_sesion VALUES(".$id_sesion.",".$id_distrito.",4,'FIN DE LA SESION','".$horafinreal."','','".$fecha_alta."');";
	//echo $sql_insert;
	sqlsrv_query($conn, $sql_insert);
	
	}

	//echo $tmpSQL;	
	if (sqlsrv_query($conn, $tmpSQL)== true) 
	{
		echo 'Datos guardados';
		
		include("bitacora.php");
		$accion="Conluyo sesion ".$id_distrito;
		bitacora($accion);	
		
		
		$sql_update="UPDATE sisesecd_sesiones SET con_fin=1 WHERE id_sesion=$id_sesion";
		if (sqlsrv_query($conn, $sql_update))
				{
				
							
			echo'<table width="166" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="156" align="center"><img src="images/ajax-loader.gif" width="160" height="24" /></td>
  </tr>
  <tr>
    <td align="center">ACTUALIZANDO</td>
  </tr>
</table>';
			echo'	<SCRIPT LANGUAGE="javascript">';
					
					echo' 	alert("El fin de la sesión se actualizó Exitosamente")';
					
					echo'	</SCRIPT>';
					echo'<SCRIPT LANGUAGE="javascript">';
	
					echo'location.href = "./grid_sesiones.php?nosesion='.$nosesion.'&tipo_sesion='.$tipo_sesion.'&desc_sesion='.$desc_sesion.'";';
					echo'	</SCRIPT>';
		

								
		}
		else{
			echo 'Se produjo un error al guardar historico. Intente nuevamente '.sqlsrv_errors();
		} 
	}
	else{
		echo 'Se produjo un error. Intente nuevamente '.sqlsrv_errors();
	} 
	
 }

else{
	$consulta ="";
	$cliente ="";

	if(isset($id_sesion)){
		
		$sql_count2="SELECT count(*) as cuantos2 FROM sisesecd_fin WHERE id_sesion =$_REQUEST[id_sesion]";
		$exec_count2 = sqlsrv_query($conn, $sql_count2);
		$row_count2 = sqlsrv_fetch_array($exec_count2);
		$cuantos2=0;
		$cuantos2=$row_count2[cuantos2];
		
		
		
		$sql_consulta="SELECT * FROM sisesecd_fin WHERE id_sesion =$_REQUEST[id_sesion]";
		
	//	echo $sql_consulta;
		$consulta = sqlsrv_query($conn, $sql_consulta);
		$cliente = sqlsrv_fetch_array($consulta);

	}
	if($cuantos2>0)
	{
		// ES ACUALIZACION
?>
<style>
	.tcAlert { color: orange; }
	.tcWarn { color: red; }
textarea{
	width:450px;
	height:120px;
	border:1px solid #ccc;
	padding:3px;
	color:black;
	font:12px Arial, sans-serif, Helvetica;
	}
</style>
<?
$sql_select = "select * from sisesecd_sesiones  where id_sesion=$id_sesion";
//echo $sql_select;
	$exec = sqlsrv_query($conn, $sql_select);
	$row = sqlsrv_fetch_array($exec);
	$nosesion=$row[nosesion];


?>
	
	<center>
		<div class="card mb-4">
	<div class="card-header">
     <b>Editar Reporte de Fin de la Sesión de los Consejos Distritales</b></br>
		<br><?php echo $encabezado; 	?>
    </div>	
	<form id="frmClienteActualizar" name="frmClienteActualizar" method="post" onsubmit="ActualizarInicio(); return false">
	<input type="hidden" name="movimiento" id="movimiento" value="EDITAR" />
    <input type="hidden" name="id_sesion" id="id_sesion" value="<?php echo $_REQUEST['id_sesion']; ?>" />

	<br/><br/>
  <input class="text" type="hidden" name="id_distrito" id="id_distrito" value="<?php echo $_SESSION['id_distrito']; ?>"/>
  </p>


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
<table style="width: 90%;">
<tr>
<td width="53%">
<label>Fecha de Termino<br /></label>
<input  type="text" id="fechafinreal"  name= "fechafinreal" value="<?php echo $cliente['fecha_inicio_final'];?>" />
</td>
<td width="47%">
    <label>Hora concluida<br />     
    </label>
   <input type="text" id="horafinreal" name="horafinreal" value="<?php echo $cliente['hora_fin_final']?>" />
</td>
</tr>
</table>
  <p></p>
 <?php 
//// me traigo los nombres de los integrantes////
$incremento=0;
$sql_integra = "select * from sisesecd_cat_funcionarios where id_sesion=$id_sesion and id_integrante in (1,2,3,4,5,6,7,8) and id_distrito=$id_distrito";
//echo $sql_select;
?>
<table style="width: 90%;" border="1" class="table table-bordered">
<tr bgcolor="#CCCCFF">
<td colspan="22" align="center"><strong>Asistencia a inicio de sesi&oacute;n de Consejo</strong></td>
</tr>
<?php
	$exec_int = sqlsrv_query($conn, $sql_integra);

	$salta=0;
	while($row_int = sqlsrv_fetch_array ($exec_int))
	{
		
	
	echo'<tr>';	
			
		if($row_int[id_integrante]==1)
		{
			
		echo'<td colspan="8"><strong>Nombre CP :</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
			echo'<td colspan="2">';
			if($cliente['qf_cp']=="1")
			{
			echo'<input type="checkbox" name="ck_cp" value="1" checked="checked">'; 
			}
			else
			{
			echo'<input type="checkbox" name="ck_cp" value="1" >';
			}
			echo'CP';
			echo'</td>';
		}
		
		if($row_int[id_integrante]==2)
		{
		echo '<td colspan="8"><strong>Nombre SC :</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		
				echo'<td colspan="2">';
				if($cliente['qf_se']=="1")
				{
				echo'<input type="checkbox" name="ck_sc" value="1" checked="checked">'; 
				}
				else
				{
				echo'<input type="checkbox" name="ck_sc" value="1" >';
				}
				echo'SC';
				echo'</td>';
		}

		if($row_int[id_integrante]==3)
		{
		echo'<td colspan="8"><strong> NombreC1 :</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['qf_c1']=="1")
				{
				echo'<input type="checkbox" name="ck_c1" value="1" checked="checked">'; 
				}
				else
				{
				echo'<input type="checkbox" name="ck_c1" value="1" >';
				}
				echo'C1';
				echo'</td>';
		}
		
		if($row_int[id_integrante]==4)
		{
		echo '<td colspan="8"><strong>NombreC2 :</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['qf_c2']=="1")
				{
				echo'<input type="checkbox" name="ck_c2" value="1" checked="checked">'; 
				}
				else
				{
				echo'<input type="checkbox" name="ck_c2" value="1" >';
				}
				echo'C2';
				echo'</td>';
		}
		
		if($row_int[id_integrante]==5)
		{
		echo '<td colspan="8"><strong> NombreC3:</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['qf_c3']=="1")
				{
				echo'<input type="checkbox" name="ck_c3" value="1" checked="checked">'; 
				}
				else
				{
				echo'<input type="checkbox" name="ck_c3" value="1" >';
				}
				echo'C3';
				echo'</td>';
		}

		if($row_int[id_integrante]==6)
		{
		echo'<td colspan="8"><strong>NombreC4:</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['qf_c4']=="1")
				{
				echo'<input type="checkbox" name="ck_c4" value="1" checked="checked">'; 
				}
				else
				{
				echo'<input type="checkbox" name="ck_c4" value="1" >';
				}
				echo'C4';
				echo'</td>';
		}
		if($row_int[id_integrante]==7)
		{
		echo '<td colspan="8"><strong>NombreC5:</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['qf_c5']=="1")
				{
				echo'<input type="checkbox" name="ck_c5" value="1" checked="checked">'; 
				}
				else
				{
				echo'<input type="checkbox" name="ck_c5" value="1" >';
				}
				echo'C5';
				echo'</td>';
		}
		if($row_int[id_integrante]==8)
		{
		echo '<td colspan="8"><strong> NombreC6:</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['qf_c6']=="1")
				{
				echo'<input type="checkbox" name="ck_c6" value="1" checked="checked">'; 
				}
				else
				{
				echo'<input type="checkbox" name="ck_c6" value="1" >';
				}
				echo'C6';
				echo'</td>';
		}
	//echo'</tr>';
	
	}// cierro while
echo'</table>';
  ?>

 
	<input type="hidden" value="<?php  echo $_REQUEST["page"] ?>" id="page" name="page" />
<br />
<table style="width: 95%;" border=1 class="table table-bordered">
<tr>
  <td colspan="12" align="center" bgcolor="#CCCCFF"><strong>Asistencia al fin de la Sesión de Representantes de Partidos Politicos </strong></td></tr>

<tr>
	<td  colspan=2 align="center">PAN</td>
	<td  colspan=2 align="center">PRI</td>
	<td  colspan=2 align="center">PRD</td>
	<td  colspan=2 align="center">PVEM</td>
	<td  colspan=2 align="center">PT</td>
	<td colspan="2" align="center">PMC</td>
</tr>

<tr>
<td width="0%">
<input type="radio" name="pan" value="1" <?php if($cliente['qf_pan_p']=="1") echo "checked=\"checked\""?> ><br>P
</td>
<td width="0%">
<input type="radio" name="pan" value="2" <?php if($cliente['qf_pan_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td width="0%">
<input type="radio" name="pri" value="1" <?php if($cliente['qf_pri_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="pri" value="2" <?php if($cliente['qf_pri_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td width="0%">
<input type="radio" name="prd" value="1" <?php if($cliente['qf_prd_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="prd" value="2" <?php if($cliente['qf_prd_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td width="0%">
<input type="radio" name="pvem" value="1" <?php if($cliente['qf_pvem_p']=="1") echo "checked=\"checked\""?>><br> P
</td>
<td width="0%">
<input type="radio" name="pvem" value="2" <?php if($cliente['qf_pvem_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td width="0%">
<input type="radio" name="pt" value="1" <?php if($cliente['qf_pt_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="pt" value="2" <?php if($cliente['qf_pt_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td width="0%">
<input type="radio" name="pmc" value="1" <?php if($cliente['qf_pmc_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="pmc" value="2" <?php if($cliente['qf_pmc_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
</tr>
<tr>

<td colspan="2" align="center">MORENA</td>
<td colspan="2" align="center">PES</td>
<td colspan="2" align="center">RSP</td>
<td colspan="2" align="center">FM</td>
	<td colspan="2" align="center">ELIGE</td>
</tr>
<tr>
<td>
<input type="radio" name="morena" value="1" <?php if($cliente['qf_morena_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td >
<input type="radio" name="morena" value="2" <?php if($cliente['qf_morena_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
	
<td>
<input type="radio" name="pes" value="1" <?php if($cliente['qf_pes_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td >
<input type="radio" name="pes" value="2" <?php if($cliente['qf_pes_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td>
<input type="radio" name="prsp" value="1" <?php if($cliente['qf_prsp_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="8%">
<input type="radio" name="prsp" value="2" <?php if($cliente['qf_prsp_s']=="1") echo "checked=\"checked\""?>><br>S
</td>

<td width="11%">
<input type="radio" name="pfsm" value="1" <?php if($cliente['qf_pfsm_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="11%">
<input type="radio" name="pfsm" value="2" <?php if($cliente['qf_pfsm_s']=="1") echo "checked=\"checked\""?>><br>S
</td>

	<td>
<input type="radio" name="elg" value="1" <?php if($cliente['qf_elg_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td>
<input type="radio" name="elg" value="2" <?php if($cliente['qf_elg_s']=="1") echo "checked=\"checked\""?>><br>S
</td>

<tr><td  colspan=12 align="center" bgcolor="#CCCCFF"><strong>Asistencia a Sesión de Candidaturas Sin Partido</strong></td></tr>
<tr align="center">
<td colspan="2">CI - 1</td>
<td colspan="2">CI - 2</td>
<td colspan="2">CI - 3</td>
<td colspan="2">CI - 4</td>
</tr>
<tr align="center">
<td>
<input type="radio" name="ci1" value="1" <?php if($cliente['qf_ci1_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="9%">
<input type="radio" name="ci1" value="2" <?php if($cliente['qf_ci1_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td>
<input type="radio" name="ci2" value="1" <?php if($cliente['qf_ci2_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="11%">
<input type="radio" name="ci2" value="2" <?php if($cliente['qf_ci2_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td>
<input type="radio" name="ci3" value="1" <?php if($cliente['qf_ci3_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="11%">
<input type="radio" name="ci3" value="2" <?php if($cliente['qf_ci3_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td>
<input type="radio" name="ci4" value="1" <?php if($cliente['qf_ci4_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="12%">
<input type="radio" name="ci4" value="2" <?php if($cliente['qf_ci4_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
</tr>
</table>
</p>
<table style="width: 90%;">
<tr><td  colspan=3 align="center" bgcolor="#CCCCFF"><strong>Asistencia a Sesi&oacute;n de los Medios de comunicaci&oacute;n</strong></td></tr>
<tr>
<td>
<input type="checkbox" name="qf_prensa" value="1" <?php if($cliente['qf_prensa']=="1") echo "checked=\"checked\""?>> Prensa
</td>
<td>
<input type="checkbox" name="qf_radio" value="1" <?php if($cliente['qf_radio']=="1") echo "checked=\"checked\""?>> Radio
</td>
<td>
<input type="checkbox" name="qf_tv" value="1" <?php if($cliente['qf_tv']=="1") echo "checked=\"checked\""?>> Television
</td>
</tr>
</table>
  </p>

  <p>
    <label>Observaciones del Fin de Sesi&oacute;n<br />
    <textarea type="text" cols="25" rows="5" name="observafin" id="observafin" onkeypress='return validar_texto(event)' onpaste='return false;'><?php echo stripslashes($cliente['observafin']);?> </textarea>
	<span id="theCounter"> </span>
    </label>
  </p>
  <p>&nbsp;</p>
		<input type="submit" class="btn btn-primary" name="submit" id="button" value="Enviar" />
		<p></p>
	  <input type="button" class="btn btn-default" name="cancelar" id="cancelar" value="Cancelar" onclick="history.back ()" />
	
	</form>
	<?php
	}
	else
	{		
		
?>
				</center>
<br>

<center>
				
		<div class="card mb-4">
	<div class="card-header">
		Reporte de Fin de la Sesión de los Consejos Distritales</br>
		<br><?php echo $encabezado; 	?>
    </div>
			
<form id="frmClienteNuevo" name="frmClienteNuevo" method="post"  onsubmit="ActualizarInicio(); return false">
 </br>
 <p>
 
     <input class="text" type="hidden" name="id_distrito" id="id_distrito" value="<?php echo $_SESSION['id_distrito']; ?>"/>
     <input type="hidden" name="id_sesion" id="id_sesion" value="<?php echo $_REQUEST['id_sesion'];?>" />
     <input type="hidden" name="movimiento" id="movimiento" value="NUEVO" />
   </label>
   </br>

 </p>
 <br />
   
   <label> Fecha de Termino </label>
   <input type="text" id="fechafinreal"  name="fechafinreal" value="<?php echo date("Y-m-j");?>" />
   <br/>
   <label>Hora concluida</label>
   
   <input type="text" id="horafinreal" name="horafinreal" value ="<?php echo date("H:i");?>"/> 
   
   <br />
	<br />
   <?php 
//// me traigo los nombres de los integrantes////
$incremento=0;

$sql_integra = "select * from sisesecd_cat_funcionarios where id_sesion=$id_sesion and id_integrante in (1,2,3,4,5,6,7,8) and id_distrito=$id_distrito";
//echo $sql_select;

echo'<table style="width: 90%;" border=1 class="table table-bordered">';
echo'<tr bgcolor="#CCCCFF">';
echo'<td colspan=10 align="center" ><strong>Asistencia al fin de sesi&oacute;n de Consejo</strong></td>';
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
		echo'<input type="checkbox" name="ck_cp" value="1"> CP';
	    echo'</td>';
		}
		if($row_int[id_integrante]==2)
		{
		echo '<td colspan="8"><strong>Nombre SC :</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo '<td colspan="2"><input type="checkbox" name="ck_sc" value="1"> SC';
		echo '</td>';
		}
	//echo'</tr>';	
	
	//echo'<tr>';
		if($row_int[id_integrante]==3)
		{
		echo'<td colspan="8"><strong> NombreC1 :</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo'<td colspan="2">';
		echo'<input type="checkbox" name="ck_c1" value="1"> C1';
	    echo'</td>';
		}
		if($row_int[id_integrante]==4)
		{
		echo '<td colspan="8"><strong>NombreC2:</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo '<td colspan="2"><input type="checkbox" name="ck_c2" value="1"> C2';
		echo '</td>';
		}
		if($row_int[id_integrante]==5)
		{
		echo '<td colspan="8"><strong> NombreC3:</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo '<td colspan="2"><input type="checkbox" name="ck_c3" value="1" /> C3</td>';
		}
	//echo'</tr>';
	//echo'<tr>';
		if($row_int[id_integrante]==6)
		{
		echo'<td colspan="8"><strong>NombreC4:</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo'<td colspan="2">';
		echo'<input type="checkbox" name="ck_c4" value="1"> C4';
	    echo'</td>';
		}
		if($row_int[id_integrante]==7)
		{
		echo '<td colspan="8"><strong>NombreC5:</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo '<td colspan="2"><input type="checkbox" name="ck_c5" value="1"> C5';
		echo '</td>';
		}
		if($row_int[id_integrante]==8)
		{
		echo '<td colspan="8"><strong>NombreC6:</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo '<td colspan="2"><input type="checkbox" name="ck_c6" value="1" /> C6</td>';
		}
	//echo'</tr>';
	
	}// cierro while
echo'</table>';
  ?>
   </br>
   <input type="hidden" value="<?php echo $_REQUEST["page"]?>" id="page" name="page" />
   
	<p>&nbsp;</p>
 <table style="width: 90%;" border="1" class="table table-bordered">
   <tr>
    <td colspan=12 align="center" bgcolor="#CCCCFF"><strong>Asistencia al fin de la Sesi&oacute;n de Partidos</strong></td></tr>
<tr>
<tr>
<td colspan=2 align="center">PAN</td>
<td colspan=2 align="center">PRI</td>
<td colspan=2 align="center">PRD</td>
<td  colspan=2 align="center">PVEM</td>
<td  colspan=2 align="center">PT</td>
<td colspan="2" align="center">PMC</td>
</tr>
 
<tr align="center">
<td width="0%" height="42">
<input type="radio" name="pan" value="1" /> <br>P
</td>
<td width="0%">
<input type="radio" name="pan" value="2" /><br>S
</td>
<td width="0%">
<input type="radio" name="pri" value="1" /><br>P
</td>
<td width="0%">
<input type="radio" name="pri" value="2" /><br>S
</td>
<td width="0%">
<input type="radio" name="prd" value="1" /><br>P
</td>
<td width="0%">
<input type="radio" name="prd" value="2" /><br>S
</td>
<td width="0%">
<input type="radio" name="pvem" value="1" /><br>P
</td>
<td width="0%">
<input type="radio" name="pvem" value="2" /><br>S
</td>
<td width="0%">
<input type="radio" name="pt" value="1" /><br>P
</td>
<td width="0%">
<input type="radio" name="pt" value="2" /><br>S
</td>
<td height="0%">
<input type="radio" name="pmc" value="1"  /><br>P
</td>
<td width="0%">
<input type="radio" name="pmc" value="2"  /><br>S
</td>
</tr>

<tr>

<td colspan="2" align="center">MORENA</td>

<td colspan="2" align="center">PES</td>
<td colspan="2" align="center">RSP</td>
<td colspan="2" align="center">FM</td>
<td colspan="2" align="center">ELIGE</td>	
</tr>
	 
<tr align="center">
<td>
<input type="radio" name="morena" value="1"  /><br>P
</td>
<td width="0%">
<input type="radio" name="morena" value="2"  /><br>S
</td>

<td>
<input type="radio" name="pes" value="1"  /><br>P
</td>
<td width="0%">
<input type="radio" name="pes" value="2"  /><br>S
</td>
<td>
<input type="radio" name="prsp" value="1"  /><br>P
</td>
<td width="0%">
<input type="radio" name="prsp" value="2"  /><br>S
</td>
<td width="0%">
<input type="radio" name="pfsm" value="1" ><br>P
</td>
<td width="0%">
<input type="radio" name="pfsm" value="2" ><br>S
</td>
	
<td>
<input type="radio" name="elg" value="1"  /><br>P
</td>
<td width="0%">
<input type="radio" name="elg" value="2"  /><br>S
</td>
	</tr>
<tr>
  <td  colspan=12 align="center" bgcolor="#CCCCFF"><strong>Asistencia a Sesión de Candidaturas Sin Partido</strong></td></tr>
<tr align="center">
<td colspan="2">CI - 1 </td>
<td colspan="2">CI - 2 </td>
<td colspan="2">CI - 3 </td>
<td colspan="2">CI - 4 </td>
</tr>
<tr align="center">
<td>
<input type="radio" name="ci1" value="1"  /><br>P
</td>
<td width="9%">
<input type="radio" name="ci1" value="2"  /><br>S
</td>
<td>
<input type="radio" name="ci2" value="1"  /><br>P
</td>
<td width="9%">
<input type="radio" name="ci2" value="2"  /><br>S
</td>
<td>
<input type="radio" name="ci3" value="1"  /><br>P
</td>
<td width="11%">
<input type="radio" name="ci3" value="2"  /><br>S
</td>
<td>
<input type="radio" name="ci4" value="1"  /><br>P
</td>
<td width="11%">
<input type="radio" name="ci4" value="2"  /><br>S
</td>
</tr>
</table>
<br />
<table style="width: 90%;" class="table table-bordered">
  <tr><td colspan=3 align="center" bgcolor="#CCCCFF"><strong>Asistencia a Sesi&oacute;n de los Medios de Comunicaci&oacute;n</strong></td></tr>
<tr>
<td>
<input type="checkbox" name="qf_prensa" value="1"> Prensa
</td>
<td>
<input type="checkbox" name="qf_radio" value="1"> Radio
</td>
<td>
<input type="checkbox" name="qf_tv" value="1"> Television
</td>
</tr>
</table>
  </p>

  <p>
    <label>Observaciones del Fin de Sesi&oacute;n<br />
    <textarea type="text" cols="45" rows="5" name="observafin" id="observafin" onkeypress='return validar_texto(event)' onpaste='return false;'></textarea>
    <br />
    </label>
<p>&nbsp;</p>
    <input type="submit" class="btn btn-primary" name="submit" id="button" value="Enviar" />
    <p>&nbsp;</p>
    <input type="button" class="btn btn-default" name="cancelar" id="cancelar" value="Cancelar" onclick="history.back()" />
  </p>
</form>
		<div id="log">
		</div>
<?php	
	}
}
?>
</center>
<script type="text/javascript">
		function numeros(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[0-9:]/;
    //ä,ë,ï,ö,ü
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
	$(function() {
            $('#horafinreal').timepicker({
                'timeFormat': 'HH:mm'
            });
        });

	$(function() {
            //$("#fecha").datepicker();
            $("#fechafinreal").datepicker({ dateFormat: 'dd/mm/yy' });
        });
</script>
<footer class="py-4 bg-light mt-auto">
    <?php include('footer.php'); ?>
   </footer>

</body>
</html>