<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reportes de incidencias relevantes.xls");
header("Pragma: no-cache");
header("Expires: 0");
//header("Content-Type: text/html;charset=utf-8");
session_start();
error_reporting(E_ERROR | E_PARSE);
include 'config_open_db.php';
include 'arreglos.php';

$nosesion=$_REQUEST['nosesion'];
$typesess=$_REQUEST['tiposesion'];
$desc=$_REQUEST['descsesion'];
//echo $desc;


	include("bitacora.php");
			$accion="GeneraReporte Incidentes CENTRAL";
			bitacora($accion);




?>
<style>
th { vertical-align: baseline }
td { vertical-align: middle }

.borde_tabla {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000;
	text-align: center;
	border-top-width: thin;
	border-right-width: thin;
	border-left-width: thin;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #000;
	border-right-color: #000;
	border-bottom-color: #000;
	border-left-color: #000;
	border-bottom-width: thin;
}
.resultados {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000;
	text-align: center;
	border-top-width: thin;
	border-right-width: thin;
	border-bottom-width: thin;
	border-left-width: thin;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #000;
	border-right-color: #000;
	border-bottom-color: #000;
	border-left-color: #000;
}
.titulos {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000;
	text-align: center;
	font-weight:bold;
}
</style>
<?php


/*$sql_consultad = "SELECT fecha_inicio_real FROM sisesecd_inicio WHERE id_sesion in(select id_sesion from sisesecd_sesiones where nosesion=$n_sesion and tipo_sesion=$t_sesion and desc_sesion=$desc and id_distrito!=41) ";
$fechita = ifx_query($sql_consultad,$conn);
$resultado=ifx_fetch_row($fechita);
//echo $sql_consultad;
$fecha_ses=$resultado['fecha_inicio_real'];
$fecha_hoy= date('Y-n-d');
$fecha_partida=explode("-", $fecha_hoy);*/

$encabezado = "SELECT * FROM sisesecd_sesiones  WHERE nosesion=".$nosesion." and tipo_sesion=".$typesess." and desc_sesion= ".$desc." and estatus=1 and id_distrito =40";
//echo $encabezado;

$resultado=sqlsrv_query($conn, $encabezado);
$undato=sqlsrv_fetch_array ($resultado);

$fecha_hoy= date('Y-n-d');
//$fecha_hoy=$undato["fecha_inicio_prog"];

$fecha_partida=explode("-", $fecha_hoy);

$anio=$fecha_partida[0];
$mes=$fecha_partida[1];
$dia=$fecha_partida[2];




echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo"<th colspan=30>";
//echo "<img src='http://distritos.iedf.org.mx/sisesecd2015/images/iedf.PNG'/>";
echo "<img src='https://aplicaciones.iecm.mx/sesiones2020/images/logo-header.png' style='vertical-align:middle;' alt='IECM'>";
echo "</th>";
echo "<tr>";
echo "<th colspan=7 padding: 16px; >SECRETARIA EJECUTIVA</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=7>";
echo "<font style='font-size:16px;font-weight:bold;'>DIRECCI&Oacute;N EJECUTIVA DE ORGANIZACI&Oacute;N ELECTORAL Y GEOESTAD&Iacute;STICA.<br>";
echo "</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=7>";
echo "<font style='font-size:16px;font-weight:bold;'>PROCESO ELECTORAL LOCAL ORDINARIO 2020-2021.<br>";
echo "</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=7 align='center'>";
echo "<font style='font-size:16px;font-weight:bold;'>REPORTE DE INCIDENTES <br></font><br>";
echo "</th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=7>";
echo "<font style='font-size:14px;font-weight:bold;'>".$nom_sesion[$nosesion]." SESI&Oacute;N DE LOS CONSEJOS DISTRITALES ($tipo_ses[$typesess] 0$desc)<br></font><br>";
echo "</th>";
echo "</tr>";

echo "<tr> ";
echo "<td colspan=7 align='center'>";
//echo "<font style='font-size:14px;font-weight:bold;'>FECHA DEL D&Iacute;A: ".$dia." DEL MES ".$mes." DE 2021</font><br>";
echo "<font style='font-size:14px;font-weight:bold;'>FECHA: ".$dia. " DE " .$ar_mes[$mes] ." DE ".$anio."</font><br>";
echo "</td>";
echo "</tr>";
echo '<tr>';
echo "<th class='borde_tabla'>Distrito</th>";
echo "<th class='borde_tabla'>Punto del orden del d&iacute;a en que se present&oacute; la incidencia</th>";
echo "<th class='borde_tabla'>Nombre Participante (s)</th>";
echo "<th class='borde_tabla'>Cargo </th>";
echo "<th class='borde_tabla'>Punto de Incidente </th>";
echo "<th class='borde_tabla'>Descripci&oacute;n breve de la incidencia</th>";
echo "<th class='borde_tabla'>R&eacute;plica o respuesta del Consejero Presidente</th>";

