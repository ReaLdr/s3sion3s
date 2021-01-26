<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
$nosesion=$_GET['nosesion'];
$id_sesion=$_GET['id_sesion'];
$id_orden=$_GET['id_orden'];
// echo $nosesion=$_GET['nosesion'];
// echo " - ";
// echo $id_sesion=$_GET['id_sesion'];
// echo " - ";
// echo $id_orden=$_GET['id_orden'];



//echo 'Bienvenido, ';
if (isset($_SESSION['user'])) {

$name= $_SESSION['transaccion'];
$grup=$_SESSION['grupo'];
$id_distrito=$_SESSION['id_distrito'];

}
else
{
echo'alert("Debe iniciar una sesion")';
	echo'<SCRIPT LANGUAGE="javascript">';
	echo'location.href = "index.php";';
	echo'</SCRIPT>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">



<title>.: SISESECD 2018 :.</title>
</head>

  <script>
function validar_texto(a) {
    tecl = (document.all) ? a.keyCode : a.which;
    if (tecl==8) return true;
//    patro =/[a-zA-Záéíóúäëïöü0ñÑ.-9\s]/;
	patro =/[a-z A-Z áéíóúäëïöü0ñÑ 0-9\-\.\?\,\"\@\:\()\;\*\+&%\$#_]/;
    t = String.fromCharCode(tecl);
    return patro.test(t);
}

</script>
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

  <?php include('header.php');?>
<body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid">
	            <h1 class="mt-4"><img src="images/logo-header.png"></h1>
	<p>&nbsp;</p>

<div class="top-menu">
<table style="width: 95%;">
  <tr>
    <td width="396" height="25" align="left" class="well">Usuario: <?php echo $name; ?></td>
    <td width="797" align="left" class="well">Consejo Distrital: <?php echo $id_distrito; ?></td>

    <td width="395" align="right"><a href="logout.php"><p class="btn btn-default">Cerrar Sesion</p></a></td>
  </tr>
</table>

	  </div>
<!--tabla para todos las pantallas --><?php

$variable= $_REQUEST["page"];
//echo "GET PAGE: ".$variable."...";
//echo "GET ID ".$_REQUEST['idsesion']."...";


$movimiento = htmlspecialchars(trim($_POST['movimiento']));

// Consigo datos a desplegar solo de muestra
$encabezado = "-ERROR DE LECTURA-";

require('functions.php');
include 'config_open_db.php';
include 'arreglos.php';


if(isset($_POST['submit'])){

	$id_orden=$_REQUEST[id_orden];
	$id_sesion=$_REQUEST[id_sesion];
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
	$inter_pfsmp = ($inter_pfsmp == 1 ? 1 : 0);

	$inter_pfsms = htmlspecialchars(trim($_POST['pfsm']));
	$inter_pfsms = ($inter_pfsms == 2 ? 1 : 0);


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

	$punto=htmlspecialchars(trim($_POST['numintervencion']));

	if($punto == "" || $punto == 0){
		echo'<SCRIPT LANGUAGE="javascript">';
		echo'alert("Seleccione el número de intervención")';
		echo'</SCRIPT>';
		echo'<SCRIPT LANGUAGE="javascript">';
		echo'history.go(-1)';
		echo'	</SCRIPT>';
		exit;
	}

//	echo"nuevo campo ". $punto;

	$tmpSQL="";

		if($movimiento=="NUEVO")
		{

		$id_orden=$_POST[id_orden];
		$id_sesion=$_POST[id_sesion];

			//$tmpSQL="INSERT INTO sisesecd_intervenciones(id_sesion,id_distrito,id_orden, tipo_intervencion, inter_cp, inter_c1,inter_c2, inter_c3, inter_c4, inter_c5, inter_c6, inter_se, inter_panp, inter_pans, inter_prip, inter_pris, inter_prdp, inter_prds, inter_ptp, inter_pts, inter_pvemp, inter_pvems, inter_pmcp, inter_pmcs, inter_pnap, inter_pnas,inter_pesp, inter_pess, inter_php, inter_phs, inter_morenap, inter_morenas, inter_ci1p, inter_ci1s, inter_ci2p, inter_ci2s, inter_ci3p, inter_ci3s, inter_ci4p, inter_ci4s, intervencion,replica) values (".$id_sesion.",".$id_distrito.", ".$id_orden.", 0, ".$inter_cp.", ".$inter_c1.", ".$inter_c2.",  ".$inter_c3.", ".$inter_c4.", ".$inter_c5.", ".$inter_c6.", ".$inter_se.", ".$inter_panp.", ".$inter_pans.", ".$inter_prip.", ".$inter_pris.", ".$inter_prdp.", ".$inter_prds.", ".$inter_ptp.", ".$inter_pts.", ".$inter_pvemp.", ".$inter_pvems.", ".$inter_pmcp.", ".$inter_pmcs.", ".$inter_pnap.", ".$inter_pnas.",".$inter_pesp.", ".$inter_pess.", ".$inter_php.",".$inter_phs.",".$inter_morenap.",".$inter_morenas.",".$inter_ci1p.", ".$inter_ci1s.", ".$inter_ci2p.", ".$inter_ci2s.", ".$inter_ci3p.", ".$inter_ci3s.", ".$inter_ci4p.", ".$inter_ci4s.",'".$intervencion."','".$replica."');";

			$tmpSQL="INSERT INTO sisesecd_intervenciones(id_sesion,id_distrito,id_orden, tipo_intervencion, inter_cp, inter_c1,inter_c2, inter_c3, inter_c4, inter_c5, inter_c6, inter_se, inter_panp, inter_pans, inter_prip, inter_pris, inter_prdp, inter_prds, inter_ptp, inter_pts, inter_pvemp, inter_pvems, inter_pmcp, inter_pmcs, inter_pelgp, inter_pelgs, inter_pesp, inter_pess, inter_prspp, inter_prsps, inter_morenap, inter_morenas, inter_pfsmp, inter_pfsms, inter_ci1p, inter_ci1s, inter_ci2p, inter_ci2s, inter_ci3p, inter_ci3s, inter_ci4p, inter_ci4s, intervencion,replica, punto) values (".$id_sesion.",".$id_distrito.", ".$id_orden.", 0, ".$inter_cp.", ".$inter_c1.", ".$inter_c2.",  ".$inter_c3.", ".$inter_c4.", ".$inter_c5.", ".$inter_c6.", ".$inter_se.", ".$inter_panp.", ".$inter_pans.", ".$inter_prip.", ".$inter_pris.", ".$inter_prdp.", ".$inter_prds.", ".$inter_ptp.", ".$inter_pts.", ".$inter_pvemp.", ".$inter_pvems.", ".$inter_pmcp.", ".$inter_pmcs.", ".$inter_pelgp.",".$inter_pelgs.",".$inter_pesp.", ".$inter_pess.", ".$inter_prspp.",".$inter_prsps.", ".$inter_morenap.",".$inter_morenas.",   ".$inter_pfsmp.",".$inter_pfsms.", ".$inter_ci1p.", ".$inter_ci1s.", ".$inter_ci2p.", ".$inter_ci2s.", ".$inter_ci3p.", ".$inter_ci3s.", ".$inter_ci4p.", ".$inter_ci4s.",'".$intervencion."','".$replica."',".$punto.");";



		}

		$tmpSQL=str_replace("\n","",$tmpSQL);
		$tmpSQL=str_replace("\r","",$tmpSQL);

//echo $tmpSQL;
//exit;
	//}


	if (sqlsrv_query($conn,$tmpSQL)== true){
		//echo 'Datos guardados';
		include("bitacora.php");
		$accion="Nuevo Intervencion ".$id_orden;
		bitacora($accion);

		$sql_update="UPDATE sisesecd_sesiones SET con_intervencion = 1 WHERE id_sesion=$id_sesion;";

		if (sqlsrv_query($conn,$sql_update)== true){

					echo'<SCRIPT LANGUAGE="javascript">';
					echo'alert("La Intervención se guardó Exitosamente")';
					echo'</SCRIPT>';
					echo'<SCRIPT LANGUAGE="javascript">';
					echo'history.go(-2)
					 history.back ()';
					echo'	</SCRIPT>';
		}
		else{
		echo 'Se produjo un error al guardar historico. Intente nuevamente ';//.ifx_error();
		}
	}
	else{
		echo 'Se produjo un error. Intente nuevamente '.sqlsrv_errors();
	}
//}else{
//	$consulta ="";
//	$cliente ="";

} //cierra e if del submit

if(isset($_GET['id_sesion']))
{

	$tmpSesion= "SELECT tipo_sesion,desc_sesion,nosesion,CAST(desc_punto as CHAR(2084)) as desc_punto,punto FROM sisesecd_sesiones,sisesecd_ordendia WHERE sisesecd_sesiones.id_sesion=sisesecd_ordendia.id_sesion and sisesecd_sesiones.id_sesion =".$id_sesion." and id_orden=".$id_orden.";";

	$consultaSesion = sqlsrv_query($conn,$tmpSesion);


	//if ($consultaSesion){
	//if (ifx_affected_rows($consultaSesion)>0){
		if (sqlsrv_has_rows($consultaSesion)){

		$registro = sqlsrv_fetch_array($consultaSesion);
		$typesess=$registro['tipo_sesion'];
		$desc=$registro['desc_sesion'];
		$nosesion=$registro['nosesion'];
		$decspunto=$registro['desc_punto'];
		$srt=$decspunto;
		eval("\$srt = \"$srt\";");

//$encabezado = "<b>".$nom_sesion[$nosesion]." Sesión ".$tipo_ses[$typesess]." de los Consejos Distritales 0".$desc."<b><br/> Punto:".$registro['punto']."".utf8_encode($srt).".";

  $encabezado = "<b>".$nom_sesion[$nosesion]." Sesión ".$tipo_ses[$typesess]." de los Consejos Distritales 0".$desc."<b><br/> Punto:".$registro['punto']."".utf8_encode($srt).".";

	}
	else{
		echo 'Se produjo un error. No se encontraron datos de la Sesion Distrital ';
		///////////////////
		echo "--- ".$tmpSesion;

			if( ($errors = sqlsrv_errors() ) != null) {
		        foreach( $errors as $error ) {
		            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
		            echo "code: ".$error[ 'code']."<br />";
		            echo "message: ".$error[ 'message']."<br />";
		        }
		    }
		//.ifx_error();
		return;
	}
}

?>
</br>
<center>
	<div class="card mb-4">
	<div class="card-header">
     <b> Nuevo Reporte de Intervención de la  <br><?php echo $encabezado; ?></b>

    </div>
		</br>
<form id="frmClienteNuevo" name="frmClienteNuevo" method="post"  onsubmit="ActualizarIncidente(); return false">
  <p>

<input class="text" type="hidden" name="id_distrito" id="id_distrito" value="<?php echo $_SESSION['id_distrito']; ?>"/>
<input type="hidden" name="id_sesion" id="id_sesion" value="<?php echo $_REQUEST['id_sesion'];?>" />
<input type="hidden" name="id_orden" id="id_orden" value="<?php echo $_REQUEST['id_orden']; ?>" />
 <input type="hidden" name="movimiento" id="movimiento" value="NUEVO" />
      <input class="text" type="hidden" name="id_distrito" id="id_distrito" value="<?php echo $_SESSION['id_distrito']; ?>"/>

    <br />
	<br />

  <?php
 $sql_integra = "select * from sisesecd_cat_funcionarios where id_sesion=$id_sesion and id_integrante in (1,2,3,4,5,6,7,8) and id_distrito=$id_distrito";

	  //echo $sql_integra;

echo'<table style="width: 90%;" border ="1">';
echo'<tr bgcolor="#CCCCFF">';
echo'<td colspan=10 align="center" ><strong>Consejeros Involucrados</strong></td>';
echo'</tr>';

	$exec_int = sqlsrv_query($conn, $sql_integra);

	$salta=0;
	while($row_int = sqlsrv_fetch_array($exec_int))
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
		echo'<td colspan="8"><strong> NombreC1: </strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo'<td colspan="2">';
		echo'<input type="checkbox" name="ck_c1" value="1"> C1';
	    echo'</td>';
		}
		if($row_int[id_integrante]==4)
		{
		echo '<td colspan="8"><strong>NombreC2: </strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo '<td colspan="2"><input type="checkbox" name="ck_c2" value="1"> C2';
		echo '</td>';
		}
		if($row_int[id_integrante]==5)
		{
		echo '<td colspan="8"><strong> NombreC3: </strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo '<td colspan="2"><input type="checkbox" name="ck_c3" value="1" /> C3</td>';
		}
	//echo'</tr>';
	//echo'<tr>';
		if($row_int[id_integrante]==6)
		{
		echo'<td colspan="8"><strong>NombreC4: </strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo'<td colspan="2">';
		echo'<input type="checkbox" name="ck_c4" value="1"> C4';
	    echo'</td>';
		}
		if($row_int[id_integrante]==7)
		{
		echo '<td colspan="8"><strong>NombreC5: </strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo '<td colspan="2"><input type="checkbox" name="ck_c5" value="1"> C5';
		echo '</td>';
		}
		if($row_int[id_integrante]==8)
		{
		echo '<td colspan="8"><strong>NombreC6: </strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo '<td colspan="2"><input type="checkbox" name="ck_c6" value="1" /> C6</td>';
		}
	//echo'</tr>';

	}// cierro while
