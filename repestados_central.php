<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte de estados.xls");
header("Pragma: no-cache");
header("Expires: 0");
//header("Content-Type: text/html;charset=utf-8");
session_start();
error_reporting(E_ERROR | E_PARSE);
include 'config_open_db.php';
include 'arreglos.php';

$nosesion=$_REQUEST[nosesion];
$typesess=$_REQUEST[tiposesion];
$desc=$_REQUEST[descsesion];
$idsesion=$_REQUEST[id_sesion];
//echo $desc;
$id_distrito=$_SESSION['id_distrito'];


	include("bitacora.php");
			$accion="GeneraReporte Estados CENTRAL";
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


$sql_consultad = "SELECT fecha_inicio_real FROM sisesecd_inicio WHERE id_sesion in(select id_sesion from sisesecd_sesiones where nosesion=$nosesion and tipo_sesion=$typesess and desc_sesion=$desc and id_distrito!=40) ";

//echo $sql_consultad;

$fechita = sqlsrv_query($conn, $sql_consultad);
$resultado=sqlsrv_fetch_array($fechita);
//echo $sql_consultad;
//$fecha_ses=$resultado['fecha_inicio_real'];
//$fecha_partida=explode("-", $fecha_ses);
$fecha_hoy= date('Y-n-d');
$fecha_partida=explode("-", $fecha_hoy);

$anio=$fecha_partida[0];
$mes=$fecha_partida[1];
$dia=$fecha_partida[2];
//echo $dia;

//$fecha_sesion = $dia.'-'.$mes.'-'.$anio;
//echo $fecha_sesion;

echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo"<th colspan=30>";
//echo "<img src='http://distritos.iedf.org.mx/sisesecd2015/images/iedf.PNG'/>";
echo "<img src='https://aplicaciones.iecm.mx/sesiones2020/images/logo-header.png' style='vertical-align:middle;' width='10%' alt='IECM'>";
echo "</th>";
echo "<tr>";
echo "<th colspan=5 padding: 16px; >SECRETARIA EJECUTIVA</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=5>";
echo "<font style='font-size:16px;font-weight:bold;'>DIRECCI&Oacute;N EJECUTIVA DE ORGANIZACI&Oacute;N ELECTORAL Y GEOESTAD&Iacute;STICA.<br>";
echo "</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=5>";
echo "<font style='font-size:16px;font-weight:bold;'>PROCESO ELECTORAL LOCAL ORDINARIO 2020-2021.<br>";
echo "</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=5 align='center'>";
echo "<font style='font-size:16px;font-weight:bold;'>REPORTE DE ESTADOS<br></font><br>";
echo "</th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=5>";
echo "<font style='font-size:14px;font-weight:bold;'>".$nom_sesion[$nosesion]." SESI&Oacute;N DE LOS CONSEJOS DISTRITALES ($tipo_ses[$typesess] 0$desc)<br></font><br>";
echo "</th>";
echo "</tr>";

echo "<tr> ";
echo "<td colspan=5 align='center'>";
//echo "<font style='font-size:14px;font-weight:bold;'>FECHA DE SESI&Oacute;N: ".$dia." DEL MES ",$mes." DE ".$anio."</font><br>";
echo "<font style='font-size:14px;font-weight:bold;'>FECHA: ".$dia. " DE " .$ar_mes[$mes] ." DE ".$anio."</font><br>";
echo "</td>";
echo "</tr>";
echo '<tr>';
echo "<th class='borde_tabla'>Distrito</th>";
echo "<th class='borde_tabla'>Hora de inicio de la acci&oacute;n</th>";
echo "<th class='borde_tabla'>Hora de t&eacute;rmino de la acci&oacute;n</th>";
echo "<th class='borde_tabla'>Estado de la sesi&oacute;n </th>";
echo "<th class='borde_tabla'>Descripci&oacute;n de la sesi&oacute;n </th>";
echo "</tr>";
echo "</table>";

echo "<table border=1 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";


		$array_estado[1]='Incio de la sesion';
		$array_estado[2]='Sin Quorum';
        $array_estado[3]='Segunda Convocatoria';
		$array_estado[4]='Fin de la sesion';
        $array_estado[5]='En receso';
        $array_estado[6]='Concluyo receso';
        $array_estado[7]='Suspendida';
        $array_estado[8]='Reanudada';
        $array_estado[9]='Prolongada';
/// inicio if


$sql_consulta1 = "SELECT id_estado, id_sesion, id_distrito,estado_sesion, CAST(descripcion as CHAR(2048)) as descripcion, hora_inicio, hora_termino FROM sisesecd_estado_sesion order by id_distrito asc";
//echo $sql_consulta1;
	$consulta1 = sqlsrv_query($conn, $sql_consulta1);

		while($consulta1_row=sqlsrv_fetch_array($consulta1))
		{

		echo "<tr>" ;
		echo "<td>".$consulta1_row['id_distrito']."</td>";
	    echo "<td>".$consulta1_row['hora_inicio']."</td>";
		echo "<td>".$consulta1_row['hora_termino']."</td>";
		echo "<td>".$array_estado[$consulta1_row['estado_sesion']]."</td>";
		echo "<td>".$consulta1_row['descripcion']."</td>";
		echo "</tr>";
		}// cierro el primer while intervenciones




?>
