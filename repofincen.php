<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_de_fin_de_sesion_CD.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html;charset=utf-8");

session_start();
error_reporting(E_ERROR | E_PARSE);
require("config_open_db.php");

include ("arreglos.php");
include ("funciones.php");

			include("bitacora.php");
			$accion="GeneraReporte ConclucionSesion CENTRAL";
			bitacora($accion);

?>
<style type="text/css">

.borde_tabla {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight:bold;
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
$r_fecha=sqlsrv_query($conn, $sql_fecha);
$d_date=sqlsrv_fetch_array ($r_fecha);
	
$fecha_act=$d_date['fecha'];
        

$nosesion=$_REQUEST['nosesion'];
$typesess=$_REQUEST['tiposesion'];
$desc=$_REQUEST['descsesion'];

//$encabezado = "SELECT f.fecha_inicio_final, s.fecha_inicio_prog, s.nosesion,s.tipo_sesion,s.desc_sesion FROM sisesecd_fin as f, sisesecd_sesiones as s WHERE f.id_sesion=s.id_sesion  and s.estatus=1";
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

//echo "soy fecha".$fecha;


echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo"<th colspan=30>";
//echo "<img src='http://distritos.iedf.org.mx/sisesecd2015/images/iedf.PNG'/>";
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
echo "<font style='font-size:16px;font-weight:bold;'>REPORTE DE CONCLUSI&Oacute;N DE SESI&Oacute;N DE LOS CONSEJOS DISTRITALES<br></font><br>";
echo "</th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=36>";
echo "<font style='font-size:14px;font-weight:bold;'>".$nom_sesion[$nosesion]." SESI&Oacute;N DE LOS CONSEJOS DISTRITALES ($tipo_ses[$typesess] 0$desc)<br></font><br>";
echo "</th>";
echo "</tr>";

echo "<tr> ";
echo "<td colspan=36 align='center'>";
echo "<font style='font-size:14px;font-weight:bold;'>FECHA DEL D&Iacute;A: ".$dia." DEL MES ".$mes." DE ".$anio."</font><br>";
echo "</td>";
echo "</tr>";
echo"<th colspan=36>";

echo "</th>";

echo '<tr border=1>';
echo '<td width=32 rowspan=5 align="center" class="borde_tabla">Dtto</td>';
echo  '<td width=52 rowspan=5 align="center" class="borde_tabla">hora inicio</td>';
echo '<td width=60 rowspan=5 class="borde_tabla">Hora fin</td>';
echo  '<td width=65 rowspan=5 class="borde_tabla">Duracion hh:mm</td>';
echo  '<td colspan=39 align="center" class="borde_tabla">Asistencia</td>';
echo  '<td width=71 rowspan=5 align="center" class="borde_tabla">Quorum Asistencia</td>';
echo   '<td rowspan=4 colspan=3 align="center" class="borde_tabla">Medios de Comunicacion</td>';
echo  '<td width=288 rowspan=5 align="left" class="borde_tabla">Observaciones</td>';
echo "</tr>";
echo '<tr border=1>';
echo  '<td colspan=7 rowspan=3 align="center" class="borde_tabla">consejeros</td>';
echo  '<td width=58 rowspan=4 align="center" class="borde_tabla">quorum votacion</td>';
echo '<td width=42 rowspan=4 align="center" class="borde_tabla">srio</td>';
echo "</tr>";

echo '<tr >';
echo  '<td colspan=22 align="center" class="borde_tabla">partidos politicos</td>';   
/* Se cambian de lugar*/
echo  '<td colspan=2 rowspan=2 align="center" class="borde_tabla"><strong>CI1</strong></td>';
echo  '<td colspan=2 rowspan=2 align="center" class="borde_tabla"><strong>CI2</strong></td>';
echo  '<td colspan=2 rowspan=2 align="center" class="borde_tabla"><strong>CI3</strong></td>';
echo  '<td colspan=2 rowspan=2 align="center" class="borde_tabla"><strong>CI4</strong></td>';
/**/
echo "</tr>";

echo '<tr>';
  
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PAN</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PRI</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PRD</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PVEM</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PT</strong></td>';

echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PMC</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>MORENA</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PELG</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PES</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PRSP</strong></td>';
echo  '<td colspan=2 align="center" class="borde_tabla"><strong>PFSM</strong></td>';

echo '</tr>';


echo '<tr>';
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
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';echo '<td width=14 class="borde_tabla"><strong>p</strong></td>';
echo '<td width=23 class="borde_tabla"><strong>s</strong></td>';


echo '<td width=55 align="center" class="borde_tabla">Prensa</td>';
echo '<td width=46 align="center" class="borde_tabla">Radio</td>';
echo '<td width=34 align="center" class="borde_tabla">T.V.</td>';
echo  "</tr>";

$indice=0;	

$sql ="SELECT s.id_distrito, f.id_fin, f.id_sesion, f.fecha_inicio_final, f.hora_fin_final, f.qf_cp, f.qf_c1, f.qf_c2, f.qf_c3, f.qf_c4, f.qf_c5, f.qf_c6, f.qf_se, f.qf_pan_p, f.qf_pan_s, f.qf_pri_p, f.qf_pri_s, f.qf_prd_p, f.qf_prd_s, f.qf_pt_p, f.qf_pt_s, f.qf_pvem_p, f.qf_pvem_s, f.qf_pmc_p, f.qf_pmc_s, f.qf_elg_p, f.qf_elg_s, f.qf_pes_p, f.qf_pes_s, f.qf_prsp_p, f.qf_prsp_s, f.qf_morena_p, f.qf_morena_s, f.qf_pfsm_p, f.qf_pfsm_s, f.qf_ci1_p, f.qf_ci1_s, f.qf_ci2_p, f.qf_ci2_s, f.qf_ci3_p, f.qf_ci3_s, f.qf_ci4_p, f.pf_ci4_s, f.qf_prensa, f.qf_radio, f.qf_tv, f.quorumfin, CAST(f.observafin as CHAR(2048))as observafin, s.id_sesion, s.id_distrito, s.nosesion, s.desc_sesion, s.tipo_sesion, s.fecha_inicio_prog, s.hora_inicio_prog, s.con_inicio, s.con_orden, s.con_votos, s.con_intervencion, s.con_incidente, s.con_fin, s.estatus, i.id_inicio, i.id_sesion, i.fecha_inicio_real, i.hora_inicio_real, i.qi_cp, i.qi_c1, i.qi_c2, i.qi_c3, i.qi_c4, i.qi_c5, i.qi_c6, i.qi_se, i.qi_radio, i.qi_prensa, i.qi_tv, i.observaini, i.quorumini, i.asistencia FROM sisesecd_sesiones as s,sisesecd_inicio as i, sisesecd_fin as f
WHERE s.id_sesion=f.id_sesion
and s.id_sesion=i.id_sesion
and f.id_sesion in( 
select id_sesion from sisesecd_sesiones where nosesion=$nosesion and tipo_sesion=$typesess and estatus=1 and desc_sesion=$desc and id_distrito!=41)order by s.id_distrito asc;";

//echo $sql;
$result=sqlsrv_query($conn, $sql);
while($datos = sqlsrv_fetch_array ($result))
{
	
$duracion=calcular_tiempo_trasnc($datos['hora_inicio_real'],$datos['hora_fin_final']);


	$observafin =  utf8_decode(htmlspecialchars(trim($datos['observafin'])));
	echo'<tr>';
	echo'<td align="center" class="resultados">'.$datos['id_distrito'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['hora_inicio_real'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['hora_fin_final'].'</td>';
	echo'<td align="center" class="resultados">'.$duracion.'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_cp'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_c1'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_c2'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_c3'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_c4'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_c5'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_c6'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['quorumfin'].'</td>';//quorum vot suma cols
	echo'<td align="center" class="resultados">'.$datos['qf_se'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_pan_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_pan_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_pri_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_pri_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_prd_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_prd_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_pvem_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_pvem_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_pt_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_pt_s'].'</td>';

	echo'<td align="center" class="resultados">'.$datos['qf_pmc_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_pmc_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_morena_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_morena_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_elg_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_elg_s'].'</td>';
	
	echo'<td align="center" class="resultados">'.$datos['qf_pes_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_pes_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_prsp_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_prsp_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_pfsm_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_pfsm_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_ci1_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_ci1_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_ci2_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_ci2_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_ci3_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_ci3_s'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_ci4_p'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['pf_ci4_s'].'</td>';

	echo'<td align="center" class="resultados">'.($datos['qf_se']+$datos['qf_cp']+$datos['qf_c1']+$datos['qf_c2']+$datos['qf_c3']+$datos['qf_c4']+$datos['qf_c5']+$datos['qf_c6']+$datos['qf_pan_p']+$datos['qf_pan_s']+$datos['qf_pri_p']+$datos['qf_pri_s']+$datos['qf_prd_p']+$datos['qf_prd_s']+$datos['qf_pt_p']+$datos['qf_pt_s']+$datos['qf_pvem_p']+$datos['qf_pvem_s']+$datos['qf_pmc_p']+$datos['qf_pmc_s']+$datos['qf_elg_p']+$datos['qf_elg_s']+$datos['qf_pes_p']+$datos['qf_pes_s']+$datos['qf_prsp_p']+$datos['qf_prsp_s']+$datos['qf_morena_p']+$datos['qf_morena_s']+$datos['qf_ci1_p']+$datos['qf_ci1_s']+$datos['qf_ci2_p']+$datos['qf_ci2_s']+$datos['qf_ci3_p']+$datos['qf_ci3_s']+$datos['qf_ci4_p']+$datos['pf_ci4_s']).'</td>'; //quorum asistencia suma de cols.
	echo'<td align="center" class="resultados">'.$datos['qf_prensa'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_radio'].'</td>';
	echo'<td align="center" class="resultados">'.$datos['qf_tv'].'</td>';	
	echo'<td align="left" class="resultados">'.$observafin.'</td>';	
	echo'</tr>';
	$indice++;
}

echo "<tr>";
echo'<td align="center" colspan="32">'.$fecha_act.'</td>';
echo "</tr>";
echo "</table>";
//ifx_free_result($result); 
sqlsrv_close($conn);
?>