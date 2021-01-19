<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_de_Inicio_de_sesion_consejos_distritales.xls");
header("Pragma: no-cache");
header("Expires: 0");
//header("Content-Type: text/html;charset=utf-8");
session_start();
error_reporting(E_ERROR | E_PARSE);
require("config_open_db.php");

		include("bitacora.php");
			$accion="GeneraReporte InicioSesion CENTRAL";
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

	$sql_fecha="SELECT CURRENT_TIMESTAMP AS fecha";
	//echo $sql_fecha;
$r_fecha=sqlsrv_query($conn, $sql_fecha);
$d_date=sqlsrv_fetch_array ($r_fecha);

//$fecha_act=$d_date['fecha'];
$fecha_hoy= date('Y-n-d');
$fecha_partida=explode("-", $fecha_hoy);

$anio=$fecha_partida[0];
$mes=$fecha_partida[1];
$dia=$fecha_partida[2];


$nosesion=$_REQUEST['nosesion'];
$typesess=$_REQUEST['tiposesion'];
$desc=$_REQUEST['descsesion'];

//$encabezado = "SELECT i.fecha_inicio_real, s.fecha_inicio_prog, s.nosesion,s.tipo_sesion,s.desc_sesion FROM sisesecd_inicio as i, sisesecd_sesiones as s WHERE s.nosesion=".$nosesion." and s.tipo_sesion=".$typesess." and s.desc_sesion= ".$desc." and s.estatus=1";

/// es la fecha de la sesion programada
$encabezado = "SELECT * FROM sisesecd_sesiones  WHERE nosesion=".$nosesion." and tipo_sesion=".$typesess." and desc_sesion= ".$desc." and estatus=1 and id_distrito =40";
//echo $encabezado;


$resultado=sqlsrv_query($conn, $encabezado);
$undato=sqlsrv_fetch_array ($resultado);

//$fecha_hoy= date('Y-n-d');
$fecha_hoy=$undato["fecha_inicio_prog"];

$fecha_partida=explode("-", $fecha_hoy);

$anio=$fecha_partida[0];
$mes=$fecha_partida[1];
$dia=$fecha_partida[2];

/*echo "añooo".$anio;
echo "messss".$mes;
echo "diaaa".$dia;*/

//$resultados=ifx_query($sql,$conn);



include ("funciones.php");
include ("arreglos.php");
//require('arreglos.php');

echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo"<th colspan=30>";
//echo "<img src='http://distritos.iedf.org.mx/sisesecd2015/images/iedf.PNG'/>";
echo "<img src='https://aplicaciones.iecm.mx/sesiones2020/images/logo-header.png' style='vertical-align:middle;' alt='IECM'>";
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
echo "<font style='font-size:16px;font-weight:bold;'>REPORTE DE INICIO DE LA SESI&Oacute;N DE LOS CONSEJOS DISTRITALES<br></font><br>";
echo "</th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=36>";
echo "<font style='font-size:14px;font-weight:bold;'>".$nom_sesion[$nosesion]." SESION DE LOS CONSEJOS DISTRITALES ($tipo_ses[$typesess] 0$desc)<br></font><br>";
echo "</th>";
echo "</tr>";

echo "<tr> ";
echo "<td colspan=36 align='center'>";
//echo "<font style='font-size:14px;font-weight:bold;'>FECHA DE SESI&Oacute;N: ".$dia." DEL MES ".$mes." DE ".$anio."</font><br>";
echo "<font style='font-size:14px;font-weight:bold;'>FECHA: ".$dia. " DE " .$ar_mes[$mes] ." DE ".$anio."</font><br>";
echo "</td>";
echo "</tr>";
echo"<th colspan=36>";

echo "</th>";

echo '<tr border=1>';
echo '<td width=32 rowspan=5 align="center" class="borde_tabla"><strong>Dtto</strong></td>';
echo  '<td width=52 rowspan=5 align="center" class="borde_tabla"><strong>hora de inicio</strong></td>';
echo  '<td colspan=39 align="center" class="borde_tabla"><strong>Asistencia</strong></td>';
echo  '<td width=71 rowspan=5 align="center" class="borde_tabla"><strong>Quorum Asistencia</strong></td>';
echo   '<td rowspan=4 colspan=3 align="center" class="borde_tabla"><strong>Medios de Comunicacion</strong></td>';
echo  '<td width=288 rowspan=5 align="center" class="borde_tabla"><strong>Observaciones</strong></td>';
echo  '<td width=288 rowspan=5 align="center" class="borde_tabla"><strong>Domicilio</strong></td>';
echo "</tr>";
echo '<tr border=1>';
echo  '<td colspan=7 rowspan=3 align="center" class="borde_tabla"><strong>consejeros</strong></td>';
echo  '<td width=58 rowspan=4 align="center" class="borde_tabla"><strong>quorum votacion</strong></td>';
echo '<td width=42 rowspan=4 align="center" class="borde_tabla"><strong>srio</strong></td>';

