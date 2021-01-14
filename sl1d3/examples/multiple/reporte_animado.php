<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
<title>SISESECD-Reporte de Seguimiento a sesiones</title>
	
	<style type="text/css" media="screen">
	
.borde_tabla {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight:bold;
	color: #FFF;
	text-align: center;
	background-color: #666666;
	border: thin solid #666;
}
.resultados {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #333;
	text-align: center;
	background-color: #FFF;
	border: thin solid #666;
}
.titulos {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: #000;
	text-align: center;
}
p {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #CCC;
	background-color: #333;
}
h3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: #FFF;
	background-color: #666666;
}
.bg {
	background-color: #DBDBDB;
}
body {
	text-align: center;
	background-color: #FFF;
	width: 1170px;
}
		
#slides .slides_container {
	
	width:700px;
	height:1140px;
	display:none;

}
#slides {
	float: right;
	height: 1190px;
	width: 600px;
}

h1 {
	font-family: Arial, Helvetica, sans-serif;
	text-align: center;
	font-weight:bold;
	font-size: 14px;
}
#footer {
	text-align: center;
}
#encabezado {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #666;
	background-color: #FFF;
}

		
		
		#slides .slides_container div {
			width:400px;
			
			display:block;
		}
		
		/*
			Slides container
			Important:
			Set the width of your slides container
			Set to display none, prevents content flash
		*/
		#slides_two .slides_container {
			width:250px;
			display:none;
		}

		/*
			Each slide
			Important:
			Set the width of your slides
			If height not specified height will be set by the slide content
			Set to display block
		*/
		
		#slides_two .slides_container div {
			width:250px;
			height:250px;
			display:block;
		}
		
		/*
			Slides container
			Important:
			Set the width of your slides container
			Set to display none, prevents content flash
		*/
		#slides_three .slides_container {
			width:200px;
			display:none;
		}

		/*
			Each slide
			Important:
			Set the width of your slides
			If height not specified height will be set by the slide content
			Set to display block
		*/
		
		#slides_three .slides_container div {
			width:200px;
			height:100px;
			display:block;
		}
		
		/* 
			Example only
		*/
		.pagination {
	list-style:none;
	margin:0;
	padding:0;
	font-family: Arial, Helvetica, sans-serif;
	color: #FFF;
	font-weight:bold;
	text-decoration: none;
	background-color: #FFF;
		}
.prev {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFF;
	background-color: #666;
	padding: 10px;
	text-decoration: none;
	border: thin solid #FFF;
}
		.pagination .current a {
	color:#FFF;
		}

.division {
	border-right-width: thin;
	border-right-style: solid;
	border-right-color: #999;
}
    
