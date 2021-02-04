<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
<title>SISESECD-Reporte de Seguimiento a las Sesiones</title>

	
	<style type="text/css" media="screen">
	
.borde_tabla {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight:bold;
	color: #FFF;
	text-align: center;
	background-color: #666;
	border: thin solid #666;
	vertical-align:middle	
}
.peque {
	background-color: #FFF;
	border: thin solid #999;
}
.resultados {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #666;
	text-align: center;
	background-color: #FFF;
	border: thin solid #999;
}

.celdita{
	vertical-align:middle	
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
	background-color: #39374A;
}
h3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	color: #FFF;
	background-color: #4E4B65;
}
.bg {
	background-color: #DBDBDB;
}
body {
	text-align: center;
	background-color: #4E4B65;
	width: 1170px;
}
#gral {
	background-color: #FFF;
}
#votos {
	background-color: #FFF;
}
		/*
			Load CSS before JavaScript
		*/
		
		/*
			Slides container
			Important:
			Set the width of your slides container
			Set to display none, prevents content flash
		*/
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
	color: #FFF;
	background-color: #39374A;
}
.tablita {
	border: thin solid #CCC;
	
}
#footer {
	text-align: center;
	padding-top: 20px;
}
#encabezado {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #FFF;
	background-color: #39374A;
	margin-left: 50px;
}

		/*
			Each slide
			Important:
			Set the width of your slides
			If height not specified height will be set by the slide content
			Set to display block
		*/
		
		#slides .slides_container div {
			width:570px;
			
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
		
	#generales {
	height: 800px;
	width: 470px;
	float: left;
	margin-left: 30px;
	padding-left: 30px;	
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


    .cuadrito {
	font-family: Arial, Helvetica, sans-serif;
	background-color: #39374A;
	color: #FFF;
	font-size: 10px;
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
<link rel="stylesheet" href="jquery-tooltip/jquery.tooltip.css" />
<link rel="stylesheet" href="jquery-tooltip/demo/screen.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="js/slides.min.jquery.js"></script>
    <script src="jquery-tooltip/jquery.tooltip.js" type="text/javascript"></script>
	
	<script>
		$(function(){
			$('#slides').slides({
				generatePagination:false,
				generateNextPrev: true,
				play: 10000,
				
			});
			
		});
	</script>
    <script type="text/javascript">
$(function() {

$("#fancy, #fancy2").tooltip({
	track: true,
	delay: 0,
	showURL: false,
	fixPNG: true,
	showBody: " - ",
	extraClass: "pretty fancy",
	top: -15,
	left: 5
});

$('#pretty').tooltip({
	track: true,
	delay: 0,
	showURL: false,
	showBody: " - ",
	extraClass: "pretty",
	fixPNG: true,
	left: -120
});

});
</script>
</head>
<?php
						
		require("config_open_db.php");
		include ("funciones.php");
		//include ("arreglos.php");
		$nosesion=$_REQUEST[nosesion];
		$typesess=$_REQUEST[tiposesion];
		$descsesion=$_REQUEST[descsesion];

$sql_fecha="select current as fecha
from systables
where tabid=1";
$r_fecha=ifx_query($sql_fecha,$conn);
$d_date=ifx_fetch_row ($r_fecha);
$fecha_act=$d_date[fecha];


//echo $sql_estado;

$sql_inicio="select s.id_sesion,s.id_distrito,nosesion,desc_sesion,tipo_sesion,
fecha_inicio_prog,hora_inicio_prog,con_inicio,con_orden,con_votos,con_intervencion,con_incidente,
con_fin,estatus,id_inicio,i.id_sesion,fecha_inicio_real,hora_inicio_real,
qi_cp,qi_c1,qi_c2,qi_c3,qi_c4,qi_c5,qi_c6,qi_se,qi_pan_p,qi_pan_s,qi_pri_p,qi_pri_s,qi_prd_p,qi_prd_s,
qi_pt_p,qi_pt_s,qi_pvem_p,qi_pvem_s,qi_pmc_p, qi_pmc_s, qi_pna_p, qi_pna_s, qi_pes_p, qi_pes_s, qi_ph_p, qi_ph_s, qi_morena_p, qi_morena_s, qi_ci1_p, qi_ci1_s, qi_ci2_p, qi_ci2_s, qi_ci3_p, qi_ci3_s, qi_prensa, qi_radio, qi_tv, CAST(observaini as CHAR(2084))as observaini,quorumini,asistencia
FROM sisesecd_sesiones as s,sisesecd_inicio as i
WHERE s.id_sesion=i.id_sesion 
and s.id_sesion in(select id_sesion from sisesecd_sesiones 
									where nosesion=$nosesion 
									and tipo_sesion=$typesess
									and desc_sesion=$descsesion
									and id_distrito!=41
									and estatus=1)order by s.id_distrito ASC;";
						 
$r_inicio=ifx_query($sql_inicio,$conn);
//echo $sql_inicio;
$head=ifx_query($sql_inicio,$conn);
$undato = ifx_fetch_row ($head);
$fecha=$undato[fecha_inicio_real];

	$iniciada=0;
	$sinquorum=0;
	$segunda=0;
	$concluida=0;
	$receso=0;
	$conc_receso=0;
	$suspendida=0;
	$reanudada=0;
	$prolongada=0;
	$fe=date_create($fecha);
	//$f1=date_format($fe, 'Y-m-d');
	$f=date_format($fe, 'd-m-Y');
	//echo $f;
	
$sql_count_estado="select count(*) as iniciadas from sisesecd_inicio where id_sesion in(
														select id_sesion from sisesecd_sesiones 
															where nosesion=$nosesion 
															and tipo_sesion=$typesess
															and desc_sesion=$descsesion
															and id_distrito!=41
															and estatus=1)";