echo "</tr>";
echo "</table>";

echo "<table border=1 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";

$sql_consulta = "SELECT * FROM sisesecd_sesiones WHERE nosesion=$nosesion AND tipo_sesion=$typesess and desc_sesion=$desc and id_distrito!=40 AND estatus=1 ORDER BY sisesecd_sesiones.id_distrito ASC";
$consulta_sesiones = sqlsrv_query($conn, $sql_consulta);
//echo $sql_consulta;

//$rowsesion = ifx_fetch_row($consulta_sesiones);

while($rowsesion = sqlsrv_fetch_array($consulta_sesiones))
{
$procede=0;
$procede=$rowsesion['con_incidente'];
$idsesion=$rowsesion['id_sesion'];
$iddistrito=$rowsesion['id_distrito'];


/// inicio if

if($procede==1)
{
$sql_consulta1 = "SELECT fecha_inicio_real, id_incidentes, inter.id_sesion, id_orden, tipo_incidente, inter_cp, inter_c1, inter_c2, inter_c3, inter_c4, inter_c5, inter_c6, inter_se, inter_panp, inter_pans, inter_prip, inter_pris, inter_prdp, inter_prds, inter_ptp, inter_pts, inter_pvemp, inter_pvems, inter_pmcp, inter_pmcs, inter_pelgp, inter_pelgs,inter_pesp, inter_pess, inter_prspp, inter_prsps, inter_pfsmp, inter_pfsms, inter_morenap, inter_morenas, inter_ci1p, inter_ci1s, inter_ci2p, inter_ci2s, inter_ci3p, inter_ci3s, inter_ci4p, inter_ci4s, CAST(incidente as CHAR(2048))as incidente, CAST(replica as CHAR(2048))as replica, punto FROM sisesecd_incidentes as inter, sisesecd_inicio as ini WHERE inter.id_sesion=ini.id_sesion and inter.id_sesion=$idsesion ";
//echo $sql_consulta1;
	$intervenciones_consulta1 = sqlsrv_query($conn, $sql_consulta1);

		while($intervenciones_consulta1_row=sqlsrv_fetch_array($intervenciones_consulta1))
		{
		$idorden=$intervenciones_consulta1_row['id_orden'];
		$sql_consulta2 = "SELECT id_sesion, id_orden, punto, estatus, CAST(desc_punto as CHAR(2048)) as desc_punto FROM sisesecd_ordendia WHERE id_orden=$idorden";
		//echo $sql_consulta2;
			$orden_consulta2 = sqlsrv_query($conn, $sql_consulta2);
			$orden_row=sqlsrv_fetch_array($orden_consulta2);


		$sql_consultaCAT ="SELECT id_integrante, tipo_acredor, nombre, ap_paterno, ap_materno FROM sisesecd_cat_funcionarios WHERE id_sesion=$idsesion and id_distrito =$iddistrito";
		//echo $sql_consultaCAT;

		$consultaCAT=sqlsrv_query($conn, $sql_consultaCAT);


			$array ="";
			$cargo="";
			while($consejoROW = sqlsrv_fetch_array($consultaCAT)) {

			if($consejoROW['tipo_acredor']=='CP')
				{
					if($intervenciones_consulta1_row['inter_cp']==1)
					{
						 $cargo.=" CP. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

				if($consejoROW['tipo_acredor']=='SC')
				{
					if($intervenciones_consulta1_row['inter_se']==1)
					{
						  $cargo.=" SC. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

				if($consejoROW['tipo_acredor']=='C1')
				{
					if($intervenciones_consulta1_row['inter_c1']==1)
					{
						  $cargo.=" C1. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			   if($consejoROW['tipo_acredor']=='C2')
				{
					if($intervenciones_consulta1_row['inter_c2']==1)
					{
						 $cargo.=" C2. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

				if($consejoROW['tipo_acredor']=='C3')
				{
					if($intervenciones_consulta1_row['inter_c3']==1)
					{
						 $cargo.=" C3. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

				if($consejoROW['tipo_acredor']=='C4')
				{
					if($intervenciones_consulta1_row['inter_c4']==1)
					{
						 $cargo.=" C4. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

				if($consejoROW['tipo_acredor']=='C5')
				{
					if($intervenciones_consulta1_row['inter_c5']==1)
					{
						 $cargo.=" C5. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

				if($consejoROW['tipo_acredor']=='C6')
				{
					if($intervenciones_consulta1_row['inter_c6']==1)
					{
						 $cargo.=" C6. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

				if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='11')
				{
					if($intervenciones_consulta1_row['inter_panp']==1)
					{
						 $cargo.="PAN-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

				if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='11')
				{
					if($intervenciones_consulta1_row['inter_pans']==1)
					{
						 $cargo.="PAN-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

				if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='12')
				{
					if($intervenciones_consulta1_row['inter_prip']==1)
					{
						 $cargo.="PRI-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

				if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='12')
				{
					if($intervenciones_consulta1_row['inter_pris']==1)
					{
						 $cargo.="PRI-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

				if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='13')
				{
					if($intervenciones_consulta1_row['inter_prdp']==1)
					{
						 $cargo.="PRD-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

				if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='13')
				{
					if($intervenciones_consulta1_row['inter_prds']==1)
					{
						 $cargo.="PRD-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

				if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='15')
				{
					if($intervenciones_consulta1_row['inter_ptp']==1)
					{
						 $cargo.="PT-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

				if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='15')
				{
					if($intervenciones_consulta1_row['inter_pts']==1)
					{
						 $cargo.="PT-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='14')
				{
					if($intervenciones_consulta1_row['inter_pvemp']==1)
					{
						 $cargo.="PVEM-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='14')
				{
					if($intervenciones_consulta1_row['inter_pvems']==1)
					{
						 $cargo.="PVEM-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='16')
				{
					if($intervenciones_consulta1_row['inter_pmcp']==1)
					{
						 $cargo.="PMC-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='16')
				{
					if($intervenciones_consulta1_row['inter_pmcs']==1)
					{
						 $cargo.="PMC-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='17')
				{
					if($intervenciones_consulta1_row['inter_pelgp']==1)
					{
						 $cargo.="PELG-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='17')
				{
					if($intervenciones_consulta1_row['inter_pelgp']==1)
					{
						 $cargo.="PELG-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='19')
				{
					if($intervenciones_consulta1_row['inter_pesp']==1)
					{
						 $cargo.="PES-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='19')
				{
					if($intervenciones_consulta1_row['inter_pess']==1)
					{
						 $cargo.="PES-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='20')
				{
					if($intervenciones_consulta1_row['inter_prspp']==1)
					{
						 $cargo.="PRS-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='20')
				{
					if($intervenciones_consulta1_row['inter_prsps']==1)
					{
						 $cargo.="PRS-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='18')
				{
					if($intervenciones_consulta1_row['inter_morenap']==1)
					{
						 $cargo.="PMORENA-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='18')
				{
					if($intervenciones_consulta1_row['inter_morenas']==1)
					{
						 $cargo.="PMORENA-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}


			if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='21')
				{
					if($intervenciones_consulta1_row['inter_pfsmp']==1)
					{
						 $cargo.="PFSM-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='21')
				{
					if($intervenciones_consulta1_row['inter_pfsms']==1)
					{
						 $cargo.="PFSM-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='31')
				{
					if($intervenciones_consulta1_row['inter_ci1p']==1)
					{
						 $cargo.="REP.LO-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='31')
				{
					if($intervenciones_consulta1_row['inter_ci1s']==1)
					{
						 $cargo.="REP.LO-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='32')
				{
					if($intervenciones_consulta1_row['inter_ci2p']==1)
					{
						 $cargo.="CI2-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='32')
				{
					if($intervenciones_consulta1_row['inter_ci2s']==1)
					{
						 $cargo.="CI2-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='33')
				{
					if($intervenciones_consulta1_row['inter_ci3p']==1)
					{
						 $cargo.="CI3-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='33')
				{
					if($intervenciones_consulta1_row['inter_ci3s']==1)
					{
						 $cargo.="CI3-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='P' && $consejoROW['id_integrante']=='34')
				{
					if($intervenciones_consulta1_row['inter_ci4p']==1)
					{
						 $cargo.="CI4-P. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			if($consejoROW['tipo_acredor']=='S' && $consejoROW['id_integrante']=='34')
				{
					if($intervenciones_consulta1_row['inter_ci4s']==1)
					{
						 $cargo.="CI4-S. <br>";
						 $array.= ($consejoROW["nombre"]." ".$consejoROW["ap_paterno"]." ".$consejoROW["ap_materno"])."<br>";
					}
				}

			}// cierra while NOMBRES


		echo "<tr>" ;
		echo "<td>"	.$rowsesion['id_distrito']."</td>";
	    echo "<td>".$orden_row['desc_punto']."</td>";
		echo "<td>".utf8_decode($array)."</td>";
		echo "<td>".utf8_decode($cargo)."</td>";
		echo "<td>".utf8_decode($intervenciones_consulta1_row['punto'])."</td>";
		echo "<td>".utf8_decode($intervenciones_consulta1_row['incidente'])."</td>";
		echo "<td>".utf8_decode($intervenciones_consulta1_row['replica'])."</td>";
		echo "</tr>";
		}// cierro el primer while intervenciones
	}
	else
	{
	echo "<tr>" ;
	echo "<td>"	.$rowsesion['id_distrito']."</td>";
	$idsesion=$rowsesion['id_sesion'];
	echo "<td></td><td></td><td></td><td>Sin incidentes relevantes</td><td></td>";
	}
	echo "</tr>";

}// cierra while de sql

?>