.pagination a {
	color:#FFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.pagination a:visited {
	color:#FFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
    .pagination a:hover {
	color:#FFF;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
    .next {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #FFF;
	background-color: #666;
	padding: 10px;
	text-decoration: none;
	border: thin solid #FFF;
}
    </style>
	<script>
function refresca(){
	/*var tiempo=60000;
	if(diap>1)
	var tiempo=10000*diap;*/
	setTimeout("location.reload(true);",200000);
	//setInterval("location.reload(true);",tiempo);
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script src="js/slides.min.jquery.js"></script>
	
	<script>
		$(function(){
			$('#slides').slides({
				generatePagination:false,
				generateNextPrev: true,
				play: 10000,
				
			});
		});
	</script>
</head>
<?php
	error_reporting(E_ERROR | E_PARSE);					
		require("config_open_db.php");
		include ("funciones.php");
		include ("arreglos.php");
	
		$nosesion=$_REQUEST[nosesion];
		$typesess=$_REQUEST[tiposesion];
		$descsesion=$_REQUEST[descsesion];

$sql_fecha="select current as fecha
from systables
where tabid=1";
$r_fecha=sqlsrv_query($conn, $sql_fecha);
$d_date=sqlsrv_fetch_array ($r_fecha);
$fecha_act=$d_date[fecha];


//echo $sql_estado;

$sql_inicio="select * FROM sisesecd_sesiones as s,sisesecd_inicio as i
WHERE s.id_sesion=i.id_sesion 
and s.id_sesion in(select id_sesion from sisesecd_sesiones 
									where nosesion=$nosesion 
									and tipo_sesion=$typesess
									and desc_sesion=$descsesion
									and id_distrito!=40
									and estatus=1)order by s.id_distrito ASC;";
$r_inicio=sqlsrv_query($conn, $sql_inicio);
//echo $sql_inicio;

$head=sqlsrv_query($conn, $sql_inicio);
$undato = sqlsrv_fetch_array ($head);
$fecha=$undato[fecha_inicio_real];



//echo $sql_participaciones;



?>
<body onLoad="javascript:refresca()">

<div id="encabezado">
<table width="1170" align="center" >
<tr>
<td width="233" align="center">
<img src="../../../images/IECM_peq.png"  alt="logoiedf" width="175" height="122">
</td>
<td width="925" align="center">
<h1>SECRETARIA EJECUTIVA</h1>
<h1>DIRECCIÓN EJECUTIVA DE ORGANIZACIÓN ELECTORAL Y GEOESTADÍSTICA</h1>
<h1>PROCESO ELECTORAL ORDINARIO 2020-2021</h1>
<?php
echo "<h1>".$nom_sesion[$nosesion]." SESIÓN DE LOS CONSEJOS DISTRITALES (".$tipo_ses[$typesess]." 0".$descsesion." )</h1>";
?>
<h1>Sesi&oacute;n celebrada el: <?php echo $fecha ?></h1>
</td>
</tr>
</table>
</div>


<table >
<tr>
<td >
<div id="generales" >
<?php
echo "<h3>REPORTE DE SEGUIMIENTO A LA SESION</h3>";

echo "<table id='gral' width='100%' border=1 >";
echo "<tr>";
echo '<td align="center" class="borde_tabla" rowspan=2>Dtto</td>';
echo  '<td align="center" class="borde_tabla" rowspan=2>hora inicio</td>';
echo '<td class="borde_tabla" rowspan=2>Hora fin</td>';
echo  '<td class="borde_tabla" rowspan=2>Duracion hh:mm</td>';
echo  '<td align="center" class="borde_tabla" rowspan=2>Incidentes</td>';
echo  '<td align="center" class="borde_tabla" rowspan=2>Intervenciones</td>';
echo   '<td align="center" class="borde_tabla" rowspan=2>Status</td>';
echo "</tr>";
echo "<tr>";
echo "</tr>";

$indice=0;	

while($datos = sqlsrv_fetch_array ($r_inicio))
{
	
	
	echo '<tr>';
	echo'<td align="center" class="resultados">'.$datos[id_distrito].'</td>';
	echo'<td align="center" class="resultados">'.$datos[hora_inicio_real].'</td>';
	

	if($datos[con_fin]==1){
		$sql_fin="select f.id_fin, f.id_sesion, f.fecha_inicio_final, f.hora_fin_final, f.qf_cp, f.qf_c1, f.qf_c2, f.qf_c3, f.qf_c4, f.qf_c5, f.qf_c6, f.qf_se, f.qf_pan_p, f.qf_pan_s, f.qf_pri_p, f.qf_pri_s, f.qf_prd_p, f.qf_prd_s, f.qf_pt_p, f.qf_pt_s, f.qf_pvem_p, f.qf_pvem_s, f.qf_pmc_p, f.qf_pmc_s, f.qf_pna_p, f.qf_pna_s, f.qf_pes_p, f.qf_pes_s, f.qf_ph_p, f.qf_ph_s, f.qf_morena_p, f.qf_morena_s, f.qf_ci1_p, f.qf_ci1_s, f.qf_ci2_p, f.qf_ci2_s, f.qf_ci3_p, f.qf_ci3_s, f.qf_prensa, f.qf_radio, f.qf_tv, quorumfin, CAST(f.observafin as CHAR(2048))as observafin from sisesecd_fin as f where id_sesion in( 
								select id_sesion from sisesecd_sesiones 
								where nosesion=$nosesion 
									and tipo_sesion=$typesess
									and desc_sesion=$descsesion
									and id_distrito=$datos[id_distrito]
									and estatus=1);";

$r_final=sqlsrv_query($conn, $sql_fin);
//echo $sql_fin;
		$index=0;
		while($data = sqlsrv_fetch_array ($r_final))
		{
			$duracion=calcular_tiempo($data[hora_fin_final],$datos[hora_inicio_real]);
			
			echo'<td align="center" class="resultados">'.$data[hora_fin_final].'</td>';
			echo'<td align="center" class="resultados">'.$duracion.'</td>';
			$index++;
		}
	}else{
		echo '<td class="resultados">horafin n/d </td>';
		echo '<td class="resultados">duracion n/d</td>';
	}
	
	if($datos[con_incidente]==1){
		$sql_incidentes="select FIRST 1 s.id_sesion, s.id_distrito, s.nosesion, s.desc_sesion, s.tipo_sesion,
s.fecha_inicio_prog, s.hora_inicio_prog, s.con_inicio, s.con_orden, s.con_votos, s.con_intervencion, s.con_incidente,
s.con_fin, s.estatus, CAST(inci.incidente as CHAR(2084)) as incidente from sisesecd_sesiones as s, sisesecd_incidentes as inci WHERE  s.id_sesion=inci.id_sesion
	and s.id_sesion  in( select id_sesion from sisesecd_sesiones 
									where nosesion=$nosesion 
									and tipo_sesion=$typesess
									and desc_sesion=$descsesion
									and id_distrito=$datos[id_distrito]
									and estatus=1)
									order by inci.id_incidentes desc;";
//echo sql_incidentes;
		$r_incidentes=sqlsrv_query($conn, $sql_incidentes);
		$in=0;
		while($dato = sqlsrv_fetch_array ($r_incidentes))
		{
	
		echo'<td align="center" class="resultados">'.$dato[incidente].'</td>';
		//echo'<td align="center" class="resultados">'.$datos[intervenciones.intervencion].'</td>';
		$in++;
		}
	}else{
		echo '<td class="resultados">incidente n/d</td>';
		
	}
	
	if($datos[con_intervencion]==1){
		$sql_participaciones ="SELECT  FIRST 1 s.id_sesion, s.id_distrito, s.nosesion, s.desc_sesion, s.tipo_sesion,
s.fecha_inicio_prog, s.hora_inicio_prog, s.con_inicio, s.con_orden, s.con_votos, s.con_intervencion, s.con_incidente,
s.con_fin, s.estatus, CAST(inter.intervencion as CHAR(2084)) as intervencion FROM sisesecd_sesiones as s, sisesecd_intervenciones as inter 
	WHERE s.id_sesion=inter.id_sesion
	and s.id_sesion in( select id_sesion from sisesecd_sesiones 
						where nosesion=$nosesion 
						and tipo_sesion=$typesess
						and desc_sesion=$descsesion
						and id_distrito=$datos[id_distrito]
						and estatus=1)
						order by inter.id_intervencion desc;";

$r_participaciones=sqlsrv_query($conn, $sql_participaciones);
//echo $sql_participaciones;
		$ind=0;
		while($dat = sqlsrv_fetch_array ($r_participaciones))
		{
	
		echo'<td align="center" class="resultados">'.$dat[intervencion].'</td>';
		$ind++;
		}
	}else{
		echo '<td class="resultados">intervencion n/d</td>';
		
	}
	//if($datos[estado_sesion]!=""){
		$sql_estado="select FIRST 1 *
				from sisesecd_estado_sesion
				where id_sesion in
				(select id_sesion from sisesecd_sesiones 
								where nosesion=$nosesion 
								and tipo_sesion=$typesess
								and desc_sesion=$descsesion
								and id_distrito=$datos[id_distrito]
								and estatus=1)
								group by id_estado,id_sesion,id_distrito,
								estado_sesion,descripcion,hora_inicio,hora_termino,fecha_alta
								order by id_estado desc;";
	$r_estado=sqlsrv_query($conn, $sql_estado);
	//echo $sql_estado;
	
		while($datos = sqlsrv_fetch_array ($r_estado))
		{
			echo'<td align="center" class="resultados">'.utf8_encode($edo_sesion[$datos[estado_sesion]]).'</td>';
		}
	//}else{
		//echo '<td class="resultados">estado n/d</td>';
	//}
	echo '</tr>';
	$indice++;
}

echo "</table>";
?>
</div>
</td>
<td style="vertical-align: top">

<div id="slides">
<div class="slides_container">
     			
                <?php
//query para la votacion

$sql_pto_a="select punto from sisesecd_ordendia as o, sisesecd_sesiones as s where o.id_sesion=s.id_sesion 
and o.estatus=1 and s.estatus=1 and con_votos=1 and o.id_sesion in( select id_sesion from sisesecd_sesiones 
												where nosesion=$nosesion 
												and estatus=1 
												and con_votos=1 
												and tipo_sesion=$typesess
												and id_distrito!=40
												and desc_sesion=$descsesion) 
												group by punto
												order by punto";

$r_dots=sqlsrv_query($conn, $sql_pto_a);
//echo $sql_pto_a;

$i=0;
;

while($dots= sqlsrv_fetch_array ($r_dots)){

$arreglo[$i]=$dots[punto];
$i++;

}

$size=count($arreglo);
//echo $size;
$ip=0;
for ($ip=0;$ip<$size;$ip++){

$sql2 ="SELECT o.id_orden,0.id_sesion,punto,
CAST(desc_punto as CHAR(2048)) as desc_punto, o.estatus, voto_cp, voto_c1, voto_c2, voto_c3, voto_c4, voto_c5, voto_c6, observa_punto, s.id_sesion, s.id_distrito, nosesion, desc_sesion, tipo_sesion, fecha_inicio_prog, hora_inicio_prog, con_inicio,con_orden, con_votos, con_intervencion, con_incidente, con_fin, s.estatus, id_inicio, i.id_sesion, fecha_inicio_real, hora_inicio_real, qi_cp, qi_c1, qi_c2, qi_c3, qi_c4, qi_c5, qi_c6, qi_se, qi_pan_p, qi_pan_s, qi_pri_p, qi_pri_s,
qi_prd_p, qi_prd_s, qi_pt_p, qi_pt_s, qi_pvem_p, qi_pvem_s, qi_pmc_p, qi_pmc_s, qi_pna_p, qi_pna_s, qi_pes_p, qi_pes_s, qi_ph_p, qi_ph_s, qi_morena_p, qi_morena_s, qi_ci1_p, qi_ci1_s, qi_ci2_p, qi_ci2_s, qi_ci3_p, qi_ci3_s, qi_prensa, qi_radio, qi_tv, observaini 
FROM sisesecd_ordendia as o, sisesecd_sesiones as s, sisesecd_inicio as i
	WHERE s.id_sesion=o.id_sesion
	and s.id_sesion=i.id_sesion
	and o.punto='$arreglo[$ip]'
	and o.estatus=1
	and o.para_votar=1
	and s.id_sesion in( select id_sesion from sisesecd_sesiones where nosesion=".$nosesion." 
						and estatus=1 and con_votos=1 and tipo_sesion=".$typesess."
						and desc_sesion=".$descsesion."
						and id_distrito!=40)";


$sql_cuantos="SELECT count(*)as cuantos FROM sisesecd_ordendia as o, sisesecd_sesiones as s, sisesecd_inicio as i
WHERE s.id_sesion=o.id_sesion
and s.id_sesion=i.id_sesion
and o.punto=$arreglo[$ip]
and o.estatus=1
and s.id_sesion in(
select id_sesion from sisesecd_sesiones where nosesion=$nosesion and estatus=1 and con_votos=1 and tipo_sesion=$typesess and desc_sesion=$descsesion and id_distrito!=40)";
$conteo=sqlsrv_query($conn, $sql_cuantos);
$cuantos=sqlsrv_fetch_array ($conteo);
$cuantos1=$cuantos[cuantos];
//echo $sql_cuantos;
//echo $sql2;
//$result=ifx_query($sql,$conn);

$result=sqlsrv_query($conn, $sql2);
$undato=sqlsrv_fetch_array ($result);

$fecha=$undato[fecha_inicio_real];

$descripcion=$undato[desc_punto];
$desc=$undato[desc_sesion];
$pto=$undato[punto];

$res=sqlsrv_query($conn, $sql2);

$total=0;
$total6=0;
$total5=0;
$total4=0;
$afavor=0;
$encontra=0;
$excusa=0;
$grantotal=0;
$totalfav=0;
$totalcon=0;
eval("\$descripcion = \"$descripcion\";");
?>

<div>

	<?php			
                echo "<h3>SENTIDO DE LA VOTACION&nbsp;&nbsp;&nbsp;&nbsp;PUNTO:".$pto."</h3><p class='resultados'>".utf8_encode($descripcion)
."</p>";
                
	
				echo "<table id='votos'>";
		echo "<tr>";
		if($cuantos1>=1){
			echo '<td width=220 rowspan=2 class="borde_tabla"><strong>DTTO</strong></td>';
			echo '<td colspan=3 class="borde_tabla"><strong>SENTIDO DE LA VOTACI&Oacute;N</strong></td>';
			echo '<td width=220 rowspan=2 class="borde_tabla"><strong>OBSERVACIONES</strong></td>';
		echo "</tr>";

		echo "<tr>";
			echo '<td width=135 class="borde_tabla"><strong>A FAVOR</strong></td>';
			echo '<td width=114 class="borde_tabla"><strong>EN CONTRA</strong></td>';
			echo '<td width=114 class="borde_tabla"><strong>EXCUSA</strong></td>';
		echo "</tr>";
		$indice=0;	

while($datos = sqlsrv_fetch_array ($res))
{
	
	
	$distrito=$datos[id_distrito];
	
	$votocp=$datos[voto_cp];
	if($votocp==1)
		$afavor++;
	if($votocp==2)
		$encontra++;
	if($votocp==3)
		$excusa++;
		

	$votoc1=$datos[voto_c1];
	if($votoc1==1)
		$afavor++;
	if($votoc1==2)
		$encontra++;
	if($votoc1==3)
		$excusa++;
	
	$votoc2=$datos[voto_c2];
	if($votoc2==1)
		$afavor++;
	if($votoc2==2)
		$encontra++;
	if($votoc2==3)
		$excusa++;

	$votoc3=$datos[voto_c3];
	if($votoc3==1)
		$afavor++;
	if($votoc3==2)
		$encontra++;
	if($votoc3==3)
		$excusa++;
		
		
	$votoc4=$datos[voto_c4];
	if($votoc4==1)
		$afavor++;
	if($votoc4==2)
		$encontra++;
	if($votoc4==3)
		$excusa++;
	
	$votoc5=$datos[voto_c5];
	if($votoc5==1)
		$afavor++;
	if($votoc5==2)
		$encontra++;
	if($votoc5==3)	
		$excusa++;
	
	$votoc6=$datos[voto_c6];
	if($votoc6==1)
		$afavor++;
	if($votoc6==2)
		$encontra++;
	if($votoc6==3)
		$excusa++;

	$array_f[$indice]=$afavor;
	$array_c[$indice]=$encontra;
	$array_d[$indice]=$excusa;
		
	
	$observaini =  utf8_decode(htmlspecialchars(trim($datos[observapunto])));
	
	//echo'<tr>';
	
			if($afavor==6 )
				$total6++;			
			
			if($afavor==5 )
				$total5++;
				
			if($afavor==7 )
				$total++;

			if($afavor==4 )
				$total4++;	
			
			echo'<td align="center" class="resultados" width=15>'.$distrito.'</td>';
			if($afavor==0 && $encontra==0 && $excusa==0){
				echo '<td align="center" class="resultados"> no existen datos de votación.</td>';
				echo '<td align="center" class="resultados"> no existen datos de votación.</td>';
				echo '<td align="center" class="resultados"> no existen datos de votación.</td>';
			}else{
				
			echo'<td align="center" class="resultados">'.$afavor.'</td>';
			echo'<td align="center" class="resultados">'.$encontra.'</td>';
			echo'<td align="center" class="resultados">'.$excusa.'</td>';
			}
				
			echo'<td align="center" class="resultados">'.utf8_encode($observaini).'</td>';
				
			
			$grantotal=$total+$total5+$total6+$total4;
		
	echo'</tr>';
	
	$afavor=0;
	$encontra=0;
	$excusa=0;
	$indice++;
}


//echo "<tr>";
//echo "</tr>";
echo "<tr>";
echo "</tr>"; 
//echo "<tr>";
//echo'<td align="center" colspan="33">'.utf8_decode(htmlspecialchars(Footer())).'</td>';
//echo "</tr>";
echo "</table>";
echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo "<tr>";
echo "<td height=30></td>";
echo "</tr>";
echo "<tr>";
echo "<td width=100></td>";
echo "<td width=100></td>";
echo '<td colspan=2 class="borde_tabla">TOTALES VOTACI&Oacute;N</td>';
echo "<td></td>";
echo '<td colspan=2  class="borde_tabla">CONCENTRADO</td>';
echo "</tr>";

echo "<tr>";
echo "<td width=100></td>";
echo "<td width=100></td>";
echo '<td class="borde_tabla">VOTACI&Oacute;N</td>';
echo '<td class="borde_tabla">No. Dttos.</td>';
echo "<td></td>";

echo '<td class="resultados">A FAVOR</td>';
if($cuantos1>=1){
echo '<td class="resultados">'.array_sum($array_f)."</td>";
}else{
echo '<td class="resultados">NO HAY DATOS DE VOTACI&Oacute;N</td>';
}	
echo "</tr>";
echo "<tr>";
echo "<td width=100></td>";
echo "<td width=100></td>";
echo '<td class="resultados">Unanimidad con 7 votos</td>';
echo '<td class="resultados">'.$total.'</td>';
echo "<td></td>";

echo '<td class="resultados">EN CONTRA</td>';
if($cuantos1<1){
	echo '<td class="resultados">NO HAY DATOS DE VOTACI&Oacute;N</td>';
}else{
	echo '<td class="resultados">'.array_sum($array_c).'</td>';
}
echo "</tr>";
echo "<tr>";
echo "<td width=100></td>";
echo "<td width=100></td>";
echo '<td class="resultados">Unanimidad o Mayor&iacute;a con 6 votos</td>';
echo '<td class="resultados">'.$total6.'</td>';
echo "<td></td>";
echo '<td class="resultados">EXCUSA</td>';
	if($cuantos1<1){
		echo '<td class="resultados">NO HAY DATOS DE VOTACI&Oacute;N</td>';
	}else{
		echo '<td class="resultados">'.array_sum($array_d).'</td>';
	}
echo "</tr>";
echo "<tr>";
echo "<td width=100></td>";
echo "<td width=100></td>";
echo '<td class="resultados">Unanimidad o Mayor&iacute;a con 5 votos</td>';
echo '<td class="resultados">'.$total5.'</td>';
echo "</tr>";
echo "<tr>";
echo "<td width=100></td>";
echo "<td width=100></td>";
echo '<td class="resultados">Unanimidad o Mayor&iacute;a con 4 votos</td>';
echo '<td class="resultados">'.$total4.'</td>';
echo "</tr>";
echo "<tr>";
echo "<td width=100></td>";
echo "<td width=100></td>";
echo '<td class="resultados">TOTAL</td>';
echo '<td class="resultados">'.$grantotal.'</td>';
echo "</tr>";
}else{
echo '<td class="resultados">NO HAY DATOS DE VOTACI&Oacute;N</td>';
}
echo "</table>";
	?>
   
 </div>
  <?php
   	$array_f[$indice]=0;
	$array_c[$indice]=0;
	
    }
	?>
	</div>

 </div>

</td>
</tr>
</table>
   <div id="footer">
   		<p>Fecha y hora de la &uacute;ltima actualizaci&oacute;n:<?php echo $fecha_act ?></p>
   </div>
</body>
</html>
