<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reportes de Integracion Consejo.xls");
header("Pragma: no-cache");
header("Expires: 0");
//header("Content-Type: text/html;charset=utf-8"); 
session_start();
error_reporting(E_ERROR | E_PARSE);
include 'config_open_db.php';

	include("bitacora.php");
			$accion="ReporteIntegracionConsejo TODOS CENTRAL";
			bitacora($accion);

$iddistrito=$_POST[distrito];
$n_sesion=$_REQUEST[nosesion];
$t_sesion=$_REQUEST[tiposesion];
$desc=$_REQUEST[descsesion];
//echo $desc;


     

  
include 'arreglos.php';

$sql_consultad = "Select id_sesion, fecha_inicio_prog from sisesecd_sesiones where nosesion=$n_sesion and tipo_sesion=$t_sesion and desc_sesion=$desc and id_distrito!=40";
$fechita = sqlsrv_query($conn, $sql_consultad);
$resultado=sqlsrv_fetch_array($fechita);
//echo $sql_consultad;
$fecha_ses=$resultado['fecha_inicio_prog'];
$fecha_hoy= date('Y-n-d');
$fecha_partida=explode("-", $fecha_hoy);

$anio=$fecha_partida[0];
$mes=$fecha_partida[1];
$dia=$fecha_partida[2];

echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo"<th colspan=10>";
echo "</th>";
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
echo "<font style='font-size:14px;font-weight:bold;'>".$nom_sesion[$n_sesion]." SESION DE LOS CONSEJOS DISTRITALES ($tipo_ses[$t_sesion] 0$desc)<br></font><br>";
echo "</th>";
echo "</tr>";

echo "<tr> ";
echo "<td colspan=10 align='center'>";
echo "<font style='font-size:14px;font-weight:bold;'>FECHA: ".$dia." DE ",$month[$mes]." DEL " .$anio." </font><br>";
echo "</td>";
echo "</tr>";
echo"<th colspan=30>";

echo "</th>";
echo "</br>";
echo '<tr>';
echo "<th class='borde_tabla'>Num.</th>";
echo "<th class='borde_tabla'>Distrito</th>";
echo "<th class='borde_tabla'>Cargo o Partido Pol&iacute;tico</th>";
echo "<th class='borde_tabla'>Nombre </th>";
echo "<th class='borde_tabla'>Apellido Paterno</th>";
echo "<th class='borde_tabla'>Apellido Materno </th>";
echo "<th class='borde_tabla'>Tipo de Acreditacion</th>";
//echo "<th class='borde_tabla'>Nombre del Representante</th>";
//echo "<th class='borde_tabla'>Puesto de Representante</th>";


echo "</tr>";
echo "</table>";

echo "<table border=1 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";

$sql_consulta = "SELECT s.id_distrito, s.id_sesion, s.nosesion, s.desc_sesion, s.tipo_sesion, f.id_integrante, f.nombre,f.ap_paterno,f.ap_materno,f.tipo_acredor, f.id_integrante, f.candidato, f.puesto 
FROM sisesecd_sesiones as s, sisesecd_cat_funcionarios as f 
WHERE s.id_sesion=f.id_sesion order by id_distrito asc";

$consulta_sesiones = sqlsrv_query($conn, $sql_consulta);
//echo $sql_consulta;

$i=0;
		while($rowsesion = sqlsrv_fetch_array($consulta_sesiones))
		{
	
		$i++;	
		echo "<tr>" ;
		echo "<td>"	.$i."</td>";
		echo "<td>"	.$rowsesion['id_distrito']."</td>";
		echo "<td>"	.$tipo_cand[$rowsesion['id_integrante']]."</td>";
	    echo "<td>".utf8_decode($rowsesion['nombre'])."</td>";
		echo "<td>".utf8_decode($rowsesion['ap_paterno'])."</td>";
		echo "<td>".utf8_decode($rowsesion['ap_materno'])."</td>";
		echo "<td>".$rowsesion['tipo_acredor']."</td>";
		//echo "<td>".$rowsesion['candidato']."</td>";
		//echo "<td>".$rowsesion['puesto']."</td>";
		echo "</tr>";
		
		}// cierro el primer while 
	

echo "</table>";
?>