echo'</table>';
?>



  <p>
<input type="hidden" value="<?php  echo $_REQUEST["page"] ?>" id="page" name="page" />
  </p>
  <table style="width: 90%;" border="1">
    <tr>
      <td colspan="12" align="center" bgcolor="#CCCCFF"><strong>Partidos Políticos Involucrados</strong></td>
    </tr>

    <tr>
      <td  colspan="2" align="center">PAN</td>
      <td  colspan="2" align="center">PRI</td>
      <td  colspan="2" align="center">PRD</td>
      <td  colspan="2" align="center">PVEM</td>
      <td  colspan="2" align="center">PT</td>
	 <td colspan="2" align="center">PMC</td>
    </tr>
    <tr>
      <td width="0%"><input type="radio" name="pan" value="1" />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="pan" value="2" />
        <br />
        S </td>
      <td width="0%"><input type="radio" name="pri" value="1"/>
        <br />
        P </td>
      <td width="0%"><input type="radio" name="pri" value="2" />
        <br />
        S </td>
      <td width="0%"><input type="radio" name="prd" value="1" />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="prd" value="2"/>
        <br />
        S </td>
        <td width="0%"><input type="radio" name="pvem" value="1" />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="pvem" value="2"/>
        <br />
        S </td>
      <td width="0%"><input type="radio" name="pt" value="1"  />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="pt" value="2"  />
        <br />
        S </td>
        <td width="0%"><input type="radio" name="pmc" value="1"  />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="pmc" value="2"  />
        <br />
        S </td>
    </tr>
    <tr>