$r_iniciadas=ifx_query($sql_count_estado,$conn);
$d_iniciadas=ifx_fetch_row($r_iniciadas);
$iniciada=$d_iniciadas[iniciadas];

$sql_count_estado2="select count(*) as cuantas from sisesecd_estado_sesion where estado_sesion=2 and id_sesion in (
																		select id_sesion from sisesecd_sesiones 
																			where nosesion=$nosesion 
																			and tipo_sesion=$typesess
																			and desc_sesion=$descsesion
																			and id_distrito!=41
																			and estatus=1)";
$r_sinq=ifx_query($sql_count_estado2,$conn);
$d_sinq=ifx_fetch_row($r_sinq);
$sinquorum=$d_sinq[cuantas];
//echo $sql_participaciones;

$sql_count_estado3="select count(*) as cuantas2 from sisesecd_estado_sesion where estado_sesion=3 and id_sesion in 
					(
 					select id_sesion from sisesecd_sesiones 
									where nosesion=$nosesion 
									and tipo_sesion=$typesess
									and desc_sesion=$descsesion
									and id_distrito!=41
									and estatus=1)";
$r_dos=ifx_query($sql_count_estado3,$conn);
$d_dos=ifx_fetch_row($r_dos);
$segunda=$d_dos[cuantas2];

$sql_count_estado4="select count(*) as cuantas3 from sisesecd_fin where id_sesion in (
													select id_sesion from sisesecd_sesiones 
														where nosesion=$nosesion 
														and tipo_sesion=$typesess
														and desc_sesion=$descsesion
														and id_distrito!=41
														and estatus=1)";
$r_conc=ifx_query($sql_count_estado4,$conn);
$d_conc=ifx_fetch_row($r_conc);
$concluida=$d_conc[cuantas3];

$sql_count_estado5="select count(*) as cuantas4 from sisesecd_estado_sesion where estado_sesion=5 and id_sesion in (
													select id_sesion from sisesecd_sesiones 
														where nosesion=$nosesion 
														and tipo_sesion=$typesess
														and desc_sesion=$descsesion
														and id_distrito!=41
														and estatus=1)";
