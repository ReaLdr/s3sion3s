<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_de_Inicio_de_sesion_consejos_distritales.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html;charset=utf-8");

session_start();
error_reporting(E_ERROR | E_PARSE);
require("config_open_db.php");



	include("bitacora.php");
	$accion="GeneraReporte InicioyFinSesion";
	bitacora($accion);
?>

<style type="text/css">

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
	font-size: 16px;
	color: #000;
	text-align: center;
}
</style>
<?php
$id_sesion=$_REQUEST['id_sesion'];
$id_distrito=$_SESSION['id_distrito'];



$encabezado = "SELECT * FROM sisesecd_sesiones  WHERE id_sesion=$id_sesion  and id_distrito=$id_distrito";
//echo $encabezado;


$resultado=sqlsrv_query($conn, $encabezado);
$undato=sqlsrv_fetch_array ($resultado);

$desc=$undato['desc_sesion'];
$typesess= $undato['tipo_sesion'];
$nosesion=$undato['nosesion'];
$fecha_hoy= date('Y-n-d');
//$fecha_hoy=$undato['fecha_inicio_prog'];

$fecha_partida=explode("-", $fecha_hoy);

$anio=$fecha_partida[0];
$mes=$fecha_partida[1];
$dia=$fecha_partida[2];

/*
$encabezado = "SELECT i.fecha_inicio_real, s.nosesion,s.tipo_sesion,s.desc_sesion FROM sisesecd_inicio as i, sisesecd_sesiones as s WHERE i.id_sesion=s.id_sesion and id_distrito=$id_distrito and s.estatus=1";
//echo $sql;
$resultado=ifx_query($encabezado,$conn);
$undato=ifx_fetch_row ($resultado);

$dia=date('d');
$mes=date('M');

$fecha=$undato[fecha_inicio_real];
$fecha_partida=explode("-", $fecha);

$anio=$fecha_partida[0];
$mes=$fecha_partida[1];
$dia=$fecha_partida[2];
*/


include ("funciones.php");
include ("arreglos.php");

echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo"<th colspan=30>";
//echo "<img src='http://desarrollo.iedf.org.mx/sisesecd2015/images/iedf.PNG'/>";
echo "<img src='https://aplicaciones.iecm.mx/sesiones2020/images/logo-header.png' style='vertical-align:middle' alt='IECM'>";
echo "</th>";
echo "<tr>";
echo "<th colspan=36 padding: 16px; >SECRETARIA EJECUTIVA</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=36>";
echo "<font style='font-size:16px;font-weight:bold;'>DIRECCI&Oacute;N EJECUTIVA DE ORGANIZACI&Oacute;N ELECTORAL Y GEOESTAD&Iacute;STICA.<br>";
echo "</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=36>";
echo "<font style='font-size:16px;font-weight:bold;'>PROCESO ELECTORAL LOCAL ORDINARIO 2020-2021.<br>";
echo "</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=36 align='center'>";
echo "<font style='font-size:16px;font-weight:bold;'>REPORTE DE INICIO Y CONCLUSI&Oacute;N DE LA SESI&Oacute;N DE LOS CONSEJOS DISTRITALES<br></font><br>";
echo "</th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=36>";
echo "<font style='font-size:14px;font-weight:bold;'>".$nom_sesion[$nosesion]." SESION DE LOS CONSEJOS DISTRITALES ($tipo_ses[$typesess] 0$desc)<br></font><br>";
echo "</th>";
echo "</tr>";

echo "<tr> ";
echo "<td colspan=36 align='center'>";
echo "<font style='font-size:14px;font-weight:bold;'>FECHA: ".$dia. " DE " .$ar_mes[$mes] ." DE ".$anio."</font><br>";
//12 de enero de 2021
//echo "<font style='font-size:14px;font-weight:bold;'>FECHA DEL D�A:".$dia." DEL MES ".$mes." DE ".$anio."</font><br>";
echo "</td>";
echo "</tr>";
/*echo"<th colspan=30>";

echo "</th>";*/