<td colspan="2" align="center">MORENA</td>
<td colspan="2" align="center">PES</td>
<td colspan="2" align="center">RSP</td>
<td colspan="2" align="center">FSM</td>
<!--12/01/2021: SE CAMBIA PRELACIÓN -->
<td colspan="2" align="center">ELIGE</td>
    </tr>

    <tr>
        <td><input type="radio" name="morena" value="1"  />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="morena" value="2" />
        <br />
        S </td>

 <td><input type="radio" name="pes" value="1" />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="pes" value="2"  />
        <br />
        S </td>
      <td><input type="radio" name="prsp" value="1" />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="prsp" value="2" />
        <br />
        S </td>
        <td><input type="radio" name="pfsm" value="1" />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="pfsm" value="2" />
        <br />
        S </td>
<!--12/01/2021: SE CAMBIA PRELACIÓN -->
	<td><input type="radio" name="elgs" value="1" />
        <br />
        P </td>
      <td width="0%"><input type="radio" name="elgs" value="2"/>
        <br />
        S </td>
    </tr>

    <tr>
		<td  colspan="12" align="center" bgcolor="#CCCCFF"><strong> Candidaturas Sin Partido</strong></td>
    </tr>
    <tr align="center">
  		<td colspan="2">CI-1</td>
      <td colspan="2">CI-2</td>
      <td colspan="2">CI-3</td>
      <td colspan="2">CI- 4</td>
    </tr>
    <tr align="center">