$r_receso=ifx_query($sql_count_estado5,$conn);
$d_receso=ifx_fetch_row($r_receso);
$receso=$d_receso[cuantas4];

$sql_count_estado6="select count(*) as cuantas5 from sisesecd_estado_sesion where estado_sesion=6 and id_sesion in (
														select id_sesion from sisesecd_sesiones 
															where nosesion=$nosesion 
															and tipo_sesion=$typesess
															and desc_sesion=$descsesion
															and id_distrito!=41
															and estatus=1)";
$r_rc=ifx_query($sql_count_estado6,$conn);
$d_rc=ifx_fetch_row($r_rc);
$conc_receso=$d_rc[cuantas5];

$sql_count_estado7="select count(*) as cuantas6 from sisesecd_estado_sesion where estado_sesion=7 and id_sesion in
							(select id_sesion from sisesecd_sesiones 
									where nosesion=$nosesion 
									and tipo_sesion=$typesess
									and desc_sesion=$descsesion
									and id_distrito!=41
									and estatus=1)";
$r_suspendida=ifx_query($sql_count_estado7,$conn);
$d_suspendida=ifx_fetch_row($r_suspendida);
$suspendida=$d_suspendida[cuantas6];

$sql_count_estado8="select count(*) as cuantas7 from sisesecd_estado_sesion where estado_sesion=8 and id_sesion in 
																(select id_sesion from sisesecd_sesiones 
																					where nosesion=$nosesion 
																					and tipo_sesion=$typesess
																					and desc_sesion=$descsesion
																					and id_distrito!=41
																					and estatus=1)";
$r_reanudada=ifx_query($sql_count_estado8,$conn);
$d_reanudada=ifx_fetch_row($r_reanudada);
$reanudada=$d_reanudada[cuantas7];

$sql_count_estado9="select count(*) as cuantas8 from sisesecd_estado_sesion where estado_sesion=9 and id_sesion in 
												( select id_sesion from sisesecd_sesiones 
												 where nosesion=$nosesion 
												 and tipo_sesion=$typesess
												 and desc_sesion=$descsesion
												 and id_distrito!=41
												 and estatus=1)";
$r_prol=ifx_query($sql_count_estado9,$conn);
$d_prol=ifx_fetch_row($r_prol);
$prolongada=$d_prol[cuantas8];


?>
<body onLoad="javascript:refresca()">

<div id="encabezado">
<table width="1120" align="center" class="tablita">
<tr>
<td align="center"><img src="../../../images/logowIECM500x.png" width="165" height="127" ></td>
<td align="center" class="celdita">
<h1>SECRETARIA EJECUTIVA</h1>
<h1>DIRECCIÓN EJECUTIVA DE ORGANIZACIÓN ELECTORAL Y GEOESTADÍSTICA</h1>
<h1>PROCESO ELECTORAL ORDINARIO 2017-2018</h1>
<?php
echo "<h1>".$nom_sesion[$nosesion]." SESION DE LOS CONSEJOS DISTRITALES (".$tipo_ses[$typesess]." 0".$descsesion." )</h1>";
?>
<h1>Sesi&oacute;n celebrada el:<?php echo $fecha ?></h1>
</td>
</tr>
</table>
</div>
<div id="generales">
<?php
echo "<h3>REPORTESSSS DE SEGUIMIENTO A LA SESION</h3><hr>";
echo "<p><i>Pasa el mouse por los íconos, para ver la intervención,incidente y/o detalle de status.</i></p>";
echo "<table id='gral'>";
echo "<tr>";
echo '<td width=32  align="center" class="borde_tabla" rowspan=3>Dtto</td>';
echo  '<td width=52  align="center" class="borde_tabla" rowspan=3>hora inicio</td>';
echo '<td width=60  class="borde_tabla" rowspan=3>Hora fin</td>';
echo  '<td width=65  class="borde_tabla" rowspan=3>Duracion hh:mm</td>';
echo  '<td  align="center" class="borde_tabla" rowspan=3 width=50>Incidentes</td>';
echo  '<td width=71  align="center" class="borde_tabla" rowspan=3 width=50>Intervenciones</td>';
echo   '<td  align="center" class="borde_tabla" rowspan=2>Status</td>';
echo "</tr>";
echo "<tr>";
echo "</tr>";
echo "<tr>";