echo '<tr border=1>';
echo '<td width=32 rowspan=5 align="center" class="borde_tabla"><strong>Dtto</strong></td>';
echo  '<td width=52 rowspan=5 align="center" class="borde_tabla"><strong>hora de inicio</strong></td>';
echo  '<td colspan=39 align="center" class="borde_tabla"><strong>Asistencia</strong></td>';
echo  '<td width=71 rowspan=5 align="center" class="borde_tabla"><strong>Qu&oacute;rum Asistencia</strong></td>';
echo   '<td rowspan=4 colspan=3 align="center" class="borde_tabla"><strong>Medios de Comunicaci&oacute;n</strong></td>';
echo  '<td width=288 rowspan=5 align="center" class="borde_tabla"><strong>Observaciones</strong></td>';
echo  '<td width=288 rowspan=5 align="center" class="borde_tabla"><strong>Domicilio</strong></td>';
echo "</tr>";
echo '<tr border=1>';
echo  '<td colspan=7 rowspan=3 align="center" class="borde_tabla"><strong>consejeros</strong></td>';
echo  '<td width=58 rowspan=4 align="center" class="borde_tabla"><strong>qu&oacute;rum votaci&oacute;n</strong></td>';
echo '<td width=42 rowspan=4 align="center" class="borde_tabla"><strong>srio</strong></td>';

echo "</tr>";

echo '<tr border=1>';
echo  '<td colspan=22 align="center"><strong>partidos pol&iacute;ticos</strong></td>';
echo  '<td colspan=2 rowspan="2" align="center" class="borde_tabla"><strong>CI1</strong></td>';
echo  '<td colspan=2 rowspan="2"  align="center" class="borde_tabla"><strong>CI2</strong></td>';
echo  '<td colspan=2 rowspan="2" align="center" class="borde_tabla"><strong>CI3</strong></td>';
echo  '<td colspan=2 rowspan="2"  align="center" class="borde_tabla"><strong>CI4</strong></td>';
echo "</tr>";

echo '<tr border=1>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PAN</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PRI</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PRD</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PVEM</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PT</strong></td>';

echo  '<td colspan=2 align="center" class="borde_tabla"><strong>MC</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>MORENA</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PES</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>RSP</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>FM</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>ELIGE</strong></td>';
//echo  '<td colspan=2 align="center" class="borde_tabla"><strong>CI1</strong></td>';
//echo  '<td colspan=2 align="center" class="borde_tabla"><strong>CI2</strong></td>';
//echo  '<td colspan=2 align="center" class="borde_tabla"><strong>CI3</strong></td>';
//echo  '<td colspan=2 align="center" class="borde_tabla"><strong>CI4</strong></td>';
echo "</tr>";

echo '<tr border=1>';
echo '<td width=41 class="borde_tabla"><strong>Pdte</strong></td>';
echo '<td width=27 class="borde_tabla"><strong>C1</strong></td>';
echo '<td width=21 class="borde_tabla"><strong>C2</strong></td>';
echo '<td width=31 class="borde_tabla"><strong>C3</strong></td>';
echo '<td width=26 class="borde_tabla"><strong>C4</strong></td>';
echo '<td width=24 class="borde_tabla"><strong>C5</strong></td>';
echo '<td width=29 class="borde_tabla"><strong>C6</strong></td>';

echo '<td width=20 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=20 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=20 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=20 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=20 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=20 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=20 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=20 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=19 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"<strong>s</strong></td>';

echo '<td width=21 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=24 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';
echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';
echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';
echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';
echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';
echo '<td width=55 align="center" class="borde_tabla"><strong>Prensa</strong></td>';
echo '<td width=46 align="center" class="borde_tabla"><strong>Radio</strong></td>';
echo '<td width=34 align="center" class="borde_tabla"><strong>T.V.</strong></td>';
echo  "</tr>";
//exit;

