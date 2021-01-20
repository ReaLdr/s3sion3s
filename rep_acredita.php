<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte de acreditacion Rep.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html;charset=utf-8");
session_start();
error_reporting(E_ERROR | E_PARSE);
include 'config_open_db.php';
include 'arreglos.php';

$nosesion=$_REQUEST[nosesion];
$typesess=$_REQUEST[tiposesion];
$desc=$_REQUEST[descsesion];
//echo $desc;



	include("bitacora.php");
			$accion="GeneraReporte Intervenciones CENTRAL";
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


echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo"<th colspan=30>";
//echo "<img src='http://distritos.iedf.org.mx/sisesecd2015/images/iedf.PNG'/>";
echo "<img src='https://aplicaciones.iecm.mx/sesiones2020/images/logo-header.png' style='vertical-align:middle;' alt='IECM'>";
echo "</th>";
echo "<tr>";
echo "<th colspan=12 padding: 16px; >SECRETARIA EJECUTIVA</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=12>";
echo "<font style='font-size:16px;font-weight:bold;'>DIRECCI&Oacute;N EJECUTIVA DE ORGANIZACI&Oacute;N ELECTORAL Y GEOESTAD&Iacute;STICA.<br>";
echo "</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=12>";
echo "<font style='font-size:16px;font-weight:bold;'>PROCESO ELECTORAL LOCAL ORDINARIO 2020-2021.<br>";
echo "</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=12 align='center'>";
echo "<font style='font-size:16px;font-weight:bold;'>REPORTE DE ACREDITACIONES DE LOS REPRESENTANTES DE PARTIDOS POLITICOS Y CANDIDATURAS SIN PARTIDO <br></font><br>";
echo "</th>";
echo "</tr>";
echo "<tr> ";
echo "<td colspan=12 align='center'>";
echo "<font style='font-size:14px;font-weight:bold;'>FECHA: ".$dia. " DE " .$ar_mes[$mes] ." DE ".$anio."</font><br>";
echo "</td>";
echo "</tr>";
echo '<tr>';
echo "<th class='borde_tabla'>Distrito</th>";
echo "<th class='borde_tabla'>Nombre del Partido</th>";
echo "<th class='borde_tabla'>Nombre (s)</th>";
echo "<th class='borde_tabla'>Apellido Paterno </th>";
echo "<th class='borde_tabla'>Apellido Materno </th>";
echo "<th class='borde_tabla'>Tipo de acreditaci&oacute;n </th>";
echo "<th class='borde_tabla'>Fecha de notifiaci&oacute;n </th>";
echo "<th class='borde_tabla'>Num. Oficio </th>";
echo "<th class='borde_tabla'>Presentado ante </th>";
echo "<th class='borde_tabla'>Fecha de conclusi&oacute;n </th>";
echo "<th class='borde_tabla'>Num. Oficio </th>";
echo "<th class='borde_tabla'>Presentado ante </th>";


echo "</tr>";
echo "</table>";

echo "<table border=1 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";

$sql_consulta = "SELECT id_distrito, partido, nombre,  paterno, materno, tipo_acredita, fecha_notifica, oficio, presenta, fecha_concluye, oficio_concluye, presenta_concluye FROM sisesecd_acreditarep ";

$consulta_sesiones = sqlsrv_query($conn, $sql_consulta);
//echo $sql_consulta;

//$rowsesion = ifx_fetch_row($consulta_sesiones);

while($rowsesion = sqlsrv_fetch_array($consulta_sesiones))
{
$procede=0;
$procede=$rowsesion['con_intervencion'];
$idsesion=$rowsesion['id_sesion'];
$iddistrito=$rowsesion['id_distrito'];

			// cierra while NOMBRES


		echo "<tr>" ;
		echo "<td>".$rowsesion['id_distrito']."</td>";
		echo "<td>".$rowsesion['partido']."</td>";
	    echo "<td>".utf8_decode($rowsesion['nombre'])."</td>";
		echo "<td>".utf8_decode($rowsesion['paterno'])."</td>";
		echo "<td>".utf8_decode($rowsesion['materno'])."</td>";

		echo "<td>".$rowsesion['tipo_acredita']."</td>";
		echo "<td>".$rowsesion['fecha_notifica']."</td>";
		echo "<td>".utf8_decode($rowsesion['oficio'])."</td>";
		echo "<td>".$rowsesion['presenta']."</td>";
		echo "<td>".$rowsesion['fecha_concluye']."</td>";
		echo "<td>".$rowsesion['oficio_concluye']."</td>";
		echo "<td>".$rowsesion['presenta_concluye']."</td>";
		echo "</tr>";


}// cierra while de sql

?>
