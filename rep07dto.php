<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reportes de Integracion Consejo.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html;charset=utf-8"); 
session_start();
error_reporting(E_ERROR | E_PARSE);
include 'config_open_db.php';
include 'arreglos.php';

			include("bitacora.php");
			$accion="Reporte IntegracionConsejo";
			bitacora($accion);


$id_sesion=$_REQUEST['id_sesion'];
$id_distrito=$_REQUEST['id_distrito'];
//echo $desc;



$encabezado = "SELECT * FROM sisesecd_sesiones  WHERE id_sesion=$id_sesion  and id_distrito=$id_distrito";
//echo $encabezado;


$resultado=sqlsrv_query($conn, $encabezado);
$undato=sqlsrv_fetch_array($resultado);

$desc=$undato['desc_sesion'];
$typesess= $undato['tipo_sesion'];
$nosesion=$undato['nosesion'];
//$fecha_hoy= date('Y-n-d');
$fecha_hoy=$undato['fecha_inicio_prog'];

$fecha_partida=explode("-", $fecha_hoy);

$anio=$fecha_partida[0];
$mes=$fecha_partida[1];
$dia=$fecha_partida[2];

/*
$encabezado = "SELECT i.fecha_inicio_real, s.nosesion,s.tipo_sesion,s.desc_sesion FROM sisesecd_inicio as i, sisesecd_sesiones as s WHERE i.id_sesion=s.id_sesion and id_distrito=$id_distrito  and s.estatus=1";

$fechita = ifx_query($encabezado,$conn);
$undato=ifx_fetch_row($fechita);
//echo $sql_consultad;
$typesess=$undato[tipo_sesion];
$desc=$undato[desc_sesion];
$nosesion=$undato[nosesion];

$fecha_ses=$undato[fecha_inicio_real];
$fecha_partida=explode("-", $fecha_ses);

$anio=$fecha_partida[0];
$mes=$fecha_partida[1];
$dia=$fecha_partida[2];
//Cabecera general
//Cabecera general
*/

echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo "<tr>";
echo "<th colspan=10 padding: 16px; >SECRETARIA EJECUTIVA</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=10>";
echo "<font style='font-size:16px;font-weight:bold;'>DIRECCI&Oacute;N EJECUTIVA DE ORGANIZACI&Oacute;N ELECTORAL Y GEOESTAD&Iacute;STICA.<br>";
echo "</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=10>";
echo "<font style='font-size:16px;font-weight:bold;'>PROCESO ELECTORAL LOCAL ORDINARIO 2020-2021.<br>";
echo "</th>";
echo "</tr> ";
echo "<tr> ";
echo "<th colspan=10 align='center'>";
echo "<font style='font-size:16px;font-weight:bold;'>REPORTE DE INTEGRANTES DE LOS CONSEJOS DISTRITALES <br></font><br>";
echo "</th>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=10>";
echo "<font style='font-size:14px;font-weight:bold;'> DE LOS CONSEJOS DISTRITALES ($tipo_ses[$typesess] 0$desc)<br></font><br>";
echo "</th>";
echo "</tr>";

echo "<tr> ";
echo "<td colspan=10 align='center'>";
echo "<font style='font-size:14px;font-weight:bold;'>FECHA DEL D&Iacute;A: ".$dia." DEL MES ",$mes." DE 2021</font><br>";
echo "</td>";
echo "</tr>";
echo "<p>&nbsp;</p>";
echo "<th class='borde_tabla'>Num.</th>";
//echo "<th class='borde_tabla'>Distrito</th>";
echo "<th class='borde_tabla'>Cargo o Partido Pol&iacute;tico</th>";
echo "<th class='borde_tabla'>Nombre </th>";
echo "<th class='borde_tabla'>Apellido Paterno</th>";
echo "<th class='borde_tabla'>Apellido Materno </th>";
echo "<th class='borde_tabla'>Tipo de Acreditaci&oacute;n</th>";
echo "<th class='borde_tabla'>Nombre del Representante</th>";
echo "<th class='borde_tabla'>Puesto de Representante</th>";
echo "</tr>";
echo "</table>";


echo "<table border=1 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";

$sql_consulta = "SELECT s.id_distrito, s.id_sesion, s.nosesion, s.desc_sesion, s.tipo_sesion, f.nombre,f.ap_paterno,f.ap_materno,f.tipo_acredor, f.id_integrante, f.candidato, f.puesto FROM sisesecd_sesiones as s, sisesecd_cat_funcionarios as f WHERE s.id_sesion=f.id_sesion 
and f.id_sesion in(select id_sesion  from sisesecd_sesiones 
where id_sesion=$id_sesion and id_distrito= $id_distrito and estatus=1 )";

$consulta_sesiones = sqlsrv_query($conn, $sql_consulta);
//echo $sql_consulta;

$i=0;
		while($rowsesion = sqlsrv_fetch_array($consulta_sesiones))
		{
	
		$i++;	
		echo "<tr>" ;
		echo "<td>".$i."</td>";

		echo "<td>".$tipo_cand[$rowsesion['id_integrante']]."</td>";
	    echo "<td>".utf8_decode($rowsesion['nombre'])."</td>";
		echo "<td>".utf8_decode($rowsesion['ap_paterno'])."</td>";
		echo "<td>".utf8_decode($rowsesion['ap_materno'])."</td>";
		echo "<td>".utf8_decode($rowsesion['tipo_acredor'])."</td>";
		echo "<td>".utf8_decode($rowsesion['candidato'])."</td>";
		echo "<td>".utf8_decode($rowsesion['puesto'])."</td>";
		echo "</tr>";
		
		}// cierro el primer while 
	

echo "</table>";
?>