<td><input type="radio" name="ci1" value="1"  />
    <br />
    P </td>
    <td width="11%"><input type="radio" name="ci1" value="2" />
    <br />
    S </td>

    <td><input type="radio" name="ci2" value="1" />
    <br />
    P </td>
    <td width="11%"><input type="radio" name="ci2" value="2"  />
    <br />
    S </td>
    <td><input type="radio" name="ci3" value="1"  />
    <br />
    P </td>
    <td width="10%"><input type="radio" name="ci3" value="2"  />
    <br />
    S </td>
     <td><input type="radio" name="ci4" value="1"  />
    <br />
    P </td>
    <td width="12%"><input type="radio" name="ci4" value="2" />
    <br />
    S </td>
    </tr>

 <p>
	 	</table>



<table  style="width: 90%;" border="0">
	   <tr >
      <td  colspan="10" align="center" bgcolor="#CCCCFF"><strong> Detalle de las Intervenciones</strong></td>
    </tr>
		 </br>

	<tr>
		 <td>N&uacute;mero de Intervenci&oacute;n<br />	</td>
		<?php

		$sele="select count(punto) as cuantos  from sisesecd_intervenciones where id_sesion=$id_sesion and id_orden=$id_orden";
	  // echo $sele;

	 $r_validar=sqlsrv_query($conn, $sele);

 $contar=sqlsrv_fetch_array($r_validar);
 $cuantos=$contar[cuantos];

	   if($cuantos == 0)
	   {
		  echo"<td><select class='form-control'  name='numintervencion' size='1' id='numintervencion'>";
		  echo"<option value=0 selected='selected'> Seleccione una opción</option>";
          echo"<option value='1'> Primera </option>";
		  echo"<option value='2'> Segunda </option>";
		  echo"<option value='3'> Tercera </option>";
		  echo"<option value='4'> Cuarta </option>";
		  echo"<option value='5'> Quinta </option>";
		  echo"<option value='6'> Sexta </option>";
          echo"</select>";
	   }

	   else
	   {


$array_selects[0] = "<option value='1'>Primera</option>";
$array_selects[1] = "<option value='2'>Segunda</option>";
$array_selects[2] = "<option value='3'>Tercera</option>";
$array_selects[3] = "<option value='4'>Cuarta</option>";
$array_selects[4] = "<option value='5'>Quinta</option>";
$array_selects[5] = "<option value='6'>Sexta</option>";


		   echo"<td><select class='form-control'  name='numintervencion' size='1' id='numintervencion'>";

        echo "  $array_selects[$cuantos] ";

        	echo"</select>";

	   }

		?>



		</td>
		 <br>
		</tr>
 <p>

	<tr>
    <td>Descripci&oacute;n del evento<br />
    <textarea name="intervencion" cols="45" rows="5" id="intervencion" onkeypress="return validar_texto(event)"></textarea>
	</td>
  		</tr>
	</br>

  <tr>
    <td>Réplica <br />
    <textarea name="replica" cols="45" rows="5" id="replica" onkeypress="return validar_texto(event)"></textarea>
    </td>
	  </tr>
  </p>

	</table>
		<p>&nbsp;</p>
	<?php
	   if($cuantos ==6)
		   {
		   echo "<h6>NO puedes ingresar más Intervenciónes </h6>";
		   "</br>";
		   "</br>";

		   echo "<input class='btn btn-primary name='submit' id='button' value='Enviar'  disabled/>";
	   }

	  else
		  {
	echo" <input type='submit' class='btn btn-primary'  name='submit' id='button' value='Enviar'/>";

	  }
   ?>

	  <!--<input type="submit"  class="btn btn-primary"   name="submit" id="button" value="Enviar"/>-->
				<p>&nbsp;</p>
    <input type="button" class="btn btn-default" name="cancelar" id="cancelar" value="Cancelar" onclick="javascript:history.go(-1)" />

  </p>
</form>
	</center>

<footer class="py-4 bg-light mt-auto">
        <?php include('footer.php'); ?>
	</footer>



</div>
</div>

</body>
</html>
