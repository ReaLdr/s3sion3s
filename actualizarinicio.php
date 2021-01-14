<?php 
session_start();
error_reporting(E_ERROR | E_PARSE);

date_default_timezone_set("America/Mexico_City");
$iddistrito="0";

if (isset($_SESSION['user'])) {
	
$name= $_SESSION['transaccion'];
$grup=$_SESSION['grupo'];
$id_distrito=$_SESSION['id_distrito'];	
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
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
<script>
function validar_texto(a)
 { 
    tecl = (document.all) ? a.keyCode : a.which; 
    if (tecl==8) return true; 
	patro =/[a-z A-Z áéíóúäëïöü0ñÑ 0-9\-\.\?\,\"\@\:\()\;\*\+&%\$#_]/;
    t = String.fromCharCode(tecl); 
    return patro.test(t); 
} 
</script>
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
	$exec_count = sqlsrv_query($conn,$sql_count);
		//$cliente = mysql_fetch_array($consulta);
		$row_count1 = sqlsrv_fetch_array($exec_count);
		$cuantos1=0;
		$cuantos1=$row_count1[cuantos];
			
	$tmpSesion="Select * from sisesecd_sesiones where id_sesion=".$_REQUEST['id_sesion'].";";
//	$consultaSesion = mysql_query($tmpSesion);
	$consultaSesion = sqlsrv_query($conn,$tmpSesion);
	//echo $tmpSesion;
	
	
	if ($cuantos1>0){
		// Aqui consigo datos a desplegar 
//	$registro = mysql_fetch_array($consultaSesion);
		$registro = sqlsrv_fetch_array($consultaSesion);
		$descripcion=$registro[desc_sesion];
		$typesess=$registro[tipo_sesion];
		
		//$encabezado = "<b>".$nom_sesion[$registro['nosesion']]." Sesión ".$tipo_ses[$typesess]." de los Consejos Distritales 0".$descripcion."</b>";
			$encabezado = "<b>".$tipo_ses[$typesess]." de los Consejos Distritales 0".$descripcion."</b>";

	}
	else{
		echo 'Se produjo un error. No se encontraron datos de la Sesión Distrital:  ';//.ifx_error();
		return;
	} 
}

if(isset($_POST['submit'])){
	
	$fechainicioreal = htmlspecialchars(trim($_POST['fechainicioreal']));
	if($fechainicioreal != ""){
		$explode_fecha_inicial = explode("/", $fechainicioreal);
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
	$horainicioreal = htmlspecialchars(trim($_POST['horainicioreal']));
	$page =  htmlspecialchars(trim($_POST['page'])); 
	$asistenciaini =0;
	$qi_cp = htmlspecialchars(trim($_POST['ck_cp']));
	$qi_cp = ($qi_cp != 1 ? 0 : 1);
	$asistenciaini +=intval($qi_cp);
	
	$qi_c1 = htmlspecialchars(trim($_POST['ck_c1']));
	$qi_c1 = ($qi_c1 != 1 ? 0 : 1);
	$asistenciaini +=intval($qi_c1);
	
	$qi_c2 = htmlspecialchars(trim($_POST['ck_c2']));
	$qi_c2 = ($qi_c2 != 1 ? 0 : 1);
	$asistenciaini +=intval($qi_c2);
	
	$qi_c3 = htmlspecialchars(trim($_POST['ck_c3']));
	$qi_c3 = ($qi_c3 != 1 ? 0 : 1);
	$asistenciaini +=intval($qi_c3);
	
	$qi_c4 = htmlspecialchars(trim($_POST['ck_c4']));
	$qi_c4 = ($qi_c4 != 1 ? 0 : 1);
	$asistenciaini +=intval($qi_c4);
	
	$qi_c5 = htmlspecialchars(trim($_POST['ck_c5']));
	$qi_c5 = ($qi_c5 != 1 ? 0 : 1);
	$asistenciaini +=intval($qi_c5);
	
	$qi_c6 = htmlspecialchars(trim($_POST['ck_c6']));
	$qi_c6 = ($qi_c6 != 1 ? 0 : 1);
	$asistenciaini +=intval($qi_c6);
	
	$qi_sc = htmlspecialchars(trim($_POST['ck_sc']));
	$qi_sc = ($qi_sc != 1 ? 0 : 1);
	$asistenciaini +=intval($qi_sc);
	
//////partidos politicos///	
	$qi_panp = htmlspecialchars(trim($_POST['pan']));
	$qi_panp = ($qi_panp == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_panp);
	$qi_pans = htmlspecialchars(trim($_POST['pan']));
	$qi_pans = ($qi_pans == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_pans);
	$qi_prip = htmlspecialchars(trim($_POST['pri']));
	$qi_prip = ($qi_prip == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_prip);
	$qi_pris = htmlspecialchars(trim($_POST['pri']));
	$qi_pris = ($qi_pris == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_pris);
	$qi_prdp = htmlspecialchars(trim($_POST['prd']));
	$qi_prdp = ($qi_prdp == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_prdp);
	$qi_prds = htmlspecialchars(trim($_POST['prd']));
	$qi_prds = ($qi_prds == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_prds);
	$qi_ptp = htmlspecialchars(trim($_POST['pt']));
	$qi_ptp = ($qi_ptp == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_ptp);
	$qi_pts = htmlspecialchars(trim($_POST['pt']));
	$qi_pts = ($qi_pts == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_pts);
	$qi_pvemp = htmlspecialchars(trim($_POST['pvem']));
	$qi_pvemp = ($qi_pvemp == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_pvemp);
	$qi_pvems = htmlspecialchars(trim($_POST['pvem']));
	$qi_pvems = ($qi_pvems == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_pvems);
	$qi_pmcp = htmlspecialchars(trim($_POST['pmc']));
	$qi_pmcp = ($qi_pmcp == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_pmcp);
	$qi_pmcs = htmlspecialchars(trim($_POST['pmc']));
	$qi_pmcs = ($qi_pmcs == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_pmcs);
	
	$qi_morenap = htmlspecialchars(trim($_POST['morena']));
	$qi_morenap = ($qi_morenap == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_morenap);
	$qi_morenas = htmlspecialchars(trim($_POST['morena']));
	$qi_morenas = ($qi_morenas == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_morenas);
	
	$qi_elgp = htmlspecialchars(trim($_POST['elg']));
	$qi_elgp = ($qi_elgp == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_elgp);
	
	$qi_elgs = htmlspecialchars(trim($_POST['elg']));
	$qi_elgs = ($qi_elgs == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_elgs);
	
	$qi_pesp = htmlspecialchars(trim($_POST['pes']));
	$qi_pesp = ($qi_pesp == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_pesp);
	$qi_pess = htmlspecialchars(trim($_POST['pes']));
	$qi_pess = ($qi_pess == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_pess);
	
	$qi_prsp = htmlspecialchars(trim($_POST['prsp']));
	$qi_prsp = ($qi_prsp == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_prsp);
	$qi_prss = htmlspecialchars(trim($_POST['prsp']));
	$qi_prss = ($qi_prss == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_prss);
	
	$qi_pfsmp = htmlspecialchars(trim($_POST['pfsm']));
	$qi_pfsmp = ($qi_pfsmp == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_pfsmp);
	$qi_pfsms = htmlspecialchars(trim($_POST['pfsm']));
	$qi_pfsms = ($qi_pfsms == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_pfsms);

//// candidatos independientes/////	
	$qi_ci1p = htmlspecialchars(trim($_POST['ci1']));
	$qi_ci1p = ($qi_ci1p == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_ci1p);
	
	$qi_ci1s = htmlspecialchars(trim($_POST['ci1']));
	$qi_ci1s = ($qi_ci1s == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_ci1s);
	
	$qi_ci2p = htmlspecialchars(trim($_POST['ci2']));
	$qi_ci2p = ($qi_ci2p == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_ci2p);
	
	$qi_ci2s = htmlspecialchars(trim($_POST['ci2']));
	$qi_ci2s = ($qi_ci2s == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_ci2s);
	
	$qi_ci3p = htmlspecialchars(trim($_POST['ci3']));
	$qi_ci3p = ($qi_ci3p == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_ci3p);
	
	$qi_ci3s = htmlspecialchars(trim($_POST['ci3']));
	$qi_ci3s = ($qi_ci3s == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_ci3s);
	
	$qi_ci4p = htmlspecialchars(trim($_POST['ci4']));
	$qi_ci4p = ($qi_ci4p == 1 ? 1 : 0);
	$asistenciaini +=intval($qi_ci4p);
	
	$qi_ci4s = htmlspecialchars(trim($_POST['ci4']));
	$qi_ci4s = ($qi_ci4s == 2 ? 1 : 0);
	$asistenciaini +=intval($qi_ci4s);
	
	
	$qi_prensa = htmlspecialchars(trim($_POST['qi_prensa']));
	$qi_prensa = ($qi_prensa != 1 ? 0 : 1);
	$qi_radio = htmlspecialchars(trim($_POST['qi_radio']));
	$qi_radio = ($qi_radio != 1 ? 0 : 1);
	$qi_tv = htmlspecialchars(trim($_POST['qi_tv']));
	$qi_tv = ($qi_tv != 1 ? 0 : 1);
	
	$domicilio= htmlspecialchars(trim($_POST['domicilio'])); 

	$observaini =htmlspecialchars(trim($_POST['observaini']));
	$observaini=str_replace("'",'"',$observaini);

$quorumini =intval($qi_cp)+intval($qi_c1)+intval($qi_c2)+intval($qi_c3)+intval($qi_c4)+intval($qi_c5)+intval($qi_c6);
$fecha_alta=date('d-m-Y');
	
	$movimiento=htmlspecialchars(trim($_POST['movimiento'])); 
	$tmpSQL="";

	if($movimiento=="EDITAR")
	{
		$tmpSQL="UPDATE sisesecd_inicio set id_sesion=".$id_sesion.",fecha_inicio_real = '".$fechainicioreal."', hora_inicio_real= '".$horainicioreal."',qi_cp=".$qi_cp.",qi_c1=".$qi_c1.",qi_c2=".$qi_c2.",qi_c3=".$qi_c3.",qi_c4=".$qi_c4.",qi_c5=".$qi_c5.",qi_c6=".$qi_c6.",qi_se=".$qi_sc.",qi_pan_p = ".$qi_panp.", qi_pan_s = ".$qi_pans.", qi_pri_p = ".$qi_prip.", qi_pri_s = ".$qi_pris.", qi_prd_p = ".$qi_prdp.", qi_prd_s = ".$qi_prds.", qi_pt_p = ".$qi_ptp.", qi_pt_s = ".$qi_pts.", qi_pvem_p = ".$qi_pvemp.", qi_pvem_s = ".$qi_pvems.", qi_pmc_p = ".$qi_pmcp.", qi_pmc_s = ".$qi_pmcs.",  qi_morena_p=".$qi_morenap.", qi_morena_s=".$qi_morenas.", qi_elg_p=".$qi_elgp.", qi_elg_s=".$qi_elgs.", qi_pes_p=".$qi_pesp.", qi_pes_s=".$qi_pess.", qi_prsp_p=".$qi_prsp.", qi_prsp_s=".$qi_prss.", qi_pfsm_p=".$qi_pfsmp.",qi_pfsm_s=".$qi_pfsms.", qi_ci1_p=".$qi_ci1p.", qi_ci1_s=".$qi_ci1s.", qi_ci2_p=".$qi_ci2p.", qi_ci2_s=".$qi_ci2s.", qi_ci3_p=".$qi_ci3p.", qi_ci3_s=".$qi_ci3s.", qi_ci4_p=".$qi_ci4p.", qi_ci4_s=".$qi_ci4s.", qi_prensa = ".$qi_prensa.", qi_radio = ".$qi_radio.", qi_tv = ".$qi_tv.",quorumini=".$quorumini.",observaini='".$observaini."',asistencia=".$asistenciaini.", domicilio='".$domicilio."' WHERE id_sesion = ".$id_sesion;
	}
	else
	{
		$tmpSQL="INSERT INTO sisesecd_inicio(id_sesion, fecha_inicio_real, hora_inicio_real, qi_cp, qi_c1,qi_c2, qi_c3, qi_c4, qi_c5, qi_c6, qi_se, qi_pan_p, qi_pan_s, qi_pri_p, qi_pri_s, qi_prd_p, qi_prd_s, qi_pt_p, qi_pt_s, qi_pvem_p, qi_pvem_s, qi_pmc_p, qi_pmc_s, qi_elg_p, qi_elg_s, qi_pes_p, qi_pes_s, qi_prsp_p, qi_prsp_s, qi_morena_p, qi_morena_s, qi_pfsm_p, qi_pfsm_s, qi_ci1_p, qi_ci1_s, qi_ci2_p, qi_ci2_s, qi_ci3_p, qi_ci3_s, qi_ci4_p, qi_ci4_s, qi_prensa, qi_radio, qi_tv, quorumini, observaini, asistencia,domicilio) values (".$id_sesion.", '".$fechainicioreal."','".$horainicioreal."',".$qi_cp.", ".$qi_c1.", ".$qi_c2.",  ".$qi_c3.", ".$qi_c4.", ".$qi_c5.", ".$qi_c6.", ".$qi_sc.", ".$qi_panp.", ".$qi_pans.", ".$qi_prip.", ".$qi_pris.", ".$qi_prdp.", ".$qi_prds.", ".$qi_ptp.", ".$qi_pts.", ".$qi_pvemp.", ".$qi_pvems.", ".$qi_pmcp.",".$qi_pmcs.", ".$qi_elgp.",".$qi_elgs.", ".$qi_pesp.",".$qi_pess.",".$qi_prsp.",".$qi_prss.", ".$qi_morenap.",".$qi_morenas.",".$qi_pfsmp.",".$qi_pfsms.",".$qi_ci1p.",".$qi_ci1s.",".$qi_ci2p.",".$qi_ci2s.",".$qi_ci3p.",".$qi_ci3s.",".$qi_ci4p.",".$qi_ci4s.",".$qi_prensa.", ".$qi_radio.", ".$qi_tv.", ".$quorumini.",'".$observaini."',".$asistenciaini.",'".$domicilio."');";
	
		
		
		
	$sql_insert="INSERT INTO sisesecd_estado_sesion VALUES(".$id_sesion.",".$id_distrito.",1,'INICIO DE LA  SESION','".$horainicioreal."','','".$fecha_alta."');";
	//echo $sql_insert;
	sqlsrv_query($conn, $sql_insert);
	
	}

	//echo $tmpSQL;	
	//exit;
	
	if (sqlsrv_query($conn,$tmpSQL)== true) 
	{
		echo 'Datos guardados';
		
		include("bitacora.php");
		$accion="Inicio sesion ".$id_distrito;
		bitacora($accion);	
		
		
		$sql_update="UPDATE sisesecd_sesiones SET con_inicio=1 WHERE id_sesion=$id_sesion";
		if (sqlsrv_query($conn,$sql_update))
				{
							
		echo'<table width="166" border="0" cellpadding="0" cellspacing="0">
  		<tr>
    	<td width="156" align="center"><img src="images/ajax-loader.gif" width="160" height="24" /></td>
		</tr>
		<tr>
    	<td align="center">ACTUALIZANDO</td>
		</tr>
		</table>';
				echo'<SCRIPT LANGUAGE="javascript">';
				echo'alert("El inicio de la sesión se actualizó Exitosamente")';
				echo'</SCRIPT>';
				echo'<SCRIPT LANGUAGE="javascript">';
				echo'location.href = "./grid_sesiones.php?nosesion='.$nosesion.'&tipo_sesion='.$tipo_sesion.'&desc_sesion='.$desc_sesion.'";';
				echo'</SCRIPT>';
								
		}
		else{
			echo 'Se produjo un error al guardar historico. Intente nuevamente ';
			////////
					if( ($errors = sqlsrv_errors() ) != null) {
				        foreach( $errors as $error ) {
				            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
				            echo "code: ".$error[ 'code']."<br />";
				            echo "message: ".$error[ 'message']."<br />";
				        }
				    }

			////////.ifx_error();
		} 
	}
	else{
		echo 'Se produjo un error. Intente nuevamente ';
				////////
					if( ($errors = sqlsrv_errors() ) != null) {
				        foreach( $errors as $error ) {
				            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
				            echo "code: ".$error[ 'code']."<br />";
				            echo "message: ".$error[ 'message']."<br />";
				        }
				    }

			////////.ifx_error();
	} 
	
 }

else{
	$consulta ="";
	$cliente ="";

	if(isset($id_sesion)){
		
		$sql_count2="SELECT count(*) as cuantos2 FROM sisesecd_inicio WHERE id_sesion =$_REQUEST[id_sesion]";
		$exec_count2 = sqlsrv_query($conn,$sql_count2);
		$row_count2 = sqlsrv_fetch_array($exec_count2);
		$cuantos2=0;
		$cuantos2=$row_count2[cuantos2];
		

		$sql_consulta="SELECT * FROM sisesecd_inicio WHERE id_sesion =$_REQUEST[id_sesion]";
		//		$consulta = mysql_query("SELECT * FROM iniciosesion WHERE idsesion =".$_REQUEST['idsesion']);
		
		
		//echo $sql_consulta;
		$consulta = sqlsrv_query($conn,$sql_consulta);
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
	$exec = sqlsrv_query($conn,$sql_select);
	$row = sqlsrv_fetch_array($exec);
	$nosesion=$row[nosesion];
	$horainicio=$row[hora_inicio_prog];


?>
						
	</br>					
	</br>
		<center>
	<div class="card mb-4">
	<div class="card-header">
     <b>Editar Reporte de Inicio de la Sesión de los Consejos Distritales</b>
		<br><?php echo $encabezado;?>
    </div>
	<form id="frmClienteActualizar" name="frmClienteActualizar" method="post" onsubmit="ActualizarInicio(); return false">
	<input type="hidden" name="movimiento" id="movimiento" value="EDITAR" />
    	<input type="hidden" name="id_sesion" id="id_sesion" value="<?php echo $_REQUEST['id_sesion']; ?>" />

	<br/><br/>
  <input class="text" type="hidden" name="id_distrito" id="id_distrito" value="<?php echo $_SESSION['id_distrito']; ?>"/>

    <label>
	
   </label>
  </p>

<table >
<tr>
<td width="69%">
<label>Fecha de Inicio:</label>
<input  type="text" id="fechainicioreal"  name = "fechainicioreal" value="<?php echo $cliente['fecha_inicio_real'];?>" />
</td>
<td width="31%">
 <label>Hora programada: </label>
   <input type="text" id="horainicioreal" name="horainicioreal" value="<?php echo $cliente['hora_inicio_real']?>" />
</td>
</tr>
</table>
  <p align="center">
 <label>Domicilio de la Sede Distrital:</label>
  </br>
<textarea name="domicilio" cols="45" rows="5" id="domicilio" onkeypress="return validar_texto(event)"><?php echo $cliente['domicilio']?>
</textarea> 
</br>
 <?php 
//// me traigo los nombres de los integrantes////
$sql_integra = "select * from sisesecd_cat_funcionarios where id_sesion=$id_sesion and id_integrante in (1,2,3,4,5,6,7,8) and id_distrito=$id_distrito";
//echo $sql_integra;
?>
<table style="width: 90%;" border="1">
<tr>
<td colspan=10 align="center" bgcolor="#CCCCFF" ><strong>Asistencia a inicio de sesi&oacute;n de Consejo</strong></td>
</tr>
</br>
  <?php
	$exec_int = sqlsrv_query($conn, $sql_integra);

	$salta=0;
	while($row_int = sqlsrv_fetch_array($exec_int))
	{
		
	
	echo'<tr>';	
			
		if($row_int[id_integrante]==1)
		{
			
		echo'<td colspan="8" ><strong>Nombre CP :</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
			echo'<td colspan="2">';
			if($cliente['qi_cp']=="1")
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
				if($cliente['qi_se']=="1")
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
		echo'<td colspan="8"><strong> NombreC1 :</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['qi_c1']=="1")
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
		echo '<td colspan="8"><strong>NombreC2 :</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['qi_c2']=="1")
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
		echo '<td colspan="8"><strong> NombreC3:</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['qi_c3']=="1")
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
		echo'<td colspan="8"><strong>NombreC4:</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['qi_c4']=="1")
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
		echo '<td colspan="8" ><strong>NombreC5:</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['qi_c5']=="1")
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
		echo '<td colspan="8"><strong> NombreC6:</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
				echo'<td colspan="2">';
				if($cliente['qi_c6']=="1")
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

  ?>
  </table>
  <input type="hidden" value="<?php  echo $_REQUEST["page"] ?>" id="page" name="page" />
  </br>
</p>
<p>&nbsp; </p>
<table width="730" border="1">
  <tr>
  <td  colspan=12 align="center" bgcolor="#CCCCFF"><strong>Asistencia al Inicio de la Sesi&oacute;n  Representantes de Partidos Pol&iacute;ticos </strong></td></tr>
<tr>
	
<tr>
	<td  colspan=2 align="center">PAN</td>
	<td  colspan=2 align="center">PRI</td>
	<td  colspan=2 align="center">PRD</td>
	<td  colspan=2 align="center">PVEM</td>
	<td  colspan=2 align="center">PT</td>
	<td colspan=2 align="center">PMC</td>
</tr>
	
	
<tr>
<td width="0%">
<input type="radio" name="pan" value="1" <?php if($cliente['qi_pan_p']=="1") echo "checked=\"checked\""?> ><br>P
</td>
<td width="0%">
<input type="radio" name="pan" value="2" <?php if($cliente['qi_pan_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td width="0%">
<input type="radio" name="pri" value="1" <?php if($cliente['qi_pri_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="pri" value="2" <?php if($cliente['qi_pri_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td width="0%">
<input type="radio" name="prd" value="1" <?php if($cliente['qi_prd_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="prd" value="2" <?php if($cliente['qi_prd_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td width="0%">
<input type="radio" name="pvem" value="1" <?php if($cliente['qi_pvem_p']=="1") echo "checked=\"checked\""?>><br> P
</td>
<td width="0%">
<input type="radio" name="pvem" value="2" <?php if($cliente['qi_pvem_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td width="0%">
<input type="radio" name="pt" value="1" <?php if($cliente['qi_pt_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="pt" value="2" <?php if($cliente['qi_pt_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td width="0%">
<input type="radio" name="pmc" value="1" <?php if($cliente['qi_pmc_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="pmc" value="2" <?php if($cliente['qi_pmc_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
</tr>

<tr>

</tr>	
	
<tr>

<td colspan="2" align="center">MORENA</td>
<td colspan="2" align="center">PELG</td>
<td colspan="2" align="center">PES</td>
<td colspan="2" align="center">PRSP</td>
<td colspan="2" align="center">PFSM</td>
</tr>
	
	
<tr>

<td>
<input type="radio" name="morena" value="1" <?php if($cliente['qi_morena_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="morena" value="2" <?php if($cliente['qi_morena_s']=="1") echo "checked=\"checked\""?>><br>S
</td>

<td>
<input type="radio" name="elg" value="1" <?php if($cliente['qi_elg_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="elg" value="2" <?php if($cliente['qi_elg_s']=="1") echo "checked=\"checked\""?>><br>S
</td>

<td>
<input type="radio" name="pes" value="1" <?php if($cliente['qi_pes_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="pes" value="2" <?php if($cliente['qi_pes_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td>
<input type="radio" name="prsp" value="1" <?php if($cliente['qi_prsp_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="prsp" value="2" <?php if($cliente['qi_prsp_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
	
<td>
<input type="radio" name="pfsm" value="1" <?php if($cliente['qi_pfsm_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="ppfsm" value="2" <?php if($cliente['qi_prfsm_s']=="1") echo "checked=\"checked\""?>><br>S
</td>


<tr><td  colspan=12 align="center" bgcolor="#CCCCFF"><strong>Asistencia a Sesi&oacute;n de Candidaturas Sin Partido</strong></td></tr>
<tr align="center">
<td colspan="2">C1 - 1</td>
<td colspan="2">C2 - 2</td>
<td colspan="2">C3 - 3</td>
<td colspan="2">CI - 4</td>

</tr>
<tr align="center">

<td>
<input type="radio" name="ci1" value="1" <?php if($cliente['qi_ci1_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="10%">
<input type="radio" name="ci1" value="2" <?php if($cliente['qi_ci1_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td>
<input type="radio" name="ci2" value="1" <?php if($cliente['qi_ci2_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="10%">
<input type="radio" name="ci2" value="2" <?php if($cliente['qi_ci2_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td>
<input type="radio" name="ci3" value="1" <?php if($cliente['qi_ci3_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="12%">
<input type="radio" name="ci3" value="2" <?php if($cliente['qi_ci3_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td>
<input type="radio" name="ci4" value="1" <?php if($cliente['qi_ci4_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="10%">
<input type="radio" name="ci4" value="2" <?php if($cliente['qi_ci4_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
</tr>
</table>
</p>
<table width="735"  border="0">
<tr><td  colspan=3 align="center" bgcolor="#CCCCFF"><strong>Asistencia a Sesi&oacute;n de los Medios de comunicaci&oacute;n</strong></td></tr>
<tr>
<td>
<input type="checkbox" name="qi_prensa" value="1" <?php if($cliente['qi_prensa']=="1") echo "checked=\"checked\""?>> Prensa
</td>
<td>
<input type="checkbox" name="qi_radio" value="1" <?php if($cliente['qi_radio']=="1") echo "checked=\"checked\""?>> Radio
</td>
<td>
<input type="checkbox" name="qi_tv" value="1" <?php if($cliente['qi_tv']=="1") echo "checked=\"checked\""?>> Television
</td>
</tr>
</table>
<p><br />
  <label>Observaciones del inicio de Sesi&oacute;n<br />
    <textarea type="text" cols="45" rows="5" name="observaini" id="observaini" onkeypress='return validar_texto(event)'><?php echo stripslashes($cliente['observaini']);?> </textarea>
    <span id="theCounter"> </span>
  </label>

<p>&nbsp; </p>

	<p>
		<input type="submit" class="btn btn-primary" name="submit" id="button" value="Enviar" />
		<p></p>
		<input type="button" class="btn btn-default" name="cancelar" id="cancelar" value="Cancelar" onclick="history.back ()" />
	  </p>
	</form>
	<?php
	}
	else
	{
		
$ardel[2]=	'Azcapotzalco';
$ardel[3]=	'Coyoacan';
$ardel[4]=	'Cuajimalpa de Morelos';
$ardel[5]=	'Gustavo A. Madero';
$ardel[6]=	'Iztacalco';
$ardel[7]=	'Iztapalapa';
$ardel[8]=	'La Magdalena Contreras';
$ardel[9]=	'Milpa Alta';
$ardel[10]=	'Álvaro Obregon';
$ardel[11]=	'Tlahuac';
$ardel[12]=	'Tlalpan';
$ardel[13]=	'Xochimilco';
$ardel[14]=	'Benito Juarez';
$ardel[15]=	'Cuauhtemoc';
$ardel[16]=	'Miguel Hidalgo';
$ardel[17]=	'Venustiano Carranza';
	
	
	$sql_distrito="SELECT * FROM sisesecd_cat_distrito where id_distrito=$id_distrito";
	//	echo $sql_distrito;
		
		$result_dist= sqlsrv_query($conn,$sql_distrito);
		$rowDist=sqlsrv_fetch_array($result_dist);
		
		$calle = $rowDist['direccion'];
		$colonia= $rowDist['colonia'];
		$cp = $rowDist['cp'];
		$id_delega= $rowDist['id_delegacion'];
		
		$domicilioDistrito= UTF8_ENCODE($calle).' Col. '.UTF8_ENCODE($colonia). ' Demarcacion Territorial. '.$ardel[$id_delega].' CP. '.$cp ;	
		
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
<br>
</center>

<!-- aqui inicia la insercion del formulario -->
<center>
	<div class="card mb-4">
	<div class="card-header">
     <b>Reporte de Inicio de la Sesión de los Consejos Distritales <br><?php echo $encabezado; ?></b>
	
    </div>
<form id="frmClienteNuevo" name="frmClienteNuevo" method="post"  onsubmit="ActualizarInicio(); return false">
 </br>

 <input class="text" type="hidden" name="iddistrito" id="iddistrito" value="<?php echo $_SESSION['k_iddistrito']; ?>"/></label>
  </br>
<input class="text" type="hidden" name="iddistrito" id="iddistrito" value="<?php echo $_SESSION['k_iddistrito']; ?>"/>
<input type="hidden" name="id_sesion" id="id_sesion" value="<?php echo $_REQUEST['id_sesion'];?>" />
<input type="hidden" name="movimiento" id="movimiento" value="NUEVO" />
  </label>
  </br>



<br />
  <table width="78%" height="127">
<tr>
<td width="50%" height="45">
<label> Fecha de Inicio<br /></label>
<input  type="text" id="fechainicioreal"  name = "fechainicioreal" value="<?php echo date("Y-m-j");?>" />
</td>
<td width="50%">
    <label>Hora programada <br />     
    </label>
       <input type="text" id="horainicioreal" name="horainicioreal" value= "<?php echo date("H:i");?>"/> 
</td>
</tr>
<tr>
<td height="74" colspan="2" align="center">
 <label>Domicilio de la Sede Distrital:</label>
 <textarea type="text" cols="45" rows="5" name="domicilio" id="domicilio" onkeypress='return validar_texto(event)'><?php echo $domicilioDistrito;?></textarea>
</td>
</tr>
</table>
<br />
<?php 
//// me traigo los nombres de los integrantes////

$sql_integra = "select * from sisesecd_cat_funcionarios where id_sesion=$id_sesion and id_integrante in (1,2,3,4,5,6,7,8) and id_distrito=$id_distrito";
echo $sql_select;

echo'<table style="width: 90%;" border="1">';
echo'<tr bgcolor="#CCCCFF">';
echo'<td colspan=10 align="center" ><strong>Asistencia a inicio de sesi&oacute;n de Consejo</strong></td>';
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
		echo'<input type="checkbox" name="ck_cp" value="1">CP';
	    echo'</td>';
		}
		if($row_int[id_integrante]==2)
		{
		echo '<td colspan="8"><strong>Nombre SC :</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo '<td colspan="2"><input type="checkbox" name="ck_sc" value="1">SC';
		echo '</td>';
		}
	//echo'</tr>';	
	
	//echo'<tr>';
		if($row_int[id_integrante]==3)
		{
		echo'<td colspan="8"><strong> NombreC1 :</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo'<td colspan="2">';
		echo'<input type="checkbox" name="ck_c1" value="1">C1';
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
		echo '<td colspan="2"><input type="checkbox" name="ck_c3" value="1" />C3</td>';
		}
	//echo'</tr>';
	//echo'<tr>';
		if($row_int[id_integrante]==6)
		{
		echo'<td colspan="8"><strong>NombreC4:</strong>&nbsp;'.$row_int[nombre].' '.$row_int[ap_paterno].' '.$row_int[ap_materno].'</td>';
		echo'<td colspan="2">';
		echo'<input type="checkbox" name="ck_c4" value="1">C4';
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
		echo '<td colspan="2"><input type="checkbox" name="ck_c6" value="1" />C6</td>';
		}
	//echo'</tr>';
	
	}// cierro while
echo'</table>';
  ?>
</br>


	<table width="90%" height="183" border="1">
  <tr>
    <td  colspan=12 align="center" bgcolor="#CCCCFF"><strong>Asistencia al Inicio de la Sesión  Representantes de Partidos Politicos </strong></td></tr>
<tr>
<tr>
<td  colspan=2 align="center">PAN</td>
<td  colspan=2 align="center">PRI</td>
<td  colspan=2 align="center">PRD</td>
<td  colspan=2 align="center">PVEM</td>
<td  colspan=2 align="center">PT</td>
<td colspan=2 align="center">PMC</td>
</tr>
 
<tr align="center">
<td width="0%" height="45">
<input type="radio" name="pan" value="1" <?php if($cliente['qi_panp']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="pan" value="2" <?php if($cliente['qi_pans']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td width="0%">
<input type="radio" name="pri" value="1" <?php if($cliente['qi_prip']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="pri" value="2" <?php if($cliente['qi_pris']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td width="0%">
<input type="radio" name="prd" value="1" <?php if($cliente['qi_prdp']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="prd" value="2" <?php if($cliente['qi_prds']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td width="0%">
<input type="radio" name="pvem" value="1" <?php if($cliente['qi_pvemp']=="1") echo "checked=\"checked\""?>><br> P
</td>
<td width="0%">
<input type="radio" name="pvem" value="2" <?php if($cliente['qi_pvems']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td width="0%">
<input type="radio" name="pt" value="1" <?php if($cliente['qi_ptp']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="pt" value="2" <?php if($cliente['qi_pts']=="1") echo "checked=\"checked\"" ?>><br>S
</td>
<td width="0%">
<input type="radio" name="pmc" value="1" <?php if($cliente['qi_pmcp']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="pmc" value="2" <?php if($cliente['qi_pmcs']=="1") echo "checked=\"checked\""?>><br>S
</td>
</tr>

<tr>
<td colspan="2" align="center">MORENA</td>
<td colspan="2" align="center">PELGS</td>
<td colspan="2" align="center">PES</td>
<td colspan="2" align="center">PRSP</td>
<td colspan="2" align="center">PFSM</td>
</tr>

<tr align="center">

<td>
<input type="radio" name="morena" value="1" <?php if($cliente['qi_morenap']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="morena" value="2" <?php if($cliente['qi_morenas']=="1") echo "checked=\"checked\""?>><br>S
</td>
	
	<td>
<input type="radio" name="elg" value="1" <?php if($cliente['qi_elg_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="elg" value="2" <?php if($cliente['qi_elg_s']=="1") echo "checked=\"checked\""?>><br>S
</td>

<td>
<input type="radio" name="pes" value="1" <?php if($cliente['qi_pes_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="pes" value="2" <?php if($cliente['qi_pes_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
	
<td>
<input type="radio" name="prsp" value="1" <?php if($cliente['qi_prsp_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="prsp" value="2" <?php if($cliente['qi_prsp_s']=="1") echo "checked=\"checked\""?>><br>S
</td>
	
<td>
<input type="radio" name="pfsm" value="1" <?php if($cliente['qi_pfsm_p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="0%">
<input type="radio" name="pfsm" value="2" <?php if($cliente['qi_pfsm_s']=="1") echo "checked=\"checked\""?>><br>S
</td>

</tr>
<tr ><td  colspan=12 align="center" bgcolor="#CCCCFF"><strong>Asistencia a Sesión de Candidaturas Sin Partido</strong></td></tr>
<tr align="center">
<td colspan="2">CI - 1</td>
<td colspan="2">CI - 2</td>
<td colspan="2">CI - 3</td>
<td colspan="2">CI - 4</td>
</tr>
<tr align="center">
<td>
<input type="radio" name="ci1" value="1" <?php if($cliente['qi_ci1p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="10%">
<input type="radio" name="ci1" value="2" <?php if($cliente['qi_ci1s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td>
<input type="radio" name="ci2" value="1" <?php if($cliente['qi_ci2p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="12%">
<input type="radio" name="ci2" value="2" <?php if($cliente['qi_ci2s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td>
<input type="radio" name="ci3" value="1" <?php if($cliente['qi_ci3p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="11%">
<input type="radio" name="ci3" value="2" <?php if($cliente['qi_ci3s']=="1") echo "checked=\"checked\""?>><br>S
</td>
<td>
<input type="radio" name="ci4" value="1" <?php if($cliente['qi_ci4p']=="1") echo "checked=\"checked\""?>><br>P
</td>
<td width="10%">
<input type="radio" name="ci4" value="2" <?php if($cliente['qi_ci4s']=="1") echo "checked=\"checked\""?>><br>S
</td>
</tr>
</table>
<br />
<table width="90%" border="0">
  <tr><td colspan=3 align="center" bgcolor="#CCCCFF"><strong>Asistencia a Sesi&oacute;n de los Medios de Comunicaci&oacute;n</strong></td></tr>
<tr>
<td>
<input type="checkbox" name="qi_prensa" value="1"> Prensa
</td>
<td>
<input type="checkbox" name="qi_radio" value="1"> Radio
</td>
<td>
<input type="checkbox" name="qi_tv" value="1"> Television
</td>
</tr>
</table>
  </p>

  <p>
    <label>Observaciones del inicio de Sesi&oacute;n<br />
    <textarea type="text"  cols="45" rows="5" name="observaini" id="observaini" onkeypress='return validar_texto(event)'></textarea>
	<span id="theCounter"> </span>
    </label>
  </p>
  <p>&nbsp;</p>

    <input type="submit"  class="btn btn-primary" name="submit" id="button" value="Enviar" />
<p>&nbsp;</p>
    <input type="button"  class="btn btn-default" name="cancelar" id="cancelar" value="Cancelar" onclick="history.back()" />

	
</form>

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
            $('#horainicioreal').timepicker({
                'timeFormat': 'HH:mm'
            });
        });

	$(function() {
            //$("#fecha").datepicker();
            $("#fechainicioreal").datepicker({ dateFormat: 'dd/mm/yy' });
        });
</script>
<footer class="py-4 bg-light mt-auto">
    <?php include('footer.php'); ?>
   </footer>
</div>
</div>
</div>

</body>
</html>