echo "</tr>";

echo '<tr border=1>';
echo  '<td colspan=22 align="center" class="borde_tabla">partidos politicos</td>';
/* Se cambian de lugar*/
echo  '<td colspan=2 rowspan=2 align="center" class="borde_tabla"><strong>CI1</strong></td>';
echo  '<td colspan=2 rowspan=2 align="center" class="borde_tabla"><strong>CI2</strong></td>';
echo  '<td colspan=2 rowspan=2 align="center" class="borde_tabla"><strong>CI3</strong></td>';
echo  '<td colspan=2 rowspan=2 align="center" class="borde_tabla"><strong>CI4</strong></td>';
/**/
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
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>FSM</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>ELIGE</strong></td>';


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

//echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
//echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';

echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';

//echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
//echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';

//echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
//echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';
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


$indice=0;
$sql ="SELECT s.id_distrito, i.id_sesion, fecha_inicio_real, hora_inicio_real,qi_cp, qi_c1,qi_c2, qi_c3, qi_c4, qi_c5, qi_c6, qi_se, qi_pan_p, qi_pan_s, qi_pri_p, qi_pri_s, qi_prd_p, qi_prd_s, qi_pt_p, qi_pt_s, qi_pvem_p, qi_pvem_s, qi_pmc_p, qi_pmc_s, qi_elg_p, qi_elg_s, qi_pes_p, qi_pes_s, qi_prsp_p, qi_prsp_s, qi_pfsm_p, qi_pfsm_s, qi_morena_p, qi_morena_s, qi_ci1_p, qi_ci1_s, qi_ci2_p, qi_ci2_s, qi_ci3_p, qi_ci3_s, qi_ci4_p, qi_ci4_s, qi_prensa, qi_radio, qi_tv, quorumini, asistencia, CAST(observaini as CHAR(2048)) as observaini, domicilio FROM sisesecd_sesiones as s, sisesecd_inicio as i
WHERE s.id_sesion=i.id_sesion and s.id_sesion in(select id_sesion from sisesecd_sesiones where nosesion=$nosesion and tipo_sesion=$typesess and estatus=1 and desc_sesion=$desc and id_distrito!=41)order by s.id_distrito asc";

//echo $sql;
//$result=ifx_query($sql,$conn);
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


	echo'<td align="center" class="resultados">'.($datos['qi_se']+$datos['qi_cp']+$datos['qi_c1']+$datos['qi_c2']+$datos['qi_c3']+$datos['qi_c4']+$datos['qi_c5']+$datos['qi_c6']+$datos['qi_pan_p']+$datos['qi_pan_s']+$datos['qi_pri_p']+$datos['qi_pri_s']+$datos['qi_prd_p']+$datos['qi_prd_s']+$datos['qi_pt_p']+$datos['qi_pt_s']+$datos['qi_pvem_p']+$datos['qi_pvem_s']+$datos['qi_pmc_p']+$datos['qi_pmc_s']+$datos['qi_elg_p']+$datos['qi_elg_s']+ $datos['qi_pes_p']+$datos['qi_pes_s']+$datos['qi_prsp_p']+$datos['qi_prsp_s']+$datos['qi_morena_p']+$datos['qi_morena_s']+$datos['qi_ci1_p']+$datos['qi_ci1_s']+$datos['qi_ci2_p']+$datos['qi_ci2_s']+$datos['qi_ci3_p']+$datos['qi_ci3_s']+$datos['qi_ci4_p']+$datos['qi_ci4_s']).'</td>'; //quorum asistencia suma de cols.

	echo'<td align="center" class="resultados">'.$datos['qi_prensa'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_radio'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qi_tv'].'</td>';
	echo'<td align="center" class="resultados">'.$observaini.'</td>';
	echo'<td align="center" class="resultados">'.utf8_decode($datos['domicilio']).'</td>';
	echo'</tr>';
	$indice++;
}
echo "</table>";

sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
