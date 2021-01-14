<?php 
session_start();
error_reporting(E_ERROR | E_PARSE);
$name= $_SESSION['transaccion'];
$grup=$_SESSION['grupo'];
//$grup=$_SESSION[transaccion];
$id_distrito=$_SESSION['id_distrito'];


include 'arreglos.php';
	include("bitacora.php");
	$accion="Ingresa Consejo";
	bitacora($accion);	
//echo 'Bienvenido, ';
if (isset($_SESSION['user'])) {

	
}
else
{
echo' 	alert("Debe iniciar una sesion")';	
	echo'<SCRIPT LANGUAGE="javascript">';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<!--<script src="js/jquery-3.2.1.min.js"></script>-->
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">

<title>.: SISESECD 2018 :.</title>
<script type="text/javascript">
		$(document).ready(function() {			
		
			$("#nuevo").fancybox({
				'width'				: '50%',
				'height'			: '50%',
				'autoScale'			: 'true',
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'overlayShow'		: 'true',
				'overlayColor'		: '#666',
				'overlayOpacity'    : 0.6,
				'type'				: 'iframe'
			});
			
			
			$("#integra").fancybox({
				'width'				: '50%',
				'height'			: '50%',
				'autoScale'			: 'true',
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'overlayShow'		: 'true',
				'overlayColor'		: '#666',
				'overlayOpacity'    : 0.6,
				'type'				: 'iframe'
			});
			
			$("#descarga").fancybox({
				'width'				: '80%',
				'height'			: '80%',
				'autoScale'			: 'true',
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'overlayShow'		: 'true',
				'overlayColor'		: '#666',
				'overlayOpacity'    : 0.6,
				'type'				: 'iframe'
			});

		});
	</script>

<style>
.titulo{

font - family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.blanco_tablas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	text-align : center;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: none;
	color: #FFFFFF;
}
</style>

<script language="javascript">
function detalle(codigophp){
			if (confirm('¿Desea borrar la sesión?'))
				{
	document.location.href ="eliminar_sesion_central.php?idsesion=" + codigophp;
    
			}
			}
	</script>

<body>

<div id="container_blanco">
  <div align="center">
  <div class="header animated fadeIn">
    <div class="animated bounceIn" >
         <img src="images/bann02.png" > 
    </div>  
</div>
<!--tabla para todos las pantallas -->
<div class="top-menu">
<table border="0" style="width: 90%;">
  <tr>
    <td width="222" height="25" align="left" class="well">Usuario: <?php echo $name; ?></td>
    
    <td width="446" align="center" class="well"></td>
    <td width="117" align="right"><a class="btn btn-default" href="logout.php">Cerrar Sesion</a></td>
  </tr>
</table>
</div>
<br />
<br />

<!--fin tabla para todos las pantallas -->
<table class="table table-bordered table-responsive">
  <tr bgcolor="#666666" class="blanco_tablas">

    <td width="208">Descripción</td>
    
    <td width="63">Fecha<br />
      de Inicio Programada</td>
    <td width="68">Hora<br />
      de Inicio Programada</td>
     <!--<td colspan="3">Acciones</td>-->
    <td width="106" colspan="10">Reportes</td>
    </tr>
<!-- entra ciclo -->

<!-- paginador -->

<?php
include ("config_open_db.php"); 
$sql_count= "SELECT count(*) AS cuantos FROM sisesecd_sesiones WHERE id_distrito =$id_distrito and estatus=1;";
$exe_sql_count=ifx_query($sql_count,$conn);
$row_cuantos = ifx_fetch_row ($exe_sql_count);
$cuantos=$row_cuantos[cuantos];
//echo $cuantos;
$n_pages= $cuantos/15;
//echo $n_pages;
$n_pages=ceil($n_pages);
//echo "pages";
//echo $n_pages;
$page=1;
$skip[1]=0;
$skip[2]=15;
$skip[3]=30;
$skip[4]=45;
$skip[5]=60;
$skip[6]=75;
$skip[7]=90;
$skip[8]=105;
$sql = "SELECT FIRST 15 * FROM sisesecd_sesiones WHERE id_distrito='$id_distrito' and estatus=1 order by nosesion ASC";
//$sql = "SELECT id_delegacion, clave_colonia, nombre_colonia from simro_seguimientocap WHERE id_distrito='$id_distrito' order by nombre_colonia";
$result=ifx_query($sql,$conn);
$i=0;
while($datos = ifx_fetch_row ($result))
{
	
//$i++;
  echo'<tr>';
  //echo'<td>'.$i.'</td>';
  //echo'<td>'.$datos[nosesion].'</td>';

  echo'<td>'.$nom_sesion[$datos[nosesion]]." SESION (".$tipo_ses[$datos[tipo_sesion]]." 0".$datos[desc_sesion]." )".'</td>';
  //echo'<td>'.$datos[tiposesion].'</td>';
  echo'<td>'.$datos[fecha_inicio_prog].'</td>';
  echo'<td>'.$datos[hora_inicio_prog].'</td>';

  ?>
 

<?php

  echo'<td><a class="btn btn-default" href="nuevorep.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_new">Reporte de Inicio de Sesion</a></td>';///<img src="images/folderyellow.png" title="Reporte de Inicio de Sesion" alt="Reporte Inicio de Sesion" border="0" />
  echo'<td><a class="btn btn-default" href="repofincen.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_new">Reporte Final de Sesion</a></td>';///<img src="images/foldergreen.png" title="Reporte Final de Sesion" alt="Reporte de Final de Sesion" border="0" />
  echo'<td><a class="btn btn-default" id="nuevo" href="menu_filtro_voto.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_new">Reporte Sentido Voto</a></td>';///<img src="images/folderblue.png" title="Reporte Sentido Voto" alt="Reporte Sentido Voto" border="0" />
  echo'<td><a class="btn btn-default" href="rep05.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_new">Reporte Intervenciones</a></td>';///<img src="images/foldered.png" title="Reporte Intervenciones" alt="Reporte Intervenciones" border="0" />
  echo'<td><a class="btn btn-default" href="rep06.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_new">Reporte de Incidentes</a></td>';///<img src="images/foldergrey.png" title="Reporte de Incidentes" alt="Reporte Incidentes" border="0" />
 echo'<td><a class="btn btn-default" id="integra" href="menu_filtro_dto.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_new">Reporte de Integrantes del Consejo</a></td>';////<img src="images/folderviolet.png" title="Reporte de Integrantes del Consejo" alt="Reporte de Integrantes del CD" border="0" />
echo'<td><a class="btn btn-default" href="repestados_central.php?id_sesion='.$datos[id_sesion].'&id_distrito='.$id_distrito.'" target="_new">Estados de la sesion</a></td>';
	
echo'<td><a class="btn btn-default" id="descarga" href="descargas.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_blank">Descargar Actas 33 Dtos</a></td>';////<img src="images/printer_empty.png" title="Descargar Actas 40Dtos" alt="Reporte Concentrado" border="0" />
echo'<td><a class="btn btn-default" href="sl1d3/examples/multiple/reporte_animado.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_blank">Reporte Seguimiento 1</a></td>';////<img src="images/rpt_incidentes.png" title="Reporte Animado 1" alt="Reporte Concentrado" border="0" />
  
  echo'<td><a class="btn btn-default" href="sl1d3/examples/multiple/reporte_animado2.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_blank">Reporte Seguimiento 2</a></td>';////<img src="images/rpt_intervenciones.png" title="Reporte Animado 2" alt="Reporte Concentrado" border="0" />
  echo'</tr>';
}
?>
</table>
<br />
<br />
</div>
</div>
<div class="footer">
		  <p>Instituto Electoral del Distrito Federal &copy; 2017</p>  
  <p>Huizaches 25 &bull; Colonia Rancho Los Colorines &bull; Delegaci&oacute;n Tlalpan &bull; C.P. 14386 &bull; Ciudad de M&eacute;xico. &bull; Conmutador: (55) 5483 3800 </p>
</div>
</body>
</html>