$sql ="SELECT s.id_distrito, s.nosesion,s.desc_sesion, s.tipo_sesion, i.id_sesion, fecha_inicio_real, hora_inicio_real,qi_cp, qi_c1,qi_c2, qi_c3, qi_c4, qi_c5, qi_c6, qi_se, qi_pan_p, qi_pan_s, qi_pri_p, qi_pri_s, qi_prd_p, qi_prd_s, qi_pt_p, qi_pt_s, qi_pvem_p, qi_pvem_s, qi_pmc_p, qi_pmc_s, qi_elg_p, qi_elg_s, qi_pes_p, qi_pes_s, qi_prsp_p, qi_prsp_s, qi_pfsm_p, qi_pfsm_s, qi_morena_p, qi_morena_s, qi_ci1_p, qi_ci1_s, qi_ci2_p, qi_ci2_s, qi_ci3_p, qi_ci3_s, qi_ci4_p, qi_ci4_s, qi_prensa, qi_radio, qi_tv, quorumini, asistencia, CAST(observaini as CHAR(2048)) as observaini, domicilio FROM sisesecd_sesiones as s, sisesecd_inicio as i
WHERE s.id_sesion=i.id_sesion and s.id_sesion in(select id_sesion from sisesecd_sesiones where id_sesion=$id_sesion and estatus=1 and id_distrito=$id_distrito)";
//echo $sql;
$indice=0;
$result=sqlsrv_query($conn, $sql);
while($datos = sqlsrv_fetch_array ($result))
{

	$observaini =  utf8_decode(htmlspecialchars(trim($datos['observaini'])));
	echo'<tr>';
	echo'<td align="center" class="resultados">'.$datos['id_distrito'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['hora_inicio_real'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_cp'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_c1'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_c2'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_c3'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_c4'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_c5'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_c6'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['quorumini'].'</td>';//quorum vot suma cols
	echo'<td align="center" class="resultados">'.$datos['qi_se'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_pan_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_pan_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_pri_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_pri_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_prd_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_prd_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_pvem_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_pvem_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_pt_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_pt_s'].'</td>';

	echo'<td align="center" class="resultados">'.$datos['qi_pmc_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_pmc_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_morena_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_morena_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_pes_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_pes_s'].'</td>';

	echo'<td align="center" class="resultados">'.$datos['qi_prsp_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_prsp_s'].'</td>';

	echo'<td align="center" class="resultados">'.$datos['qi_pfsm_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_pfsm_s'].'</td>';

	echo'<td align="center" class="resultados">'.$datos['qi_elg_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_elg_s'].'</td>';

	echo'<td align="center" class="resultados">'.$datos['qi_ci1_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_ci1_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_ci2_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_ci2_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_ci3_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_ci3_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_ci4_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_ci4_s'].'</td>';


	echo'<td align="center" class="resultados">'.($datos['qi_se']+$datos['qi_cp']+$datos['qi_c1']+$datos['qi_c2']+$datos['qi_c3']+$datos['qi_c4']+$datos['qi_c5']+$datos['qi_c6']+$datos['qi_pan_p']+$datos['qi_pan_s']+$datos['qi_pri_p']+$datos['qi_pri_s']+$datos['qi_prd_p']+$datos['qi_prd_s']+$datos['qi_pt_p']+$datos['qi_pt_s']+$datos['qi_pvem_p']+$datos['qi_pvem_s']+$datos['qi_pmc_p']+$datos['qi_pmc_s']+$datos['qi_elg_p']+$datos['qi_elg_s']+ $datos['qi_pes_p']+$datos['qi_pes_s']+$datos['qi_prsp_p']+$datos['qi_prsp_s']+$datos['qi_pfsm_p']+$datos['qi_pfsm_s']+$datos['qi_morena_p']+$datos['qi_morena_s']+$datos['qi_ci1_p']+$datos['qi_ci1_s']+$datos['qi_ci2_p']+$datos['qi_ci2_s']+$datos['qi_ci3_p']+$datos['qi_ci3_s']+$datos['qi_ci4_p']+$datos['qi_ci4_s']).'</td>'; //quorum asistencia suma de cols.

	echo'<td align="center" class="resultados">'.$datos['qi_prensa'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_radio'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_tv'].'</td>';
	echo'<td align="center" class="resultados">'.$observaini.'</td>';
	echo'<td align="center" class="resultados">'.utf8_decode($datos['domicilio']).'</td>';
	echo'</tr>';
	$indice++;
}

echo "<tr>";
//echo'<td align="center" colspan="30">'.utf8_decode(htmlspecialchars(Footer())).'</td>';
echo "</tr>";
echo "<tr>";
echo "</tr>";
echo "</table>";

/// Empieza la tabla de fin de la sesi�n
$sql_fin ="SELECT f.id_fin, f.id_sesion, f.fecha_inicio_final, f.hora_fin_final, f.qf_cp, f.qf_c1, f.qf_c2, f.qf_c3, f.qf_c4, f.qf_c5, f.qf_c6, f.qf_se, f.qf_pan_p, f.qf_pan_s, f.qf_pri_p, f.qf_pri_s, f.qf_prd_p, f.qf_prd_s, f.qf_pt_p, f.qf_pt_s, f.qf_pvem_p, f.qf_pvem_s, f.qf_pmc_p, f.qf_pmc_s, f.qf_pes_p, f.qf_pes_s, f.qf_prsp_p, f.qf_prsp_s, f.qf_elg_p, f.qf_elg_s,	 f.qf_morena_p, f.qf_morena_s, f.qf_ci1_p, f.qf_ci1_s, f.qf_ci2_p, f.qf_ci2_s, f.qf_ci3_p, f.qf_ci3_s, f.qf_ci4_p, f.pf_ci4_s, f.qf_prensa, f.qf_radio, f.qf_tv, f.quorumfin, f.qf_pfsm_p, f.qf_pfsm_s , CAST(f.observafin as CHAR(2048))as observafin, s.id_sesion, s.id_distrito, s.nosesion, s.desc_sesion, s.tipo_sesion, s.fecha_inicio_prog, s.hora_inicio_prog, s.con_inicio, s.con_orden, s.con_votos, s.con_intervencion, s.con_incidente, s.con_fin, s.estatus, i.id_inicio, i.id_sesion, i.fecha_inicio_real, i.hora_inicio_real, i.qi_cp, i.qi_c1, i.qi_c2, i.qi_c3, i.qi_c4, i.qi_c5, i.qi_c6, i.qi_se, i.qi_radio, i.qi_prensa, i.qi_tv, i.observaini, i.quorumini, i.asistencia FROM sisesecd_sesiones as s,sisesecd_inicio as i, sisesecd_fin as f
WHERE s.id_sesion=f.id_sesion
and s.id_sesion=i.id_sesion
and f.id_sesion in(
select id_sesion from sisesecd_sesiones where id_sesion =$id_sesion and id_distrito=$id_distrito);";

//echo $sql_fin;
$result_fin=sqlsrv_query($conn, $sql_fin);
$undato=sqlsrv_fetch_array ($result_fin);
$fecha=$undato['fecha_inicio_final'];
$resultados_fin=sqlsrv_query($conn, $sql_fin);
//echo "soy fecha".$fecha;


echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";

echo "</tr>";

echo '<tr border=1>';
echo '<td width=32 rowspan=5 align="center" class="borde_tabla">Dtto</td>';
//echo  '<td width=52 rowspan=5 align="center" class="borde_tabla">hora inicio</td>';
echo '<td width=60 rowspan=5 class="borde_tabla">Hora fin</td>';
//echo  '<td width=65 rowspan=5 class="borde_tabla">Duracion hh:mm</td>';
echo  '<td colspan=39 align="center" class="borde_tabla">Asistencia</td>';
echo  '<td width=71 rowspan=5 align="center" class="borde_tabla">Qu&oacute;rum Asistencia</td>';
echo   '<td rowspan=4 colspan=3 align="center" class="borde_tabla">Medios de Comunicaci&oacute;n</td>';
echo  '<td width=288 rowspan=5 align="left" class="borde_tabla">Observaciones</td>';
echo "</tr>";
echo '<tr border=1>';
echo  '<td colspan=7 rowspan=3 align="center" class="borde_tabla">consejeros</td>';
echo  '<td width=58 rowspan=4 align="center" class="borde_tabla">qu&oacute;rum votaci&oacute;n</td>';
echo '<td width=42 rowspan=4 align="center" class="borde_tabla">srio</td>';

echo "</tr>";

echo '<tr >';
echo  '<td colspan=22 align="center" class="borde_tabla">partidos pol&iacute;ticos</td>';
echo  '<td colspan=2  rowspan=2 align="center" class="borde_tabla"><strong>CI1</strong></td>';
echo  '<td colspan=2  rowspan=2 align="center" class="borde_tabla"><strong>CI2</strong></td>';
echo  '<td colspan=2  rowspan=2 align="center" class="borde_tabla"><strong>CI3</strong></td>';
echo  '<td colspan=2  rowspan=2 align="center" class="borde_tabla"><strong>CI4</strong></td>';
echo "</tr>";

echo '<tr>';

echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PAN</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PRI</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PRD</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PVEM</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PT</strong></td>';

echo  '<td colspan=2 align="center" class="borde_tabla"><strong>MC</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>MORENA</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PES</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>RSP</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>FM</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>ELIGE</strong></td>';

echo '</tr>';

echo '<tr >';
echo '<td width=41 class="borde_tabla"><strong>Pdte</strong></td>';
echo '<td width=27 class="borde_tabla"><strong>C1</strong></td>';
echo '<td width=21 class="borde_tabla"><strong>C2</strong></td>';
echo '<td width=31 class="borde_tabla"><strong>C3</strong></td>';
echo '<td width=26 class="borde_tabla"><strong>C4</strong></td>';
echo '<td width=24 class="borde_tabla"><strong>C5</strong></td>';
echo '<td width=29 class="borde_tabla"><strong>C6</strong></td>';

echo '<td width=20 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=20 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=20 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=20 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=20 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=20 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=20 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=20 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=19 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=21 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=24 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';
echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';
echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';
echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';
echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=55 align="center" class="borde_tabla">Prensa</td>';
echo '<td width=46 align="center" class="borde_tabla">Radio</td>';
echo '<td width=34 align="center" class="borde_tabla">T.V.</td>';
echo  "</tr>";

$indice=0;

while($datos_fin = sqlsrv_fetch_array ($resultados_fin))
{

//$duracion=calcular_tiempo_trasnc($datos_fin['hora_inicio_real'],$datos_fin['hora_fin_final']);


	$observafin =  utf8_decode(htmlspecialchars(trim($datos_fin['observafin'])));
	echo'<tr>';
	echo'<td align="center" class="resultados">'.$datos_fin['id_distrito'].'</td>';
	//echo'<td align="center" class="resultados">'.$datos_fin['hora_inicio_real'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['hora_fin_final'].'</td>';
	//echo'<td align="center" class="resultados">'.$duracion.'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_cp'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_c1'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_c2'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_c3'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_c4'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_c5'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_c6'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['quorumfin'].'</td>';//quorum vot suma cols
	echo'<td align="center" class="resultados">'.$datos_fin['qf_se'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_pan_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_pan_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_pri_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_pri_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_prd_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_prd_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_pvem_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_pvem_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_pt_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_pt_s'].'</td>';

	echo'<td align="center" class="resultados">'.$datos_fin['qf_pmc_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_pmc_s'].'</td>';

	echo'<td align="center" class="resultados">'.$datos_fin['qf_morena_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_morena_s'].'</td>';

	echo'<td align="center" class="resultados">'.$datos_fin['qf_pes_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_pes_s'].'</td>';

	echo'<td align="center" class="resultados">'.$datos_fin['qf_prsp_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_prsp_s'].'</td>';

	echo'<td align="center" class="resultados">'.$datos_fin['qf_pfsm_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_pfsm_s'].'</td>';

	echo'<td align="center" class="resultados">'.$datos_fin['qf_elg_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_elg_s'].'</td>';

	echo'<td align="center" class="resultados">'.$datos_fin['qf_ci1_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_ci1_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_ci2_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_ci2_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_ci3_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_ci3_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_ci4_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['pf_ci4_s'].'</td>';

    $suma_total = ($datos_fin['qf_cp']+$datos_fin['qf_c1']+$datos_fin['qf_c2']+$datos_fin['qf_c3']+$datos_fin['qf_c4']+$datos_fin['qf_c5']+$datos_fin['qf_c6']+$datos_fin['qf_se']+$datos_fin['qf_pan_p']+$datos_fin['qf_pan_s']+$datos_fin['qf_pri_p']+$datos_fin['qf_pri_s']+$datos_fin['qf_prd_p']+$datos_fin['qf_prd_s']+$datos_fin['qf_pvem_p']+$datos_fin['qf_pvem_s']+$datos_fin['qf_pt_p']+$datos_fin['qf_pt_s']+$datos_fin['qf_pmc_p']+$datos_fin['qf_pmc_s']+$datos_fin['qf_morena_p']+$datos_fin['qf_morena_s']+$datos_fin['qf_pes_p']+$datos_fin['qf_pes_s']+$datos_fin['qf_prsp_p']+$datos_fin['qf_prsp_s']+$datos_fin['qf_pfsm_p']+$datos_fin['qf_pfsm_s']+$datos_fin['qf_elg_p']+$datos_fin['qf_elg_s']+$datos_fin['qf_ci1_p']+$datos_fin['qf_ci1_s']+$datos_fin['qf_ci2_p']+$datos_fin['qf_ci2_s']+$datos_fin['qf_ci3_p']+$datos_fin['qf_ci3_s']+$datos_fin['qf_ci4_p']+$datos_fin['pf_ci4_s']);
	echo'<td align="center" class="resultados">'.$suma_total.'</td>'; 
	
	
	//quorum asistencia suma de cols.
	echo'<td align="center" class="resultados">'.$datos_fin['qf_prensa'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_radio'].'</td>';
	echo'<td align="center" class="resultados">'.$datos_fin['qf_tv'].'</td>';
	echo'<td align="left" class="resultados">'.$observafin.'</td>';
	echo'</tr>';
	$indice++;
}

echo "<tr>";
echo'<td align="center" colspan="32">'.utf8_decode(htmlspecialchars(Footer())).'</td>';
echo "</tr>";
echo "</table>";

sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
