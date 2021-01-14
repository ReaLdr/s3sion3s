<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<title>Slides, A Slideshow Plugin for jQuery</title>
	
	<link rel="stylesheet" href="css/global.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script src="http://gsgd.co.uk/sandbox/jquery/easing/jquery.easing.1.3.js"></script>
	<script src="js/slides.min.jquery.js"></script>
	<script>
		$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				play: 5000,
				pause: 2500,
				hoverPause: true
			});
		});
	</script>
</head>
<body>
	<div id="container">
		<div id="example">
			
			<div id="slides">
				<div class="slides_container">
					<?php
//query para la votacion

//$pto_final=$_POST[punto];
$pto_final=4;
for ($puntos=1;$puntos<=$pto_final;$puntos++){

$sql2 ="SELECT ordendia.idorden,ordendia.idsesion,punto,
CAST(descpunto as CHAR(2048)) as descpunto,ordendia.estatus,votocp,votoc1,votoc2,votoc3,votoc4,votoc5,votoc6,observapunto,sesiones.idsesion,iddistrito,nosesion,descsesion,tiposesion,fechainicioprog,horainicioprog,con_inicio,con_orden,
con_votos, con_intervencion, con_incidente,con_fin,sesiones.estatus,idiniciosesion,iniciosesion.idsesion,fechainicioreal,horainicioreal,
qi_cp,qi_c1,qi_c2,qi_c3,qi_c4,qi_c5,qi_c6,qi_se,qi_panp,qi_pans,qi_prip,qi_pris,
qi_prdp,qi_prds,qi_ptp,qi_pts,qi_pvemp,qi_pvems,qi_convp,qi_convs,qi_pnap,qi_pnas,qi_psp,qi_pss,
qi_prensa,qi_radio,qi_tv,observaini 
FROM ordendia,sesiones,iniciosesion
	WHERE sesiones.idsesion=ordendia.idsesion
	and sesiones.idsesion=iniciosesion.idsesion
	and ordendia.punto=$puntos
	and ordendia.estatus=1
	and sesiones.idsesion in(
							select idsesion from sesiones where nosesion=".$nosesion." 
							and estatus=1 and con_votos=1 and tiposesion=".$typesess."
							and descsesion=".$descsesion.")";

$sql_cuantos="SELECT count(*)as cuantos FROM ordendia,sesiones,iniciosesion
WHERE sesiones.idsesion=ordendia.idsesion
and sesiones.idsesion=iniciosesion.idsesion
and ordendia.punto=$puntos
and ordendia.estatus=1
and sesiones.idsesion in(
select idsesion from sesiones where nosesion=$nosesion and estatus=1 and con_votos=1 and tiposesion=$typesess and descsesion=$descsesion)";
$conteo=ifx_query($sql_cuantos,$conn);
$cuantos=ifx_fetch_row ($conteo);
$cuantos1=$cuantos[cuantos];
//echo $sql_cuantos;
//echo $sql2;
//$result=ifx_query($sql,$conn);
$result=ifx_query($sql2,$conn);
$undato=ifx_fetch_row ($result);
$fecha=$undato[fechainicioreal];
$descripcion=$undato[descpunto];
$desc=$undato[descsesion];
$res=ifx_query($sql2,$conn);
$total=0;
$total6=0;
$total5=0;
$afavor=0;
$encontra=0;
$grantotal=0;
$totalfav=0;
$totalcon=0;
		
                echo "<h3>SENTIDO DE LA VOTACION&nbsp;&nbsp;&nbsp;&nbsp;PUNTO:".$puntos."</h3><p class='resultados'>".utf8_encode($descripcion)."</p>";
                
	
				echo "<table>";
		echo "<tr>";
		if($cuantos1>=1){
			echo '<td colspan=2 class="borde_tabla"><strong>SENTIDO DE LA VOTACI&Oacute;N</strong></td>';
			echo '<td width=239 rowspan=2 class="borde_tabla"><strong>OBSERVACIONES</strong></td>';
		echo "</tr>";

		echo "<tr>";
			echo '<td width=135 class="borde_tabla"><strong>A FAVOR</strong></td>';
			echo '<td width=114 class="borde_tabla"><strong>EN CONTRA</strong></td>';
		echo "</tr>";
		$indice=0;	

while($datos = ifx_fetch_row ($res))
{
	
	$distrito=$datos[iddistrito];
	$votocp=$datos[votocp];
	if($votocp==1)
		$afavor++;
	else
		$encontra++;
	$votoc1=$datos[votoc1];
	if($votoc1==1)
		$afavor++;
	else
		$encontra++;
	
	$votoc2=$datos[votoc2];
	if($votoc2==1)
		$afavor++;
	else
		$encontra++;
	$votoc3=$datos[votoc3];
	if($votoc3==1)
		$afavor++;
	else
		$encontra++;
	$votoc4=$datos[votoc4];
	if($votoc4==1)
		$afavor++;
	else
		$encontra++;
	$votoc5=$datos[votoc5];
	if($votoc5==1)
		$afavor++;
	else
		$encontra++;
	$votoc6=$datos[votoc6];
	if($votoc6==1)
		$afavor++;
	else
		$encontra++;
		
	
	$array_f[$indice]=$afavor;
	$array_c[$indice]=$encontra;
	
	$observaini =  utf8_decode(htmlspecialchars(trim($datos[observapunto])));
	
	//echo'<tr>';
	
		
			if($afavor==6 || $encontra==6 )
				$total6++;			
			
			if($afavor==5 || $encontra==5 )
				$total5++;
				
			if($afavor==7 || $encontra==7 )
				$total++;
			
			
			echo'<td align="center" class="resultados">'.$afavor.'</td>';
			echo'<td align="center" class="resultados">'.$encontra.'</td>';
			
				echo'<td align="center" class="resultados">'.$observaini.'</td>';
			
			
		$grantotal=$total+$total5+$total6;
		
	echo'</tr>';
	
	$afavor=0;
	$encontra=0;
	
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
echo '<td class="resultados">Unanimidad con 6 votos</td>';
echo '<td class="resultados">'.$total6.'</td>';
echo "</tr>";
echo "<tr>";
echo "<td width=100></td>";
echo "<td width=100></td>";
echo '<td class="resultados">Unanimidad con 5 votos</td>';
echo '<td class="resultados">'.$total5.'</td>';
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
	
	$puntos++;
    }
	?>
				</div>
				<a href="#" class="prev"><img src="img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
				<a href="#" class="next"><img src="img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
			</div>
			<img src="img/example-frame.png" width="739" height="341" alt="Example Frame" id="frame">
		</div>
		<div id="footer">
			<p>For full instructions go to <a href="http://slidesjs.com" target="_blank">http://slidesjs.com</a>.</p>
			<p>Slider design by Orman Clark at <a href="http://www.premiumpixels.com/" target="_blank">Premium Pixels</a>. You can donwload the source PSD at <a href="http://www.premiumpixels.com/clean-simple-image-slider-psd/" target="_blank">Premium Pixels</a></p>
			<p>&copy; 2010 <a href="http://nathansearles.com" target="_blank">Nathan Searles</a>. All rights reserved. Slides is licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0" target="_blank">Apache license</a>.</p>
		</div>
	</div>
</body>
</html>
