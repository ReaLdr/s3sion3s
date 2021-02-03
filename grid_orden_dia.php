<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ERROR | E_PARSE);
session_start();
if (isset($_SESSION['user'])) {

$name= $_SESSION['transaccion'];
$grup=$_SESSION['grupo'];
$id_distrito=$_SESSION['id_distrito'];


$nosesion=$_GET['nosesion'];
$id_sesion=$_GET['id_sesion'];
$tipo_sesion=$_GET['tipo_sesion'];

//echo "es el tipo".$tipo_sesion;

include 'arreglos.php';
}
else
{
	echo' alert("Debe iniciar una sesion")';
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
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />


<!--<script src="js/jquery-3.2.1.min.js"></script>-->
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">

<title>.: SISESECD 2018 :.</title>
<script type="text/javascript">
	$(document).ready(function() {

			for(var xx=1; xx<120; xx++)
			{
				$("#liga"+xx).fancybox({
				'width'				: '95%',
				'height'			: '95%',
				'autoScale'			: 'true',
				'transitionIn'		: 'fade',
				'transitionOut'		: 'fade',
				'overlayShow'		: 'true',
				'overlayColor'		: '#666',
				'overlayOpacity'    : 0.6,
				'type'				: 'iframe'
				});
			}

			for(var ii=1; ii<20; ii++)
			{
				$("#nuevoinci"+ii).fancybox({
					'width'				: '95%',
					'height'			: '95%',
					'autoScale'			: 'true',
					'transitionIn'		: 'fade',
					'transitionOut'		: 'fade',
					'overlayShow'		: 'true',
					'overlayColor'		: '#666',
					'overlayOpacity'    : 0.6,
					'type'				: 'iframe'
				});
			}
		});
	</script>
</head>

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
<body>
<div id="container_blanco">

  <?php include('header.php');?>
<!--tabla para todos las pantallas -->
    <body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid">
	            <h1 class="mt-4"><img src="images/logo-header.png"></h1>
	<p>&nbsp;</p>
<div class="top-menu">
<table border="0" style="width: 90%;">
  <tr>
    <td width="159" height="25" align="left" class="well">Usuario: <?php echo $name; ?></td>
    <td width="555" align="left" class="well">Consejo Distritital: <?php echo $id_distrito; ?></td>
    <td width="542" align="center"><?php echo"<a class='btn btn-primary' href='javascript:history.back(-2)'> Menu principal</a>";?></td>

   <td width="169" align="right"><a class="btn btn-default"  href="logout.php">Cerrar Sesi&oacute;n</a></td>
  </tr>
</table>
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><!--fin tabla para todos las pantallas -->
</p>
<table class="table table-bordered table-responsive">
  <tr >
    <td class="fondogris-tabla">Punto</td>
    <td class="fondogris-tabla">Descripción</td>
    <td class="fondogris-tabla" colspan="6" align="center">Acciones</td>
    </tr>

<?php

include ("config_open_db.php");
	
$desc_sesion = $_GET['desc_sesion'];
//////para traer los puntos y crearlos para ese distrito
$sql_opciones="select punto,CAST(desc_punto as CHAR(2084)) as desc_punto,obligatorios,para_votar from sisesecd_ordendia where estatus=1 and id_sesion in (select id_sesion from sisesecd_sesiones where id_distrito=40 and nosesion=".$_REQUEST['nosesion']." and tipo_sesion=".$_REQUEST['tipo_sesion']." AND desc_sesion = $desc_sesion)";
//echo "sql_opciones: " . $sql_opciones."<br>";
$r_opcion=sqlsrv_query($conn,$sql_opciones);


 $id_sesion=$_GET['id_sesion'];
 $sql_validar="select count(*) as cuantos from sisesecd_ordendia where id_sesion=$id_sesion and estatus=1";
// echo  $sql_validar;
 $r_validar=sqlsrv_query($conn,$sql_validar);
 $d_validar=sqlsrv_fetch_array($r_validar);
 $cuantos=$d_validar['cuantos'];

	//echo "cuantos registros de puntos tengo".$cuantos;

////para insertar los puntos
//$idsesion=$_GET['idsesion'];
$indice=0;
if($cuantos<=0){


	while($datos=sqlsrv_fetch_array($r_opcion)){

	$sql_insert="INSERT INTO sisesecd_ordendia(id_sesion, punto, desc_punto,obligatorios,para_votar,estatus,estatus_noaplica) VALUES ($id_sesion, '$datos[punto]', '$datos[desc_punto]',$datos[obligatorios],$datos[para_votar],1,1);";
	sqlsrv_query($conn,$sql_insert);
	//echo $sql_insert."<br>";
	$indice++;

	}

}


/////para traerlos ya con el distrito y pintarlos
//$sql = "select id_orden,id_sesion, punto, CAST(desc_punto as CHAR(2084)) as desc_punto, estatus_noaplica from sisesecd_ordendia where id_sesion=$id_sesion and estatus=1 order by id_orden";

	
	$sql= "SELECT ROW_NUMBER() OVER(
       ORDER BY punto) AS RowNum, * from sisesecd_ordendia A where id_sesion=$id_sesion and punto like 'PP%'
UNION ALL
SELECT ROW_NUMBER() OVER(
       ORDER BY punto) AS RowNum,* from sisesecd_ordendia where id_sesion=$id_sesion and punto not like 'PP%'";
	//echo $sql;