echo   '<td  align="center" class="borde_tabla"><span id="pretty" title="
<table> 
<tr>
<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;Estado&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</strong></td>
<td></td>
<td><strong>Dttos.</strong></td>
</tr> - 
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;Iniciaron: &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</td>
<td></td>
<td>'.number_format($iniciada,0).'</td>
</tr>

<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;Sin Quorum: &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;</td>
<td></td>
<td>'.number_format($sinquorum,0).'</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;2da. Convocatoria: &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td></td>
<td>'.number_format($segunda,0).'</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;Concluyeron: &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td></td>
<td>'.number_format($concluida,0).'</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;Tomaron Receso: &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td></td>
<td>'.number_format($receso,0).'</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;Concluyeron Receso: &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td></td>
<td>'.number_format($conc_receso,0).'</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;Suspendieron:&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td></td>
<td>'.number_format($suspendida,0).'</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;Reanudaron: &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td></td>
<td>'.number_format($reanudada,0).'</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;Prolongaron&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<td></td>
<td>'.number_format($prolongada,0).'</td>
</tr>
">
<img src="status.png" width="35" height="33">
</span>
</td>';
echo "</tr>";


$indice=0;	

while($datos = ifx_fetch_row ($r_inicio))
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

$r_final=ifx_query($sql_fin,$conn);
//echo $sql_fin;
		$index=0;
		while($data = ifx_fetch_row ($r_final))
		{
			$duracion=calcular_tiempo_trasnc($data[hora_fin_final],$datos[hora_inicio_real]);
			
			echo'<td align="center" class="resultados">'.$data[hora_fin_final].'</td>';
			echo'<td align="center" class="resultados">'.$duracion.'</td>';
			$index++;
		}
	}else{
		echo '<td class="resultados">n/d </td>';
		echo '<td class="resultados">n/d</td>';
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
$r_incidentes=ifx_query($sql_incidentes,$conn);
//echo $sql_incidentes;

		$in=0;
		while($dato = ifx_fetch_row ($r_incidentes))
		{
					
		/*if($dato[inter_cp]!=0 || $dato[inter_c1]!=0 || $dato[inter_c2]!=0 || $dato[inter_c3]!=0 || $dato[inter_c4]!=0 || $dato[inter_c5]!=0|| $dato[inter_c6]!=0 || $dato[inter_panp]!=0 || $dato[inter_pans]!=0 || $dato[inter_prip]!=0 || $dato[inter_pris]!=0 || $dato[inter_prdp]!=0 || $dato[inter_prds]!=0 || $dato[inter_ptp]!=0 || $dato[inter_pts]!=0 || $dato[inter_pvemp]!=0 || $dato[inter_pvems]!=0 || $dato[inter_pmcp]!=0 || $dato[inter_pmcs]!=0 || $dato[inter_pnap]!=0 || $dato[inter_pnas]!=0 || $dato[inter_pesp]!=0 || $dato[inter_pess]!=0 || $dato[inter_php]!=0 || $dato[inter_phs]!=0  || $dato[inter_morenap]!=0 || $dato[inter_morenas]!=0 || $dato[inter_ci1p]!=0 || $dato[inter_ci1s]!=0 || $dato[inter_ci2p]!=0 || $dato[inter_ci2s]!=0 || $dato[inter_ci3p]!=0 || $dato[inter_ci3s]!=0){*/
		//echo'<td align="center" class="resultados">'.substr($dato[intervencion],0,40).'</td>';
		echo'<td align="center" class="resultados"><span id="fancy" title="Intervención Dtto.'.$datos[id_distrito].' para el Punto: '.$dat[punto].'  -  '.$dato[incidente].'"><img src="check.png" width="25" height="20" /></span></td>';
		//echo'<td align="center" class="resultados">'.$datos[intervenciones.intervencion].'</td>';
		$in++;
		}
	}else{
		//echo '<td class="resultados">incidente n/d</td>';
		echo '<td class="resultados"><span id="fancy" title="Dtto.'.$datos[id_distrito].' - sin intervenciones relevantes"><img src="cross.png" width="25" height="26"></span></td>';
		
	}
	
	if($datos[con_intervencion]==1){
		$sql_participaciones ="SELECT FIRST 1 s.id_sesion, s.id_distrito, s.nosesion, s.desc_sesion, s.tipo_sesion,
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

$r_participaciones=ifx_query($sql_participaciones,$conn);
//echo $sql_incidentes;
		$ind=0;
		while($dat = ifx_fetch_row ($r_participaciones))
		{
			/*if($dat[inter_cp]!=0 || $dat[inter_c1] !=0 || $dat[inter_c2] !=0 || $dat[inter_c3] !=0 || $dat[inter_c4]!=0 || $dat[inter_c5]!=0 || $dat[inter_c6]!=0 || $dat[inter_panp]!=0 || $dat[inter_pans]!=0 || $dat[inter_prip]!=0 || $dat[inter_pris]!=0 || $dat[inter_prdp]!=0 || $dat[inter_prds]!=0 || $dat[inter_ptp]!=0 || $dat[inter_pts]!=0 || $dat[inter_pvemp]!=0 || $dat[inter_pvems]!=0 || $dat[inter_pmcp]!=0 || $dat[inter_pmcs]!=0 || $dat[inter_pnap]!=0 || $dat[inter_pnas]!=0 || $dat[inter_pesp]!=0 || $dat[inter_pess]!=0 || $dat[inter_php]!=0 || $dat[inter_phs]!=0  || $dat[inter_morenap]!=0 || $dat[inter_morenas]!=0 || $dat[inter_ci1p]!=0 || $dat[inter_ci1s]!=0 || $dat[inter_ci2p]!=0 || $dat[inter_ci2s]!=0 || $dat[inter_ci3p]!=0 || $dat[inter_ci3s]!=0 ){*/
	echo'<td align="center" class="resultados"><span id="fancy" title="Intervención Dtto.'.$datos[id_distrito].' para el Punto: '.$dat[punto].'  -  '.$dat[intervencion].'"><img src="check.png" width="25" height="20" /></span></td>';
		//echo'<td align="center" class="resultados">'.$datos[intervenciones.intervencion].'</td>';
		$in++;
		}
	}else{
		//echo '<td class="resultados">incidente n/d</td>';
		echo '<td class="resultados"><span id="fancy" title="Dtto.'.$datos[id_distrito].' - sin intervenciones relevantes"><img src="cross.png" width="25" height="26"></span></td>';
		
	}
	//if($datos[estado_sesion]!=""){
		$sql_estado="select FIRST 1 *
				from sisesecd_estado_sesion
				where id_sesion in
				( select id_sesion from sisesecd_sesiones 
				  where nosesion=$nosesion 
				  and tipo_sesion=$typesess
				  and desc_sesion=$descsesion
				 and id_distrito=$datos[id_distrito]
				 and estatus=1)
				 group by id_estado,id_sesion,id_distrito,
				estado_sesion,descripcion,hora_inicio,hora_termino,fecha_alta
				order by id_estado desc;";
	$r_estado=ifx_query($sql_estado,$conn);
	
	
	while($datos = ifx_fetch_row ($r_estado))
		{
		echo'<td align="center" class="resultados">'.utf8_encode($edo_sesion[$datos[estado_sesion]]).'</td>';
		}
			
	echo '</tr>';
	$indice++;
}

