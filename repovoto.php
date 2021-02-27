<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Reporte_de_Sentido_del_voto_de_las_sesiones_de_consejos_distritales.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html;charset=utf-8");
//session_start();
error_reporting(E_ERROR | E_PARSE);
require("config_open_db.php");


$punto=$_POST['punto'];
$nosesion=$_POST['nosesion'];
$typesess=$_POST['tiposesion'];
$desc=$_POST['descsesion'];

	include("bitacora.php");
	$accion="GeneraReporte Votacion CENTRAL".$punto;
	bitacora($accion);

	$fecha_hoy= date('Y-n-d');
	//$fecha_hoy=$undato["fecha_inicio_prog"];

	$fecha_partida=explode("-", $fecha_hoy);

	$anio=$fecha_partida[0];
	$mes=$fecha_partida[1];
	$dia=$fecha_partida[2];
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
$sql ="SELECT o.id_orden, o.id_sesion, o.punto, CAST(desc_punto as CHAR(2048)) as desc_punto, o.estatus, o.voto_cp, o.voto_c1, o.voto_c2, o.voto_c3, o.voto_c4, o.voto_c5, o.voto_c6,o.observa_punto, s.id_sesion, s.id_distrito, s.nosesion, s.desc_sesion, s.tipo_sesion, s.fecha_inicio_prog, s.hora_inicio_prog, s.con_inicio, s.con_orden, s.con_votos, s.con_intervencion, s.con_incidente, s.con_fin, s.estatus, i.id_inicio,i.id_sesion, i.fecha_inicio_real, i.hora_inicio_real, i.qi_cp, i.qi_c1, i.qi_c2, i.qi_c3, i.qi_c4, i.qi_c5, i.qi_c6, i.qi_se, i.qi_pan_p, i.qi_pan_s, i.qi_pri_p, qi_pri_s, i.qi_prd_p, i.qi_prd_s, i.qi_pt_p, i.qi_pt_s, i.qi_pvem_p, i.qi_pvem_s, i.qi_pmc_p, i.qi_pmc_s, i.qi_elg_p, i.qi_elg_s, i.qi_pes_p, i.qi_pes_s, i.qi_prsp_p, i.qi_prsp_s, i.qi_pfsm_p, i.qi_pfsm_s, i.qi_morena_p, i.qi_morena_s, i.qi_prensa, i.qi_radio, i.qi_tv, i.observaini FROM sisesecd_ordendia as o,sisesecd_sesiones as s,sisesecd_inicio as i WHERE s.id_sesion=o.id_sesion
and s.id_sesion=i.id_sesion
and o.punto='$punto'
and o.estatus=1
and s.id_sesion in(
select id_sesion from sisesecd_sesiones where nosesion=$nosesion and estatus=1 and con_votos=1 and tipo_sesion=$typesess and desc_sesion=$desc)order by s.id_distrito asc";
//echo $sql;

$sql_cuantos="SELECT count(*)as cuantos FROM sisesecd_ordendia as o, sisesecd_sesiones as s, sisesecd_inicio as i
WHERE s.id_sesion=o.id_sesion
and s.id_sesion=i.id_sesion
and o.punto='$punto'
and o.estatus=1
and s.id_sesion in(
select id_sesion from sisesecd_sesiones where nosesion=$nosesion and estatus=1 and con_votos=1 and tipo_sesion=$typesess and desc_sesion=$desc and id_distrito!=40)";

$conteo=sqlsrv_query($conn, $sql_cuantos);
$cuantos=sqlsrv_fetch_array ($conteo);
$cuantos1=$cuantos['cuantos'];

//echo $sql;
$result=sqlsrv_query($conn, $sql);
$undato=sqlsrv_fetch_array ($result);

$fecha=$undato['fecha_inicio_real'];

$descripcion=$undato['desc_punto'];

$desc=$undato['desc_sesion'];
$resultados=sqlsrv_query($conn, $sql);

$total=0;
$total7=0;
$total6=0;
$total5=0;
$total4=0;
$afavor=0;
$encontra=0;
$excusa=0;
$grantotal=0;
$totalfav=0;
$totalcon=0;
//eval("\$descripcion = \"$descripcion\";");

include ("funciones.php");
include ("arreglos.php");
echo '<div id="contenedor">';

echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo"<th colspan=5>";
//echo "<img src='http://desarrollo.iedf.org.mx/sisesecd2015/images/iedf.PNG'/>";
echo "<img src='https://aplicaciones.iecm.mx/sesiones2020/images/logo-header.png' style='vertical-align:middle;' width='10%' alt='IECM'>";
echo "</th>";
echo "<tr>";
echo "<th colspan=5 padding: 16px;>SECRETARIA EJECUTIVA</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=5 >";
echo "<font style='font-size:16px;font-weight:bold;'>DIRECCI&Oacute;N EJECUTIVA DE ORGANIZACI&Oacute;N ELECTORAL Y GEOESTAD&Iacute;STICA.<br>";
echo "</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=5>";
echo "<font style='font-size:16px;font-weight:bold;'>PROCESO ELECTORAL LOCAL ORDINARIO 2020- 2021.<br>";
echo "</th>";
echo "</tr> ";
echo "<tr>";
echo "<th colspan=5>";
echo "<font style='font-size:14px;font-weight:bold;'>".$nom_sesion[$nosesion]." SESI&Oacute;N DE LOS CONSEJOS DISTRITALES (".$tipo_ses[$typesess]." 0".$desc." )<br></font><br>";
echo "</th>";
echo "</tr>";
echo "<tr> ";


echo "<th colspan=5 align='center'>";
echo "<font style='font-size:16px;font-weight:bold;'>REPORTE DE SENTIDO DE LA VOTACI&Oacute;N<br>Punto ".utf8_decode($punto)." ".$descripcion."</font><br>";
echo "</th>";

echo "</tr>";
echo "<tr>";
echo "<td colspan=5 align='center'>";
//echo "<font style='font-size:14px;font-weight:bold;'>Sesi&oacute;n celebrada el: ".$fecha."<br></font><br>";
echo "<font style='font-size:14px;font-weight:bold;'>FECHA: ".$dia. " DE " .$ar_mes[$mes] ." DE ".$anio."</font><br>";
echo "</td>";
echo "</tr>";
echo "</table>";

echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo "<tr>";
echo '<td width=88 rowspan=2 class="borde_tabla"><strong>DISTRITO</strong></td>';
//echo '<td width=88 rowspan=2 class="borde_tabla"><strong>DESCRIPCI&Oacute;N</strong></td>';

echo '<td colspan=3 class="borde_tabla"><strong>SENTIDO DE LA VOTACI&Oacute;N</strong></td>';
echo '<td width=239 rowspan=2 class="borde_tabla"><strong>OBSERVACIONES</strong></td>';
echo  "</tr>";
echo "<tr>";
//echo  '<td width=133 class="borde_tabla"><strong>UNANIMIDAD</strong></td>';
echo  '<td width=135 class="borde_tabla"><strong>A FAVOR</strong></td>';
echo '<td width=114 class="borde_tabla"><strong>EN CONTRA</strong></td>';
echo '<td width=114 class="borde_tabla"><strong>EXCUSA</strong></td>';
echo "</tr>";


$indice=0;