$result=sqlsrv_query($conn,$sql);
$i=0;

while($row =sqlsrv_fetch_array($result))
{

$i++;

$sql_valid="select obligatorios,para_votar from sisesecd_ordendia where estatus=1 and punto='$row[punto]' and id_sesion in (select id_sesion from sisesecd_sesiones where id_distrito=40 and nosesion=".$_REQUEST['nosesion']." and tipo_sesion=".$_REQUEST['tipo_sesion'].")";

	//echo $sql_valid;

$r_valid=sqlsrv_query($conn,$sql_valid);
 $dat=sqlsrv_fetch_array($r_valid);

 $obligatorios=$dat['obligatorios'];
 $avotar=$dat['para_votar'];
 // echo'<td>'.$i.'</td>';
//  echo'<td>'.$datos[idsesion].'</td>';
  echo'<td>'.$row['punto'].'.-</td>';
  $punto=$row['punto'];
  $srt=$row['desc_punto'];
  eval("\$srt = \"$srt\";");
  echo'<td>'.utf8_encode($srt).'</td>';

 // echo"<td><span class='modi3'>";
 // echo"<a href='actualizar2.php?idsesion=".$row['idsesion']."&idorden=".$row['idorden']."'><img src='images/sesion_edit.png' title='Editar' alt='Editar' border='0' /></a></span></td>";


	$noaplica = $row['estatus_noaplica'];

 // echo "no aplica valor <br>:". $noaplica;


  if($avotar==1){

  		if($noaplica==1)
  		{
    	echo "<td><span class='modi4'><a href='actualizar3.php?id_sesion=".$row['id_sesion']."&id_orden=".$row['id_orden']."&nosesion=".$nosesion."'><img src='images/hand.png' title='Registro de la Votación' alt='Registro de la Votación' border='0' /> Votación </a></span></td>";
		}
		else
		{
		echo'<td><img src="images/application_key.png" title="No aplica" alt="No aplica" border="0" /></td>';
		}
  }else
	{
	echo'<td><img src="images/application_key.png" title="No aplica" alt="No aplica" border="0" /></td>';
	}
	  if($noaplica==1)
  {
		echo "<td><span class='interv'><a href='Nueva_intervencion.php?id_sesion=".$row['id_sesion']."&id_orden=".$row['id_orden']."&nosesion=".$nosesion."'><img src='images/lightbulb_add.png' border='0' title='Intervenciones del punto' alt='Intervenciones del punto' /> Nueva intervención</a></span></td>";

	  	echo '<td>
		<a  id="liga'.$i.'" href="grid_intervenciones.php?id_sesion='.$row['id_sesion'].'&id_orden='.$row['id_orden'].'&nosesion='.$nosesion.'&punto='.$punto.'"><img src="images/pen.png" border="0" title="Intervenciones del punto" alt="Intervenciones del punto" /> Edita intervención</a>
		</td>';


	}
	else
	{
	echo'<td><img src="images/application_key.png" title="No aplica" alt="No aplica " border="0" /></td>';
	}

	  if($noaplica==1)
  {

		echo "<td><span class='incid'><a href='Nueva_incidente.php?id_sesion=".$row['id_sesion']."&id_orden=".$row['id_orden']."&nosesion=".$nosesion."'><img src='images/lightning_add.png' title='Incidentes del punto' alt='Incidentes del punto' border='0' /> Nuevo inicidente</a></span></td>";

  	  	echo '<td>
		<a  id="nuevoinci'.$i.'" href="grid_incidentes.php?id_sesion='.$row['id_sesion'].'&id_orden='.$row['id_orden'].'&nosesion='.$nosesion.'&punto='.$punto.'"><img src="images/pen.png" border="0" title="Incidentes del punto" alt="Incidentes del punto" /> Edita incidente</a>
		</td>';
	}
	else
	{
	echo'<td><img src="images/application_key.png" title="No aplica" alt="No aplica" border="0" /></td>';
	}
	if($obligatorios==0){
		if($noaplica==1)
		{
		echo "<td><span class='dele'><a href='inserta_orden.php?id_sesion=".$row['id_sesion']."&id_orden=".$row['id_orden']."&id_distrito=".$id_distrito."'><img src='images/borrar.png' title='Inahbilita' border='0' alt='Inahbilita' /></a></span></td>";
		}
		else
		{
		echo "<td><img src='images/application_key.png' title='No aplica' alt='No aplica' border='0' /></td>";
		echo "<td><img src='images/application_key.png' title='No aplica' alt='No aplica' border='0' /></td>";
		echo "<td><span class='dele'><a href='eliminar_orden.php?id_sesion=".$row['id_sesion']."&id_orden=".$row['id_orden']."&id_distrito=".$id_distrito."'><img src='images/sesion_edit.png' title='Habilita' border='0' alt='Habilita' /></a></span></td>";
		}
	}else{
		echo'<td><img src="images/application_key.png" title="No aplica" alt="No aplica" border="0" /></td>';
		}

		echo "</tr>";
}/// cierra while
?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><br />
</p>
<!-- numero de paginas -->

</div>
</div>


<footer class="py-4 bg-light mt-auto">
        <?php include('footer.php'); ?>
	</footer>

</body>
</html>