echo "</table>";
?>
</div>
<div id="slides">
<div class="slides_container">
     			
                <?php

$sql_pto_a="select punto from sisesecd_ordendia as o, sisesecd_sesiones as s where o.id_sesion=s.id_sesion 
and o.estatus=1 and s.estatus=1 and con_votos=1 and o.id_sesion in( select id_sesion from sisesecd_sesiones 
												where nosesion=$nosesion 
												and estatus=1 
												and con_votos=1 
												and tipo_sesion=$typesess
												and id_distrito!=41
												and desc_sesion=$descsesion) 
												group by punto
												order by punto";

$r_dots=ifx_query($sql_pto_a,$conn);
//echo $sql_pto_a;

$i=0;
;

while($dots= ifx_fetch_row ($r_dots)){

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
	and o.punto=$arreglo[$ip]
	and o.estatus=1
	and s.id_sesion in( select id_sesion from sisesecd_sesiones where nosesion=".$nosesion." 
						and estatus=1 and con_votos=1 and tipo_sesion=".$typesess."
						and desc_sesion=".$descsesion."
						and id_distrito!=41)";
						

$sql_cuantos="SELECT count(*)as cuantos FROM sisesecd_ordendia as o, sisesecd_sesiones as s, sisesecd_inicio as i
WHERE s.id_sesion=o.id_sesion
and s.id_sesion=i.id_sesion
and o.punto=$arreglo[$ip]
and o.estatus=1
and s.id_sesion in(
select id_sesion from sisesecd_sesiones where nosesion=$nosesion and estatus=1 and con_votos=1 and tipo_sesion=$typesess and desc_sesion=$descsesion and id_distrito!=41)";

$conteo=ifx_query($sql_cuantos,$conn);
$cuantos=ifx_fetch_row ($conteo);
$cuantos1=$cuantos[cuantos];
//echo $sql_cuantos;
//echo $sql2;
//$result=ifx_query($sql,$conn);
$result=ifx_query($sql2,$conn);
$undato=ifx_fetch_row ($result);
$fecha=$undato[fecha_inicio_real];
$descripcion=$undato[desc_punto];
$desc=$undato[desc_sesion];
$pto=$undato[punto];
$res=ifx_query($sql2,$conn);
$total=0;
$total6=0;
$total5=0;
$afavor=0;
$encontra=0;
$grantotal=0;
$excusa=0;
$totalfav=0;
$totalcon=0;
eval("\$descripcion = \"$descripcion\";");
?>
<div>
	<?php			
                echo "<h3>SENTIDO DE LA VOTACION&nbsp;&nbsp;&nbsp;&nbsp;PUNTO:".$pto."</h3><hr><p class='resultados'>".utf8_encode($descripcion)
."</p>";
                
	
				echo "<table id='votos'>";
		echo "<tr>";
		if($cuantos1>=1){
			echo '<td width=239 rowspan=2 class="borde_tabla"><strong>DTTO</strong></td>';
			echo '<td colspan=3 class="borde_tabla"><strong>SENTIDO DE LA VOTACI&Oacute;N</strong></td>';
			//echo '<td width=239 rowspan=2 class="borde_tabla"><strong>OBSERVACIONES</strong></td>';
		echo "</tr>";

		echo "<tr>";
			echo '<td width=135 class="borde_tabla"><strong>A FAVOR</strong></td>';
			echo '<td width=114 class="borde_tabla"><strong>EN CONTRA</strong></td>';
			echo '<td width=114 class="borde_tabla"><strong>EXCUSADOS</strong></td>';
		echo "</tr>";
		$indice=0;	

while($datos = ifx_fetch_row ($res))
{
	
	$distrito=$datos[id_distrito];
	$votocp=$datos[voto_cp];
	if($votocp==1)
		$afavor++;
	elseif($votocp==2)
		$encontra++;
	elseif($votocp==3)
		$excusa++;
		
	$votoc1=$datos[voto_c1];
	if($votoc1==1)
		$afavor++;
	elseif($votoc1==2)
		$encontra++;
	elseif($votoc1==3)
		$excusa++;
	
	$votoc2=$datos[voto_c2];
	if($votoc2==1)
		$afavor++;
	elseif($votoc2==2)
		$encontra++;
	elseif($votoc2==3)
		$excusa++;
		
	$votoc3=$datos[voto_c3];
	if($votoc3==1)
		$afavor++;
	elseif($votoc3==2)
		$encontra++;
	elseif($votoc3==3)
		$excusa++;
		
	$votoc4=$datos[voto_c4];
	if($votoc4==1)
		$afavor++;
	elseif($votoc4==2)
		$encontra++;
	elseif($votoc4==3)
		$excusa++;
		
	$votoc5=$datos[voto_c5];
	if($votoc5==1)
		$afavor++;
	elseif($votoc5==2)
		$encontra++;
	elseif($votoc5==3)
		$excusa++;
	
	$votoc6=$datos[voto_c6];
	if($votoc6==1)
		$afavor++;
	elseif($votoc6==2)
		$encontra++;
	elseif($votoc6==3)
		$excusa++;	

	
	$array_f[$indice]=$afavor;
	$array_c[$indice]=$encontra;
	$array_e[$indice]=$excusa;
	
	$observaini =  utf8_decode(htmlspecialchars(trim($datos[observapunto])));
	
	//echo'<tr>';
	
		
			if($afavor==6 || $encontra==6 || $excusa==6 )
				$total6++;			
			
			if($afavor==5 || $encontra==5 || $excusa==5)
				$total5++;
				
			if($afavor==7 || $encontra==7 || $excusa==7)
				$total++;
			
			echo'<td align="center" class="resultados" width=15>'.$distrito.'</td>';
			if($afavor==0 && $encontra==0 && $excusa==0){
				echo '<td align="center" class="resultados"> sin votación.</td>';
				echo '<td align="center" class="resultados"> sin votación.</td>';
				echo '<td align="center" class="resultados"> sin votación.</td>';
			}else{
				echo'<td align="center" class="resultados">'.$afavor.'</td>';
				echo'<td align="center" class="resultados">'.$encontra.'</td>';
				echo'<td align="center" class="resultados">'.$excusa.'</td>';
			}
				
			//echo'<td align="center" class="resultados">'.utf8_encode($observaini).'</td>';
				
			
		$grantotal=$total+$total5+$total6;
		
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

echo "</table>";
echo "<table border=0  style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo "<tr>";
echo "<td height=30></td>";
echo "</tr>";

echo "<tr>";
echo "<td width=100></td>";
echo "<td width=100></td>";
echo '<td colspan=2 class="cuadrito">ESTADO</td>';
echo '<td colspan=2  class="cuadrito">DTTOS.</td>';
echo "</tr>";
echo "<tr>";
echo "<td width=100></td>";
echo "<td width=100></td>";
echo '<td colspan=2 class="borde_tabla">Iniciados</td>';
echo '<td colspan=2  class="borde_tabla">'.number_format($iniciada,0).'</td>';
echo "</tr>";
echo "<tr>";
echo "<td width=100></td>";
echo "<td width=100></td>";
echo '<td colspan=2 class="borde_tabla">Faltan por iniciar</td>';
echo '<td colspan=2  class="borde_tabla">'.number_format((40-$iniciada),0).'</td>';
echo "</tr>";
echo "<tr>";
echo "<td width=100></td>";
echo "<td width=100></td>";
echo '<td colspan=2 class="borde_tabla">Conclu&iacute;dos</td>';
echo '<td colspan=2  class="borde_tabla">'.number_format($concluida,0).'</td>';
echo "</tr>";
echo "<tr>";
echo "<td width=100></td>";
echo "<td width=100></td>";
echo '<td colspan=2 class="borde_tabla">Faltan por concluir</td>';
echo '<td colspan=2  class="borde_tabla">'.number_format((40-$concluida),0).'</td>';
echo "</tr>";
echo "<tr>";

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
   <div id="footer">
	
   		<p>Fecha y hora de la &uacute;ltima actualizaci&oacute;n:<?php echo $fecha_act ?></p>
   </div>
</body>
</html>