while($datos = sqlsrv_fetch_array ($resultados))
{

	$distrito=$datos['id_distrito'];
	$desc_punto=$datos['desc_punto'];

	$votocp=$datos['voto_cp'];
	if($votocp==1)
		$afavor++;
	if($votocp==2)
		$encontra++;
	if($votocp==3)
		$excusa++;

	$votoc1=$datos['voto_c1'];
	if($votoc1==1)
		$afavor++;
	if($votoc1==2)
		$encontra++;
	if($votoc1==3)
		$excusa++;

	$votoc2=$datos['voto_c2'];
	if($votoc2==1)
		$afavor++;
	if($votoc2==2)
		$encontra++;
	if($votoc2==3)
		$excusa++;

	$votoc3=$datos['voto_c3'];
	if($votoc3==1)
		$afavor++;
	if($votoc3==2)
		$encontra++;
	if($votoc3==3)
		$excusa++;


	$votoc4=$datos['voto_c4'];
	if($votoc4==1)
		$afavor++;
	if($votoc4==2)
		$encontra++;
	if($votoc4==3)
		$excusa++;

	$votoc5=$datos['voto_c5'];
	if($votoc5==1)
		$afavor++;
	if($votoc5==2)
		$encontra++;
	if($votoc5==3)
		$excusa++;

	$votoc6=$datos['voto_c6'];
	if($votoc6==1)
		$afavor++;
	if($votoc6==2)
		$encontra++;
	if($votoc6==3)
		$excusa++;

	$array_f[$indice]=$afavor;
	$array_c[$indice]=$encontra;
	$array_d[$indice]=$excusa;

	$observaini =  utf8_decode(htmlspecialchars(trim($datos['observa_punto'])));

	echo'<tr>';

	//if($distrito<=10){
		echo'<td align="center" class="resultados">'.$datos['id_distrito'].'</td>';
		//echo'<td align="center" class="resultados">'.$datos['desc_punto'].'</td>';

			/*if($afavor==6 || $encontra==6 || $excusa==6)
				$total6++;

			if($afavor==5 || $encontra==5 || $excusa==5)
				$total5++;

			if($afavor==7 || $encontra==7 || $excusa==7)
				$total7++;*/

			if($afavor==6 )
				$total6++;

			if($afavor==5 )
				$total5++;

			if($afavor==7 )
				$total7++;

			if($afavor==4 )
			$total4++;


			echo'<td align="center" class="resultados">'.$afavor.'</td>';
			echo'<td align="center" class="resultados">'.$encontra.'</td>';
			echo'<td align="center" class="resultados">'.$excusa.'</td>';
			echo'<td align="center" class="resultados">'.$observaini.'</td>';

		$grantotal=$total7+$total5+$total6+$total4;

	echo'</tr>';

	$afavor=0;
	$encontra=0;
	$excusa=0;

	$indice++;
}


echo "<tr>";
echo "</tr>";
echo "<tr>";
echo "</tr>";

echo "</table>";
echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo "<tr>";
echo '<td colspan=2 class="borde_tabla">TOTALES VOTACI&Oacute;N</td>';
//echo "<td></td>";
//echo '<td colspan=2  class="borde_tabla">CONCENTRADO</td>';
echo "</tr>";

echo "<tr>";
//echo '<td class="borde_tabla">VOTACI&Oacute;N</td>';
//echo '<td class="borde_tabla">No. Dttos.</td>';
//echo "<td></td>";
$total_daniel = 0;
echo '<td class="resultados">A FAVOR</td>';
if($cuantos1>=1){
echo '<td class="resultados">'.array_sum($array_f)."</td>";
$total_daniel += array_sum($array_f);
}else{
echo '<td class="resultados">NO HAY DATOS DE VOTACI&Oacute;N</td>';
}
echo "</tr>";

echo "<tr>";
//echo '<td class="resultados">Unanimidad con 7 votos</td>';
//echo '<td class="resultados">'.$total7.'</td>';
//echo "<td></td>";

echo '<td class="resultados">EN CONTRA</td>';
if($cuantos1<1){
	echo '<td class="resultados">NO HAY DATOS DE VOTACI&Oacute;N</td>';
}else{
	echo '<td class="resultados">'.array_sum($array_c).'</td>';
	$total_daniel += array_sum($array_c);
}
echo "</tr>";

echo "<tr>";
//echo '<td class="resultados">Unanimidad o Mayor&iacute;a con 6 votos</td>';
//echo '<td class="resultados">'.$total6.'</td>';
//echo "<td></td>";
echo '<td class="resultados">EXCUSA</td>';
	if($cuantos1<1){
		echo '<td class="resultados">NO HAY DATOS DE VOTACI&Oacute;N</td>';
	}else{
		echo '<td class="resultados">'.array_sum($array_d).'</td>';
		$total_daniel += array_sum($array_d);
	}
echo "</tr>";
/*
echo "<tr>";
echo '<td class="resultados">Unanimidad o Mayor&iacute;a con 5 votos</td>';
echo '<td class="resultados">'.$total5.'</td>';
echo "</tr>";
echo "<tr>";
echo '<td class="resultados">Unanimidad o Mayor&iacute;a con 4 votos</td>';
echo '<td class="resultados">'.$total4.'</td>';
echo "</tr>";*/
echo "<tr>";
echo '<td class="resultados">TOTAL</td>';
echo '<td class="resultados">'.$total_daniel.'</td>';
echo "</tr>";
echo "</table>";
echo "</div>";

sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?>
